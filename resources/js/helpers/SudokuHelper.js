class SudokuHelper {

    /**
     * Getting occurrences numbers in the table
     * @param table
     * @param numbers
     * @returns {[]}
     */
    static countOccurrences(table, numbers) {
        let array = [];
        let occur = [];
        let counter = 0;
        for (let i = 0; i < table.length; i++) {
            for (let j = 0; j < table[i].length; j++) {
                array.push(table[i][j]);
            }
        }
        array.sort(function(a,b) { return a - b; });
        for (let n=1; n < numbers+1; n++){
            for (let i=0; i<array.length; i++){
                if(array[i] === n) counter++;
            }
            if (counter !== 0) {
                occur.push([n, counter]); //Store Number and it occurrences
                counter = 0;
            }
        }
        return occur;
    }

    /**
     * Creating a table with random numbers
     * @param numbers
     * @param cols
     * @param rows
     * @returns {[]}
     */
    static getFilledTableByRangeOfNumbers(numbers, cols, rows){
        let table = [];
        let row = [];
        for (let x=0; x<cols; x++){
            for (let y=0; y<rows; y++){
                row.push(RandomizeHelper.getRandomInt(1, numbers));
            }
            table.push(row);
            row = [];
        }
        return table;
    }

    /**
     * Getting pattern of correct sudoku, depends from size (type) of table
     * @param cols Integer
     * @param rows Integer
     * @returns {[]}
     */
    static getTablePattern(cols, rows){
        let table = [];
        const size = cols * rows;
        switch (size) {
            case 9:
                table = [
                    [6,8,1,5,9,4,3,2,7],
                    [5,9,7,2,8,3,4,1,6],
                    [3,4,2,6,7,1,5,8,9],
                    [9,3,4,1,5,7,2,6,8],
                    [2,7,8,9,3,6,1,4,5],
                    [1,5,6,8,4,2,9,7,3],
                    [7,2,9,3,1,8,6,5,4],
                    [8,1,3,4,6,5,7,9,2],
                    [4,6,5,7,2,9,8,3,1]
                ];
                break;
            case 6:
                table = [
                    [1,5,2,4,3,6],
                    [4,6,3,1,2,5],
                    [6,2,5,3,1,4],
                    [3,4,1,6,5,2],
                    [5,3,6,2,4,1],
                    [2,1,4,5,6,3]
                ];
                break;
            case 4:
                table = [
                    [4,1,3,2],
                    [2,3,4,1],
                    [1,4,2,3],
                    [3,2,1,4]
                ];
                break;
            case 3:
                table = [
                    [1,3,2],
                    [3,2,1],
                    [2,1,3]
                ];
                break;
        }
        return table;
    }

    /**
     * Swap two rows in one area
     * @param table Array - sudoku table
     * @param cols Integer
     * @param rows Integer
     */
    static swapTwoRowsSmall(table, cols, rows) {
        let area = RandomizeHelper.getRandomInt(0, rows - 1);
        let line1 = RandomizeHelper.getRandomInt(0, rows - 1);
        let N1 = area * cols + line1;
        let line2 = RandomizeHelper.getRandomInt(0, rows - 1);
        while (line1 === line2) line2 = RandomizeHelper.getRandomInt(0, rows - 1);
        let N2 = area * cols + line2;
        let temp = table[N1];
        table[N1] = table[N2];
        table[N2] = temp;
        return table;
    }

    /**
     * Transposing rows and cols
     * @param array Array
     * @returns {[]}
     */
    static transpose(array) {
        return array[0].map((col, i) => array.map(row => row[i]));
    }

    /**
     * Swapping two cols
     * @param table Array
     * @param cols Integer
     * @param rows Integer
     */
    static swapTwoColumnsSmall(table, cols, rows) {
        table = this.transpose(table);
        table = this.swapTwoRowsSmall(table, cols, rows);
        return  this.transpose(table);
    }

    /**
     * Swapping tow rows areas (by horizontal)
     * @param table Array
     * @param cols Integer
     * @param rows Integer
     * @returns {[]}
     */
    static swapRowsArea(table, cols, rows) {
        let rnd = () => RandomizeHelper.getRandomInt(0, cols - 1);
        let area1 = rnd();
        let area2 = rnd();
        while (area1 === area2) area2 = rnd();
        for (let i = 0; i < rows; i++) {
            let temp = table[area1 * rows + i];
            table[area1 * rows + i] = table[area2 * rows + i];
            table[area2 * rows + i] = temp;
        }
        return table;
    }

    /**
     * Swapping tow columns areas (by vertical)
     * @param table Array
     * @param cols Integer
     * @param rows Integer
     * @returns {[]}
     */
    static swapColumnsArea(table, cols, rows) {
        table = this.transpose(table);
        table = this.swapRowsArea(table, cols, rows);
        return this.transpose(table);
    }

    static mix(table, cols, rows, amt) {
        let size = cols * rows;
        let listMixFunctions = [];
        if (size === 3) { //when a small table, excepting swap inner rows and cols
            listMixFunctions = [
                'this.transpose(table)',
                'this.swapRowsArea(table, cols, rows)',
                'this.swapColumnsArea(table, cols, rows)'
            ];
        } else {
            listMixFunctions = [
                'this.transpose(table)',
                'this.swapTwoRowsSmall(table, cols, rows)',
                'this.swapTwoColumnsSmall(table, cols, rows)',
                'this.swapRowsArea(table, cols, rows)',
                'this.swapColumnsArea(table, cols, rows)'
            ];
        }
        for (let i = 0; i < amt; i++) {
            let id_func = RandomizeHelper.getRandomInt(0, listMixFunctions.length - 1);
            table = eval(listMixFunctions[id_func]);
        }
        return table;
    }

    static createGrid(n) {
        let table = [];
        for (let i = 0; i < n * n; i++) {
            let row = [];
            for (let j = 0; j < n * n; j++) {
                let c = Math.floor(((i * n + i / n + j) % (n * n) + 1));
                row.push(c);
            }
            table.push(row);
        }
        return table;
    }
}