/**
 * Randomize helper
 */
class RandomizeHelper{
    /**
     * Returns a random number between min (inclusive) and max (exclusive)
     */
    static getRandomArbitrary(min, max) {
        return Math.random() * (max - min) + min;
    }

    /**
     * Getting random words from array, count on range of the letters quantity
     * @param wordsList
     * @param lettersQuantityMin
     * @param lettersQuantityMax
     * @param quantity
     * @returns {boolean|[]}
     */
    static getRandomWordsByLength(wordsList, lettersQuantityMin, lettersQuantityMax, quantity){
        if (wordsList.length < quantity) return false;
        else {
            let randomList = [];
            let i = 0;
            let c = 0;
            while (i < quantity) {
                let n = this.getRandomInt(0, wordsList.length-1);
                if (!randomList.includes(n) && wordsList[n].length >= lettersQuantityMin && wordsList[n].length <= lettersQuantityMax) {
                    randomList.push(wordsList[n]);
                    i++;
                }
                c++;
                if (c >= wordsList.length) return randomList; //Not found words anymore
            }
            return randomList;

        }
    }

    /**
     * Returns a random integer between min (inclusive) and max (inclusive).
     * The value is no lower than min (or the next integer greater than min
     * if min isn't an integer) and no greater than max (or the next integer
     * lower than max if max isn't an integer).
     * Using Math.round() will give you a non-uniform distribution!
     */
    static getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    /**
     * Getting a random list of integer between min (inclusive) and max (inclusive)
     * @param min
     * @param max
     * @param quantity
     * @returns {[]}
     */
    static getRandomNumbersFromRange(min, max, quantity) {
        let randomList = [];
        let i = 0;
        while (i < quantity) {
            let n = this.getRandomInt(min, max);
            if (!randomList.includes(n)) {
                randomList.push(n);
                i++;
            }
        }
        return randomList;
    }
}