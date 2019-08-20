/**
 * Shuffle array elements
 */
class ShuffleArray{

  /**
   * Shuffles array in place.
   * @param {Array} arr items An array containing the items.
   */
  static shuffle(arr){
      var j, temp;
      for(var i = arr.length - 1; i > 0; i--){
          j = Math.floor(Math.random()*(i + 1));
          temp = arr[j];
          arr[j] = arr[i];
          arr[i] = temp;
      }
      return arr;
  }

}