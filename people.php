
<!DOCTYPE html>
<html lang="ar" dir="rtl" class="page-people">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دليل السكان الشامل - نظام الإسكان</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="container">
        <!-- Header -->
        <div style="padding: 2rem 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; margin: 0 0 0.5rem 0; color: var(--text-color);">
                    <i class="fas fa-address-book" style="margin-left: 0.5rem; color: var(--accent-gray-400);"></i>
                    دليل السكان الشامل
                </h1>
                <p style="color: var(--text-muted); margin: 0;">عرض وإدارة جميع السكان في نظام الإسكان</p>
            </div>
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center;">
                <div class="theme-switcher" role="group" aria-label="اختيار الثيم">
                    <button type="button" class="theme-btn" data-theme="dark">غامق</button>
                    <button type="button" class="theme-btn" data-theme="burgundy">أبيض</button>
                </div>
                <a href="index_modified.php" class="btn-primary" style="font-size: 0.95rem; padding: 10px 20px; display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none;">
                    <i class="fas fa-home"></i>
                    الرئيسية
                </a>
            </div>
        </div>

        <!-- Filter and Actions -->
        <div class="glass-panel" style="margin-bottom: 2rem; padding: 1.5rem;">
            <div style="display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; justify-content: space-between;">
                <div style="display: flex; flex-wrap: wrap; gap: 1rem; flex: 1; min-width: 300px;">
                    <input type="text" id="search-input" class="glass-input" style="flex: 1; min-width: 200px;" placeholder="ابحث باسم الساكن..." oninput="filterPeople()">
                    <select id="filter-building" class="glass-input" style="width: auto; color: var(--stat-1-border);" onchange="filterPeople()">
                        <option value="">كل المباني</option>
                        <option value="A">🟢 المبنى A</option>
                        <option value="B">🔵 المبنى B</option>
                        <option value="C">⚪ المبنى C</option>
                    </select>
                    <select id="filter-health" class="glass-input" style="width: auto; color: var(--health-chronic);" onchange="filterPeople()">
                        <option value="">كل الحالات</option>
                        <option value="سليم">🟢 سليم</option>
                        <option value="مرض مزمن">🟠 مرض مزمن</option>
                        <option value="إعاقة">🔴 إعاقة</option>
                    </select>
                    <select id="filter-sort" class="glass-input" style="width: auto;" onchange="filterPeople()">
                        <option value="default">ترتيب افتراضي</option>
                        <option value="name">حسب الاسم</option>
                        <option value="age">حسب العمر</option>
                        <option value="building">حسب المبنى</option>
                        <option value="health">حسب الحالة الصحية</option>
                    </select>
                </div>
                <div class="actions-row">
                    <button onclick="refreshPeopleData()" class="btn-primary" style="display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-rotate-right"></i>
                        تحديث
                    </button>
                    <button onclick="exportFilteredExcel()" class="btn-primary" style="display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-excel"></i>
                        تصدير
                    </button>
                    <button onclick="exportFilteredCsv()" class="btn-primary" style="display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-csv"></i>
                        تصدير CSV
                    </button>
                    <button onclick="copyPeopleSummary()" class="btn-primary" style="display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-copy"></i>
                        نسخ ملخص
                    </button>
                    <button onclick="clearAllPeopleData()" class="btn-close" style="display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-trash"></i>
                        مسح الكل
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
            <button type="button" class="glass-panel stat-btn" data-stat="all" style="padding: 1.5rem; border-top: 4px solid var(--stat-1-border);">
                <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.5rem;">إجمالي السكان</div>
                <div id="stat-total" style="font-size: 2rem; font-weight: 700; color: var(--text-color);">0</div>
            </button>
            <button type="button" class="glass-panel stat-btn" data-stat="children" style="padding: 1.5rem; border-top: 4px solid var(--stat-2-border);">
                <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.5rem;">أطفال</div>
                <div id="stat-children" style="font-size: 2rem; font-weight: 700; color: var(--text-color);">0</div>
            </button>
            <button type="button" class="glass-panel stat-btn" data-stat="adults" style="padding: 1.5rem; border-top: 4px solid var(--stat-3-border);">
                <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.5rem;">بالغين</div>
                <div id="stat-adults" style="font-size: 2rem; font-weight: 700; color: var(--text-color);">0</div>
            </button>
            <button type="button" class="glass-panel stat-btn" data-stat="elderly" style="padding: 1.5rem; border-top: 4px solid var(--stat-4-border);">
                <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.5rem;">كبار السن</div>
                <div id="stat-elderly" style="font-size: 2rem; font-weight: 700; color: var(--text-color);">0</div>
            </button>
            <button type="button" class="glass-panel stat-btn" data-stat="disabled" style="padding: 1.5rem; border-top: 4px solid var(--stat-5-border);">
                <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.5rem;">ذوي احتياجات</div>
                <div id="stat-disabled" style="font-size: 2rem; font-weight: 700; color: var(--text-color);">0</div>
            </button>
             <button type="button" onclick="showChildrenUnderFive()" class="glass-panel" style="padding: 1.5rem; border-top: 4px solid var(--stat-6-border);">
                <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.5rem;">أطفال تحت 5 سنوات</div>
                <div id="stat-under-5" style="font-size: 2rem; font-weight: 700; color: var(--text-color);">0</div>
            </button>
        </div>

        <div class="results-count">
            عدد النتائج: <span id="results-count">0</span> • آخر تحديث: <span id="last-updated">-</span>
        </div>

        <!-- People Grid -->
        <div id="people-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem;">
        </div>
    </div>

    <!-- Family Details Modal -->
    <div id="familyDetailsModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title" style="margin: 0; font-size: 1.3rem; font-weight: 700; color: var(--text-color);">تفاصيل العائلة</h3>
                <button onclick="closeModal()" class="btn-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="familyDetailsContent"></div>
            </div>
            <div class="modal-footer">
                <button onclick="closeModal()" class="btn-primary">إغلاق</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
        // === Configuration ===
        const STORAGE_KEY = 'housing_data';
        const BUILDINGS_KEY = 'housing_buildings';
        
        // === State ===
        let allPeople = [];
        let filteredPeople = [];
        let familyMembers = [];
        let families = [];
        let buildings = [];
        const THEME_KEY = 'ui_theme';
        let currentTheme = 'dark';
        let activeStatFilter = 'all';
        let lastFilteredPeople = [];

        function setActiveThemeButton() {
            document.querySelectorAll('.theme-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.theme === currentTheme);
            });
        }

        function getCssVar(name) {
            return getComputedStyle(document.documentElement)
                .getPropertyValue(name)
                .trim();
        }

        function applyTheme(theme, options = {}) {
            currentTheme = theme || 'dark';
            document.documentElement.setAttribute('data-theme', currentTheme);
            if (!options.skipSave) {
                localStorage.setItem(THEME_KEY, currentTheme);
            }
            setActiveThemeButton();
        }

        function initTheme() {
            const savedTheme = localStorage.getItem(THEME_KEY);
            applyTheme(savedTheme || 'dark', { skipSave: true });
        }

        function applyStatFilter(list) {
            if (activeStatFilter === 'all') return list;

            return list.filter(person => {
                const age = person.age !== null && person.age !== undefined ? parseInt(person.age) : null;
                if (Number.isNaN(age)) return false;

                if (activeStatFilter === 'children') return age < 18;
                if (activeStatFilter === 'elderly') return age >= 60;
                if (activeStatFilter === 'disabled') return age >= 18 && age < 60 && person.health !== 'سليم';
                if (activeStatFilter === 'adults') return age >= 18 && age < 60 && person.health === 'سليم';

                return true;
            });
        }

        function sortPeople(list) {
            const sortValue = document.getElementById('filter-sort')?.value || 'default';
            if (sortValue === 'default') return list;

            const sorted = list.slice();
            const healthOrder = { 'سليم': 0, 'مرض مزمن': 1, 'إعاقة': 2 };

            sorted.sort((a, b) => {
                if (sortValue === 'name') {
                    return (a.name || '').localeCompare(b.name || '', 'ar');
                }
                if (sortValue === 'age') {
                    const ageA = a.age === null || a.age === undefined ? Infinity : a.age;
                    const ageB = b.age === null || b.age === undefined ? Infinity : b.age;
                    return ageA - ageB;
                }
                if (sortValue === 'building') {
                    const buildingA = (a.buildingName || a.building || '').toString();
                    const buildingB = (b.buildingName || b.building || '').toString();
                    const cmp = buildingA.localeCompare(buildingB, 'ar');
                    if (cmp !== 0) return cmp;
                    return (a.room || 0) - (b.room || 0);
                }
                if (sortValue === 'health') {
                    const orderA = healthOrder[a.health] ?? 99;
                    const orderB = healthOrder[b.health] ?? 99;
                    return orderA - orderB;
                }
                return 0;
            });

            return sorted;
        }

        function updateResultsCount(count) {
            const el = document.getElementById('results-count');
            if (el) el.textContent = count;
        }

        function updateLastUpdatedTime() {
            const el = document.getElementById('last-updated');
            if (!el) return;
            el.textContent = new Date().toLocaleString('ar-EG');
        }

        function exportFilteredCsv() {
            if (!lastFilteredPeople.length) {
                alert('لا توجد نتائج لتصديرها.');
                return;
            }

            const header = ['الاسم', 'الصفة', 'العمر', 'الصحة', 'المبنى', 'الغرفة', 'العائلة', 'الهاتف'];
            const rows = lastFilteredPeople.map(p => ([
                p.name || '',
                p.roleLabel || '',
                p.age ?? '',
                p.health || '',
                p.buildingName || p.building || '',
                p.room || '',
                p.surname || '',
                p.phone || ''
            ]));

            const csvContent = [header, ...rows]
                .map(row => row.map(value => `"${String(value ?? '').replace(/\"/g, '""')}"`).join(','))
                .join('\n');

            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = 'People_Filtered.csv';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(url);
        }

        function copyPeopleSummary() {
            const summary = [
                `إجمالي السكان: ${document.getElementById('stat-total').textContent}`,
                `أطفال: ${document.getElementById('stat-children').textContent}`,
                `بالغين: ${document.getElementById('stat-adults').textContent}`,
                `كبار السن: ${document.getElementById('stat-elderly').textContent}`,
                `ذوي احتياجات: ${document.getElementById('stat-disabled').textContent}`,
                `أطفال تحت 5 سنوات: ${document.getElementById('stat-under-5').textContent}`,
                `عدد النتائج الحالية: ${document.getElementById('results-count').textContent}`
            ].join('\n');

            if (navigator.clipboard) {
                navigator.clipboard.writeText(summary).then(() => {
                    const btn = document.querySelector('button[onclick="copyPeopleSummary()"]');
                    if (btn) {
                        const original = btn.innerHTML;
                        btn.innerHTML = '<i class="fas fa-check"></i> تم النسخ';
                        setTimeout(() => { btn.innerHTML = original; }, 1200);
                    }
                });
            } else {
                alert(summary);
            }
        }

        async function refreshPeopleData() {
            await AppUtils.trySyncPending();
            await loadData();
            populateBuildingFilter();
            filterPeople();
            updateLastUpdatedTime();
        }

        function updateStatButtons() {
            document.querySelectorAll('.stat-btn').forEach(btn => {
                const isActive = btn.dataset.stat === activeStatFilter;
                btn.classList.toggle('active', isActive);
                btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
            });
        }

        function setStatFilter(filterKey) {
            activeStatFilter = activeStatFilter === filterKey ? 'all' : filterKey;
            updateStatButtons();
            filterPeople();
        }

        // === Initialize ===
        document.addEventListener('DOMContentLoaded', async () => {
            initTheme();
            document.querySelectorAll('.theme-btn').forEach(btn => {
                btn.addEventListener('click', () => applyTheme(btn.dataset.theme));
            });
            document.querySelectorAll('.stat-btn').forEach(btn => {
                btn.addEventListener('click', () => setStatFilter(btn.dataset.stat));
            });
            await AppUtils.trySyncPending();
            await loadData();
            populateBuildingFilter();
            filterPeople();
            initChart();
            updateStatButtons();
        });

        // === Data Management ===
        async function loadData() {
            const data = await AppUtils.loadAllData();
            families = data.families || [];
            buildings = data.buildings || [];
            allPeople = transformFamiliesToPeople(families);
        }

        function getBuildingName(buildingId) {
            if (!buildingId) return '';
            const building = buildings.find(b => String(b.id) === String(buildingId));
            return building?.name || buildingId;
        }

        function populateBuildingFilter() {
            const select = document.getElementById('filter-building');
            if (!select) return;

            let optionsHtml = '<option value="">كل المباني</option>';

            if (buildings.length > 0) {
                buildings.forEach(building => {
                    optionsHtml += `<option value="${building.id}">المبنى ${building.name}</option>`;
                });
            } else {
                const seen = new Set();
                allPeople.forEach(person => {
                    if (!person.building) return;
                    const key = String(person.building);
                    if (seen.has(key)) return;
                    seen.add(key);
                    const label = person.buildingName || person.building;
                    optionsHtml += `<option value="${person.building}">المبنى ${label}</option>`;
                });
            }

            select.innerHTML = optionsHtml;
        }
        function getVisibleUnderFive() {
            const visibleChildIds = new Set(
                filteredPeople
                    .filter(person => person.role === 'child')
                    .map(person => person.id)
            );
            const underFive = [];

            families.forEach(family => {
                (family.children || []).forEach((child, idx) => {
                    const childId = `child-${family.id}-${idx}`;
                    if (!visibleChildIds.has(childId)) return;
                    if (child.age !== null && child.age !== undefined && child.age !== "") {
                        const age = parseInt(child.age);
                        if (!Number.isNaN(age) && age <= 5) {
                            underFive.push({ child, family });
                        }
                    }
                });
            });

            return underFive;
        }

        function showChildrenUnderFive() {
            const underFive = getVisibleUnderFive();

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
                confirmButtonColor: "#6d001a",
                showCloseButton: true,
            });
        }

        function transformFamiliesToPeople(families) {
            const people = [];
            
            families.forEach(family => {
                const baseInfo = {
                    familyId: family.id,
                    building: family.building,
                    buildingName: family.buildingName,
                    floor: family.floor,
                    room: family.room,
                    surname: family.father?.surname || family.mother?.name || 'غير محدد',
                    needs: family.needs || [],
                    notes: family.adminNotes
                };

                // Father
                if (family.father?.name) {
                    people.push({
                        ...baseInfo,
                        id: `father-${family.id}`,
                        name: family.father.name,
                        role: 'father',
                        roleLabel: 'الأب',
                        age: family.father.age || null,
                        phone: family.father.phone || '',
                        health: family.father.health || 'سليم'
                    });
                }

                // Mother
                if (family.mother?.name) {
                    people.push({
                        ...baseInfo,
                        id: `mother-${family.id}`,
                        name: family.mother.name,
                        role: 'mother',
                        roleLabel: 'الأم',
                        age: family.mother.age || null,
                        phone: '',
                        health: family.mother.health || 'سليم'
                    });
                }

                // Children
                (family.children || []).forEach((child, idx) => {
                    people.push({
                        ...baseInfo,
                        id: `child-${family.id}-${idx}`,
                        name: child.name,
                        role: 'child',
                        roleLabel: 'ابن',
                        age: child.age || null,
                        phone: '',
                        health: child.health || 'سليم',
                        gender: child.gender
                    });
                });

                // Relatives
                (family.relatives || []).forEach((relative, idx) => {
                    people.push({
                        ...baseInfo,
                        id: `relative-${family.id}-${idx}`,
                        name: relative.name,
                        role: 'relative',
                        roleLabel: relative.relationship || 'قريب',
                        age: relative.age || null,
                        phone: '',
                        health: relative.health || 'سليم'
                    });
                });
            });

            return people;
        }

        // === Filter & Render ===
        function filterPeople() {
            const searchTerm = document.getElementById('search-input').value.trim().toLowerCase();
            const filterBuilding = document.getElementById('filter-building').value;
            const filterHealth = document.getElementById('filter-health').value;

            const basePeople = allPeople.filter(person => {
                const nameValue = (person.name || '').toLowerCase();
                const surnameValue = (person.surname || '').toLowerCase();
                const matchesSearch = !searchTerm || 
                    nameValue.includes(searchTerm) ||
                    surnameValue.includes(searchTerm);
                const matchesBuilding = !filterBuilding || String(person.building) === String(filterBuilding);
                const matchesHealth = !filterHealth || person.health === filterHealth;

                return matchesSearch && matchesBuilding && matchesHealth;
            });

            const statFiltered = applyStatFilter(basePeople);
            filteredPeople = sortPeople(statFiltered);
            lastFilteredPeople = filteredPeople;
            renderPeople();
            updateChart();
            updateResultsCount(filteredPeople.length);
            updateLastUpdatedTime();
        }
        function renderPeople() {
            const grid = document.getElementById('people-grid');
            grid.innerHTML = '';

            if (filteredPeople.length === 0) {
                grid.innerHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--text-muted);">
                        <i class="fas fa-users" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                        <p>لا يوجد سكان مطابقين</p>
                    </div>
                `;
                return;
            }

            const roleIcons = {
                father: 'fa-male',
                mother: 'fa-female',
                child: 'fa-child',
                relative: 'fa-user'
            };

            filteredPeople.forEach(person => {
                const card = document.createElement('div');
                card.className = 'glass-panel person-card';
                card.style.padding = '1.5rem';

                card.innerHTML = `
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--hover-bg); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--accent-gray-300);">
                            <i class="fas ${roleIcons[person.role] || 'fa-user'}"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 600; font-size: 1.1rem; color: var(--text-color); margin-bottom: 0.25rem;">
                                ${person.name}
                            </div>
                            <span class="role-badge">${person.roleLabel}</span>
                        </div>
                    </div>
                    <div style="display: grid; gap: 0.5rem; font-size: 0.9rem;">
                        ${person.age ? `
                            <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-muted);">
                                <i class="fas fa-birthday-cake" style="width: 20px; color: var(--accent-gray-500);"></i>
                                <span>${person.age} سنة</span>
                            </div>
                        ` : ''}
                        ${person.health ? `
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-heartbeat" style="width: 20px;"></i>
                                <span style="color: ${person.health === 'سليم' ? 'var(--health-ok)' : person.health === 'مرض مزمن' ? 'var(--health-chronic)' : 'var(--health-disability)'}; background: ${person.health === 'سليم' ? 'var(--health-ok-bg)' : person.health === 'مرض مزمن' ? 'var(--health-chronic-bg)' : 'var(--health-disability-bg)'}; padding: 4px 10px; border-radius: 12px; font-size: 0.85rem;">${person.health}</span>
                            </div>
                        ` : ''}
                        ${person.phone ? `
                            <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-muted);">
                                <i class="fas fa-phone" style="width: 20px; color: var(--accent-gray-500);"></i>
                                <span>${person.phone}</span>
                            </div>
                        ` : ''}
                        ${person.building ? `
                            <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-muted);">
                                <i class="fas fa-home" style="width: 20px; color: var(--accent-gray-500);"></i>
                                <span>مبنى ${getBuildingName(person.building)} - غرفة ${person.room}</span>
                            </div>
                        ` : ''}
                    </div>
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--glass-border);">
                        <button onclick="showFamilyDetails(${JSON.stringify(person.familyId)})" class="btn-primary" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                            <i class="fas fa-users"></i>
                            عرض تفاصيل العائلة
                        </button>
                    </div>
                `;

                grid.appendChild(card);
            });
        }

        // === Modal Functions ===
        function showFamilyDetails(familyId) {
            const family = getCurrentFamilies().find(f => String(f.id) === String(familyId));
            if (!family) return;

            const content = document.getElementById('familyDetailsContent');
            
            // Build family members list
            let membersHtml = '';
            
            if (family.father?.name) {
                membersHtml += createMemberCard('fa-male', 'الأب', family.father.name, family.father.age, family.father.health, family.father.phone);
            }
            
            if (family.mother?.name) {
                membersHtml += createMemberCard('fa-female', 'الأم', family.mother.name, family.mother.age, family.mother.health);
            }
            
            if (family.children?.length) {
                family.children.forEach(child => {
                    membersHtml += createMemberCard('fa-child', 'ابن', child.name, child.age, child.health);
                });
            }
            
            if (family.relatives?.length) {
                family.relatives.forEach(relative => {
                    membersHtml += createMemberCard('fa-user', relative.relationship || 'قريب', relative.name, relative.age, relative.health);
                });
            }

            content.innerHTML = `
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <div style="font-size: 3rem; margin-bottom: 0.5rem;">🏠</div>
                    <h4 style="font-size: 1.3rem; font-weight: 700; color: var(--text-color); margin: 0;">
                        عائلة ${family.father?.surname || family.mother?.name || 'غير محدد'}
                    </h4>
                    ${family.building ? `
                        <div style="color: var(--accent-gray-400); margin-top: 0.5rem;">
                            <i class="fas fa-building" style="margin-left: 0.5rem;"></i>
                            المبنى ${family.building} - الطابق ${family.floor} - غرفة ${family.room}
                        </div>
                    ` : ''}
                </div>
                
                <div class="glass-panel" style="padding: 1.5rem; margin-bottom: 1.5rem;">
                    <h5 style="font-size: 1rem; font-weight: 600; color: var(--text-color); margin: 0 0 1rem 0; border-bottom: 1px solid var(--glass-border); padding-bottom: 0.5rem;">
                        أعضاء العائلة
                    </h5>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        ${membersHtml || '<p style="color: var(--text-muted); text-align: center;">لا يوجد أعضاء</p>'}
                    </div>
                </div>

                ${family.needs?.length ? `
                    <div class="glass-panel" style="padding: 1.5rem; margin-bottom: 1.5rem;">
                        <h5 style="font-size: 1rem; font-weight: 600; color: var(--text-color); margin: 0 0 1rem 0; border-bottom: 1px solid var(--glass-border); padding-bottom: 0.5rem;">
                            <i class="fas fa-hands-helping" style="margin-left: 0.5rem; color: var(--accent-gray-400);"></i>
                            احتياجات خاصة
                        </h5>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                            ${family.needs.map(need => `
                                <span style="background: var(--hover-bg); padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; color: var(--accent-gray-300);">
                                    ${need}
                                </span>
                            `).join('')}
                        </div>
                    </div>
                ` : ''}

                ${family.adminNotes ? `
                    <div class="glass-panel" style="padding: 1.5rem;">
                        <h5 style="font-size: 1rem; font-weight: 600; color: var(--text-color); margin: 0 0 1rem 0; border-bottom: 1px solid var(--glass-border); padding-bottom: 0.5rem;">
                            <i class="fas fa-sticky-note" style="margin-left: 0.5rem; color: var(--accent-gray-400);"></i>
                            ملاحظات إدارية
                        </h5>
                        <p style="color: var(--text-muted); margin: 0; line-height: 1.6;">${family.adminNotes}</p>
                    </div>
                ` : ''}
            `;

            document.getElementById('familyDetailsModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function createMemberCard(icon, role, name, age, health, phone = '') {
            return `
                <div class="glass-panel" style="padding: 1rem;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--hover-bg); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: var(--accent-gray-300);">
                            <i class="fas ${icon}"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 600; color: var(--text-color);">${name}</div>
                            <div style="font-size: 0.85rem; color: var(--text-muted);">${role}</div>
                        </div>
                        <div style="text-align: left;">
                            ${age ? `<div style="font-size: 0.85rem; color: var(--text-muted);">${age} سنة</div>` : ''}
                            <div style="font-size: 0.85rem; color: ${health === 'سليم' ? 'var(--accent-gray-200)' : 'var(--accent-gray-500)'};">${health || '-'}</div>
                        </div>
                    </div>
                </div>
            `;
        }

        function closeModal() {
            const modal = document.getElementById('familyDetailsModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // === Helper Functions ===
        function getCurrentFamilies() {
            if (Array.isArray(families) && families.length) {
                return families;
            }

            const data = localStorage.getItem(STORAGE_KEY);
            if (data) {
                return JSON.parse(data);
            }

            const legacyData = localStorage.getItem('housing_families');
            return legacyData ? JSON.parse(legacyData) : [];
        }

        // === Statistics ===
        function initChart() {
            updateChart();
        }
    
        function updateChart() {
            const categories = { children: 0, adults: 0, elderly: 0, disabled: 0 };
            
            filteredPeople.forEach(p => {
                if (p.age) {
                    if (p.age < 18) {
                        categories.children++;
                    } else if (p.age >= 60) {
                        categories.elderly++;
                    } else if (p.health !== 'سليم') {
                        categories.disabled++;
                    } else {
                        categories.adults++;
                    }
                }
            });
            
            // Update stats cards
            document.getElementById('stat-total').textContent = filteredPeople.length;
            document.getElementById('stat-children').textContent = categories.children;
            document.getElementById('stat-adults').textContent = categories.adults;
            document.getElementById('stat-elderly').textContent = categories.elderly;
            document.getElementById('stat-disabled').textContent = categories.disabled;
            document.getElementById('stat-under-5').textContent = getVisibleUnderFive().length;
        }

        // === Export ===
        function exportFilteredExcel() {
            const dataToExport = filteredPeople.map(p => ({
                الاسم: p.name,
                الصفة: p.roleLabel,
                العمر: p.age || '',
                الصحة: p.health,
                المبنى: p.building || '',
                الغرفة: p.room || '',
                العائلة: p.surname,
                الهاتف: p.phone || ''
            }));
            
            const ws = XLSX.utils.json_to_sheet(dataToExport);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "People_List");
            XLSX.writeFile(wb, "People_Filtered.xlsx");
        }

        // === Clear All Data ===
        function clearAllPeopleData() {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: 'سيتم حذف جميع السكان والبيانات المسجلة نهائياً! لا يمكن التراجع عن هذا الإجراء.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#525252',
                cancelButtonColor: '#a1a1aa',
                confirmButtonText: 'نعم، مسح الكل',
                cancelButtonText: 'إلغاء',
                background: getCssVar('--card-bg') || '#0f0f0f',
                color: getCssVar('--text-color') || '#fff',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    localStorage.removeItem(STORAGE_KEY);
                    localStorage.removeItem('housing_families');
                    localStorage.removeItem(BUILDINGS_KEY);
                    families = [];
                    buildings = [];
                    AppUtils.saveAllData({ families, buildings });
                    
                    location.reload();
                    
                    setTimeout(() => {
                        Swal.fire({
                            title: 'تم المسح!',
                            text: 'تم حذف جميع البيانات بنجاح',
                            icon: 'success',
                            background: getCssVar('--card-bg') || '#0f0f0f',
                            color: getCssVar('--text-color') || '#fff',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }, 500);
                }
            });
        }

        // === Event Listeners ===
        // Close modal on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Close modal on overlay click
        document.getElementById('familyDetailsModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('familyDetailsModal')) {
                closeModal();
            }
        });
    </script>
</body>
</html>
