//Local storage Helper (for Vue components work with)

/**
 * Getting stored data
 * @param key
 * @returns {*}
 */
export function readSettings(key) {
    let settings = localStorage.getItem(key);
    return (settings == null) ? null : JSON.parse(settings);
}

/**
 * Save data in the local storage
 * @param key
 * @param settings
 */
export function saveSettings(key, settings) {
    localStorage.setItem(key, JSON.stringify(settings));
}