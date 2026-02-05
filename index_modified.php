
<!doctype html>
<html lang="ar" dir="rtl" class="page-index">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
    />
    <title>نظام الإسكان الذكي - لوحة التحكم</title>
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
    <script src="https://cdn.tailwindcss.com"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    
  </head>
  <body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="container" style="padding: 2rem 1rem">
      <!-- Header Section -->
      <div
        style="
          display: flex;
          justify-content: space-between;
          align-items: start;
          flex-wrap: wrap;
          gap: 1rem;
          margin-bottom: 2rem;
        "
      >
        <div>
          <h1
            style="
              font-size: 2rem;
              font-weight: 700;
              margin: 0 0 0.5rem 0;
              color: var(--text-color);
            "
          >
            <i
              class="fas fa-home"
              style="margin-left: 0.5rem; color: var(--monochrome-4)"
            ></i>
            مدرسة الصناعة - لوحة التحكم
          </h1>
          <p style="color: var(--text-muted); margin: 0">
            لوحة التحكم الرئيسية
          </p>
          <p id="current-date" style="color: var(--text-muted); margin: 0.25rem 0 0; font-size: 0.9rem;">
            آخر تحديث: -
          </p>
        </div>
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap">
          <div class="theme-switcher" role="group" aria-label="اختيار الثيم">
            <button type="button" class="theme-btn" data-theme="dark">
              غامق
            </button>
            <button type="button" class="theme-btn" data-theme="burgundy">
              أبيض 
            </button>
          </div>
          <button
            onclick="openBuildingModal()"
            class="btn-primary"
            style="display: flex; align-items: center; gap: 0.5rem"
          >
            <i class="fas fa-plus"></i>
            إضافة مبنى جديد
          </button>
          <a
            href="families_management.php"
            class="btn-primary"
            style="
              display: flex;
              align-items: center;
              gap: 0.5rem;
              text-decoration: none;
            "
          >
            <i class="fas fa-users"></i>
            إدارة العائلات
          </a>
          <a
            href="people.php"
            class="btn-primary"
            style="
              display: flex;
              align-items: center;
              gap: 0.5rem;
              text-decoration: none;
            "
          >
            <i class="fas fa-address-book"></i>
            دليل السكان
          </a>
          <a
            href="rooms.php"
            class="btn-primary"
            style="
              display: flex;
              align-items: center;
              gap: 0.5rem;
              text-decoration: none;
            "
          >
            <i class="fas fa-door-open"></i>
            صفحة الغرف
          </a>
        </div>
      </div>

      <!-- Quick Stats Cards -->
      <div
        style="
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
          gap: 1rem;
          margin-bottom: 2rem;
        "
      >
        <button type="button" class="glass-panel stat-btn" style="padding: 1.5rem" onclick="scrollToSection('building')">
          <div style="display: flex; align-items: center; gap: 1rem">
            <div
              style="
                width: 50px;
                height: 50px;
                border-radius: 12px;
                background: var(--stat-1-bg);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--stat-1-fg);
              "
            >
              <i class="fas fa-building"></i>
            </div>
            <div>
              <div
                style="
                  font-size: 0.9rem;
                  color: var(--text-muted);
                  margin-bottom: 0.25rem;
                "
              >
                إجمالي المباني
              </div>
              <div
                id="total-buildings"
                style="
                  font-size: 2rem;
                  font-weight: 700;
                  color: var(--text-color);
                "
              >
                0
              </div>
            </div>
          </div>
        </button>
        <button type="button" class="glass-panel stat-btn" style="padding: 1.5rem" onclick="window.location.href='families_management.php#fam'">
          <div style="display: flex; align-items: center; gap: 1rem">
            <div
              style="
                width: 50px;
                height: 50px;
                border-radius: 12px;
                background: var(--stat-2-bg);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--stat-2-fg);
              "
            >
              <i class="fas fa-home"></i>
            </div>
            <div>
              <div
                style="
                  font-size: 0.9rem;
                  color: var(--text-muted);
                  margin-bottom: 0.25rem;
                "
              >
                إجمالي العوائل
              </div>
              <div
                id="total-families"
                style="
                  font-size: 2rem;
                  font-weight: 700;
                  color: var(--text-color);
                "
              >
                0
              </div>
            </div>
          </div>
        </button>
        
        <button type="button" class="glass-panel stat-btn" style="padding: 1.5rem" onclick="window.location.href='people.php'">
          <div style="display: flex; align-items: center; gap: 1rem">
            <div
              style="
                width: 50px;
                height: 50px;
                border-radius: 12px;
                background: var(--stat-3-bg);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--stat-3-fg);
              "
            >
              <i class="fas fa-users"></i>
            </div>
            <div>
              <div
                style="
                  font-size: 0.9rem;
                  color: var(--text-muted);
                  margin-bottom: 0.25rem;
                "
              >
                إجمالي السكان
              </div>
              <div
                id="total-people"
                style="
                  font-size: 2rem;
                  font-weight: 700;
                  color: var(--text-color);
                "
              >
                0
              </div>
            </div>
          </div>
        </button>
        <button type="button" class="glass-panel stat-btn" style="padding: 1.5rem" onclick="scrollToSection('building')">
          <div style="display: flex; align-items: center; gap: 1rem">
            <div
              style="
                width: 50px;
                height: 50px;
                border-radius: 12px;
                background: var(--stat-4-bg);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--stat-4-fg);
              "
            >
              <i class="fas fa-door-open"></i>
            </div>
            <div>
              <div
                style="
                  font-size: 0.9rem;
                  color: var(--text-muted);
                  margin-bottom: 0.25rem;
                "
              >
                الوحدات المشغولة
              </div>
              <div
                id="occupied-units"
                style="
                  font-size: 2rem;
                  font-weight: 700;
                  color: var(--text-color);
                "
              >
                0
              </div>
            </div>
          </div>
        </button>
        <button type="button" class="glass-panel stat-btn" style="padding: 1.5rem" onclick="scrollToSection('charts-section')">
          <div style="display: flex; align-items: center; gap: 1rem">
            <div
              style="
                width: 50px;
                height: 50px;
                border-radius: 12px;
                background: var(--stat-5-bg);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--stat-5-fg);
              "
            >
              <i class="fas fa-chart-pie"></i>
            </div>
            <div>
              <div
                style="
                  font-size: 0.9rem;
                  color: var(--text-muted);
                  margin-bottom: 0.25rem;
                "
              >
                نسبة الإشغال
              </div>
              <div
                id="occupancy-rate"
                style="
                  font-size: 2rem;
                  font-weight: 700;
                  color: var(--text-color);
                "
              >
                0%
              </div>
            </div>
          </div>
        </button>
        
        <button class="glass-panel stat-btn" style="padding: 1.5rem" type="button" onclick="showChildrenUnderFive()">
          <div style="display: flex; align-items: center; gap: 1rem">
            <div
              style="
                width: 50px;
                height: 50px;
                border-radius: 12px;
                background: var(--stat-6-bg);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--stat-6-fg);
              "
            >
              <i class="fas fa-baby"></i>
            </div>
            <div>
              <div
                style="
                  font-size: 0.9rem;
                  color: var(--text-muted);
                  margin-bottom: 0.25rem;
                "
              >
                أطفال تحت 5 سنوات
              </div>
              <div
                id="total-children-under-5"
                style="
                  font-size: 2rem;
                  font-weight: 700;
                  color: var(--text-color);
                "
              >
                0
              </div>
            </div>
          </div>
        </button>
      </div>

      <!-- Charts Section -->
      <div id="charts-section"
        style="
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
          gap: 1.5rem;
          margin-bottom: 2rem;
        "
      >
        <!-- Age Distribution Chart -->
        <div class="glass-panel" style="padding: 1.5rem">
          <h3
            style="
              font-size: 1.1rem;
              font-weight: 600;
              margin: 0 0 1rem 0;
              color: var(--text-color);
              border-bottom: 1px solid var(--glass-border);
              padding-bottom: 0.5rem;
            "
          >
            <i
              class="fas fa-birthday-cake"
              style="margin-left: 0.5rem; color: var(--monochrome-4)"
            ></i>
            توزيع الأعمار
          </h3>
          <div class="chart-container">
            <canvas id="ageChart"></canvas>
          </div>
        </div>

        <!-- Health Status Chart -->
        <div class="glass-panel" style="padding: 1.5rem">
          <h3
            style="
              font-size: 1.1rem;
              font-weight: 600;
              margin: 0 0 1rem 0;
              color: var(--text-color);
              border-bottom: 1px solid var(--glass-border);
              padding-bottom: 0.5rem;
            "
          >
            <i
              class="fas fa-heartbeat"
              style="margin-left: 0.5rem; color: var(--monochrome-4)"
            ></i>
            الحالة الصحية
          </h3>
          <div class="chart-container">
            <canvas id="healthChart"></canvas>
          </div>
        </div>
      </div>

      <!-- Rooms Summary -->
      <div id="building" class="glass-panel" style="padding: 1.5rem; margin-bottom: 2rem">
        <h3
          style="
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0 0 1.5rem 0;
            color: var(--text-color);
            border-bottom: 1px solid var(--glass-border);
            padding-bottom: 0.5rem;
          "
        >
          <i
            class="fas fa-door-open"
            style="margin-left: 0.5rem; color: var(--monochrome-4)"
          ></i>
          ملخص السكنات
        </h3>
        <div class="summary-grid">
          <div class="summary-card">
            <div class="summary-title">إجمالي الغرف</div>
            <div id="summary-total-rooms" class="summary-value">0</div>
          </div>
          <div class="summary-card">
            <div class="summary-title">غرف مشغولة</div>
            <div id="summary-occupied-rooms" class="summary-value">0</div>
          </div>
          <div class="summary-card">
            <div class="summary-title">غرف فارغة</div>
            <div id="summary-empty-rooms" class="summary-value">0</div>
          </div>
          <div class="summary-card">
            <div class="summary-title">غرف مشتركة</div>
            <div id="summary-shared-rooms" class="summary-value">0</div>
          </div>
        </div>
        <div style="margin-top: 1.5rem; text-align: left;">
          <a href="rooms.php" class="btn-primary" style="text-decoration: none;">
            <i class="fas fa-door-open"></i>
            عرض تفاصيل الغرف
          </a>
        </div>
      </div>

      <!-- Quick Insights -->
      <div class="glass-panel" style="padding: 1.5rem; margin-bottom: 2rem">
        <h3
          style="
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0 0 1.5rem 0;
            color: var(--text-color);
            border-bottom: 1px solid var(--glass-border);
            padding-bottom: 0.5rem;
          "
        >
          <i
            class="fas fa-lightbulb"
            style="margin-left: 0.5rem; color: var(--monochrome-4)"
          ></i>
          رؤى سريعة
        </h3>
        <div class="insights-grid">
          <div class="insight-card">
            <div class="insight-title">أعلى مبنى إشغالاً</div>
            <div id="insight-top-building" class="insight-value">-</div>
          </div>
          <div class="insight-card">
            <div class="insight-title">أكثر مبنى بغرف مشتركة</div>
            <div id="insight-shared-building" class="insight-value">-</div>
          </div>
          <div class="insight-card">
            <div class="insight-title">متوسط العائلات لكل غرفة</div>
            <div id="insight-average-families" class="insight-value">0</div>
          </div>
          <div class="insight-card">
            <div class="insight-title">الغرف الفارغة حالياً</div>
            <div id="insight-empty-rooms" class="insight-value">0</div>
          </div>
        </div>
      </div>

      <!-- Recent Activity -->
      <div class="glass-panel" style="padding: 1.5rem; margin-bottom: 2rem">
        <h3
          style="
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0 0 1.5rem 0;
            color: var(--text-color);
            border-bottom: 1px solid var(--glass-border);
            padding-bottom: 0.5rem;
          "
        >
          <i
            class="fas fa-clock"
            style="margin-left: 0.5rem; color: var(--monochrome-4)"
          ></i>
          آخر التحديثات
        </h3>
        <div
          id="recent-activity"
          style="max-height: 300px; overflow-y: auto"
        ></div>
      </div>

      <!-- Quick Actions -->
      <div class="glass-panel" style="padding: 1.5rem; margin-bottom: 2rem">
        <h3
          style="
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0 0 1.5rem 0;
            color: var(--text-color);
            border-bottom: 1px solid var(--glass-border);
            padding-bottom: 0.5rem;
          "
        >
          <i
            class="fas fa-bolt"
            style="margin-left: 0.5rem; color: var(--monochrome-4)"
          ></i>
          إجراءات سريعة
        </h3>
        <div style="display: flex; flex-wrap: wrap; gap: 1rem">
          <button
            onclick="openBuildingModal()"
            class="btn-primary"
            style="display: flex; align-items: center; gap: 0.5rem"
          >
            <i class="fas fa-plus"></i>
            إضافة مبنى جديد
          </button>
          <a
            href="families_management.php"
            class="btn-primary"
            style="
              display: flex;
              align-items: center;
              gap: 0.5rem;
              text-decoration: none;
            "
          >
            <i class="fas fa-plus"></i>
            إضافة عائلة جديدة
          </a>
          <a
            href="rooms.php"
            class="btn-primary"
            style="
              display: flex;
              align-items: center;
              gap: 0.5rem;
              text-decoration: none;
            "
          >
            <i class="fas fa-door-open"></i>
            عرض الغرف
          </a>
          <button
            onclick="exportExcel()"
            class="btn-primary"
            style="display: flex; align-items: center; gap: 0.5rem"
          >
            <i class="fas fa-file-excel"></i>
            تصدير تقرير إكسل
          </button>
          <button
            onclick="generatePDF()"
            class="btn-primary"
            style="display: flex; align-items: center; gap: 0.5rem"
          >
            <i class="fas fa-file-pdf"></i>
            تصدير تقرير PDF
          </button>
          <button
            onclick="confirmClearAll()"
            class="btn-close"
            style="display: flex; align-items: center; gap: 0.5rem"
          >
            <i class="fas fa-trash"></i>
            مسح جميع البيانات
          </button>
          <button
            onclick="refreshDashboard()"
            class="btn-primary"
            style="display: flex; align-items: center; gap: 0.5rem"
          >
            <i class="fas fa-rotate-right"></i>
            تحديث البيانات
          </button>
          <button
            onclick="copyDashboardSummary()"
            class="btn-primary"
            style="display: flex; align-items: center; gap: 0.5rem"
          >
            <i class="fas fa-copy"></i>
            نسخ ملخص
          </button>
        </div>
      </div>
    </div>

    <!-- Add Building Modal -->
    <div id="addBuildingModal" class="modal-overlay">
      <div class="modal-content">
        <div
          style="
            padding: 1.5rem;
            border-bottom: 1px solid var(--glass-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
          "
        >
          <h3
            style="
              margin: 0;
              font-size: 1.3rem;
              font-weight: 700;
              color: var(--text-color);
            "
          >
            <i class="fas fa-plus" style="margin-left: 0.5rem"></i>
            إضافة مبنى جديد
          </h3>
          <button onclick="closeBuildingModal()" class="btn-close">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div style="padding: 1.5rem">
          <div style="margin-bottom: 1.5rem">
            <label
              style="
                display: block;
                margin-bottom: 0.5rem;
                color: var(--text-color);
                font-weight: 500;
              "
            >
              اسم المبنى
            </label>
            <input
              type="text"
              id="buildingName"
              class="glass-input"
              placeholder="مثال: المبنى أ"
            />
          </div>

          <div style="margin-bottom: 1.5rem">
            <label
              style="
                display: block;
                margin-bottom: 0.5rem;
                color: var(--text-color);
                font-weight: 500;
              "
            >
              عدد الطوابق
            </label>
            <input
              type="number"
              id="floorsCount"
              class="glass-input"
              placeholder="أدخل عدد الطوابق"
              min="1"
              max="20"
            />
          </div>

          <div id="floorsContainer" style="margin-bottom: 1.5rem"></div>

          <div style="display: flex; gap: 1rem; justify-content: flex-end">
            <button onclick="closeBuildingModal()" class="btn-close">
              إلغاء
            </button>
            <button onclick="addBuilding()" class="btn-primary">
              إضافة المبنى
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Building Details Modal -->
    <div id="buildingModal" class="modal-overlay">
      <div class="modal-content">
        <div
          style="
            padding: 1.5rem;
            border-bottom: 1px solid var(--glass-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
          "
        >
          <h3
            id="modalTitle"
            style="
              margin: 0;
              font-size: 1.3rem;
              font-weight: 700;
              color: var(--text-color);
            "
          ></h3>
          <button onclick="closeModal()" class="btn-close">
            <i class=" fas fa-times"></i>
          </button>
        </div>
        <div
          id="modalContent"
          style="padding: 1.5rem; max-height: 60vh; overflow-y: auto"
        ></div>
        <div
          style="
            padding: 1.5rem;
            border-top: 1px solid var(--glass-border);
            text-align: left;
          "
        >
          <button onclick="editBuilding()" class="btn-primary" style="margin-right: 1rem">
            تعديل المبنى
          </button>
          <button onclick="deleteBuilding()" class="btn-danger">
            حذف المبنى
          </button>
        </div>
        
      </div>
    </div>

    <script src="script.js"></script>
    <script>
      let currentEditingBuildingId = null;
      // === Configuration ===
      const STORAGE_KEY = "housing_data";
      const BUILDINGS_KEY = "housing_buildings";
      const LEGACY_KEY = "housing_families";

      // === State ===
      let families = [];
      let buildings = [];
      let ageChart = null;
      let healthChart = null;
      const THEME_KEY = "ui_theme";
      let currentTheme = "dark";

      function getCssVar(name) {
        return getComputedStyle(document.documentElement)
          .getPropertyValue(name)
          .trim();
      }

      function setActiveThemeButton() {
        document.querySelectorAll(".theme-btn").forEach(btn => {
          btn.classList.toggle("active", btn.dataset.theme === currentTheme);
        });
      }

      function applyTheme(theme, options = {}) {
        currentTheme = theme || "dark";
        document.documentElement.setAttribute("data-theme", currentTheme);
        if (!options.skipSave) {
          localStorage.setItem(THEME_KEY, currentTheme);
        }
        setActiveThemeButton();
        if (typeof updateCharts === "function") {
          updateCharts();
        }
      }

      function initTheme() {
        const savedTheme = localStorage.getItem(THEME_KEY);
        applyTheme(savedTheme || "dark", { skipSave: true });
      }

      function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (!section) return;
        section.scrollIntoView({ behavior: "smooth", block: "start" });
      }

      // === Initialize ===
      document.addEventListener("DOMContentLoaded", async () => {
        initTheme();
        document.querySelectorAll(".theme-btn").forEach(btn => {
          btn.addEventListener("click", () => applyTheme(btn.dataset.theme));
        });
        await AppUtils.trySyncPending();
        await loadData();
        renderDashboard();
        updateLastUpdateTime();

        const params = new URLSearchParams(window.location.search);
        const buildingParam = params.get("building");
        if (buildingParam) {
          const target = buildings.find(
            b => String(b.id) === String(buildingParam)
          );
          if (target) {
            showBuildingDetails(target);
          }
        }
      });

      // === Data Management ===
      async function loadData() {
        const data = await AppUtils.loadAllData();
        buildings = data.buildings || [];
        families = data.families || [];
      }

      function syncData() {
        AppUtils.saveAllData({ families, buildings });
      }

      // === Render Dashboard ===
      function renderDashboard() {
        updateStats();
        updateCharts();
        updateBuildingsOverview();
        updateInsights();
        updateRecentActivity();
      }

      function getRoomStats() {
        let totalRooms = 0;
        const roomUsage = new Map();

        buildings.forEach(b => {
          const floors = Array.isArray(b.floors) ? b.floors : [];
          floors.forEach(floor => {
            totalRooms += parseInt(floor.rooms, 10) || 0;
          });
        });

        families.forEach(f => {
          if (!f.building || !f.floor || !f.room) return;
          const key = `${f.building}::${f.floor}::${f.room}`;
          roomUsage.set(key, (roomUsage.get(key) || 0) + 1);
        });

        let sharedRooms = 0;
        roomUsage.forEach(count => {
          if (count > 1) sharedRooms++;
        });

        const occupiedRooms = roomUsage.size;
        const emptyRooms = Math.max(totalRooms - occupiedRooms, 0);

        return {
          totalRooms,
          occupiedRooms,
          sharedRooms,
          emptyRooms,
        };
      }

      function updateInsights() {
        const topBuildingEl = document.getElementById("insight-top-building");
        const sharedBuildingEl = document.getElementById("insight-shared-building");
        const avgFamiliesEl = document.getElementById("insight-average-families");
        const emptyRoomsEl = document.getElementById("insight-empty-rooms");

        if (!topBuildingEl || !sharedBuildingEl || !avgFamiliesEl || !emptyRoomsEl) return;

        if (buildings.length === 0) {
          topBuildingEl.textContent = "-";
          sharedBuildingEl.textContent = "-";
          avgFamiliesEl.textContent = "0";
          emptyRoomsEl.textContent = "0";
          return;
        }

        let topBuilding = null;
        let topRate = -1;
        let topShared = null;
        let topSharedCount = -1;

        buildings.forEach(building => {
          const floors = Array.isArray(building.floors) ? building.floors : [];
          let totalRooms = 0;
          floors.forEach(floor => {
            totalRooms += parseInt(floor.rooms, 10) || 0;
          });

          const roomUsage = new Map();
          families.forEach(f => {
            if (f.building != building.id || !f.floor || !f.room) return;
            const key = `${f.floor}::${f.room}`;
            roomUsage.set(key, (roomUsage.get(key) || 0) + 1);
          });

          let sharedRooms = 0;
          roomUsage.forEach(count => {
            if (count > 1) sharedRooms++;
          });

          const occupiedRooms = roomUsage.size;
          const rate = totalRooms > 0 ? Math.round((occupiedRooms / totalRooms) * 100) : 0;

          if (rate > topRate) {
            topRate = rate;
            topBuilding = building;
          }
          if (sharedRooms > topSharedCount) {
            topSharedCount = sharedRooms;
            topShared = building;
          }
        });

        const roomStats = getRoomStats();
        const averageFamilies = roomStats.totalRooms > 0
          ? (families.length / roomStats.totalRooms).toFixed(2)
          : "0";

        topBuildingEl.textContent = topBuilding
          ? `${topBuilding.name} (${topRate}%)`
          : "-";
        sharedBuildingEl.textContent = topShared
          ? `${topShared.name} (${topSharedCount} غرفة)`
          : "-";
        avgFamiliesEl.textContent = averageFamilies;
        emptyRoomsEl.textContent = roomStats.emptyRooms;
      }

      function updateStats() {
        const totalBuildings = buildings.length;
        const totalFamilies = families.length;
        let totalPeople = 0;
        let totalChildrenUnderFive = 0;

        families.forEach(f => {
          if (f.father?.name) totalPeople++;
          if (f.mother?.name) totalPeople++;
          if (f.children?.length) totalPeople += f.children.length;
          if (f.relatives?.length) totalPeople += f.relatives.length;

          if (f.children?.length) {
            f.children.forEach(child => {
              if (child.age !== null && child.age !== undefined && child.age !== "") {
                const age = parseInt(child.age);
                if (!Number.isNaN(age) && age <= 5) {
                  totalChildrenUnderFive++;
                }
              }
            });
          }
        });

        const roomStats = getRoomStats();
        const occupancyRate =
          roomStats.totalRooms > 0
            ? Math.round((roomStats.occupiedRooms / roomStats.totalRooms) * 100)
            : 0;

        document.getElementById("total-buildings").textContent = totalBuildings;
        document.getElementById("total-families").textContent = totalFamilies;
        document.getElementById("total-people").textContent = totalPeople;
        document.getElementById("total-children-under-5").textContent =
          totalChildrenUnderFive;
        document.getElementById("occupied-units").textContent =
          roomStats.occupiedRooms;
        document.getElementById("occupancy-rate").textContent =
          occupancyRate + "%";
      }

      function showChildrenUnderFive() {
        const underFive = [];

        families.forEach(f => {
          if (f.children?.length) {
            f.children.forEach(child => {
              if (child.age !== null && child.age !== undefined && child.age !== "") {
                const age = parseInt(child.age);
                if (!Number.isNaN(age) && age <= 5) {
                  underFive.push({ child, family: f });
                }
              }
            });
          }
        });

        if (underFive.length === 0) {
          Swal.fire({
            title: "لا يوجد أطفال",
            text: "لا توجد بيانات لأطفال تحت 5 سنوات حالياً",
            icon: "info",
            background: "#0f0f0f",
            color: "#fff",
          });
          return;
        }

        let htmlContent = `<div style="text-align: right; max-height: 60vh; overflow-y: auto;">`;

        underFive.forEach((item, index) => {
          const child = item.child || {};
          const family = item.family || {};
          const familyLabel =
            family.father?.surname ||
            family.father?.name ||
            family.mother?.name ||
            "عائلة";
          const buildingLabel =
            family.buildingName || family.building || "-";
          const floorLabel = family.floor || "-";
          const roomLabel = family.room || "-";

          htmlContent += `
            <div class="glass-panel" style="padding: 1rem; margin-bottom: 0.75rem;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                <div style="font-weight: 600; color: var(--text-color);">
                  ${child.name || "غير مسجل"}
                </div>
                <div style="font-size: 0.85rem; color: var(--text-muted);">
                  #${index + 1}
                </div>
              </div>
              <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 0.5rem;">
                <div style="font-size: 0.9rem; color: var(--text-muted);">
                  العمر: <span style="color: var(--text-color);">${child.age ?? "-"}</span>
                </div>
                <div style="font-size: 0.9rem; color: var(--text-muted);">
                  العمر بالأشهر: <span style="color: var(--text-color);">${child.ageMonths ?? "-"}</span>
                </div>
                <div style="font-size: 0.9rem; color: var(--text-muted);">
                  الجنس: <span style="color: var(--text-color);">${child.gender || "-"}</span>
                </div>
                <div style="font-size: 0.9rem; color: var(--text-muted);">
                  الحالة الصحية: <span style="color: var(--text-color);">${child.health || "-"}</span>
                </div>
                <div style="font-size: 0.9rem; color: var(--text-muted);">
                  قياس الحفاضات: <span style="color: var(--text-color);">${child.diaperSize || "غير مسجل"}</span>
                </div>
                <div style="font-size: 0.9rem; color: var(--text-muted);">
                  نوع الحليب: <span style="color: var(--text-color);">${child.milkType || "غير مسجل"}</span>
                </div>
                <div style="font-size: 0.9rem; color: var(--text-muted); grid-column: span 2;">
                  احتياجات أخرى: <span style="color: var(--text-color);">${child.otherNeeds || "غير مسجل"}</span>
                </div>
                <div style="font-size: 0.9rem; color: var(--text-muted); grid-column: span 2;">
                  الأسرة: <span style="color: var(--text-color);">${familyLabel}</span> • السكن: <span style="color: var(--text-color);">${buildingLabel}</span> • الطابق: <span style="color: var(--text-color);">${floorLabel}</span> • الغرفة: <span style="color: var(--text-color);">${roomLabel}</span>
                </div>
              </div>
            </div>
          `;
        });

        htmlContent += `</div>`;

        Swal.fire({
          title: "أطفال تحت 5 سنوات",
          html: htmlContent,
          background: "#0f0f0f",
          color: "#fff",
          width: 820,
          confirmButtonText: "إغلاق",
          confirmButtonColor: "#6b001a",
          confirmButtonBorder: "1px solid #6b001a",
          confirmButtonHoverColor: "#8a1028",
          showCloseButton: true,
        });
      }

      function updateCharts() {
        // Age Distribution
        const ageCategories = {
          "0-18": 0,
          "19-35": 0,
          "36-50": 0,
          "51-65": 0,
          "65+": 0,
        };

        // Health Status
        const healthCategories = {
          سليم: 0,
          "مرض مزمن": 0,
          إعاقة: 0,
        };

        families.forEach(f => {
          // Father
          if (f.father?.age) {
            const age = parseInt(f.father.age);
            if (age < 18) ageCategories["0-18"]++;
            else if (age <= 35) ageCategories["19-35"]++;
            else if (age <= 50) ageCategories["36-50"]++;
            else if (age <= 65) ageCategories["51-65"]++;
            else ageCategories["65+"]++;
            if (f.father.health) {
              if (healthCategories.hasOwnProperty(f.father.health)) {
                healthCategories[f.father.health]++;
              } else {
                healthCategories["مسجل"] = (healthCategories["مسجل"] || 0) + 1;
              }
            }
          }

          // Mother
          if (f.mother?.age) {
            const age = parseInt(f.mother.age);
            if (age < 18) ageCategories["0-18"]++;
            else if (age <= 35) ageCategories["19-35"]++;
            else if (age <= 50) ageCategories["36-50"]++;
            else if (age <= 65) ageCategories["51-65"]++;
            else ageCategories["65+"]++;
            if (f.mother.health) {
              if (healthCategories.hasOwnProperty(f.mother.health)) {
                healthCategories[f.mother.health]++;
              } else {
                healthCategories["مسجل"] = (healthCategories["مسجل"] || 0) + 1;
              }
            }
          }

          // Children
          if (f.children?.length) {
            f.children.forEach(child => {
              if (child.age) {
                const age = parseInt(child.age);
                if (age < 18) ageCategories["0-18"]++;
                else if (age <= 35) ageCategories["19-35"]++;
                else if (age <= 50) ageCategories["36-50"]++;
                else if (age <= 65) ageCategories["51-65"]++;
                else ageCategories["65+"]++;
              }
              if (child.health) {
                if (healthCategories.hasOwnProperty(child.health)) {
                  healthCategories[child.health]++;
                } else {
                  healthCategories["مسجل"] =
                    (healthCategories["مسجل"] || 0) + 1;
                }
              }
            });
          }

          // Relatives
          if (f.relatives?.length) {
            f.relatives.forEach(relative => {
              if (relative.age) {
                const age = parseInt(relative.age);
                if (age < 18) ageCategories["0-18"]++;
                else if (age <= 35) ageCategories["19-35"]++;
                else if (age <= 50) ageCategories["36-50"]++;
                else if (age <= 65) ageCategories["51-65"]++;
                else ageCategories["65+"]++;
              }
              if (relative.health) {
                if (healthCategories.hasOwnProperty(relative.health)) {
                  healthCategories[relative.health]++;
                } else {
                  healthCategories["مسجل"] =
                    (healthCategories["مسجل"] || 0) + 1;
                }
              }
            });
          }
        });

        const textMuted = getCssVar("--text-muted") || "#a1a1aa";
        const gridColor =
          getCssVar("--glass-border") || "rgba(255, 255, 255, 0.05)";

        const chartColors = [
          getCssVar("--chart-1-bg"),
          getCssVar("--chart-2-bg"),
          getCssVar("--chart-3-bg"),
          getCssVar("--chart-4-bg"),
          getCssVar("--chart-5-bg"),
          getCssVar("--chart-6-bg"),
          getCssVar("--chart-7-bg"),
          getCssVar("--chart-8-bg"),
        ];
        const chartBorders = [
          getCssVar("--chart-1-border"),
          getCssVar("--chart-2-border"),
          getCssVar("--chart-3-border"),
          getCssVar("--chart-4-border"),
          getCssVar("--chart-5-border"),
          getCssVar("--chart-6-border"),
          getCssVar("--chart-7-border"),
          getCssVar("--chart-8-border"),
        ];

        // Age Chart
        const ageCtx = document.getElementById("ageChart");
        if (ageChart) ageChart.destroy();
        ageChart = new Chart(ageCtx, {
          type: "bar",
          data: {
            labels: Object.keys(ageCategories),
            datasets: [
              {
                label: "عدد السكان",
                data: Object.values(ageCategories),
                backgroundColor: chartColors,
                borderColor: chartBorders,
                borderWidth: 2,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              },
              title: {
                display: false,
              },
            },
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  color: textMuted,
                },
                grid: {
                  color: gridColor,
                },
              },
              x: {
                ticks: {
                  color: textMuted,
                },
                grid: {
                  display: false,
                },
              },
            },
          },
        });

        // Health Chart with colors per category
        const healthCtx = document.getElementById("healthChart");
        if (healthChart) healthChart.destroy();

        // Map health status to colors for better visualization
        const healthColors = [];
        const healthBorders = [];

        const colorMap = {
          سليم: {
            bg: getCssVar("--health-ok-bg"),
            border: getCssVar("--health-ok-border"),
          },
          "مرض مزمن": {
            bg: getCssVar("--health-chronic-bg"),
            border: getCssVar("--health-chronic-border"),
          },
          إعاقة: {
            bg: getCssVar("--health-disability-bg"),
            border: getCssVar("--health-disability-border"),
          },
        };

        Object.keys(healthCategories).forEach(status => {
          const colors = colorMap[status];
          if (colors) {
            healthColors.push(colors.bg);
            healthBorders.push(colors.border);
          } else {
            healthColors.push(getCssVar("--health-other-bg"));
            healthBorders.push(getCssVar("--health-other-border"));
          }
        });

        healthChart = new Chart(healthCtx, {
          type: "doughnut",
          data: {
            labels: Object.keys(healthCategories),
            datasets: [
              {
                data: Object.values(healthCategories),
                backgroundColor: healthColors,
                borderColor: healthBorders,
                borderWidth: 2,
              },
            ],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                position: "bottom",
                labels: {
                  color: textMuted,
                  padding: 15,
                  font: {
                    size: 12,
                  },
                },
              },
              title: {
                display: false,
              },
            },
          },
        });
      }

      function updateBuildingsOverview() {
        const stats = getRoomStats();
        const totalEl = document.getElementById("summary-total-rooms");
        const occupiedEl = document.getElementById("summary-occupied-rooms");
        const emptyEl = document.getElementById("summary-empty-rooms");
        const sharedEl = document.getElementById("summary-shared-rooms");

        if (!totalEl || !occupiedEl || !emptyEl || !sharedEl) return;

        totalEl.textContent = stats.totalRooms;
        occupiedEl.textContent = stats.occupiedRooms;
        emptyEl.textContent = stats.emptyRooms;
        sharedEl.textContent = stats.sharedRooms;
      }


      function updateRecentActivity() {
        const container = document.getElementById("recent-activity");
        container.innerHTML = "";

        if (families.length === 0) {
          container.innerHTML = `
            <div style="text-align: center; padding: 2rem; color: var(--text-muted);">
              لا توجد أنشطة حالياً
            </div>
          `;
          return;
        }

        const recentFamilies = families.slice(-10).reverse();
        recentFamilies.forEach(family => {
          const dateStr = new Date(family.id).toLocaleDateString("ar-EG", {
            year: "numeric",
            month: "short",
            day: "numeric",
          });

          let memberCount = 0;
          if (family.father?.name) memberCount++;
          if (family.mother?.name) memberCount++;
          if (family.children?.length) memberCount += family.children.length;
          if (family.relatives?.length) memberCount += family.relatives.length;

          const compositionLabels = {
            "father-mother-children": "عائلة كاملة",
            "father-only": "أب فقط",
            "mother-only": "أم فقط",
            "mother-children-only": "أم وأبناء",
            "father-children-only": "أب وأبناء",
            "no-family": "بدون عائلة",
          };

          const item = document.createElement("div");
          item.style.cssText =
            "display: flex; align-items: center; gap: 1rem; padding: 1rem; border-bottom: 1px solid var(--glass-border); transition: background 0.3s ease;";
          item.onmouseover = () => (item.style.background = "var(--hover-bg)");
          item.onmouseout = () => (item.style.background = "transparent");
          item.innerHTML = `
            <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; font-size: 1rem; color: var(--monochrome-3);">
              <i class="fas fa-home"></i>
            </div>
            <div style="flex: 1;">
              <div style="font-weight: 500; color: var(--text-color); margin-bottom: 0.25rem;">
                ${family.father?.surname || family.father?.name || family.mother?.name || "عائلة جديدة"}
              </div>
              <div style="font-size: 0.85rem; color: var(--text-muted);">
                ${compositionLabels[family.composition] || "غير محدد"} • ${memberCount} فرد ${
                  family.building
                    ? `• مبنى ${families.find(f => f.id === family.id)?.buildingName || family.building}`
                    : ""
                }
              </div>
            </div>
            <div style="text-align: left;">
              <div style="font-size: 0.85rem; color: var(--text-muted);">${dateStr}</div>
            </div>
          `;
          container.appendChild(item);
        });
      }

      // === Building Modal Functions ===
      function openBuildingModal() {
        const modal = document.getElementById("addBuildingModal");
        if (!modal) return;
        modal.classList.add("active");
        
        // Reset form

        document.getElementById("buildingName").value = "";
        document.getElementById("floorsCount").value = "";
        document.getElementById("floorsContainer").innerHTML = "";
        currentEditingBuildingId = null;
        // Reset add button

        const addButton = document.querySelector("#addBuildingModal .btn-primary");
        addButton.textContent = "إضافة المبنى";
        addButton.onclick = addBuilding;
      }

      function closeBuildingModal() {
        const modal = document.getElementById("addBuildingModal");
        if (!modal) return;
        modal.classList.remove("active");
      }
      // Generate floor input fields
      document
        .getElementById("floorsCount")
        ?.addEventListener("change", function () {
          const floorsCount = parseInt(this.value) || 0;
          const container = document.getElementById("floorsContainer");
          container.innerHTML = "";

          for (let i = 1; i <= floorsCount; i++) {
            
            const floorDiv = document.createElement("div");

            
            floorDiv.style.cssText =
            
              "margin-bottom: 1rem; padding: 1rem; background: rgba(255,255,255,0.01); border: 1px solid var(--glass-border); border-radius: 8px;";
            
            floorDiv.innerHTML = `
            
            <label style="display: block; margin-bottom: 0.5rem; color: var(--text-color); font-weight: 500;">
              الطابق ${i} - عدد الغرف
            </label>
            <input type="number" class="glass-input floor-rooms" data-floor="${i}" placeholder="أدخل عدد الغرف" min="1" max="100" />
          `;
            container.appendChild(floorDiv);


          }
        });

      function addBuilding() {
        const buildingName = document
          .getElementById("buildingName")
          .value.trim();
        const floorsCount =
          parseInt(document.getElementById("floorsCount").value) || 0;

        if (!buildingName) {
          Swal.fire({
            title: "خطأ",
            text: "يرجى إدخال اسم المبنى",
            icon: "error",
            background: "#0f0f0f",
            color: "#fff",
          });
          return;
        }

        if (floorsCount < 1) {
          Swal.fire({
            title: "خطأ",
            text: "يرجى إدخال عدد الطوابق (1 على الأقل)",
            icon: "error",
            background: "#0f0f0f",
            color: "#fff",
          });
          return;
        }

        const floors = [];
        let isValid = true;

        document.querySelectorAll(".floor-rooms").forEach(input => {
          const rooms = parseInt(input.value) || 0;
          const floorNum = parseInt(input.dataset.floor);

          if (rooms < 1) {
            Swal.fire({
              title: "خطأ",
              text: `يرجى إدخال عدد الغرف للطابق ${floorNum}`,
              icon: "error",
              background: "#0f0f0f",
              color: "#fff",
            });
            isValid = false;
            return;
          }

          floors.push({
            floor: floorNum,
            rooms: rooms,
          });
        });

        if (!isValid) return;

        // Create building object
        const newBuilding = {
          id: Date.now(),
          name: buildingName,
          floors: floors,
          createdAt: new Date().toISOString(),
        };

        buildings.push(newBuilding);
        syncData();

        Swal.fire({
          title: "تم بنجاح!",
          text: `تم إضافة المبنى "${buildingName}" بنجاح`,
          icon: "success",
          background: "#0f0f0f",
          color: "#fff",
          timer: 2000,
          showConfirmButton: false,
        });

        closeBuildingModal();
        renderDashboard();
      }
      function editBuilding() {
        const building = buildings.find(b => b.id === currentEditingBuildingId);
        if (!building) return;

        // Pre-fill the add building modal with existing data
        openBuildingModal();
        document.getElementById("buildingName").value = building.name;
        document.getElementById("floorsCount").value = building.floors.length;

        // Trigger change to generate floor inputs
        const event = new Event('change');
        document.getElementById("floorsCount").dispatchEvent(event);

        // Fill in the floor rooms
        setTimeout(() => {
          building.floors.forEach(floor => {
            const input = document.querySelector(`.floor-rooms[data-floor="${floor.floor}"]`);
            if (input) {
              input.value = floor.rooms;
            }
          });
        }, 100);

        // Change the add button to save changes
        const addButton = document.querySelector("#addBuildingModal .btn-primary");
        addButton.textContent = "حفظ التعديلات";
        addButton.onclick = function() {
          saveBuildingEdits(building.id);
        };
      }

      // === Building Details Modal ===
      function showBuildingDetails(building) {
        currentEditingBuildingId = building.id;
        const buildingFamilies = families.filter(
          f => f.building === building.id
        );

        document.getElementById("modalTitle").textContent =
          `${building.name} - التفاصيل`;

        let htmlContent = `
          <div style="margin-bottom: 1.5rem;">
            <h4 style="color: var(--text-color); margin: 0 0 1rem 0; font-weight: 600;">معلومات المبنى</h4>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">
              <div style="padding: 1rem; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid var(--glass-border);">
                <div style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem;">عدد الطوابق</div>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--text-color);">${building.floors.length}</div>
              </div>
              <div style="padding: 1rem; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid var(--glass-border);">
                <div style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem;">إجمالي الغرف</div>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--text-color);">${building.floors.reduce((sum, f) => sum + f.rooms, 0)}</div>
              </div>
              <div style="padding: 1rem; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid var(--glass-border);">
                <div style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem;">الوحدات المشغولة</div>
                <div style="font-size: 1.5rem; font-weight: 700; color: var(--text-color);">${buildingFamilies.length}</div>
              </div>
            </div>
          </div>
        `;

        // Add floors details
        htmlContent += `<h4 style="color: var(--text-color); margin: 1.5rem 0 1rem 0; font-weight: 600;">تفاصيل الطوابق</h4>`;

        building.floors.forEach(floor => {
          const floorFamilies = buildingFamilies.filter(
            f => f.floor === floor.floor
          );
          const occupancyPercent = Math.round(
            (floorFamilies.length / floor.rooms) * 100
          );

          htmlContent += `
            <div class="floor-section">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h5 style="margin: 0; color: var(--text-color); font-weight: 600;">الطابق ${floor.floor}</h5>
                <span style="font-size: 0.85rem; color: var(--text-muted);">${floorFamilies.length}/${floor.rooms}</span>
              </div>
              <div style="background: rgba(255,255,255,0.05); height: 6px; border-radius: 3px; overflow: hidden; margin-bottom: 0.5rem;">
                <div style="background: var(--primary-gradient); height: 100%; width: ${occupancyPercent}%;"></div>
              </div>
              <div style="font-size: 0.85rem; color: var(--text-muted);">نسبة الإشغال: ${occupancyPercent}%</div>
            </div>
          `;
        });

        // Add families list
        if (buildingFamilies.length > 0) {
          htmlContent += `<h4 style="color: var(--text-color); margin: 1.5rem 0 1rem 0; font-weight: 600;">العائلات المسجلة</h4>`;

          buildingFamilies.forEach(family => {
            const membersCount =
              1 +
              (family.mother?.name ? 1 : 0) +
              (family.children?.length || 0) +
              (family.relatives?.length || 0);
            htmlContent += `
              <div class="glass-panel" style="padding: 1rem; margin-bottom: 0.5rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                  <span style="font-weight: 600; color: var(--text-color);">${family.father?.surname || family.father?.name || "-"}</span>
                  <span style="font-size: 0.8rem; background: rgba(255,255,255,0.05); padding: 2px 8px; border-radius: 4px; color: var(--monochrome-3);">
                    الطابق ${family.floor || "-"} • الغرفة ${family.room || "-"}
                  </span>
                </div>
                <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.5rem;">
                  <i class="fas fa-user" style="margin-left: 0.5rem;"></i>${family.father?.name || "-"}
                </div>
                <div style="font-size: 0.85rem; color: var(--text-muted);">
                  <i class="fas fa-users" style="margin-left: 0.5rem;"></i>${membersCount} فرد
                </div>
              </div>
            `;
          });
        } else {
          htmlContent += `
            <div style="text-align: center; padding: 2rem; color: var(--text-muted);">
              <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 0.5rem; display: block;"></i>
              لا توجد عائلات مسجلة في هذا المبنى
            </div>
          `;
        }

        document.getElementById("modalContent").innerHTML = htmlContent;
        document.getElementById("buildingModal").classList.add("active");
        document.body.style.overflow = "hidden";
      }

      function closeModal() {
        document.getElementById("buildingModal").classList.remove("active");
        document.body.style.overflow = "";
      }

      // === Export Functions ===
      function exportExcel() {
        if (families.length === 0) {
          Swal.fire({
            title: "لا توجد بيانات",
            text: "لا توجد عوائل مسجلة للتصدير",
            icon: "info",
            background: "#0f0f0f",
            color: "#fff",
          });
          return;
        }

        const exportData = families.map(f => {
          const building = buildings.find(b => b.id === f.building);
          return {
            "معرف العائلة": f.id,
            المبنى: building?.name || "-",
            الطابق: f.floor || "-",
            الغرفة: f.room || "-",
            "اسم الأب": f.father?.name || "-",
            "اسم العائلة": f.father?.surname || "-",
            "اسم الأم": f.mother?.name || "-",
            "عدد الأبناء": f.children?.length || 0,
            "عدد الأقارب": f.relatives?.length || 0,
            الهاتف: f.father?.phone || "-",
            "تاريخ التسجيل": new Date(f.id).toLocaleDateString("ar-EG"),
          };
        });

        const ws = XLSX.utils.json_to_sheet(exportData);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "العائلات");
        XLSX.writeFile(wb, "تقرير_العائلات.xlsx");
      }

      function generatePDF() {
        if (families.length === 0) {
          Swal.fire({
            title: "لا توجد بيانات",
            text: "لا توجد عوائل مسجلة للتصدير",
            icon: "info",
            background: "#0f0f0f",
            color: "#fff",
          });
          return;
        }

        const element = document.querySelector(".container");
        const opt = {
          margin: [10, 10, 10, 10],
          filename: "تقرير_العائلات.pdf",
          image: { type: "jpeg", quality: 0.98 },
          html2canvas: {
            scale: 2,
            backgroundColor: getCssVar("--bg-color") || "#050505",
          },
          jsPDF: { unit: "mm", format: "a4", orientation: "portrait" },
        };

        html2pdf().set(opt).from(element).save();
      }

      // === Clear All Data ===
      function confirmClearAll() {
        Swal.fire({
          title: "هل أنت متأكد؟",
          text: "سيتم حذف جميع المباني والعوائل والبيانات المسجلة نهائياً! لا يمكن التراجع عن هذا الإجراء.",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#525252",
          cancelButtonColor: "#a1a1aa",
          confirmButtonText: "نعم، مسح الكل",
          cancelButtonText: "إلغاء",
          background: "#0f0f0f",
          color: "#fff",
          reverseButtons: true,
        }).then(result => {
          if (result.isConfirmed) {
            localStorage.removeItem(STORAGE_KEY);
            localStorage.removeItem(BUILDINGS_KEY);
            localStorage.removeItem(LEGACY_KEY);
            families = [];
            buildings = [];
            AppUtils.saveAllData({ families, buildings });

            // مسح الرسوم البيانية
            if (ageChart) {
              ageChart.destroy();
              ageChart = null;
            }
            if (healthChart) {
              healthChart.destroy();
              healthChart = null;
            }

            renderDashboard();

            Swal.fire({
              title: "تم المسح!",
              text: "تم حذف جميع البيانات بنجاح",
              icon: "success",
              background: "#0f0f0f",
              color: "#fff",
              timer: 2000,
              showConfirmButton: false,
            });
          }
        });
      }

      async function refreshDashboard() {
        await AppUtils.trySyncPending();
        await loadData();
        renderDashboard();
        updateLastUpdateTime();
      }

      function copyDashboardSummary() {
        const summary = [
          `إجمالي المباني: ${document.getElementById("total-buildings").textContent}`,
          `إجمالي العوائل: ${document.getElementById("total-families").textContent}`,
          `إجمالي السكان: ${document.getElementById("total-people").textContent}`,
          `غرف مشغولة: ${document.getElementById("occupied-units").textContent}`,
          `نسبة الإشغال: ${document.getElementById("occupancy-rate").textContent}`,
          `غرف مشتركة: ${document.getElementById("summary-shared-rooms").textContent}`,
        ].join("\n");

        if (navigator.clipboard) {
          navigator.clipboard.writeText(summary).then(() => {
            Swal.fire({
              title: "تم النسخ",
              text: "تم نسخ الملخص بنجاح",
              icon: "success",
              background: getCssVar("--card-bg") || "#0f0f0f",
              color: getCssVar("--text-color") || "#fff",
              timer: 1500,
              showConfirmButton: false,
            });
          });
        } else {
          alert(summary);
        }
      }

      // === Update Time ===
      function updateLastUpdateTime() {
        const now = new Date();
        const dateElement = document.getElementById("current-date");
        if (dateElement) {
          dateElement.textContent = `آخر تحديث: ${now.toLocaleDateString(
            "ar-EG",
            {
              weekday: "long",
              year: "numeric",
              month: "long",
              day: "numeric",
            }
          )}`;
        }
      }

      // === Event Listeners ===
      // Close modal on escape key
      document.addEventListener("keydown", e => {
        if (e.key === "Escape") {
          closeModal();
          closeBuildingModal();
        }
      });

      // Close modals on overlay click
      document.getElementById("buildingModal")?.addEventListener("click", e => {
        if (e.target === document.getElementById("buildingModal")) {
          closeModal();
        }
      });
      deleteBuilding = () => {
    // 1. استخدام المتغير العالمي الذي قمت بتعريفه في كودك currentEditingBuildingId
    // هذا المتغير يحتوي على الرقم الصحيح للمبنى المفتوح حالياً
    const buildingId = currentEditingBuildingId;

    if (!buildingId) {
        Swal.fire({
            title: 'خطأ',
            text: 'لم يتم العثور على معرف المبنى بشكل صحيح',
            icon: 'error',
            background: getCssVar('--card-bg') || '#0f0f0f',
            color: getCssVar('--text-color') || '#fff'
        });
        return;
    }

    Swal.fire({
        title: 'هل أنت متأكد؟',
        text: 'سيتم حذف هذا المبنى وجميع العوائل المسجلة فيه نهائياً!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ae2b2b',
        confirmButtonText: 'نعم، حذف المبنى',
        cancelButtonText: 'إلغاء',
        background: getCssVar('--card-bg') || '#0f0f0f',
        color: getCssVar('--text-color') || '#fff',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // 2. الحذف من المصفوفات باستخدام الـ ID الرقمي
            buildings = buildings.filter(b => b.id !== buildingId);
            families = families.filter(f => f.building !== buildingId);

            // 3. حفظ وتحديث الواجهة
            syncData();
            closeModal();
            renderDashboard();

            Swal.fire({
                title: 'تم الحذف!',
                text: 'تم حذف المبنى والعوائل بنجاح',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false,
                background: getCssVar('--card-bg') || '#0f0f0f',
                color: getCssVar('--text-color') || '#fff'
            });
            
            // تصفير المتغير للأمان
            currentEditingBuildingId = null;
        }
    });
};
    </script>
  </body>
</html>
