<!DOCTYPE html>
<html lang="ar" dir="rtl" class="page-families">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>إدارة العائلات المتقدمة</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
</head>
<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="container" style="padding: 2rem 1rem;">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; margin: 0 0 0.5rem 0; color: var(--text-color);">
                    <i class="fas fa-users" style="margin-left: 0.5rem; color: var(--accent-gray-400);"></i>
                    إدارة العائلات
                </h1>
                <p style="color: var(--text-muted); margin: 0;">إضافة وتعديل بيانات العائلات</p>
            </div>
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center;">
                <div class="theme-switcher" role="group" aria-label="اختيار الثيم">
                    <button type="button" class="theme-btn" data-theme="dark">غامق</button>
                    <button type="button" class="theme-btn" data-theme="burgundy">أبيض</button>
                </div>
                <button type="button" onclick="createRandomFamily()" class="btn-secondary" style="display: flex; align-items: center; gap: 0.4rem; font-size: 0.85rem; padding: 6px 10px;">
                    <i class="fas fa-random"></i>
                </button>
                <button onclick="openModal()" class="btn-primary" style="display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-plus"></i>
                    إضافة عائلة جديدة
                </button>
                
            <a href="index_modified.php" class="btn-primary" style="font-size: 0.95rem; padding: 10px 20px; display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none;">
                <i class="fas fa-home"></i>
                الرئيسية
            </a>
            <a href="rooms.php" class="btn-primary" style="font-size: 0.95rem; padding: 10px 20px; display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none;">
                <i class="fas fa-door-open"></i>
                صفحة الغرف
            </a>
            </div>
        </div>

        <!-- Stats -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
            <button type="button" class="glass-panel stat-btn" style="padding: 1.5rem;" onclick="scrollToSection('fam')">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 50px; height: 50px; border-radius: 12px; background: var(--stat-1-bg); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--stat-1-fg);">
                        <i class="fas fa-home"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.25rem;">إجمالي العائلات</div>
                        <div id="total-families" style="font-size: 2rem; font-weight: 700; color: var(--text-color);">0</div>
                    </div>
                </div>
            </button>
            <button type="button" class="glass-panel stat-btn" style="padding: 1.5rem;" onclick="window.location.href='rooms.php'">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 50px; height: 50px; border-radius: 12px; background: var(--stat-1-bg); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--stat-1-fg);">
                        <i class="fas fa-door-closed"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.25rem;">عدد الغرف</div>
                        <div id="total-rooms" style="font-size: 2rem; font-weight: 700; color: var(--text-color);">0</div>
                    </div>
                </div>
            </button>
            <button type="button" onclick="window.location.href='people.php'" class="glass-panel stat-btn" style="padding: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 50px; height: 50px; border-radius: 12px; background: var(--stat-2-bg); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--stat-2-fg);">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.25rem;">إجمالي السكان</div>
                        <div id="total-people" style="font-size: 2rem; font-weight: 700; color: var(--text-color);">0</div>
                    </div>
                </div>
            </button>
            
            <button type="button" onclick="window.location.href='rooms.php?status=shared'" class="glass-panel stat-btn" style="padding: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 50px; height: 50px; border-radius: 12px; background: var(--stat-3-bg); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--stat-3-fg);">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.25rem;">الغرف المشتركة</div>
                        <div id="total-shared-rooms" style="font-size: 2rem; font-weight: 700; color: var(--text-color);">0</div>
                    </div>
                </div>
            </button>

        </div>

        <div class="glass-panel" style="padding: 1.5rem; margin-bottom: 1.5rem;">
            <div class="filters-grid">
                <input id="family-search" type="text" class="glass-input" placeholder="ابحث باسم العائلة أو رب الأسرة">
                <select id="family-filter-building" class="glass-input">
                    <option value="">كل المباني</option>
                </select>
                <select id="family-filter-composition" class="glass-input">
                    <option value="">كل التكوينات</option>
                    <option value="father-mother-children">عائلة كاملة</option>
                    <option value="father-only">أب فقط</option>
                    <option value="mother-only">أم فقط</option>
                    <option value="mother-children-only">أم وأبناء</option>
                    <option value="father-children-only">أب وأبناء</option>
                    <option value="no-family">بدون عائلة</option>
                </select>
                <select id="family-filter-sort" class="glass-input">
                    <option value="default">ترتيب افتراضي</option>
                    <option value="name">حسب الاسم</option>
                    <option value="members">حسب عدد الأفراد</option>
                    <option value="latest">الأحدث</option>
                </select>
            </div>
            <div class="actions-row">
                <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                    <button id="family-refresh" type="button" class="btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-rotate-right"></i>
                        تحديث البيانات
                    </button>
                    <button id="family-export" type="button" class="btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-file-csv"></i>
                        تصدير CSV
                    </button>
                </div>
                <button id="family-reset" type="button" class="btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-rotate"></i>
                    مسح الفلاتر
                </button>
            </div>
        </div>

        <div class="results-count">
            عدد النتائج: <span id="families-results-count">0</span> • آخر تحديث: <span id="families-last-updated">-</span>
        </div>

        <!-- Families List -->
        <div id="fam" class="glass-panel" style="padding: 1.5rem;">
            <h2 style="font-size: 1.3rem; font-weight: 600; margin: 0 0 1.5rem 0; color: var(--text-color); border-bottom: 1px solid var(--glass-border); padding-bottom: 0.5rem;">
                <i class="fas fa-list" style="margin-left: 0.5rem; color: var(--accent-gray-400);"></i>
                قائمة العائلات
            </h2>
            <div id="families-list" class="families-grid"></div>
        </div>
    </div>

    <!-- Family Modal -->
    <div id="family-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title" style="margin: 0; font-size: 1.3rem; font-weight: 700; color: var(--text-color);">إضافة عائلة جديدة</h2>
                <button onclick="closeModal()" class="btn-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="family-form">
                    <input type="hidden" id="family-id">
                    
                    <!-- Family Composition -->
                    <div style="margin-bottom: 2rem;">
                        <label class="label">مكونات الأسرة <span style="color: var(--error);">*</span></label>
                        <div class="composition-grid" id="composition-options">
                            <div class="composition-card" data-value="father-mother-children" onclick="selectComposition('father-mother-children')">
                                <div class="check-indicator"></div>
                                <div class="icon-wrapper">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-content">
                                    <div class="card-title">عائلة كاملة</div>
                                    <div class="card-description">الأب، الأم، والأبناء</div>
                                </div>
                            </div>
                            
                            <div class="composition-card" data-value="father-only" onclick="selectComposition('father-only')">
                                <div class="check-indicator"></div>
                                <div class="icon-wrapper">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="card-content">
                                    <div class="card-title">أب فقط</div>
                                    <div class="card-description">عائلة بمعيل واحد (الأب)</div>
                                </div>
                            </div>
                            
                            <div class="composition-card" data-value="mother-only" onclick="selectComposition('mother-only')">
                                <div class="check-indicator"></div>
                                <div class="icon-wrapper">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="card-content">
                                    <div class="card-title">أم فقط</div>
                                    <div class="card-description">عائلة بمعيل واحد (الأم)</div>
                                </div>
                            </div>
                            
                            <div class="composition-card" data-value="mother-children-only" onclick="selectComposition('mother-children-only')">
                                <div class="check-indicator"></div>
                                <div class="icon-wrapper">
                                    <i class="fas fa-child"></i>
                                </div>
                                <div class="card-content">
                                    <div class="card-title">أم وأبناء</div>
                                    <div class="card-description">أم مع أبناء فقط</div>
                                </div>
                            </div>
                            
                            <div class="composition-card" data-value="father-children-only" onclick="selectComposition('father-children-only')">
                                <div class="check-indicator"></div>
                                <div class="icon-wrapper">
                                    <i class="fas fa-male"></i>
                                </div>
                                <div class="card-content">
                                    <div class="card-title">أب وأبناء</div>
                                    <div class="card-description">أب مع أبناء فقط</div>
                                </div>
                            </div>
                            
                            <div class="composition-card" data-value="no-family" onclick="selectComposition('no-family')">
                                <div class="check-indicator"></div>
                                <div class="icon-wrapper">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="card-content">
                                    <div class="card-title">بدون عائلة</div>
                                    <div class="card-description">مسكن بدون عائلة</div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="field-composition" value="">
                        <div id="composition-error" class="error-message hidden">يرجى اختيار تكوين الأسرة</div>
                    </div>

                    <!-- Location Fields -->
                    <div id="location-fields" style="margin-bottom: 2rem;">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                            <div>
                                <label class="label">المبنى <span style="color: var(--error);">*</span></label>
                                <select id="field-building" class="glass-input" onchange="loadAvailableFloors()">
                                    <option value="">اختر المبنى</option>
                                </select>
                            </div>
                            <div>
                                <label class="label">الطابق <span style="color: var(--error);">*</span></label>
                                <select id="field-floor" class="glass-input" onchange="loadAvailableRooms()">
                                    <option value="">اختر الطابق</option>
                                </select>
                            </div>
                            <div>
                                <label class="label">رقم الغرفة <span style="color: var(--error);">*</span></label>
                                <select id="field-room" class="glass-input">
                                    <option value="">اختر الغرفة</option>
                                </select>
                            </div>
                        </div>
                        <div id="room-error" class="error-message hidden"></div>
                    </div>

                    <!-- Father Section -->
                    <div id="father-section" style="margin-bottom: 2rem;">
                        <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 1rem; color: var(--text-color); border-bottom: 1px solid var(--glass-border); padding-bottom: 0.5rem;">
                            <i class="fas fa-male" style="margin-left: 0.5rem; color: var(--accent-gray-400);"></i>
                            بيانات الأب
                        </h3>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                            <div style="grid-column: span 2;">
                                <label class="label">الاسم الكامل <span style="color: var(--error);">*</span></label>
                                <input type="text" id="field-father-name" class="glass-input" placeholder="أدخل اسم الأب الكامل">
                            </div>
                            <div>
                                <label class="label">اسم العائلة (اللقب) <span style="color: var(--error);">*</span></label>
                                <input type="text" id="field-surname" class="glass-input" placeholder="اسم العائلة">
                            </div>
                            <div>
                                <label class="label">العمر</label>
                                <input type="number" id="field-father-age" class="glass-input" placeholder="العمر" min="0" max="120">
                            </div>
                            <div>
                                <label class="label">رقم الهاتف</label>
                                <input type="tel" id="field-phone" class="glass-input" placeholder="رقم الهاتف">
                            </div>
                            <div>
                                <label class="label">الحالة الصحية</label>
                                <select id="field-father-health" class="glass-input">
                                    <option value="سليم">سليم</option>
                                    <option value="مرض مزمن">مرض مزمن</option>
                                    <option value="إعاقة">إعاقة</option>
                                    <option value="أخرى">أخرى</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Mother Section -->
                    <div id="mother-section" style="margin-bottom: 2rem;">
                        <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 1rem; color: var(--text-color); border-bottom: 1px solid var(--glass-border); padding-bottom: 0.5rem;">
                            <i class="fas fa-female" style="margin-left: 0.5rem; color: var(--accent-gray-400);"></i>
                            بيانات الأم
                        </h3>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                            <div style="grid-column: span 2;">
                                <label class="label">الاسم الكامل</label>
                                <input type="text" id="field-mother-name" class="glass-input" placeholder="أدخل اسم الأم الكامل">
                            </div>
                            <div>
                                <label class="label">العمر</label>
                                <input type="number" id="field-mother-age" class="glass-input" placeholder="العمر" min="0" max="120">
                            </div>
                            <div>
                                <label class="label">الحالة الصحية</label>
                                <select id="field-mother-health" class="glass-input">
                                    <option value="سليم">سليم</option>
                                    <option value="مرض مزمن">مرض مزمن</option>
                                    <option value="إعاقة">إعاقة</option>
                                    <option value="أخرى">أخرى</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Children Section -->
                    <div id="children-section" style="margin-bottom: 2rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <h3 style="font-size: 1.2rem; font-weight: 600; margin: 0; color: var(--text-color); border-bottom: 1px solid var(--glass-border); padding-bottom: 0.5rem; flex: 1;">
                                <i class="fas fa-child" style="margin-left: 0.5rem; color: var(--accent-gray-400);"></i>
                                الأبناء
                            </h3>
                            <button type="button" onclick="addChildRow()" class="btn-primary" style="display: flex; align-items: center; gap: 0.5rem; margin-right: 1rem;">
                                <i class="fas fa-plus"></i>
                                إضافة ابن
                            </button>
                        </div>
                        <div id="children-container"></div>
                    </div>

                    <!-- Relatives Section -->
                    <div id="relatives-section" style="margin-bottom: 2rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <h3 style="font-size: 1.2rem; font-weight: 600; margin: 0; color: var(--text-color); border-bottom: 1px solid var(--glass-border); padding-bottom: 0.5rem; flex: 1;">
                                <i class="fas fa-users" style="margin-left: 0.5rem; color: var(--accent-gray-400);"></i>
                                الأقارب
                            </h3>
                            <button type="button" onclick="addRelativeRow()" class="btn-primary" style="display: flex; align-items: center; gap: 0.5rem; margin-right: 1rem;">
                                <i class="fas fa-plus"></i>
                                إضافة قريب
                            </button>
                        </div>
                        <div id="relatives-container"></div>
                    </div>

                    <!-- Notes Section -->
                    <div style="margin-bottom: 2rem;">
                        <label class="label">ملاحظات إدارية</label>
                        <textarea id="field-notes" class="glass-input" placeholder="أضف ملاحظات إدارية إذا لزم الأمر" style="min-height: 100px; resize: vertical;"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button onclick="closeModal()" class="btn-close">إلغاء</button>
                <button onclick="saveFamily()" class="btn-primary">حفظ البيانات</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
        // === Configuration ===
        const STORAGE_KEY = 'housing_data';
        const BUILDINGS_KEY = 'housing_buildings';
        const LEGACY_KEY = 'housing_families';
        
        // === State ===
        let families = [];
        let buildings = [];
        let selectedComposition = '';
        const THEME_KEY = 'ui_theme';
        let currentTheme = 'dark';
        let filteredFamilies = [];

        const familyFilters = {
            search: '',
            building: '',
            composition: '',
            sort: 'default'
        };

        function getCssVar(name) {
            return getComputedStyle(document.documentElement)
                .getPropertyValue(name)
                .trim();
        }

        function setActiveThemeButton() {
            document.querySelectorAll('.theme-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.theme === currentTheme);
            });
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

        function populateFamilyFilters() {
            const buildingSelect = document.getElementById('family-filter-building');
            if (!buildingSelect) return;

            buildingSelect.innerHTML = '<option value="">كل المباني</option>';
            buildings.forEach(building => {
                const option = document.createElement('option');
                option.value = building.id;
                option.textContent = building.name;
                buildingSelect.appendChild(option);
            });
        }

        function getFamilyLabel(family) {
            return (
                family.father?.surname ||
                family.father?.name ||
                family.mother?.name ||
                family.mother?.surname ||
                'بدون اسم'
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

        function sortFamilies(list) {
            if (familyFilters.sort === 'default') return list;

            const sorted = list.slice();
            sorted.sort((a, b) => {
                if (familyFilters.sort === 'name') {
                    return getFamilyLabel(a).localeCompare(getFamilyLabel(b), 'ar');
                }
                if (familyFilters.sort === 'members') {
                    return getFamilyMembersCount(b) - getFamilyMembersCount(a);
                }
                if (familyFilters.sort === 'latest') {
                    return Number(b.id) - Number(a.id);
                }
                return 0;
            });
            return sorted;
        }

        function applyFamilyFilters() {
            const searchTerm = familyFilters.search.trim().toLowerCase();

            const filtered = families.filter(family => {
                const matchesBuilding = !familyFilters.building || String(family.building) === String(familyFilters.building);
                const matchesComposition = !familyFilters.composition || family.composition === familyFilters.composition;

                let matchesSearch = true;
                if (searchTerm) {
                    const label = getFamilyLabel(family).toLowerCase();
                    const father = family.father?.name?.toLowerCase() || '';
                    const mother = family.mother?.name?.toLowerCase() || '';
                    const room = `${family.building || ''} ${family.floor || ''} ${family.room || ''}`.toLowerCase();
                    matchesSearch = label.includes(searchTerm) || father.includes(searchTerm) || mother.includes(searchTerm) || room.includes(searchTerm);
                }

                return matchesBuilding && matchesComposition && matchesSearch;
            });

            filteredFamilies = sortFamilies(filtered);
        }

        function updateFamiliesResultsInfo(count) {
            const countEl = document.getElementById('families-results-count');
            if (countEl) countEl.textContent = count;
            const dateEl = document.getElementById('families-last-updated');
            if (dateEl) dateEl.textContent = new Date().toLocaleString('ar-EG');
        }

        function resetFamilyFilters() {
            familyFilters.search = '';
            familyFilters.building = '';
            familyFilters.composition = '';
            familyFilters.sort = 'default';

            const searchInput = document.getElementById('family-search');
            const buildingSelect = document.getElementById('family-filter-building');
            const compositionSelect = document.getElementById('family-filter-composition');
            const sortSelect = document.getElementById('family-filter-sort');

            if (searchInput) searchInput.value = '';
            if (buildingSelect) buildingSelect.value = '';
            if (compositionSelect) compositionSelect.value = '';
            if (sortSelect) sortSelect.value = 'default';

            renderFamilies();
        }

        function exportFamiliesCsv() {
            if (!filteredFamilies.length) {
                alert('لا توجد نتائج لتصديرها.');
                return;
            }

            const header = ['اسم العائلة', 'التكوين', 'عدد الأفراد', 'المبنى', 'الطابق', 'الغرفة'];
            const rows = filteredFamilies.map(family => ([
                getFamilyLabel(family),
                family.composition || '',
                getFamilyMembersCount(family),
                family.buildingName || family.building || '',
                family.floor || '',
                family.room || ''
            ]));

            const csvContent = [header, ...rows]
                .map(row => row.map(value => `"${String(value ?? '').replace(/\"/g, '""')}"`).join(','))
                .join('\n');

            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = 'families_report.csv';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(url);
        }

        async function refreshFamilyData() {
            await AppUtils.trySyncPending();
            await loadData();
            populateBuildingsSelect();
            populateFamilyFilters();
            renderFamilies();
            updateStats();
        }

        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (!section) return;
            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        // === Initialize ===
        document.addEventListener('DOMContentLoaded', async () => {
            initTheme();
            document.querySelectorAll('.theme-btn').forEach(btn => {
                btn.addEventListener('click', () => applyTheme(btn.dataset.theme));
            });
            await AppUtils.trySyncPending();
            await loadData();
            populateBuildingsSelect();
            populateFamilyFilters();
            renderFamilies();
            updateStats();

            document.getElementById('family-search')?.addEventListener('input', (e) => {
                familyFilters.search = e.target.value;
                renderFamilies();
            });
            document.getElementById('family-filter-building')?.addEventListener('change', (e) => {
                familyFilters.building = e.target.value;
                renderFamilies();
            });
            document.getElementById('family-filter-composition')?.addEventListener('change', (e) => {
                familyFilters.composition = e.target.value;
                renderFamilies();
            });
            document.getElementById('family-filter-sort')?.addEventListener('change', (e) => {
                familyFilters.sort = e.target.value;
                renderFamilies();
            });
            document.getElementById('family-reset')?.addEventListener('click', resetFamilyFilters);
            document.getElementById('family-export')?.addEventListener('click', exportFamiliesCsv);
            document.getElementById('family-refresh')?.addEventListener('click', refreshFamilyData);
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

        // === Building Management ===
        function populateBuildingsSelect() {
            const select = document.getElementById('field-building');
            select.innerHTML = '<option value="">اختر المبنى</option>';

            if (buildings.length === 0) {
                select.innerHTML += '<option value="" disabled>لا توجد مباني. يرجى إنشاء مبنى أولاً</option>';
                select.disabled = true;
                return;
            }

            select.disabled = false;
            buildings.forEach(building => {
                const option = document.createElement('option');
                option.value = building.id;
                option.textContent = building.name;
                select.appendChild(option);
            });
        }

        function loadAvailableFloors() {
            const buildingId = document.getElementById('field-building').value;
            const floorSelect = document.getElementById('field-floor');
            const roomSelect = document.getElementById('field-room');

            floorSelect.innerHTML = '<option value="">اختر الطابق</option>';
            roomSelect.innerHTML = '<option value="">اختر الغرفة</option>';

            if (!buildingId) return;

            const building = buildings.find(b => b.id == buildingId);
            if (!building) return;

            building.floors.forEach(floor => {
                const option = document.createElement('option');
                option.value = floor.floor;
                option.textContent = `الطابق ${floor.floor}`;
                floorSelect.appendChild(option);
            });
        }

        function loadAvailableRooms() {
            const buildingId = document.getElementById('field-building').value;
            const floor = document.getElementById('field-floor').value;
            const roomSelect = document.getElementById('field-room');

            roomSelect.innerHTML = '<option value="">اختر الغرفة</option>';

            if (!buildingId || !floor) return;

            const building = buildings.find(b => b.id == buildingId);
            if (!building) return;

            const floorData = building.floors.find(f => f.floor == floor);
            if (!floorData) return;

            // Generate room numbers based on the number of rooms in this floor
            for (let i = 1; i <= floorData.rooms; i++) {
                const familiesInRoom = families.filter(f =>
                    f.building == buildingId &&
                    f.floor == floor &&
                    f.room == i
                ).length;

                const option = document.createElement('option');
                option.value = i;
                option.textContent = familiesInRoom > 0
                    ? `${i} (مشتركة: ${familiesInRoom})`
                    : i;
                roomSelect.appendChild(option);
            }
        }
        
        function updateTotalRoomsCount() {
            const totalRooms = buildings.reduce((sum, building) => {
                const floors = Array.isArray(building.floors) ? building.floors : [];
                return sum + floors.reduce((floorSum, floor) => {
                    return floorSum + (parseInt(floor.rooms, 10) || 0);
                }, 0);
            }, 0);
            const el = document.getElementById('total-rooms');
            if (el) el.textContent = totalRooms;
        }
        function roomsCountInUse() {
            const usedRooms = new Set();
            families.forEach(family => {
                if (!family.building || !family.floor || !family.room) return;
                const key = `${family.building}-${family.floor}-${family.room}`;
                usedRooms.add(key);
            });
            return usedRooms.size;
        }
        function totalsharedRooms () {
            const sharedRooms = {};
            families.forEach(family => {
                if (!family.building || !family.floor || !family.room) return;
                const key = `${family.building}-${family.floor}-${family.room}`;
                if (!sharedRooms[key]) {
                    sharedRooms[key] = 0;
                }
                sharedRooms[key]++;
            });
            return Object.values(sharedRooms).filter(count => count > 1).length;
        }

        function updateSharedRoomsCount() {
            const count = totalsharedRooms();
            const el = document.getElementById('total-shared-rooms');
            if (el) el.textContent = count;
        }

        function showSharedRooms() {
            const sharedRooms = {};

            families.forEach(family => {
                if (!family.building || !family.floor || !family.room) return;
                const key = `${family.building}-${family.floor}-${family.room}`;
                if (!sharedRooms[key]) {
                    sharedRooms[key] = {
                        building: family.building,
                        floor: family.floor,
                        room: family.room,
                        families: []
                    };
                }
                sharedRooms[key].families.push(family);
            });

            const sharedList = Object.values(sharedRooms).filter(room => room.families.length > 1);

            if (sharedList.length === 0) {
                Swal.fire({
                    title: 'لا توجد غرف مشتركة',
                    text: 'لا توجد غرف يسكنها أكثر من عائلة حالياً',
                    icon: 'info',
                    background: getCssVar('--card-bg') || '#0f0f0f',
                    color: getCssVar('--text-color') || '#fff'
                });
                return;
            }

            let html = `<div style="text-align: right; max-height: 60vh; overflow-y: auto;">`;
            sharedList.forEach((room, index) => {
                const building = buildings.find(b => b.id == room.building);
                const buildingName = building ? building.name : `مبنى ${room.building || '-'}`;
                const familiesList = room.families
                    .map(fam => getFamilyLabel(fam))
                    .join(' • ');

                html += `
                    <div class="glass-panel" style="padding: 1rem; margin-bottom: 0.75rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <div style="font-weight: 600; color: var(--text-color);">
                                ${buildingName} • الطابق ${room.floor} • الغرفة ${room.room}
                            </div>
                            <div style="font-size: 0.85rem; color: var(--text-muted);">
                                #${index + 1} • ${room.families.length} عوائل
                            </div>
                        </div>
                        <div style="font-size: 0.9rem; color: var(--text-muted);">
                            ${familiesList}
                        </div>
                    </div>
                `;
            });
            html += `</div>`;

            Swal.fire({
                title: 'الغرف المشتركة',
                html,
                background: getCssVar('--card-bg') || '#0f0f0f',
                color: getCssVar('--text-color') || '#fff',
                width: 820,
                confirmButtonText: 'إغلاق',
                showCloseButton: true
            });
        }
        // === Children/Relatives Management ===
        function updateChildRowFields(row, options = {}) {
            const { preserveValues = false } = options;
            const ageInput = row.querySelector('.child-age');
            const infantFields = row.querySelector('.child-infant-fields');
            const monthsField = row.querySelector('.child-months-field');
            const ageValue = ageInput ? ageInput.value.trim() : '';
            const ageNumber = ageValue === '' ? null : parseInt(ageValue, 10);
            const showInfantFields = ageNumber !== null && ageNumber < 5;
            const showMonthsField = ageNumber !== null && ageNumber === 0;

            if (infantFields) {
                if (showInfantFields) {
                    infantFields.classList.remove('hidden');
                } else {
                    infantFields.classList.add('hidden');
                    if (!preserveValues) {
                        const diaperInput = row.querySelector('.child-diaper-size');
                        const milkInput = row.querySelector('.child-milk-type');
                        const needsInput = row.querySelector('.child-other-needs');
                        if (diaperInput) diaperInput.value = '';
                        if (milkInput) milkInput.value = '';
                        if (needsInput) needsInput.value = '';
                    }
                }
            }

            if (monthsField) {
                if (showMonthsField) {
                    monthsField.classList.remove('hidden');
                } else {
                    monthsField.classList.add('hidden');
                    if (!preserveValues) {
                        const monthsInput = row.querySelector('.child-age-months');
                        if (monthsInput) monthsInput.value = '';
                    }
                }
            }
        }
        function roomlist() {
            if (!buildings || buildings.length === 0) {
                Swal.fire({
                    title: 'لا توجد مباني',
                    text: 'يرجى إضافة مبنى أولاً',
                    icon: 'info',
                    background: getCssVar('--card-bg') || '#0f0f0f',
                    color: getCssVar('--text-color') || '#fff'
                });
                return;
            }

            let html = `<div style="text-align: right; max-height: 60vh; overflow-y: auto;">`;
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
                            ? 'فارغة'
                            : roomFamilies.length === 1
                                ? 'مشغولة'
                                : `مشتركة (${roomFamilies.length})`;
                        const names = roomFamilies.length
                            ? roomFamilies.map(f => getFamilyLabel(f)).join(' • ')
                            : 'لا توجد عوائل';

                        html += `
                            <div class="glass-panel" style="padding: 0.9rem; margin-bottom: 0.6rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.25rem;">
                                    <div style="font-weight: 600; color: var(--text-color);">
                                        ${building.name} • الطابق ${floor.floor} • الغرفة ${i}
                                    </div>
                                    <div style="font-size: 0.85rem; color: var(--text-muted);">
                                        ${status}
                                    </div>
                                </div>
                                <div style="font-size: 0.85rem; color: var(--text-muted);">
                                    ${names}
                                </div>
                            </div>
                        `;
                    }
                });
            });
            html += `</div>`;

            Swal.fire({
                title: 'قائمة الغرف',
                html,
                background: getCssVar('--card-bg') || '#0f0f0f',
                color: getCssVar('--text-color') || '#fff',
                width: 900,
                confirmButtonText: 'إغلاق',
                showCloseButton: true
            });
        }

        function addChildRow() {
            const container = document.getElementById('children-container');
            const row = document.createElement('div');
            row.className = 'child-row';
            row.innerHTML = `
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <strong>الابن</strong>
                    <button type="button" onclick="this.parentElement.parentElement.remove()" style="background: none; border: none; color: var(--error); cursor: pointer;">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 0.75rem;">
                    <div style="grid-column: span 2;">
                        <label style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem; display: block;">الاسم</label>
                        <input type="text" class="glass-input child-name" placeholder="اسم الابن">
                    </div>
                    <div>
                        <label style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem; display: block;">العمر</label>
                        <input type="number" class="glass-input child-age" placeholder="العمر" min="0" max="18">
                    </div>
                    <div>
                        <label style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem; display: block;">الجنس</label>
                        <select class="glass-input child-gender">
                            <option value="ذكر">ذكر</option>
                            <option value="أنثى">أنثى</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem; display: block;">الحالة الصحية</label>
                        <select class="glass-input child-health">
                            <option value="سليم">سليم</option>
                            <option value="مرض مزمن">مرض مزمن</option>
                            <option value="إعاقة">إعاقة</option>
                            <option value="أخرى">أخرى</option>
                        </select>
                    </div>
                </div>
                <div class="child-infant-fields hidden" style="margin-top: 0.75rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 0.75rem;">
                    <div>
                        <label style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem; display: block;">قياس الحفاضات</label>
                        <input type="text" class="glass-input child-diaper-size" placeholder="قياس الحفاضات">
                    </div>
                    <div>
                        <label style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem; display: block;">نوع الحليب</label>
                        <input type="text" class="glass-input child-milk-type" placeholder="نوع الحليب">
                    </div>
                    <div style="grid-column: span 2;">
                        <label style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem; display: block;">احتياجات أخرى</label>
                        <input type="text" class="glass-input child-other-needs" placeholder="احتياجات أخرى">
                    </div>
                </div>
                <div class="child-months-field hidden" style="margin-top: 0.75rem;">
                    <label style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem; display: block;">العمر بالأشهر</label>
                    <input type="number" class="glass-input child-age-months" placeholder="عدد الأشهر" min="0" max="24">
                </div>
            `;
            container.appendChild(row);

            const ageInput = row.querySelector('.child-age');
            if (ageInput) {
                ageInput.addEventListener('input', () => updateChildRowFields(row));
                ageInput.addEventListener('change', () => updateChildRowFields(row));
            }

            updateChildRowFields(row);
        }

        function addRelativeRow() {
            const container = document.getElementById('relatives-container');
            const row = document.createElement('div');
            row.className = 'relative-row';
            row.innerHTML = `
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <strong>القريب</strong>
                    <button type="button" onclick="this.parentElement.parentElement.remove()" style="background: none; border: none; color: var(--error); cursor: pointer;">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 0.75rem;">
                    <div style="grid-column: span 2;">
                        <label style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem; display: block;">الاسم</label>
                        <input type="text" class="glass-input relative-name" placeholder="اسم القريب">
                    </div>
                    <div>
                        <label style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem; display: block;">صلة القرابة</label>
                        <select class="glass-input relative-relationship">
                            <option value="أخ">أخ</option>
                            <option value="أخت">أخت</option>
                            <option value="جدة">جدة</option>
                            <option value="جد">جد</option>
                            <option value="خال">خال</option>
                            <option value="خالة">خالة</option>
                            <option value="عم">عم</option>
                            <option value="عمة">عمة</option>
                            <option value="أخرى">أخرى</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem; display: block;">العمر</label>
                        <input type="number" class="glass-input relative-age" placeholder="العمر" min="0" max="120">
                    </div>
                    <div>
                        <label style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem; display: block;">الحالة الصحية</label>
                        <select class="glass-input relative-health">
                            <option value="سليم">سليم</option>
                            <option value="مرض مزمن">مرض مزمن</option>
                            <option value="إعاقة">إعاقة</option>
                            <option value="أخرى">أخرى</option>
                        </select>
                    </div>
                </div>
            `;
            container.appendChild(row);
        }

        // === Modal Management ===
        function openModal(familyId = null) {
            const modal = document.getElementById('family-modal');
            const form = document.getElementById('family-form');
            const title = document.getElementById('modal-title');
            
            form.reset();
            document.getElementById('family-id').value = '';
            document.getElementById('children-container').innerHTML = '';
            document.getElementById('relatives-container').innerHTML = '';
            
            // Reset composition selection
            document.querySelectorAll('.composition-card').forEach(card => {
                card.classList.remove('active');
            });
            selectedComposition = '';
            updateFormVisibility();
            
            document.getElementById('room-error').classList.add('hidden');
            document.getElementById('composition-error').classList.add('hidden');

            populateBuildingsSelect();

            if (familyId) {
                title.textContent = 'تعديل بيانات العائلة';
                editFamily(familyId);
            } else {
                title.textContent = 'إضافة عائلة جديدة';
            }

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('family-modal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // === Family CRUD ===
        function editFamily(id) {
            const family = families.find(f => f.id === id);
            if (!family) return;

            document.getElementById('family-id').value = family.id;
            selectComposition(family.composition);

            if (family.building) {
                document.getElementById('field-building').value = family.building;
                loadAvailableFloors();
            }
            if (family.floor) {
                setTimeout(() => {
                    document.getElementById('field-floor').value = family.floor;
                    loadAvailableRooms();
                }, 100);
            }
            if (family.room) {
                setTimeout(() => {
                    document.getElementById('field-room').value = family.room;
                }, 200);
            }

            if (family.father) {
                document.getElementById('field-father-name').value = family.father.name || '';
                document.getElementById('field-surname').value = family.father.surname || '';
                document.getElementById('field-father-age').value = family.father.age || '';
                document.getElementById('field-phone').value = family.father.phone || '';
                document.getElementById('field-father-health').value = family.father.health || 'سليم';
            }

            if (family.mother) {
                document.getElementById('field-mother-name').value = family.mother.name || '';
                document.getElementById('field-mother-age').value = family.mother.age || '';
                document.getElementById('field-mother-health').value = family.mother.health || 'سليم';
            }

            if (family.children) {
                family.children.forEach(child => {
                    addChildRow();
                    const rows = document.querySelectorAll('.child-row');
                    const lastRow = rows[rows.length - 1];
                    lastRow.querySelector('.child-name').value = child.name || '';
                    lastRow.querySelector('.child-age').value = child.age || '';
                    lastRow.querySelector('.child-gender').value = child.gender || 'ذكر';
                    lastRow.querySelector('.child-health').value = child.health || 'سليم';
                    const diaperInput = lastRow.querySelector('.child-diaper-size');
                    const milkInput = lastRow.querySelector('.child-milk-type');
                    const needsInput = lastRow.querySelector('.child-other-needs');
                    const monthsInput = lastRow.querySelector('.child-age-months');
                    if (diaperInput) diaperInput.value = child.diaperSize || '';
                    if (milkInput) milkInput.value = child.milkType || '';
                    if (needsInput) needsInput.value = child.otherNeeds || '';
                    if (monthsInput) monthsInput.value = child.ageMonths || '';
                    updateChildRowFields(lastRow, { preserveValues: true });
                });
            }

            if (family.relatives) {
                family.relatives.forEach(relative => {
                    addRelativeRow();
                    const rows = document.querySelectorAll('.relative-row');
                    const lastRow = rows[rows.length - 1];
                    lastRow.querySelector('.relative-name').value = relative.name || '';
                    lastRow.querySelector('.relative-relationship').value = relative.relationship || 'أخ';
                    lastRow.querySelector('.relative-age').value = relative.age || '';
                    lastRow.querySelector('.relative-health').value = relative.health || 'سليم';
                });
            }

            document.getElementById('field-notes').value = family.adminNotes || '';
        }

        function saveFamily() {
            const id = document.getElementById('family-id').value;
            const familyComposition = selectedComposition;
            const building = document.getElementById('field-building').value;
            const floor = document.getElementById('field-floor').value;
            const roomId = document.getElementById('field-room').value;

            // Validate composition
            if (!familyComposition) {
                document.getElementById('composition-error').classList.remove('hidden');
                return;
            } else {
                document.getElementById('composition-error').classList.add('hidden');
            }

            // Validate location for non-empty families
            if (familyComposition !== 'no-family') {
                if (!building || !floor || !roomId) {
                    document.getElementById('room-error').textContent = 'يرجى اختيار المبنى والطابق والغرفة';
                    document.getElementById('room-error').classList.remove('hidden');
                    return;
                } else {
                    document.getElementById('room-error').classList.add('hidden');
                }
            } else {
                document.getElementById('room-error').classList.add('hidden');
            }
            
            let children = [];
            let childRows = document.querySelectorAll('.child-row');
            childRows.forEach(row => {
                const childName = row.querySelector('.child-name').value.trim();
                const childAge = row.querySelector('.child-age').value.trim();
                const childGender = row.querySelector('.child-gender').value;
                const childHealth = row.querySelector('.child-health').value.trim();
                const childDiaperSize = row.querySelector('.child-diaper-size')?.value.trim();
                const childMilkType = row.querySelector('.child-milk-type')?.value.trim();
                const childOtherNeeds = row.querySelector('.child-other-needs')?.value.trim();
                const childAgeMonths = row.querySelector('.child-age-months')?.value.trim();
                
                if (childName) {
                    children.push({
                        name: childName,
                        age: childAge ? parseInt(childAge) : null,
                        gender: childGender,
                        health: childHealth,
                        diaperSize: childDiaperSize || null,
                        milkType: childMilkType || null,
                        otherNeeds: childOtherNeeds || null,
                        ageMonths: childAgeMonths ? parseInt(childAgeMonths) : null
                    });
                }
            });
            
            let relatives = [];
            let relativesRows = document.querySelectorAll('.relative-row');
            relativesRows.forEach(row => {
                const relativeName = row.querySelector('.relative-name').value.trim();
                const relativeRelationship = row.querySelector('.relative-relationship').value;
                const relativeAge = row.querySelector('.relative-age').value.trim();
                const relativeHealth = row.querySelector('.relative-health').value.trim();
                
                if (relativeName) {
                    relatives.push({
                        name: relativeName,
                        relationship: relativeRelationship,
                        age: relativeAge ? parseInt(relativeAge) : null,
                        health: relativeHealth
                    });
                }
            });
            
            const familyData = {
                id: id ? parseInt(id) : Date.now(),
                composition: familyComposition,
                building: familyComposition === 'no-family' ? null : building,
                floor: familyComposition === 'no-family' ? null : floor,
                room: familyComposition === 'no-family' ? null : roomId,
                buildingName: familyComposition === 'no-family' ? null : buildings.find(b => b.id == building)?.name,
                father: (familyComposition === 'mother-only' || familyComposition === 'mother-children-only' || familyComposition === 'no-family') ? null : {
                    name: document.getElementById('field-father-name').value.trim(),
                    surname: document.getElementById('field-surname').value.trim(),
                    age: document.getElementById('field-father-age').value,
                    phone: document.getElementById('field-phone').value.trim(),
                    health: document.getElementById('field-father-health').value
                },
                mother: (familyComposition === 'father-only' || familyComposition === 'no-family') ? null : {
                    name: document.getElementById('field-mother-name').value.trim(),
                    age: document.getElementById('field-mother-age').value,
                    health: document.getElementById('field-mother-health').value
                },
                children: (familyComposition === 'father-mother-children' || familyComposition === 'mother-children-only' || familyComposition === 'father-children-only') ? children : [],
                relatives: relatives,
                adminNotes: document.getElementById('field-notes').value.trim()
            };
            
            if (id) {
                const index = families.findIndex(f => f.id === parseInt(id));
                if (index !== -1) {
                    families[index] = familyData;
                }
            } else {
                families.push(familyData);
            }
            
            syncData();
            closeModal();
            renderFamilies();
            updateStats();
            
            Swal.fire({
                icon: 'success',
                title: id ? 'تم التعديل بنجاح' : 'تم الحفظ بنجاح',
                background: getCssVar('--card-bg') || '#0f0f0f',
                color: getCssVar('--text-color') || '#fff',
                timer: 2000,
                showConfirmButton: false
            });
        }

        function deleteFamily(id) {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: 'سيتم حذف هذه العائلة نهائياً!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#525252',
                cancelButtonColor: '#a1a1aa',
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء',
                background: getCssVar('--card-bg') || '#0f0f0f',
                color: getCssVar('--text-color') || '#fff',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    families = families.filter(f => f.id !== id);
                    syncData();
                    renderFamilies();
                    updateStats();
                    
                    Swal.fire({
                        title: 'تم الحذف!',
                        text: 'تم حذف العائلة بنجاح',
                        icon: 'success',
                        background: getCssVar('--card-bg') || '#0f0f0f',
                        color: getCssVar('--text-color') || '#fff',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        }

        function createRandomFamily() {
            if (!buildings || buildings.length === 0) {
                Swal.fire({
                    title: 'لا توجد مباني',
                    text: 'يرجى إضافة مبنى أولاً لإنشاء عائلة عشوائية',
                    icon: 'info',
                    background: getCssVar('--card-bg') || '#0f0f0f',
                    color: getCssVar('--text-color') || '#fff'
                });
                return;
            }

            const pick = (list) => list[Math.floor(Math.random() * list.length)];
            const randInt = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min;

            const availableRooms = [];
            buildings.forEach(building => {
                if (!building.floors) return;
                building.floors.forEach(floor => {
                    const roomsCount = parseInt(floor.rooms) || 0;
                    for (let i = 1; i <= roomsCount; i++) {
                        availableRooms.push({
                            building,
                            floor: floor.floor,
                            room: i
                        });
                    }
                });
            });

            if (availableRooms.length === 0) {
                Swal.fire({
                    title: 'لا توجد غرف متاحة',
                    text: 'يرجى إضافة غرف للمباني أولاً',
                    icon: 'warning',
                    background: getCssVar('--card-bg') || '#0f0f0f',
                    color: getCssVar('--text-color') || '#fff'
                });
                return;
            }

            const maleNames = ['محمد', 'أحمد', 'خالد', 'عمر', 'سعيد', 'يوسف', 'عبدالله', 'علي', 'إبراهيم', 'مصطفى'];
            const femaleNames = ['فاطمة', 'عائشة', 'سارة', 'مريم', 'آمنة', 'هبة', 'نور', 'ريم', 'لينا', 'سلمى'];
            const surnames = ['الشمري', 'الزيدي', 'النجار', 'الحربي', 'القحطاني', 'العتيبي', 'السعدي', 'الأنصاري', 'الهاشمي', 'التميمي'];
            const healthOptions = ['سليم', 'مرض مزمن', 'إعاقة', 'أخرى'];
            const relationships = ['أخ', 'أخت', 'جدة', 'جد', 'خال', 'خالة', 'عم', 'عمة', 'أخرى'];
            const diaperSizes = ['حديثي الولادة', 'صغير', 'متوسط', 'كبير'];
            const milkTypes = ['طبيعي', 'حليب أطفال', 'خالٍ من اللاكتوز', 'مكمل غذائي'];
            const otherNeedsOptions = ['كريم جلدي', 'حفاضات إضافية', 'مناديل مبللة', 'دواء خفيف'];

            const compositions = [
                'father-mother-children',
                'father-only',
                'mother-only',
                'mother-children-only',
                'father-children-only'
            ];

            const composition = pick(compositions);
            const includeFather = composition === 'father-mother-children' || composition === 'father-only' || composition === 'father-children-only';
            const includeMother = composition === 'father-mother-children' || composition === 'mother-only' || composition === 'mother-children-only';
            const includeChildren = composition === 'father-mother-children' || composition === 'mother-children-only' || composition === 'father-children-only';

            const surname = pick(surnames);
            const randomPhone = () => `05${randInt(10000000, 99999999)}`;

            const father = includeFather ? {
                name: `${pick(maleNames)} ${surname}`,
                surname: surname,
                age: randInt(25, 60),
                phone: randomPhone(),
                health: pick(healthOptions)
            } : null;

            const mother = includeMother ? {
                name: `${pick(femaleNames)} ${surname}`,
                age: randInt(20, 55),
                health: pick(healthOptions)
            } : null;

            const children = [];
            if (includeChildren) {
                const childrenCount = randInt(1, 4);
                for (let i = 0; i < childrenCount; i++) {
                    const gender = pick(['ذكر', 'أنثى']);
                    const age = randInt(0, 16);
                    const child = {
                        name: `${gender === 'ذكر' ? pick(maleNames) : pick(femaleNames)} ${surname}`,
                        age: age,
                        gender: gender,
                        health: pick(healthOptions),
                        diaperSize: null,
                        milkType: null,
                        otherNeeds: null,
                        ageMonths: null
                    };
                    if (age <= 5) {
                        child.diaperSize = pick(diaperSizes);
                        child.milkType = pick(milkTypes);
                        child.otherNeeds = Math.random() > 0.5 ? pick(otherNeedsOptions) : null;
                        if (age === 0) {
                            child.ageMonths = randInt(1, 11);
                        }
                    }
                    children.push(child);
                }
            }

            const relatives = [];
            const relativesCount = randInt(0, 2);
            for (let i = 0; i < relativesCount; i++) {
                const relationship = pick(relationships);
                const isFemale = ['أخت', 'جدة', 'خالة', 'عمة'].includes(relationship);
                relatives.push({
                    name: `${isFemale ? pick(femaleNames) : pick(maleNames)} ${surname}`,
                    relationship: relationship,
                    age: randInt(18, 75),
                    health: pick(healthOptions)
                });
            }

            const location = pick(availableRooms);

            const familyData = {
                id: Date.now() + randInt(1, 999),
                composition: composition,
                building: location.building.id,
                floor: location.floor,
                room: location.room,
                buildingName: location.building.name,
                father: father,
                mother: mother,
                children: includeChildren ? children : [],
                relatives: relatives,
                adminNotes: 'تم إنشاؤها تلقائياً للتجربة'
            };

            families.push(familyData);
            syncData();
            renderFamilies();
            updateStats();

            Swal.fire({
                icon: 'success',
                title: 'تم إنشاء عائلة عشوائية',
                background: getCssVar('--card-bg') || '#0f0f0f',
                color: getCssVar('--text-color') || '#fff',
                timer: 1500,
                showConfirmButton: false
            });
        }

        // === Rendering ===
        function renderFamilies() {
            const container = document.getElementById('families-list');
            container.innerHTML = '';

            applyFamilyFilters();

            if (families.length === 0) {
                container.innerHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--text-muted);">
                        <i class="fas fa-users" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                        <p>لا توجد عائلات مسجلة</p>
                    </div>
                `;
                updateFamiliesResultsInfo(0);
                return;
            }

            if (filteredFamilies.length === 0) {
                container.innerHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--text-muted);">
                        <i class="fas fa-filter" style="font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                        <p>لا توجد نتائج مطابقة للفلاتر الحالية</p>
                    </div>
                `;
                updateFamiliesResultsInfo(0);
                return;
            }

            filteredFamilies.forEach(family => {
                const card = document.createElement('div');
                card.className = 'glass-panel family-card';
                card.style.padding = '1.5rem';

                let memberCount = 0;
                let membersInfo = '';

                if (family.father && family.father.name) {
                    memberCount++;
                    membersInfo += `<div style="font-size: 0.85rem; color: var(--text-muted);"><i class="fas fa-male" style="margin-left: 0.5rem;"></i>${family.father.name}</div>`;
                }
                if (family.mother && family.mother.name) {
                    memberCount++;
                    membersInfo += `<div style="font-size: 0.85rem; color: var(--text-muted);"><i class="fas fa-female" style="margin-left: 0.5rem;"></i>${family.mother.name}</div>`;
                }
                if (family.children && family.children.length > 0) {
                    memberCount += family.children.length;
                    membersInfo += `<div style="font-size: 0.85rem; color: var(--text-muted);"><i class="fas fa-child" style="margin-left: 0.5rem;"></i>${family.children.length} أبناء</div>`;
                }
                if (family.relatives && family.relatives.length > 0) {
                    memberCount += family.relatives.length;
                    membersInfo += `<div style="font-size: 0.85rem; color: var(--text-muted);"><i class="fas fa-users" style="margin-left: 0.5rem;"></i>${family.relatives.length} أقارب</div>`;
                }

                const compositionLabels = {
                    'father-mother-children': 'عائلة كاملة',
                    'father-only': 'أب فقط',
                    'mother-only': 'أم فقط',
                    'mother-children-only': 'أم وأبناء',
                    'father-children-only': 'أب وأبناء',
                    'no-family': 'بدون عائلة'
                };

                const locationInfo = family.building && family.floor && family.room 
                    ? `<div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.75rem;"><i class="fas fa-map-marker-alt" style="margin-left: 0.5rem;"></i>${family.buildingName || 'مبنى'} • الطابق ${family.floor} • الغرفة ${family.room}</div>`
                    : '';

                card.innerHTML = `
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                        <div>
                            <div style="font-weight: 600; font-size: 1.1rem; color: var(--text-color); margin-bottom: 0.25rem;">
                                ${family.father?.surname || family.father?.name || family.mother?.name || 'بدون اسم'}
                            </div>
                            <div style="font-size: 0.85rem; color: var(--accent-gray-400); background: rgba(255,255,255,0.05); padding: 2px 8px; border-radius: 4px; display: inline-block;">
                                ${compositionLabels[family.composition] || 'غير محدد'}
                            </div>
                        </div>
                        <div style="display: flex; gap: 0.5rem;">
                            <button onclick="event.stopPropagation(); openModal(${family.id})" style="background: none; border: none; color: var(--accent-gray-400); cursor: pointer; padding: 0.5rem; transition: color 0.3s;">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="event.stopPropagation(); deleteFamily(${family.id})" style="background: none; border: none; color: var(--error); cursor: pointer; padding: 0.5rem; transition: color 0.3s;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div style="border-top: 1px solid var(--glass-border); padding-top: 1rem; margin-top: 1rem;">
                        ${membersInfo}
                        ${locationInfo}
                    </div>
                `;
                container.appendChild(card);
            });

            updateFamiliesResultsInfo(filteredFamilies.length);
        }

        function updateStats() {
            const totalFamilies = families.length;
            let totalPeople = 0;

            families.forEach(f => {
                if (f.father?.name) totalPeople++;
                if (f.mother?.name) totalPeople++;
                if (f.children?.length) totalPeople += f.children.length;
                if (f.relatives?.length) totalPeople += f.relatives.length;
            });

            document.getElementById('total-families').textContent = totalFamilies;
            document.getElementById('total-people').textContent = totalPeople;
            updateTotalRoomsCount();
            updateSharedRoomsCount();
        }

        // === Composition Selection ===
        function selectComposition(value) {
            const cards = document.querySelectorAll('.composition-card');
            const compositionInput = document.getElementById('field-composition');
            const errorMsg = document.getElementById('composition-error');

            if (selectedComposition === value) {
                selectedComposition = '';
                compositionInput.value = '';
                cards.forEach(card => {
                    card.classList.remove('active', 'hidden-choice');
                });
            } else {
                selectedComposition = value;
                compositionInput.value = value;
                cards.forEach(card => {
                    if (card.dataset.value === value) {
                        card.classList.add('active');
                        card.classList.remove('hidden-choice');
                    } else {
                        card.classList.remove('active');
                        card.classList.add('hidden-choice');
                    }
                });
                errorMsg.classList.add('hidden');
            }

            updateFormVisibility();
        }

        function updateFormVisibility() {
            const fatherSection = document.getElementById('father-section');
            const motherSection = document.getElementById('mother-section');
            const childrenSection = document.getElementById('children-section');
            const relativesSection = document.getElementById('relatives-section');
            const locationFields = document.getElementById('location-fields');

            switch(selectedComposition) {
                case 'father-mother-children':
                    fatherSection.style.display = 'block';
                    motherSection.style.display = 'block';
                    childrenSection.style.display = 'block';
                    relativesSection.style.display = 'block';
                    locationFields.style.display = 'block';
                    break;
                case 'father-only':
                    fatherSection.style.display = 'block';
                    motherSection.style.display = 'none';
                    childrenSection.style.display = 'none';
                    relativesSection.style.display = 'block';
                    locationFields.style.display = 'block';
                    break;
                case 'mother-only':
                    fatherSection.style.display = 'none';
                    motherSection.style.display = 'block';
                    childrenSection.style.display = 'none';
                    relativesSection.style.display = 'block';
                    locationFields.style.display = 'block';
                    break;
                case 'mother-children-only':
                    fatherSection.style.display = 'none';
                    motherSection.style.display = 'block';
                    childrenSection.style.display = 'block';
                    relativesSection.style.display = 'block';
                    locationFields.style.display = 'block';
                    break;
                case 'father-children-only':
                    fatherSection.style.display = 'block';
                    motherSection.style.display = 'none';
                    childrenSection.style.display = 'block';
                    relativesSection.style.display = 'block';
                    locationFields.style.display = 'block';
                    break;
                case 'no-family':
                    fatherSection.style.display = 'none';
                    motherSection.style.display = 'none';
                    childrenSection.style.display = 'none';
                    relativesSection.style.display = 'none';
                    locationFields.style.display = 'none';
                    break;
                default:
                    fatherSection.style.display = 'none';
                    motherSection.style.display = 'none';
                    childrenSection.style.display = 'none';
                    relativesSection.style.display = 'none';
                    locationFields.style.display = 'none';
            }
        }

        // === Event Listeners ===
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        document.getElementById('family-modal')?.addEventListener('click', (e) => {
            if (e.target === document.getElementById('family-modal')) {
                closeModal();
            }
        });
    </script>
</body>
</html>
