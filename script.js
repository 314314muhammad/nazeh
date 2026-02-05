/* Shared API + storage utilities */
(function () {
  const STORAGE_KEY = "housing_data";
  const BUILDINGS_KEY = "housing_buildings";
  const LEGACY_KEY = "housing_families";
  const SYNC_PENDING_KEY = "housing_sync_pending";
  const OFFLINE_KEY = "housing_offline";

  const DEFAULT_API_BASE = "http://127.0.0.1:3000";
  const explicitApiBase =
    (typeof window.APP_API_BASE === "string" ? window.APP_API_BASE : null)
    || localStorage.getItem("");
  const hasExplicitApiBase = explicitApiBase !== null && explicitApiBase !== undefined && String(explicitApiBase).length > 0;
  const apiBase =
    (hasExplicitApiBase ? explicitApiBase : null)
    || (location.port === "3000" ? "" : DEFAULT_API_BASE);
  const offlineParam = new URLSearchParams(location.search).get("offline");
  const offlineFromQuery = offlineParam === "1" || offlineParam === "true";
  function isOffline() {
    return window.APP_OFFLINE === true
      || offlineFromQuery
      || localStorage.getItem(OFFLINE_KEY) === "1";
  }

  function canUseApi() {
    if (isOffline()) return false;
    if (location.port === "3000") return true;
    if (hasExplicitApiBase) return true;
    if (typeof navigator !== "undefined" && navigator.onLine === false) return false;
    return true;
  }

  function setOffline(value) {
    if (value) {
      localStorage.setItem(OFFLINE_KEY, "1");
    } else {
      localStorage.removeItem(OFFLINE_KEY);
    }
  }

  function safeJsonParse(value, fallback) {
    if (!value) return fallback;
    try {
      return JSON.parse(value);
    } catch (err) {
      return fallback;
    }
  }

  function loadLocalData() {
    const families = safeJsonParse(localStorage.getItem(STORAGE_KEY), null)
      || safeJsonParse(localStorage.getItem(LEGACY_KEY), [])
      || [];
    const buildings = safeJsonParse(localStorage.getItem(BUILDINGS_KEY), []) || [];

    const buildingMap = new Map(
      (buildings || []).map(b => [String(b.id), b.name])
    );
    families.forEach(family => {
      if (!family) return;
      if (!family.buildingName && family.building) {
        family.buildingName = buildingMap.get(String(family.building)) || family.building;
      }
    });

    return {
      families: Array.isArray(families) ? families : [],
      buildings: Array.isArray(buildings) ? buildings : [],
    };
  }

  function saveLocalData(data) {
    if (!data) return;
    const families = Array.isArray(data.families) ? data.families : [];
    const buildings = Array.isArray(data.buildings) ? data.buildings : [];
    localStorage.setItem(STORAGE_KEY, JSON.stringify(families));
    localStorage.setItem(BUILDINGS_KEY, JSON.stringify(buildings));
  }

  async function apiFetch(path, options) {
    if (!canUseApi()) {
      throw new Error("Offline mode");
    }
    const response = await fetch(`${apiBase}${path}`, {
      headers: { "Content-Type": "application/json" },
      ...options,
    });
    if (!response.ok) {
      const message = await response.text();
      throw new Error(message || "API error");
    }
    return response.json();
  }

  async function fetchSummary() {
    return apiFetch("/api/summary");
  }

  async function fetchData() {
    return apiFetch("/api/data");
  }

  async function saveData(data) {
    await apiFetch("/api/data", {
      method: "PUT",
      body: JSON.stringify(data),
    });
  }

  async function loadAllData() {
    const local = loadLocalData();
    if (!canUseApi()) {
      return local;
    }

    try {
      const summary = await fetchSummary();
      const hasLocal = local.families.length > 0 || local.buildings.length > 0;
      const isDbEmpty = summary.totalBuildings === 0 && summary.totalFamilies === 0;

      if (hasLocal && isDbEmpty) {
        await saveData(local);
      }

      const remote = await fetchData();
      saveLocalData(remote);
      localStorage.removeItem(SYNC_PENDING_KEY);
      return remote;
    } catch (err) {
      return local;
    }
  }

  async function saveAllData(data) {
    saveLocalData(data);
    if (!canUseApi()) {
      localStorage.setItem(SYNC_PENDING_KEY, "1");
      return false;
    }
    try {
      await saveData(data);
      localStorage.removeItem(SYNC_PENDING_KEY);
      return true;
    } catch (err) {
      localStorage.setItem(SYNC_PENDING_KEY, "1");
      return false;
    }
  }

  async function trySyncPending() {
    if (!canUseApi()) return false;
    const pending = localStorage.getItem(SYNC_PENDING_KEY);
    if (!pending) return false;
    const local = loadLocalData();
    try {
      await saveData(local);
      localStorage.removeItem(SYNC_PENDING_KEY);
      return true;
    } catch (err) {
      return false;
    }
  }

  window.AppUtils = {
    loadAllData,
    saveAllData,
    loadLocalData,
    saveLocalData,
    trySyncPending,
    isOffline,
    setOffline,
  };

  if (typeof window !== "undefined" && window.addEventListener) {
    window.addEventListener("online", () => {
      trySyncPending();
    });
  }
})();
