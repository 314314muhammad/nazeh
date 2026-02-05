
const express = require("express");
const cors = require("cors");
const path = require("path");
const { getPool } = require("./db");

const app = express();
const port = process.env.PORT ? Number(process.env.PORT) : 3000;

app.use(cors());
app.use(express.json({ limit: "5mb" }));
app.use(express.static(path.join(__dirname, "..")));

function normalizeNeeds(needs) {
  if (!needs) return [];
  if (Array.isArray(needs)) return needs;
  try {
    const parsed = JSON.parse(needs);
    return Array.isArray(parsed) ? parsed : [];
  } catch (err) {
    return [];
  }
}

function normalizeValue(value, fallback = null) {
  return value === undefined ? fallback : value;
}

async function fetchBuildings(conn) {
  const [rows] = await conn.query(
    `SELECT b.id, b.name, b.created_at, f.floor_number, f.rooms_count
     FROM buildings b
     LEFT JOIN floors f ON f.building_id = b.id
     ORDER BY b.name, f.floor_number`
  );

  const map = new Map();
  rows.forEach(row => {
    if (!map.has(row.id)) {
      map.set(row.id, {
        id: row.id,
        name: row.name,
        createdAt: row.created_at,
        floors: [],
      });
    }
    if (row.floor_number !== null && row.floor_number !== undefined) {
      map.get(row.id).floors.push({
        floor: row.floor_number,
        rooms: row.rooms_count,
      });
    }
  });

  return Array.from(map.values());
}

function mapPeopleToFamilies(families, peopleRows) {
  const familiesById = new Map();
  families.forEach(family => {
    familiesById.set(family.id, family);
  });

  peopleRows.forEach(person => {
    const family = familiesById.get(person.family_id);
    if (!family) return;

    const base = {
      name: person.name || "",
      age: normalizeValue(person.age, null),
      health: person.health || "سليم",
    };

    if (person.role === "father") {
      family.father = {
        ...base,
        surname: person.surname || "",
        phone: person.phone || "",
      };
      return;
    }

    if (person.role === "mother") {
      family.mother = {
        ...base,
      };
      return;
    }

    if (person.role === "child") {
      family.children.push({
        ...base,
        gender: person.gender || "",
        diaperSize: person.diaper_size || null,
        milkType: person.milk_type || null,
        otherNeeds: person.other_needs || null,
        ageMonths: normalizeValue(person.age_months, null),
      });
      return;
    }

    if (person.role === "relative") {
      family.relatives.push({
        ...base,
        relationship: person.relationship || "",
      });
    }
  });
}

async function fetchFamilies(conn, buildingNameMap) {
  const [familyRows] = await conn.query("SELECT * FROM families");
  const [peopleRows] = await conn.query("SELECT * FROM people");

  const families = familyRows.map(row => ({
    id: row.id,
    composition: row.composition,
    building: row.building_id,
    buildingName: buildingNameMap.get(String(row.building_id)) || row.building_id || "",
    floor: normalizeValue(row.floor_number, null),
    room: normalizeValue(row.room_number, null),
    needs: normalizeNeeds(row.needs_json),
    adminNotes: row.admin_notes || "",
    father: null,
    mother: null,
    children: [],
    relatives: [],
  }));

  mapPeopleToFamilies(families, peopleRows);
  return families;
}

async function replaceAllData(conn, payload) {
  const buildings = Array.isArray(payload.buildings) ? payload.buildings : [];
  const families = Array.isArray(payload.families) ? payload.families : [];

  await conn.beginTransaction();
  try {
    await conn.query("DELETE FROM people");
    await conn.query("DELETE FROM families");
    await conn.query("DELETE FROM floors");
    await conn.query("DELETE FROM buildings");

    for (const building of buildings) {
      await conn.query(
        "INSERT INTO buildings (id, name, created_at) VALUES (?, ?, ?)",
        [
          String(building.id),
          building.name || "",
          building.createdAt || null,
        ]
      );

      const floors = Array.isArray(building.floors) ? building.floors : [];
      for (const floor of floors) {
        await conn.query(
          "INSERT INTO floors (building_id, floor_number, rooms_count) VALUES (?, ?, ?)",
          [
            String(building.id),
            Number(floor.floor),
            Number(floor.rooms),
          ]
        );
      }
    }

    for (const family of families) {
      await conn.query(
        `INSERT INTO families
          (id, composition, building_id, floor_number, room_number, admin_notes, needs_json, created_at)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)`
        ,
        [
          String(family.id),
          family.composition || "no-family",
          family.building ? String(family.building) : null,
          family.floor !== undefined && family.floor !== null ? Number(family.floor) : null,
          family.room !== undefined && family.room !== null ? Number(family.room) : null,
          family.adminNotes || "",
          JSON.stringify(Array.isArray(family.needs) ? family.needs : []),
          family.createdAt || null,
        ]
      );

      const people = [];
      if (family.father?.name) {
        people.push({
          role: "father",
          roleLabel: "الأب",
          name: family.father.name,
          surname: family.father.surname || "",
          gender: "ذكر",
          age: normalizeValue(family.father.age, null),
          phone: family.father.phone || "",
          health: family.father.health || "سليم",
        });
      }
      if (family.mother?.name) {
        people.push({
          role: "mother",
          roleLabel: "الأم",
          name: family.mother.name,
          surname: family.father?.surname || "",
          gender: "أنثى",
          age: normalizeValue(family.mother.age, null),
          phone: "",
          health: family.mother.health || "سليم",
        });
      }

      (family.children || []).forEach(child => {
        people.push({
          role: "child",
          roleLabel: "ابن",
          name: child.name || "",
          surname: family.father?.surname || "",
          gender: child.gender || "",
          age: normalizeValue(child.age, null),
          phone: "",
          health: child.health || "سليم",
          ageMonths: normalizeValue(child.ageMonths, null),
          diaperSize: child.diaperSize || null,
          milkType: child.milkType || null,
          otherNeeds: child.otherNeeds || null,
        });
      });

      (family.relatives || []).forEach(relative => {
        people.push({
          role: "relative",
          roleLabel: relative.relationship || "قريب",
          name: relative.name || "",
          surname: family.father?.surname || "",
          gender: "",
          age: normalizeValue(relative.age, null),
          phone: "",
          health: relative.health || "سليم",
          relationship: relative.relationship || "",
        });
      });

      for (const person of people) {
        await conn.query(
          `INSERT INTO people
            (family_id, role, role_label, name, surname, relationship, gender, age, phone, health, age_months, diaper_size, milk_type, other_needs)
           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`
          ,
          [
            String(family.id),
            person.role,
            person.roleLabel || "",
            person.name || "",
            person.surname || "",
            person.relationship || null,
            person.gender || null,
            person.age !== undefined && person.age !== null ? Number(person.age) : null,
            person.phone || null,
            person.health || "",
            person.ageMonths !== undefined && person.ageMonths !== null ? Number(person.ageMonths) : null,
            person.diaperSize || null,
            person.milkType || null,
            person.otherNeeds || null,
          ]
        );
      }
    }

    await conn.commit();
  } catch (error) {
    await conn.rollback();
    throw error;
  }
}

app.get("/api/health", async (req, res) => {
  try {
    const pool = getPool();
    await pool.query("SELECT 1");
    res.json({ ok: true });
  } catch (error) {
    res.status(500).json({ ok: false, error: error.message });
  }
});

app.get("/api/summary", async (req, res) => {
  try {
    const pool = getPool();
    const [[buildingsCount]] = await pool.query("SELECT COUNT(*) AS count FROM buildings");
    const [[familiesCount]] = await pool.query("SELECT COUNT(*) AS count FROM families");
    const [[peopleCount]] = await pool.query("SELECT COUNT(*) AS count FROM people");
    res.json({
      totalBuildings: buildingsCount.count,
      totalFamilies: familiesCount.count,
      totalPeople: peopleCount.count,
    });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

app.get("/api/data", async (req, res) => {
  try {
    const pool = getPool();
    const buildings = await fetchBuildings(pool);
    const buildingNameMap = new Map(
      buildings.map(building => [String(building.id), building.name])
    );
    const families = await fetchFamilies(pool, buildingNameMap);
    res.json({ buildings, families });
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

app.put("/api/data", async (req, res) => {
  try {
    const pool = getPool();
    await replaceAllData(pool, req.body || {});
    res.json({ ok: true });
  } catch (error) {
    res.status(500).json({ ok: false, error: error.message });
  }
});

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});
