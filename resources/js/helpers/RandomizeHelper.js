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
        randomList.sort(function(a,b) { return a - b; });
        return randomList;
    }
}