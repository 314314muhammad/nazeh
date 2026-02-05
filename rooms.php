<!doctype html>
<html lang="ar" dir="rtl" class="page-rooms">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
    />
    <title>نظام الإسكان الذكي - صفحة الغرف</title>
    <link
      rel="icon"
      href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🏠</text></svg>"
    />

    <link
      href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="style.css" />

    
  </head>
  <body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="container">
      <div
        style="
          display: flex;
          justify-content: space-between;
          align-items: center;
          flex-wrap: wrap;
          gap: 1rem;
          margin-bottom: 2rem;
        "
      >
        <div>
          <h1 style="font-size: 2rem; font-weight: 700; margin: 0 0 0.5rem 0;">
            <i class="fas fa-door-open" style="margin-left: 0.5rem; color: var(--monochrome-4);"></i>
            صفحة الغرف والسكنات
          </h1>
          <p style="color: var(--text-muted); margin: 0;">
            عرض تفاصيل الغرف وإشغالها مع فلاتر متقدمة
          </p>
        </div>
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center;">
          <div class="theme-switcher" role="group" aria-label="اختيار الثيم">
            <button type="button" class="theme-btn" data-theme="dark">غامق</button>
            <button type="button" class="theme-btn" data-theme="burgundy">أبيض</button>
          </div>
          <a href="index_modified.php" class="btn-primary">
            <i class="fas fa-home"></i>
            الرئيسية
          </a>
          <a href="families_management.php" class="btn-primary">
            <i class="fas fa-users"></i>
            إدارة العائلات
          </a>
          <a href="people.php" class="btn-primary">
            <i class="fas fa-address-book"></i>
            دليل السكان
          </a>
        </div>
      </div>

      <div class="glass-panel" style="padding: 1.5rem; margin-bottom: 1.5rem;">
        <div class="filters-grid">
          <input
            id="search-input"
            type="text"
            class="glass-input"
            placeholder="ابحث باسم العائلة أو رقم الغرفة"
          />
          <select id="filter-building" class="glass-input">
            <option value="">كل المباني</option>
          </select>
          <select id="filter-floor" class="glass-input">
            <option value="">كل الطوابق</option>
          </select>
          <select id="filter-status" class="glass-input">
            <option value="all">كل الحالات</option>
            <option value="empty">غرف فارغة</option>
            <option value="occupied">غرف مشغولة</option>
            <option value="shared">غرف مشتركة</option>
          </select>
          <select id="filter-sort" class="glass-input">
            <option value="default">ترتيب افتراضي</option>
            <option value="building">حسب المبنى</option>
            <option value="floor">حسب الطابق</option>
            <option value="room">حسب رقم الغرفة</option>
            <option value="families">حسب عدد العائلات</option>
            <option value="status">حسب الحالة</option>
          </select>
        </div>
        <div class="actions-bar">
          <div class="action-group">
            <button id="manage-building" class="btn-primary" type="button" disabled>
              <i class="fas fa-building"></i>
              إدارة المبنى المحدد
            </button>
            <button id="refresh-data" class="btn-primary" type="button">
              <i class="fas fa-rotate-right"></i>
              تحديث البيانات
            </button>
            <button id="export-csv" class="btn-primary" type="button">
              <i class="fas fa-file-csv"></i>
              تصدير CSV
            </button>
            <button id="copy-summary" class="btn-primary" type="button">
              <i class="fas fa-copy"></i>
              نسخ ملخص
            </button>
          </div>
          <button id="reset-filters" class="btn-primary" type="button">
            <i class="fas fa-rotate"></i>
            مسح الفلاتر
          </button>
        </div>
      </div>

      <div class="stats-grid">
        <div class="glass-panel stat-card">
          <div class="stat-title">إجمالي الغرف</div>
          <div id="stat-total-rooms" class="stat-value">0</div>
        </div>
        <div class="glass-panel stat-card">
          <div class="stat-title">غرف مشغولة</div>
          <div id="stat-occupied-rooms" class="stat-value">0</div>
        </div>
        <div class="glass-panel stat-card">
          <div class="stat-title">غرف فارغة</div>
          <div id="stat-empty-rooms" class="stat-value">0</div>
        </div>
        <div class="glass-panel stat-card">
          <div class="stat-title">غرف مشتركة</div>
          <div id="stat-shared-rooms" class="stat-value">0</div>
        </div>
        <div class="glass-panel stat-card">
          <div class="stat-title">نسبة الإشغال</div>
          <div id="stat-occupancy-rate" class="stat-value">0%</div>
        </div>
      </div>

      <h3 class="section-title">
        <i class="fas fa-chart-line" style="color: var(--monochrome-4);"></i>
        مؤشرات إضافية
      </h3>
      <div class="info-grid">
        <div class="info-card">
          <div class="info-title">إجمالي المباني</div>
          <div id="info-total-buildings" class="info-value">0</div>
        </div>
        <div class="info-card">
          <div class="info-title">إجمالي الطوابق</div>
          <div id="info-total-floors" class="info-value">0</div>
        </div>
        <div class="info-card">
          <div class="info-title">إجمالي العائلات</div>
          <div id="info-total-families" class="info-value">0</div>
        </div>
        <div class="info-card">
          <div class="info-title">متوسط العائلات لكل غرفة</div>
          <div id="info-average-families" class="info-value">0</div>
        </div>
        <div class="info-card">
          <div class="info-title">متوسط الأفراد لكل غرفة</div>
          <div id="info-average-people" class="info-value">0</div>
        </div>
        <div class="info-card">
          <div class="info-title">نسبة الغرف المشتركة</div>
          <div id="info-shared-rate" class="info-value">0%</div>
        </div>
      </div>

      <h3 class="section-title">
        <i class="fas fa-building" style="color: var(--monochrome-4);"></i>
        ملخص المباني
      </h3>
      <div id="building-summary" class="building-grid"></div>

      <div class="results-count">
        عدد النتائج: <span id="results-count">0</span> • آخر تحديث: <span id="last-updated">-</span>
      </div>
      <div id="rooms-grid" class="rooms-grid"></div>
    </div>

    <script src="script.js"></script>
    <script>
      const STORAGE_KEY = "housing_data";
      const BUILDINGS_KEY = "housing_buildings";
      const THEME_KEY = "ui_theme";

      let families = [];
      let buildings = [];
      let rooms = [];
      let lastFilteredRooms = [];

      const filters = {
        search: "",
        building: "",
        floor: "",
        status: "all",
        sort: "default",
      };

      function setActiveThemeButton() {
        document.querySelectorAll(".theme-btn").forEach(btn => {
          btn.classList.toggle("active", btn.dataset.theme === currentTheme);
        });
      }

      let currentTheme = "dark";
      function applyTheme(theme, options = {}) {
        currentTheme = theme || "dark";
        document.documentElement.setAttribute("data-theme", currentTheme);
        if (!options.skipSave) {
          localStorage.setItem(THEME_KEY, currentTheme);
        }
        setActiveThemeButton();
      }

      function initTheme() {
        const savedTheme = localStorage.getItem(THEME_KEY);
        applyTheme(savedTheme || "dark", { skipSave: true });
      }

      async function loadData() {
        const data = await AppUtils.loadAllData();
        buildings = data.buildings || [];
        families = data.families || [];
      }

      function buildRooms() {
        rooms = [];
        buildings.forEach(building => {
          const floors = Array.isArray(building.floors) ? building.floors : [];
          floors.forEach(floor => {
            const roomsCount = parseInt(floor.rooms, 10) || 0;
            for (let i = 1; i <= roomsCount; i++) {
              const roomFamilies = families.filter(f =>
                f.building == building.id &&
                f.floor == floor.floor &&
                f.room == i
              );
              const status = roomFamilies.length === 0
                ? "empty"
                : roomFamilies.length === 1
                  ? "occupied"
                  : "shared";

              rooms.push({
                id: `${building.id}::${floor.floor}::${i}`,
                buildingId: building.id,
                buildingName: building.name,
                floor: floor.floor,
                room: i,
                families: roomFamilies,
                status
              });
            }
          });
        });
      }

      function populateBuildingFilter() {
        const select = document.getElementById("filter-building");
        select.innerHTML = '<option value="">كل المباني</option>';
        buildings.forEach(building => {
          const option = document.createElement("option");
          option.value = building.id;
          option.textContent = building.name;
          select.appendChild(option);
        });
      }

      function populateFloorFilter() {
        const select = document.getElementById("filter-floor");
        select.innerHTML = '<option value="">كل الطوابق</option>';

        const floorsSet = new Set();
        if (filters.building) {
          const building = buildings.find(b => String(b.id) === String(filters.building));
          const floors = Array.isArray(building?.floors) ? building.floors : [];
          floors.forEach(floor => floorsSet.add(String(floor.floor)));
        } else {
          buildings.forEach(building => {
            const floors = Array.isArray(building.floors) ? building.floors : [];
            floors.forEach(floor => floorsSet.add(String(floor.floor)));
          });
        }

        Array.from(floorsSet).sort((a, b) => Number(a) - Number(b)).forEach(floorValue => {
          const option = document.createElement("option");
          option.value = floorValue;
          option.textContent = `الطابق ${floorValue}`;
          select.appendChild(option);
        });
      }

      function updateManageBuildingButton() {
        const button = document.getElementById("manage-building");
        if (!button) return;
        if (filters.building) {
          button.disabled = false;
          button.dataset.buildingId = filters.building;
        } else {
          button.disabled = true;
          button.dataset.buildingId = "";
        }
      }

      function getFamilyLabel(family) {
        return (
          family.father?.name ||
          family.mother?.name ||
          family.father?.surname ||
          family.mother?.surname ||
          "عائلة بدون اسم"
        );
      }

      function getFamilyMembersCount(family) {
        let count = 0;
        if (family.father?.name) count++;
        if (family.mother?.name) count++;
        if (family.children?.length) count += family.children.length;
        if (family.relatives?.length) count += family.relatives.length;
        return count;
      }

      function getCompositionLabel(composition) {
        const labels = {
          "father-mother-children": "عائلة كاملة",
          "father-only": "أب فقط",
          "mother-only": "أم فقط",
          "mother-children-only": "أم وأبناء",
          "father-children-only": "أب وأبناء",
          "no-family": "بدون عائلة",
        };
        return labels[composition] || "غير محدد";
      }

      function sortRooms(list) {
        if (filters.sort === "default") {
          return list;
        }

        const sorted = list.slice();
        const statusOrder = { shared: 0, occupied: 1, empty: 2 };

        sorted.sort((a, b) => {
          if (filters.sort === "building") {
            const nameCompare = a.buildingName.localeCompare(b.buildingName, "ar");
            if (nameCompare !== 0) return nameCompare;
            if (a.floor !== b.floor) return a.floor - b.floor;
            return a.room - b.room;
          }
          if (filters.sort === "floor") {
            if (a.floor !== b.floor) return a.floor - b.floor;
            return a.room - b.room;
          }
          if (filters.sort === "room") {
            if (a.room !== b.room) return a.room - b.room;
            return a.floor - b.floor;
          }
          if (filters.sort === "families") {
            if (b.families.length !== a.families.length) {
              return b.families.length - a.families.length;
            }
            return a.room - b.room;
          }
          if (filters.sort === "status") {
            const statusCompare = statusOrder[a.status] - statusOrder[b.status];
            if (statusCompare !== 0) return statusCompare;
            return a.room - b.room;
          }
          return 0;
        });

        return sorted;
      }

      function applyFilters() {
        const searchTerm = filters.search.trim().toLowerCase();

        const filtered = rooms.filter(room => {
          const matchesBuilding = !filters.building || String(room.buildingId) === String(filters.building);
          const matchesFloor = !filters.floor || String(room.floor) === String(filters.floor);
          const matchesStatus = filters.status === "all" || room.status === filters.status;

          let matchesSearch = true;
          if (searchTerm) {
            const roomText = `${room.buildingName} ${room.floor} ${room.room}`.toLowerCase();
            const familyText = room.families.map(getFamilyLabel).join(" ").toLowerCase();
            matchesSearch = roomText.includes(searchTerm) || familyText.includes(searchTerm);
          }

          return matchesBuilding && matchesFloor && matchesStatus && matchesSearch;
        });

        const sorted = sortRooms(filtered);
        lastFilteredRooms = sorted;
        renderRooms(sorted);
        updateResultsCount(sorted.length);
      }

      function renderRooms(list) {
        const grid = document.getElementById("rooms-grid");
        grid.innerHTML = "";

        if (!list.length) {
          grid.innerHTML = `
            <div class="empty-state">
              <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 0.75rem; display: block;"></i>
              لا توجد غرف مطابقة للفلاتر الحالية
            </div>
          `;
          return;
        }

        list.forEach(room => {
          const card = document.createElement("div");
          card.className = "glass-panel room-card";

          const statusLabel = room.status === "empty"
            ? "فارغة"
            : room.status === "occupied"
              ? "مشغولة"
              : "مشتركة";

          const totalPeople = room.families.reduce((sum, fam) => sum + getFamilyMembersCount(fam), 0);
          const familiesHtml = room.families.length
            ? room.families.map(fam => {
                const label = getFamilyLabel(fam);
                const composition = getCompositionLabel(fam.composition);
                const count = getFamilyMembersCount(fam);
                return `• ${label} (${composition} • ${count} أفراد)`;
              }).join("<br>")
            : "لا توجد عوائل";

          card.innerHTML = `
            <div class="room-header">
              <div class="room-title">${room.buildingName} • غرفة ${room.room}</div>
              <span class="status-pill status-${room.status}">${statusLabel}</span>
            </div>
            <div class="room-meta">
              الطابق ${room.floor} • العوائل ${room.families.length} • الأفراد ${totalPeople}
            </div>
            <div class="room-families">
              ${familiesHtml}
            </div>
            <div class="room-tags">
              <span class="room-tag">الحالة: ${statusLabel}</span>
              <span class="room-tag">عوائل: ${room.families.length}</span>
              <span class="room-tag">أفراد: ${totalPeople}</span>
            </div>
          `;

          grid.appendChild(card);
        });
      }

      function updateStats() {
        const totalRooms = rooms.length;
        const occupiedRooms = rooms.filter(r => r.status !== "empty").length;
        const sharedRooms = rooms.filter(r => r.status === "shared").length;
        const emptyRooms = totalRooms - occupiedRooms;
        const occupancyRate = totalRooms > 0
          ? Math.round((occupiedRooms / totalRooms) * 100)
          : 0;

        document.getElementById("stat-total-rooms").textContent = totalRooms;
        document.getElementById("stat-occupied-rooms").textContent = occupiedRooms;
        document.getElementById("stat-shared-rooms").textContent = sharedRooms;
        document.getElementById("stat-empty-rooms").textContent = emptyRooms;
        document.getElementById("stat-occupancy-rate").textContent = `${occupancyRate}%`;

        updateAdvancedStats({ totalRooms, occupiedRooms, sharedRooms, emptyRooms });
        updateBuildingSummaries();
        updateLastUpdatedTime();
      }

      function updateAdvancedStats(roomStats) {
        const totalBuildings = buildings.length;
        const totalFloors = buildings.reduce((sum, building) => {
          const floors = Array.isArray(building.floors) ? building.floors : [];
          return sum + floors.length;
        }, 0);
        const totalFamilies = families.length;
        const totalPeople = families.reduce((sum, fam) => sum + getFamilyMembersCount(fam), 0);
        const averageFamilies = roomStats.totalRooms > 0
          ? (totalFamilies / roomStats.totalRooms).toFixed(2)
          : "0";
        const averagePeople = roomStats.totalRooms > 0
          ? (totalPeople / roomStats.totalRooms).toFixed(2)
          : "0";
        const sharedRate = roomStats.totalRooms > 0
          ? Math.round((roomStats.sharedRooms / roomStats.totalRooms) * 100)
          : 0;

        document.getElementById("info-total-buildings").textContent = totalBuildings;
        document.getElementById("info-total-floors").textContent = totalFloors;
        document.getElementById("info-total-families").textContent = totalFamilies;
        document.getElementById("info-average-families").textContent = averageFamilies;
        document.getElementById("info-average-people").textContent = averagePeople;
        document.getElementById("info-shared-rate").textContent = `${sharedRate}%`;
      }

      function updateBuildingSummaries() {
        const container = document.getElementById("building-summary");
        if (!container) return;
        container.innerHTML = "";

        if (buildings.length === 0) {
          container.innerHTML = `
            <div class="empty-state">
              لا توجد مباني مسجلة حالياً.
            </div>
          `;
          return;
        }

        buildings.forEach(building => {
          const floors = Array.isArray(building.floors) ? building.floors : [];
          let totalRooms = 0;
          floors.forEach(floor => {
            totalRooms += parseInt(floor.rooms, 10) || 0;
          });

          const roomUsage = new Map();
          families.forEach(fam => {
            if (fam.building != building.id || !fam.floor || !fam.room) return;
            const key = `${fam.floor}::${fam.room}`;
            roomUsage.set(key, (roomUsage.get(key) || 0) + 1);
          });

          let sharedRooms = 0;
          roomUsage.forEach(count => {
            if (count > 1) sharedRooms++;
          });

          const occupiedRooms = roomUsage.size;
          const emptyRooms = Math.max(totalRooms - occupiedRooms, 0);
          const occupancyRate = totalRooms > 0
            ? Math.round((occupiedRooms / totalRooms) * 100)
            : 0;

          const card = document.createElement("div");
          card.className = "glass-panel building-card";
          card.innerHTML = `
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
              <div style="font-weight: 700;">${building.name}</div>
              <div style="font-size: 0.85rem; color: var(--text-muted);">
                ${occupiedRooms}/${totalRooms}
              </div>
            </div>
            <div class="progress-track">
              <div class="progress-fill" style="width: ${occupancyRate}%;"></div>
            </div>
            <div style="margin-top: 0.75rem; font-size: 0.85rem; color: var(--text-muted);">
              إشغال: ${occupancyRate}% • غرف فارغة: ${emptyRooms} • غرف مشتركة: ${sharedRooms}
            </div>
            <div style="margin-top: 0.75rem; text-align: left;">
              <button type="button" class="btn-primary btn-mini" data-building="${building.id}">
                عرض غرف المبنى
              </button>
            </div>
          `;
          card.querySelector("button")?.addEventListener("click", () => {
            filters.building = String(building.id);
            filters.floor = "";
            document.getElementById("filter-building").value = String(building.id);
            document.getElementById("filter-floor").value = "";
            populateFloorFilter();
            updateManageBuildingButton();
            applyFilters();
          });
          container.appendChild(card);
        });
      }

      function updateResultsCount(count) {
        const el = document.getElementById("results-count");
        if (el) el.textContent = count;
      }

      function updateLastUpdatedTime() {
        const el = document.getElementById("last-updated");
        if (!el) return;
        el.textContent = new Date().toLocaleString("ar-EG");
      }

      function exportFilteredRoomsCsv() {
        if (!lastFilteredRooms.length) {
          alert("لا توجد نتائج لتصديرها.");
          return;
        }

        const header = [
          "المبنى",
          "الطابق",
          "الغرفة",
          "الحالة",
          "عدد العائلات",
          "عدد الأفراد",
          "العائلات"
        ];

        const rows = lastFilteredRooms.map(room => {
          const totalPeople = room.families.reduce((sum, fam) => sum + getFamilyMembersCount(fam), 0);
          const familiesList = room.families.map(fam => getFamilyLabel(fam)).join(" | ");
          const statusLabel = room.status === "empty"
            ? "فارغة"
            : room.status === "occupied"
              ? "مشغولة"
              : "مشتركة";
          return [
            room.buildingName,
            room.floor,
            room.room,
            statusLabel,
            room.families.length,
            totalPeople,
            familiesList
          ];
        });

        const csvContent = [header, ...rows]
          .map(row => row.map(value => `"${String(value ?? "").replace(/\"/g, '""')}"`).join(","))
          .join("\n");

        const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
        const url = URL.createObjectURL(blob);
        const link = document.createElement("a");
        link.href = url;
        link.download = "rooms_report.csv";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
      }

      function copySummaryToClipboard() {
        const summary = [
          `إجمالي الغرف: ${document.getElementById("stat-total-rooms").textContent}`,
          `غرف مشغولة: ${document.getElementById("stat-occupied-rooms").textContent}`,
          `غرف فارغة: ${document.getElementById("stat-empty-rooms").textContent}`,
          `غرف مشتركة: ${document.getElementById("stat-shared-rooms").textContent}`,
          `نسبة الإشغال: ${document.getElementById("stat-occupancy-rate").textContent}`,
          `إجمالي العائلات: ${document.getElementById("info-total-families").textContent}`,
          `متوسط العائلات لكل غرفة: ${document.getElementById("info-average-families").textContent}`,
        ].join("\n");

        if (navigator.clipboard) {
          navigator.clipboard.writeText(summary).then(() => {
            const btn = document.getElementById("copy-summary");
            if (btn) {
              const original = btn.innerHTML;
              btn.innerHTML = `<i class="fas fa-check"></i> تم النسخ`;
              setTimeout(() => { btn.innerHTML = original; }, 1200);
            }
          });
        } else {
          alert(summary);
        }
      }

      async function refreshData() {
        await AppUtils.trySyncPending();
        const currentBuilding = filters.building;
        const currentFloor = filters.floor;
        await loadData();
        buildRooms();
        populateBuildingFilter();
        if (currentBuilding) {
          filters.building = currentBuilding;
          document.getElementById("filter-building").value = currentBuilding;
        }
        populateFloorFilter();
        if (currentFloor) {
          filters.floor = currentFloor;
          document.getElementById("filter-floor").value = currentFloor;
        }
        updateManageBuildingButton();
        updateStats();
        applyFilters();
      }

      function resetFilters() {
        filters.search = "";
        filters.building = "";
        filters.floor = "";
        filters.status = "all";
        filters.sort = "default";
        document.getElementById("search-input").value = "";
        document.getElementById("filter-building").value = "";
        document.getElementById("filter-floor").value = "";
        document.getElementById("filter-status").value = "all";
        document.getElementById("filter-sort").value = "default";
        populateFloorFilter();
        updateManageBuildingButton();
        applyFilters();
      }

      function applyUrlFilters() {
        const params = new URLSearchParams(window.location.search);
        const statusParam = params.get("status");
        const buildingParam = params.get("building");
        const floorParam = params.get("floor");
        const searchParam = params.get("search");
        const sortParam = params.get("sort");

        if (buildingParam) {
          filters.building = buildingParam;
          document.getElementById("filter-building").value = buildingParam;
        }

        populateFloorFilter();
        updateManageBuildingButton();

        if (floorParam) {
          filters.floor = floorParam;
          document.getElementById("filter-floor").value = floorParam;
        }

        if (statusParam) {
          filters.status = statusParam;
          document.getElementById("filter-status").value = statusParam;
        }

        if (sortParam) {
          filters.sort = sortParam;
          document.getElementById("filter-sort").value = sortParam;
        }

        if (searchParam) {
          filters.search = searchParam;
          document.getElementById("search-input").value = searchParam;
        }
      }

      document.addEventListener("DOMContentLoaded", async () => {
        initTheme();
        document.querySelectorAll(".theme-btn").forEach(btn => {
          btn.addEventListener("click", () => applyTheme(btn.dataset.theme));
        });

        await AppUtils.trySyncPending();
        await loadData();
        buildRooms();
        populateBuildingFilter();
        populateFloorFilter();
        applyUrlFilters();
        updateStats();
        applyFilters();
        updateManageBuildingButton();

        document.getElementById("search-input").addEventListener("input", e => {
          filters.search = e.target.value;
          applyFilters();
        });
        document.getElementById("filter-building").addEventListener("change", e => {
          filters.building = e.target.value;
          filters.floor = "";
          document.getElementById("filter-floor").value = "";
          populateFloorFilter();
          updateManageBuildingButton();
          applyFilters();
        });
        document.getElementById("filter-floor").addEventListener("change", e => {
          filters.floor = e.target.value;
          applyFilters();
        });
        document.getElementById("filter-status").addEventListener("change", e => {
          filters.status = e.target.value;
          applyFilters();
        });
        document.getElementById("filter-sort").addEventListener("change", e => {
          filters.sort = e.target.value;
          applyFilters();
        });
        document.getElementById("reset-filters").addEventListener("click", resetFilters);
        document.getElementById("manage-building").addEventListener("click", e => {
          const buildingId = e.currentTarget.dataset.buildingId;
          if (!buildingId) return;
          window.location.href = `index_modified.php?building=${encodeURIComponent(buildingId)}`;
        });
        document.getElementById("refresh-data").addEventListener("click", refreshData);
        document.getElementById("export-csv").addEventListener("click", exportFilteredRoomsCsv);
        document.getElementById("copy-summary").addEventListener("click", copySummaryToClipboard);
      });
    </script>
  </body>
</html>
