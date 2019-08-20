/**
 * Local storage helper
 */
class LocalStorageHelper {

  /**
   * Saving json data to local storage, by key
   * @param {String} key 
   * @param {JSON} settings 
   */
  static saveFontSettings(key, settings) {
    localStorage.setItem(key, JSON.stringify(settings));
  }

  /**
   * Getting json data by key, from local store
   * @param {String} key 
   */
  static getFontSettings(key){
    var retrievedSettings = localStorage.getItem(key);
    return (retrievedSettings == null) ? null : JSON.parse(retrievedSettings);
  }

}