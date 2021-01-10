$(function () {

    if($("#encoding-numbers").length){
        function start() {

            let settings = { //default settings for "sudoku-examples"
                'fontName': 'Arial',
                'fontSize': 18,
                'padding': 50,
            };
            const key = "encoding-numbers";

            let resultWordsList = [];
            let resultAnswerList = [];

            //assign id's of the elements
            const startEncoding = "#encoding-btn";
            const showAnswers = "#answer-btn";

            const inputColumnsNumber = "#inputColumnsNumber";
            const textarea = "#main-textarea";

            const inputFontName = "#inputFontName";
            const inputTextColor = "#inputTextColor";
            const inputFontSize = "#inputFontSize";
            const checkboxBold = "#checkboxBold";
            const paddingRange = "#paddingRange";

            const answersContent = "#answers-content";

            $(answersContent).hide();

            /**
             * Setting controls from local storage or by default
             */
            function setupControls() {
                if (LocalStorageHelper.getFontSettings(key) != null) {
                    settings.fontName = LocalStorageHelper.getFontSettings(key).fontName;
                    settings.fontSize = LocalStorageHelper.getFontSettings(key).fontSize;
                    settings.padding = LocalStorageHelper.getFontSettings(key).padding;
                }
                $(inputFontName).val(settings.fontName);
                $(inputFontSize).val(settings.fontSize);
                $(paddingRange).val(settings.padding);
            }
            setupControls();

            //values of the controls
            let columnsNumber = $(inputColumnsNumber).val();

            let fontSize = $(inputFontSize).val();
            let fontColor = $(inputTextColor).val();
            let fontName = $(inputFontName).val();
            let isFontBold = !!$(checkboxBold).prop("checked");
            let padding = $(paddingRange).val();

            $(inputColumnsNumber).change( function () {
                columnsNumber= this.value;
            });

            $(inputFontSize).on('change', function () {
                fontSize = this.value;
                $(".th-main").css("font-size", fontSize + "px");
                settings.fontSize = fontSize;
                LocalStorageHelper.saveFontSettings(key, settings);
            });
            $(inputFontName).on('change', function () {
                fontName = this.value;
                $(".th-main").css("font-family", fontName);
                settings.fontName = fontName;
                LocalStorageHelper.saveFontSettings(key, settings);
            });
            $(inputTextColor).change(function () {
                fontColor = this.value;
                $(".th-main").css("color", fontColor);
            });
            $(paddingRange).change( function () {
                padding = this.value;
                $(".th-main").css({
                    "padding-left": padding + "rem",
                    "padding-right": padding + "rem"
                });
                $(".th-main").css({
                    "padding-left": padding + "rem",
                    "padding-right": padding + "rem"
                });
                settings.padding = padding;
                LocalStorageHelper.saveFontSettings(key, settings);
            });

            $(checkboxBold).change( function () {
                isFontBold = $(checkboxBold).prop("checked");
                $("th").css("font-weight", isFontBold ? "bold" : "normal");
            });

            /**
             * Start encoding
             */
            $(startEncoding).click( ()=> {
                $(answersContent).hide();

                let text = $(textarea).val();
                text = vowels(text);

                resultWordsList = text.split(" ");

                resultAnswerList = [];

                resultWordsList.forEach( (word) => {
                    let newWord = '';
                    for (let i=0; i<word.length; i++){
                        newWord += encodeChar(word.charAt(i));
                    }
                    resultAnswerList.push(newWord);
                });

                showTable(resultWordsList, columnsNumber);
                styleTable(fontName, fontSize, padding, isFontBold,fontColor);
            });

            /**
             * Showing answers
             */
            $(showAnswers).click( ()=> {
                $(answersContent).show();
                getAnswers(resultAnswerList, columnsNumber);
                styleTable(fontName, fontSize, padding, isFontBold, fontColor);
            });

        }
        start();


        /**
         * Encode char
         * @param char
         * @returns {string|number}
         */
        let encodeChar = (char) => {
            switch (char) {
                case 'К':
                    return 1;
                case 'Г':
                    return 1;
                case 'Б':
                    return 2;
                case 'Ц':
                    return 2;
                case 'Х':
                    return 2;
                case 'Т':
                    return 3;
                case 'З':
                    return 3;
                case 'Ч':
                    return 4;
                case 'Р':
                    return 4;
                case 'П':
                    return 5;
                case 'Ш':
                    return 6;
                case 'Щ':
                    return 6;
                case 'Ж':
                    return 6;
                case 'С':
                    return 7;
                case 'М':
                    return 7;
                case 'В':
                    return 8;
                case 'Ф':
                    return 8;
                case 'Д':
                    return 9;
                case 'Н':
                    return 0;
                case 'Л':
                    return 0;
                default : return '';
            }
        };

        /**
         * String to vowels
         * @param str
         * @returns {string}
         */
        let vowels = (str) => {
            return str.split('')
                .reduce((a, c) =>
                    a + (/[БВГДЖЗКЛМНПРСТФХЦЧШЩбвгджзклмнпрстфхцчшщ]/i.test(c) ?
                    c.toLocaleUpperCase('ru-RU') :
                    c.toLocaleLowerCase('ru-RU')), "");
        };


        /**
         * Showing the main task table
         * @param resultList
         * @param columnsNumber
         */
        function showTable(resultList, columnsNumber) {
            const resultContent = "#result";
            const wordsQuantity = resultList.length;
            let column = 0;
            let table = '<table id="table-math-examples" class="table">';
            table += '<tbody>';
            table += '<tr class="tr-main">';
            for (let j=0; j<wordsQuantity; j++){
                if (column < columnsNumber) {
                    table += `<th class="cell-math  th-main" style="text-align: left;">`;
                    table += resultList[j];
                    table += `</th>`;
                    column++;
                } else {
                    table += '</tr><tr>';
                    table += `<th class="cell-math  th-main" style="text-align: left;">`;
                    table += resultList[j];
                    table += `</th>`;
                    column = 1;
                }
            }
            table += '</tr></tbody></table>';
            $(resultContent).html(table);
        }



        /**
         * Showing the answers table
         * @param resultList
         * @param columnsNumber
         */
        function getAnswers(resultList, columnsNumber) {
            const answersContent = "#answers";
            const wordsQuantity = resultList.length;
            let column = 0;
            let table = '<table id="table-math-examples" class="table">';
            table += '<tbody>';
            table += '<tr class="tr-main">';
            for (let j=0; j<wordsQuantity; j++){
                if (column < columnsNumber) {
                    table += `<th class="cell-math th-main" style="text-align: left;">`;
                    table += resultList[j];
                    table += `</th>`;
                    column++;
                } else {
                    table += '</tr><tr>';
                    table += `<th class="cell-math th-main" style="text-align: left;">`;
                    table += resultList[j];
                    table += `</th>`;
                    column = 1;
                }
            }
            table += '</tr></tbody></table>';
            $(answersContent).html(table);
        }

        /**
         * Stylable table
         * @param fontName - String
         * @param fontSize - Integer
         * @param padding - Integer
         * @param isFontBold - boolean
         */
        function styleTable(fontName, fontSize, padding, isFontBold, fontColor) {
            $(".th-main").css({
                "font-family": fontName,
                "font-size": fontSize + "px",
                "font-weight": isFontBold?"bold":"normal",
                "color": fontColor,
                "width": padding + "px",
                "height": padding + "px",
                "text-align": "left !important",
                "padding-left": padding + "rem",
                "padding-right": padding + "rem"
            });
            $(".tr-main").find("img").css({
                "width": padding/100*90+"px",
                "padding": padding/100*10+"px"
            });

        }
    }
});