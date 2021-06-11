/*
 * Main Filwords functions
 */

/**
 * Getting filled table rows list
 * @param cells
 * @param sizeTable
 * @param isUpperCase
 * @returns {[]}
 */
export function getTableRows(cells, sizeTable, isUpperCase) {
    let c = 1;
    let rowcount = 1;
    let tableRows = []; //List of the chars rows
    let row = []; //List of a chars
    let area = Math.pow(sizeTable, 2);
    for (let i=1; i <= area; i++){
        if (i < cells.length ){
            if (isUpperCase) row.push(cells[i].toUpperCase());
            else row.push(cells[i].toLowerCase());
        } else {
            row.push('@'); //fill missing cells with symbol
        }
        if (rowcount === sizeTable) {
            rowcount = 0;
            tableRows.push(row);
            row = [];
        }
        rowcount++;
    }
    return tableRows;
}

/**
 * Searching words
 * @param words
 * @param sizeTable
 * @param isRowDirection
 * @param isColumnDirection
 * @returns {[]}
 */
export function wordSearch(words, sizeTable, isRowDirection, isColumnDirection) {
    let cells = [];
    let notInTable = [];
    let wordNumber = 0;
    for (let q = 0; q < words.length; q++) {
        let wrongWord = wordPlace(words[q], cells, wordNumber, sizeTable, isRowDirection, isColumnDirection);
        if(wrongWord !== null) notInTable.push(wrongWord);
        wordNumber++;
    }
    // Display error for words not placed
    if (notInTable[0]) {
        for (let r = 0; r < notInTable.length; r++) {
            let wrongWord = notInTable[r];
            words.forEach( function (word, index) {
                if (word === wrongWord) {
                    words.splice(index, 1);
                }
            });
        }
    }
    // Fill in each empty cell with random letter

    for (let c=0; c<cells.length; c++) {
        if (!cells[c]) {
            cells[c] = '@';
        }
    }
    return cells;
}

/**
 * Getting the word by it's place
 * @param word
 * @param cells
 * @param wordNumber
 * @param sizeTable
 * @param isRowDirection
 * @param isColumnDirection
 * @returns {null|*}
 */
export function wordPlace(word, cells, wordNumber, sizeTable, isRowDirection, isColumnDirection) {
    // Number of attempts that will be made to place a word before an error
    let attempts = 200;
    let wordLength = word.length;
    let grayed = [];
    // Attempt to find proper place for word
    let stopper = 0;
    let autoStop = 0;

    while (stopper === 0 && autoStop < attempts) {
        // Get starting cell and direction
        let cellX = (Math.floor(Math.random() * sizeTable)) + 1;
        let cellY = (Math.floor(Math.random() * sizeTable)) + 1;
        let cellXY = ((cellY - 1) * sizeTable) + cellX;
        let direction = Math.floor(Math.random()*8);

        let isDirectionAllow = !isRowDirection && !isColumnDirection;

        // If horizontal forward
        if (direction === 0 && (isRowDirection || isDirectionAllow)) {
            // If word fits
            let fits = cellX + wordLength - 1;
            if (fits <= sizeTable) {

                // Collision test
                let coltest = 0;
                let i = 1;
                let place = cellXY;
                while (i <= wordLength) {
                    if (cells[place] && cells[place] !== word.charAt(i - 1))
                        coltest = 1;
                    place++;
                    i++;
                }

                // Place letters in cells if nothing is colliding
                if (!coltest) {
                    let i = 1;
                    let place = cellXY;
                    while (i <= wordLength) {
                        cells[place] = word.charAt(i - 1);
                        if (!grayed[wordNumber])
                            grayed[wordNumber] = place;
                        else
                            grayed[wordNumber] = grayed[wordNumber] + ',' + place;
                        place++;
                        i++;
                    }
                    stopper = 1;
                }

            }
        }

        // If horizontal backward
        else if (direction === 1 && isDirectionAllow) {
            // If word fits
            let fits = cellX - wordLength + 1;
            if (fits > 0) {

                // Collision test
                let coltest = 0;
                let i = 1;
                let place = cellXY;
                while (i <= wordLength) {
                    if (cells[place] && cells[place] !== word.charAt(i - 1))
                        coltest = 1;
                    place--;
                    i++;
                }

                // Place letters in cells if nothing is colliding
                if (!coltest) {
                    let i = 1;
                    let place = cellXY;
                    while (i <= wordLength) {
                        cells[place] = word.charAt(i - 1);
                        if (!grayed[wordNumber])
                            grayed[wordNumber] = place;
                        else
                            grayed[wordNumber] = grayed[wordNumber] + ',' + place;
                        place--;
                        i++;
                    }
                    stopper = 1;
                }
            }
        }

        // If vertical forward
        else if (direction === 2 && (isColumnDirection || isDirectionAllow)) {
            let fits = cellY + wordLength - 1;
            if (fits <= sizeTable) {

                // Collision test
                let coltest = 0;
                let i = 1;
                let place = cellXY;
                while (i <= wordLength) {
                    if (cells[place] && cells[place] !== word.charAt(i - 1))
                        coltest = 1;
                    place = place + sizeTable;
                    i++;
                }

                // Place letters in cells if nothing is colliding
                if (!coltest) {
                    // Place letters in cells
                    let i = 1;
                    let place = cellXY;
                    while (i <= wordLength) {
                        cells[place] = word.charAt(i - 1);
                        if (!grayed[wordNumber])
                            grayed[wordNumber] = place;
                        else
                            grayed[wordNumber] = grayed[wordNumber] + ',' + place;
                        place = place + sizeTable;
                        i++;
                    }
                    stopper = 1;
                }
            }

        }

        // If vertical backward
        else if (direction === 3 && isDirectionAllow) {
            let fits = cellY - wordLength + 1;
            if (fits > 0) {

                // Collision test
                let coltest = 0;
                let i = 1;
                let place = cellXY;
                while (i <= wordLength) {
                    if (cells[place] && cells[place] !== word.charAt(i - 1))
                        coltest = 1;
                    place = place - sizeTable;
                    i++;
                }

                // Place letters in cells if nothing is colliding
                if (!coltest) {
                    let i = 1;
                    let place = cellXY;
                    while (i <= wordLength) {
                        cells[place] = word.charAt(i - 1);
                        if (!grayed[wordNumber])
                            grayed[wordNumber] = place;
                        else
                            grayed[wordNumber] = grayed[wordNumber] + ',' + place;
                        place = place - sizeTable;
                        i++;
                    }
                    stopper = 1;
                }
            }

        }

        // If diagonal NE
        else if (direction === 4 && isDirectionAllow) {
            let fitsx = cellX + wordLength - 1;
            let fitsy = cellY - wordLength + 1;
            if (fitsx <= sizeTable && fitsy > 0) {

                // Collision test
                let coltest = 0;
                let i = 1;
                let place = cellXY;
                while (i <= wordLength) {
                    if (cells[place] && cells[place] !== word.charAt(i - 1))
                        coltest = 1;
                    place = (place - sizeTable) + 1;
                    i++;
                }

                // Place letters in cells if nothing is colliding
                if (!coltest) {
                    let i = 1;
                    let place = cellXY;
                    while (i <= wordLength) {
                        cells[place] = word.charAt(i - 1);
                        if (!grayed[wordNumber])
                            grayed[wordNumber] = place;
                        else
                            grayed[wordNumber] = grayed[wordNumber] + ',' + place;
                        place = (place - sizeTable) + 1;
                        i++;
                    }
                    stopper = 1;
                }
            }
        }

        // If diagonal SW
        else if (direction === 5 && isDirectionAllow) {
            let fitsx = cellX - wordLength + 1;
            let fitsy = cellY + wordLength - 1;
            if (fitsy <= sizeTable && fitsx > 0) {

                // Collision test
                let coltest = 0;
                let i = 1;
                let place = cellXY;
                while (i <= wordLength) {
                    if (cells[place] && cells[place] !== word.charAt(i - 1))
                        coltest = 1;
                    place = (place + sizeTable) - 1;
                    i++;
                }

                // Place letters in cells if nothing is colliding
                if (!coltest) {
                    let i = 1;
                    let place = cellXY;
                    while (i <= wordLength) {
                        cells[place] = word.charAt(i - 1);
                        if (!grayed[wordNumber])
                            grayed[wordNumber] = place;
                        else
                            grayed[wordNumber] = grayed[wordNumber] + ',' + place;
                        place = (place + sizeTable) - 1;
                        i++;
                    }
                    stopper = 1;
                }
            }
        }

        // If diagonal SE
        else if (direction === 6 && isDirectionAllow) {
            let fitsx = cellX + wordLength - 1;
            let fitsy = cellY + wordLength - 1;
            if (fitsy <= sizeTable && fitsx <= sizeTable) {

                // Collision test
                let coltest = 0;
                let i = 1;
                let place = cellXY;
                while (i <= wordLength) {
                    if (cells[place] && cells[place] !== word.charAt(i - 1))
                        coltest = 1;
                    place = (place + sizeTable) + 1;
                    i++;
                }

                // Place letters in cells if nothing is colliding
                if (!coltest) {
                    let i = 1;
                    let place = cellXY;
                    while (i <= wordLength) {
                        cells[place] = word.charAt(i - 1);
                        if (!grayed[wordNumber])
                            grayed[wordNumber] = place;
                        else
                            grayed[wordNumber] = grayed[wordNumber] + ',' + place;
                        place = (place + sizeTable) + 1;
                        i++;
                    }
                    stopper = 1;
                }
            }
        }

        // If diagonal NW
        else if (direction === 7 && isDirectionAllow) {
            let fitsx = cellX - wordLength + 1;
            let fitsy = cellY - wordLength + 1;
            if (fitsy > 0 && fitsx > 0) {

                // Collision test
                let coltest = 0;
                let i = 1;
                let place = cellXY;
                while (i <= wordLength) {
                    if (cells[place] && cells[place] !== word.charAt(i - 1))
                        coltest = 1;
                    place = (place - sizeTable) - 1;
                    i++;
                }

                // Place letters in cells if nothing is colliding
                if (!coltest) {
                    let i = 1;
                    let place = cellXY;
                    while (i <= wordLength) {
                        cells[place] = word.charAt(i - 1);
                        if (!grayed[wordNumber])
                            grayed[wordNumber] = place;
                        else
                            grayed[wordNumber] = grayed[wordNumber] + ',' + place;
                        place = (place - sizeTable) - 1;
                        i++;
                    }
                    stopper = 1;
                }
            }
        }
        autoStop++;
    } // End stopper loop

    // If word could not be placed
    if (autoStop === attempts) {
        return word;
    } else return null;
}