$(function () {

    if($("#filwords").length){

        function startFilwords() {
            let settingsFilwordsExamplesObject = { //default settings for "filwords-examples"
                'fontName': 'Arial',
                'fontSize': 18,
                'padding': 50,
            };
            const keyFilwordsExamples = "filwords-examples";

            //assign id's of the elements
            const generateFilwords = "#generate-filwords";
            const answersFilwords = "#answers-filwords";
            const inputSizeTable = "#inputSizeTable";
            const inputWords = "#inputWords";
            const inputFontNameFilwords = "#inputFontNameFilwords";
            const inputFontSizeFilwords = "#inputFontSizeFilwords";
            const checkboxBoldFilwords = "#checkboxBoldFilwords";
            const paddingRangeFilwords = "#paddingRangeFilwords";
            let isAnswers = true;

            let sizeTable = $(inputSizeTable).val();
            sizeTable = parseInt(sizeTable);

            /**
             * Setting controls from local storage or by default
             */
            function setupControlsFilwordsExamples() {
                if (LocalStorageHelper.getFontSettings(keyFilwordsExamples) != null) {
                    settingsFilwordsExamplesObject.fontName = LocalStorageHelper.getFontSettings(keyFilwordsExamples).fontName;
                    settingsFilwordsExamplesObject.fontSize = LocalStorageHelper.getFontSettings(keyFilwordsExamples).fontSize;
                    settingsFilwordsExamplesObject.padding = LocalStorageHelper.getFontSettings(keyFilwordsExamples).padding;
                }
                $(inputFontNameFilwords).val(settingsFilwordsExamplesObject.fontName);
                $(inputFontSizeFilwords).val(settingsFilwordsExamplesObject.fontSize);
                $(paddingRangeFilwords).val(settingsFilwordsExamplesObject.padding);
            }
            setupControlsFilwordsExamples();

            let cells = sizeTable * sizeTable;
            let grayed = [];
            let wordnum = 0;
            let cell = [];
            let startletter = [];
            let stopletter = [];
            let notintable = [];
            //styleTable(fontName, fontSize, padding, isFontBold)
            let fontName = $(inputFontNameFilwords).val();
            let fontSize = $(inputFontSizeFilwords).val();
            let padding = $(paddingRangeFilwords).val();
            let isFontBold = !!$(checkboxBoldFilwords).prop("checked");
            
            let words = $(inputWords).val(); //Basic set of words

            //Generate table
            $(generateFilwords).click(function () {
                cell = [];
                notintable = [];
                console.log((sizeTable));
                console.log((typeof(sizeTable)));
                startGame(cells, words);
            });

            //Showing answers
            $(answersFilwords).click(function () {
                $('*[id*=true-char]:visible').each(function() {
                    $(this).css({
                        "background": isAnswers?'#eee':'#fff'
                    });
                });
                isAnswers = !isAnswers;
            });

            //Size of table
            $(inputSizeTable).change(function () {
                sizeTable = parseInt(this.value);
                cells = sizeTable * sizeTable;
            });

            //Basic set of words
            $(inputWords).change(function () {
                words = this.value;
            });

            $(paddingRangeFilwords).change(function () {
                padding = this.value;
                $("th").css({
                    "width": padding + "px",
                    "height": padding + "px"
                });
                $("tr").find("img").css({
                    "width": padding/100*90+"px",
                    "padding": padding/100*10+"px"
                });
                settingsFilwordsExamplesObject.padding = padding;
                LocalStorageHelper.saveFontSettings(keyFilwordsExamples, settingsFilwordsExamplesObject);
            });
            $(inputFontSizeFilwords).on('change', function(){
                fontSize = this.value;
                $("th").css("font-size", fontSize + "px");
                settingsFilwordsExamplesObject.fontSize = fontSize;
                LocalStorageHelper.saveFontSettings(keyFilwordsExamples, settingsFilwordsExamplesObject);
            });
            $(inputFontNameFilwords).on('change', function(){
                fontName = this.value;
                $("th").css("font-family", fontName);
                settingsFilwordsExamplesObject.fontName = fontName;
                LocalStorageHelper.saveFontSettings(keyFilwordsExamples, settingsFilwordsExamplesObject);
            });
            $(checkboxBoldFilwords).change(function () {
                isFontBold = $(checkboxBoldFilwords).prop("checked");
                $("th").css("font-weight", isFontBold ? "bold" : "normal");
            });

            /**
             * Getting a random letter
             * @returns {*}
             */
            function randLetter() {
                let letters = ["Й", "Ц", "У", "К", "Е", "Н", "Г", "Ш", "Щ", "З", "Х", "Ъ", "Ё", "Ф", "Ы", "В", "А", "П", "Р", "О", "Л", "Д", "Ж", "Э", "Я", "Ч", "С", "М", "И", "Т", "Ь", "Б", "Ю"];
                return letters[Math.floor(Math.random()*letters.length)];
            }

            /**
             * Word placement function
             * @param theword
             */
            function wordPlace(theword) {
                // Number of attempts that will be made to place a word before an error
                let attemptnum = 200;
                let wordlength = theword.length;
                // Attempt to find proper place for word
                let stopper = 0;
                let autostop = 0;
                while (stopper === 0 && autostop < attemptnum) {
                    // Get starting cell and direction
                    let cellx = (Math.floor(Math.random() * sizeTable)) + 1;
                    let celly = (Math.floor(Math.random() * sizeTable)) + 1;
                    let cellxy = ((celly - 1) * sizeTable) + cellx;
                    startletter[wordnum] = cellxy;
                    let direction = Math.floor(Math.random()*8);

                    // If horizontal forward
                    if (direction === 0) {
                        // If word fits
                        let fits = cellx + wordlength - 1;
                        if (fits <= sizeTable) {

                            // Collision test
                            let coltest = 0;
                            let i = 1;
                            let place = cellxy;
                            while (i <= wordlength) {
                                if (cell[place] && cell[place] != theword.charAt(i - 1))
                                    coltest = 1;
                                place++;
                                i++;
                            }

                            // Place letters in cells if nothing is colliding
                            if (!coltest) {
                                let i = 1;
                                let place = cellxy;
                                while (i <= wordlength) {
                                    cell[place] = theword.charAt(i - 1);
                                    stopletter[wordnum] = place;
                                    if (!grayed[wordnum])
                                        grayed[wordnum] = place;
                                    else
                                        grayed[wordnum] = grayed[wordnum] + ',' + place;
                                    place++;
                                    i++;
                                }
                                stopper = 1;
                            }

                        }
                    }

                    // If horizontal backward
                    else if (direction === 1) {
                        // If word fits
                        let fits = cellx - wordlength + 1;
                        if (fits > 0) {

                            // Collision test
                            let coltest = 0;
                            let i = 1;
                            let place = cellxy;
                            while (i <= wordlength) {
                                if (cell[place] && cell[place] != theword.charAt(i - 1))
                                    coltest = 1;
                                place--;
                                i++;
                            }

                            // Place letters in cells if nothing is colliding
                            if (!coltest) {
                                let i = 1;
                                let place = cellxy;
                                while (i <= wordlength) {
                                    cell[place] = theword.charAt(i - 1);
                                    stopletter[wordnum] = place;
                                    if (!grayed[wordnum])
                                        grayed[wordnum] = place;
                                    else
                                        grayed[wordnum] = grayed[wordnum] + ',' + place;
                                    place--;
                                    i++;
                                }
                                stopper = 1;
                            }
                        }
                    }


                    // If vertical forward
                    else if (direction === 2) {
                        let fits = celly + wordlength - 1;
                        if (fits <= sizeTable) {

                            // Collision test
                            let coltest = 0;
                            let i = 1;
                            let place = cellxy;
                            while (i <= wordlength) {
                                if (cell[place] && cell[place] != theword.charAt(i - 1))
                                    coltest = 1;
                                place = place + sizeTable;
                                i++;
                            }

                            // Place letters in cells if nothing is colliding
                            if (!coltest) {
                                // Place letters in cells
                                let i = 1;
                                let place = cellxy;
                                while (i <= wordlength) {
                                    cell[place] = theword.charAt(i - 1);
                                    stopletter[wordnum] = place;
                                    if (!grayed[wordnum])
                                        grayed[wordnum] = place;
                                    else
                                        grayed[wordnum] = grayed[wordnum] + ',' + place;
                                    place = place + sizeTable;
                                    i++;
                                }
                                stopper = 1;
                            }
                        }

                    }


                    // If vertical backward
                    else if (direction === 3) {
                        let fits = celly - wordlength + 1;
                        if (fits > 0) {

                            // Collision test
                            let coltest = 0;
                            let i = 1;
                            let place = cellxy;
                            while (i <= wordlength) {
                                if (cell[place] && cell[place] != theword.charAt(i - 1))
                                    coltest = 1;
                                place = place - sizeTable;
                                i++;
                            }

                            // Place letters in cells if nothing is colliding
                            if (!coltest) {
                                let i = 1;
                                let place = cellxy;
                                while (i <= wordlength) {
                                    cell[place] = theword.charAt(i - 1);
                                    stopletter[wordnum] = place;
                                    if (!grayed[wordnum])
                                        grayed[wordnum] = place;
                                    else
                                        grayed[wordnum] = grayed[wordnum] + ',' + place;
                                    place = place - sizeTable;
                                    i++;
                                }
                                stopper = 1;
                            }
                        }

                    }



                    // If diagonal NE
                    else if (direction === 4) {
                        let fitsx = cellx + wordlength - 1;
                        let fitsy = celly - wordlength + 1;
                        if (fitsx <= sizeTable && fitsy > 0) {

                            // Collision test
                            let coltest = 0;
                            let i = 1;
                            let place = cellxy;
                            while (i <= wordlength) {
                                if (cell[place] && cell[place] != theword.charAt(i - 1))
                                    coltest = 1;
                                place = (place - sizeTable) + 1;
                                i++;
                            }

                            // Place letters in cells if nothing is colliding
                            if (!coltest) {
                                let i = 1;
                                let place = cellxy;
                                while (i <= wordlength) {
                                    cell[place] = theword.charAt(i - 1);
                                    stopletter[wordnum] = place;
                                    if (!grayed[wordnum])
                                        grayed[wordnum] = place;
                                    else
                                        grayed[wordnum] = grayed[wordnum] + ',' + place;
                                    place = (place - sizeTable) + 1;
                                    i++;
                                }
                                stopper = 1;
                            }
                        }
                    }



                    // If diagonal SW
                    else if (direction === 5) {
                        let fitsx = cellx - wordlength + 1;
                        let fitsy = celly + wordlength - 1;
                        if (fitsy <= sizeTable && fitsx > 0) {

                            // Collision test
                            let coltest = 0;
                            let i = 1;
                            let place = cellxy;
                            while (i <= wordlength) {
                                if (cell[place] && cell[place] != theword.charAt(i - 1))
                                    coltest = 1;
                                place = (place + sizeTable) - 1;
                                i++;
                            }

                            // Place letters in cells if nothing is colliding
                            if (!coltest) {
                                let i = 1;
                                let place = cellxy;
                                while (i <= wordlength) {
                                    cell[place] = theword.charAt(i - 1);
                                    stopletter[wordnum] = place;
                                    if (!grayed[wordnum])
                                        grayed[wordnum] = place;
                                    else
                                        grayed[wordnum] = grayed[wordnum] + ',' + place;
                                    place = (place + sizeTable) - 1;
                                    i++;
                                }
                                stopper = 1;
                            }
                        }
                    }



                    // If diagonal SE
                    else if (direction === 6) {
                        let fitsx = cellx + wordlength - 1;
                        let fitsy = celly + wordlength - 1;
                        if (fitsy <= sizeTable && fitsx <= sizeTable) {

                            // Collision test
                            let coltest = 0;
                            let i = 1;
                            let place = cellxy;
                            while (i <= wordlength) {
                                if (cell[place] && cell[place] != theword.charAt(i - 1))
                                    coltest = 1;
                                place = (place + sizeTable) + 1;
                                i++;
                            }

                            // Place letters in cells if nothing is colliding
                            if (!coltest) {
                                let i = 1;
                                let place = cellxy;
                                while (i <= wordlength) {
                                    cell[place] = theword.charAt(i - 1);
                                    stopletter[wordnum] = place;
                                    if (!grayed[wordnum])
                                        grayed[wordnum] = place;
                                    else
                                        grayed[wordnum] = grayed[wordnum] + ',' + place;
                                    place = (place + sizeTable) + 1;
                                    i++;
                                }
                                stopper = 1;
                            }
                        }
                    }



                    // If diagonal NW
                    else if (direction === 7) {
                        let fitsx = cellx - wordlength + 1;
                        let fitsy = celly - wordlength + 1;
                        if (fitsy > 0 && fitsx > 0) {

                            // Collision test
                            let coltest = 0;
                            let i = 1;
                            let place = cellxy;
                            while (i <= wordlength) {
                                if (cell[place] && cell[place] != theword.charAt(i - 1))
                                    coltest = 1;
                                place = (place - sizeTable) - 1;
                                i++;
                            }

                            // Place letters in cells if nothing is colliding
                            if (!coltest) {
                                let i = 1;
                                let place = cellxy;
                                while (i <= wordlength) {
                                    cell[place] = theword.charAt(i - 1);
                                    stopletter[wordnum] = place;
                                    if (!grayed[wordnum])
                                        grayed[wordnum] = place;
                                    else
                                        grayed[wordnum] = grayed[wordnum] + ',' + place;
                                    place = (place - sizeTable) - 1;
                                    i++;
                                }
                                stopper = 1;
                            }
                        }
                    }
                    autostop++;
                } // End stopper loop
                // If word could not be placed
                if (autostop == attemptnum) {
                    notintable.push(theword);
                }
                wordnum++;
            } // End wordPlace()

            /**
             * Sorting array by string length
             * @param a
             * @param b
             * @returns {number}
             */
            function sortByLengthDesc(a, b) {
                if (a.length > b.length)
                    return -1;
                if (a.length < b.length)
                    return 1;
                return 0;
            }

            /**
             * Searching words
             * @param wordlist
             * @returns {string}
             */
            function wordSearch(wordlist) {
                wordlist = wordlist.split(',');
                let alertstring = "";
                for (let q = 0; q < wordlist.length; q++) {
                    wordPlace(wordlist[q]);
                }
                // Display error for words not placed
                if (notintable[0]) {
                    alertstring = "Следующие слова не могут быть вписаны в таблицу:\n\n";
                    let r = 0;
                    for (r = 0; r < notintable.length; r++) {
                        alertstring = alertstring + notintable[r] + '\n';
                    }
                    alertstring = alertstring + "\nПопробуйте уменьшить слово или уменьшить количество слов.";
                    alert(alertstring);
                }
                // Fill in each empty cell with random letter
                let c = 1;
                while (c <= cells) {
                    if (!cell[c]) {
                        cell[c] = "@";
                    }
                    c++;
                }
            }

            /**
             * Showing a result table
             */
            function showTable() {
                let result = "#res";
                let c = 1;
                let rowcount = 1;
                let _id = "";
                let table = '<table class="table-filwords">';
                table += '<tbody>';
                while (c <= cells) {
                    if (rowcount === 1) {
                        table += '<tr>';
                    }
                    if (cell[c] === "@") {
                        _id = "false-char";
                        cell[c] =  randLetter();
                    }
                    else {
                        _id = "true-char";
                    }
                    table += `<th id="${_id}">${cell[c].toUpperCase()}</th>`;
                    if (rowcount === sizeTable) {
                        table += '</tr>';
                        rowcount = 0;
                    }
                    c++;
                    rowcount++;
                }
                table += '</tbody></table>';
                $(result).html(table);
            }

            /**
             * Starting Filwords
             * @param cells
             * @param words
             */
            function startGame(cells, words) {
                words = words.split(",");
                words = words.sort(sortByLengthDesc);
                wordSearch(words.join());
                showTable();
                styleTable(fontName, fontSize, padding, isFontBold);
            }

            /**
             * Stylable table
             * @param fontName - String
             * @param fontSize - Integer
             * @param padding - Integer
             * @param isFontBold - boolean
             */
            function styleTable(fontName, fontSize, padding, isFontBold) {
                $("th").css({
                    "font-family": fontName,
                    "font-size": fontSize + "px",
                    "font-weight": isFontBold?"bold":"normal",
                    "width": padding + "px",
                    "height": padding + "px"
                });
                $("tr").find("img").css({
                    "width": padding/100*90+"px",
                    "padding": padding/100*10+"px"
                });

            }
            
            
        }
        startFilwords();
    }

});