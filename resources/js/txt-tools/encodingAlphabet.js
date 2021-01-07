$(function () {

    if($("#encoding-alphabet").length){
        function startCount() {

            let settings = { //default settings for "sudoku-examples"
                'fontName': 'Arial',
                'fontSize': 18,
                'padding': 50,
            };
            const key = "encoding-alphabet";

            let resultWordsList = [];
            let encodeSet = "";

            //assign id's of the elements
            const startEncoding = "#encoding-btn";
            const showAnswers = "#answer-btn";

            const inputWordsQuantity = "#inputWordsQuantity";
            const inputLettersQuantityMin = "#inputLettersQuantityMin";
            const inputLettersQuantityMax = "#inputLettersQuantityMax";
            const inputColumnsNumber = "#inputColumnsNumber";
            const inputEncodeSet = "#inputEncode";
            const textarea = "#main-textarea";

            const inputFontName = "#inputFontName";
            const inputFontSize = "#inputFontSize";
            const checkboxBold = "#checkboxBold";
            const paddingRange = "#paddingRange";
            const imageSizeRange = "#imageSizeRange";

            const answersContent = "#answers-content";
            const resultContent = "#result-content";
            const selectedEncodeSet = "#selected-encode-set";

            const checkboxManual = "#checkboxManual";
            $("#main-textarea").attr("disabled","disabled");

            $(answersContent).hide();

            /**
             * Setting controls from local storage or by default
             */
            function setupControls() {
                if (LocalStorageHelper.getFontSettings(key) != null) {
                    settings.fontName = LocalStorageHelper.getFontSettings(key).fontName;
                    settings.fontSize = LocalStorageHelper.getFontSettings(key).fontSize;
                }
                $(inputFontName).val(settings.fontName);
                $(inputFontSize).val(settings.fontSize);
            }
            setupControls();

            //values of the controls
            let wordsQuantity = $(inputWordsQuantity).val();
            let lettersQuantityMin = $(inputLettersQuantityMin).val();
            let lettersQuantityMax = $(inputLettersQuantityMax).val();
            let columnsNumber = $(inputColumnsNumber).val();

            let isManualInput = !!$(checkboxManual).prop("checked");
            encodeSet = $(inputEncodeSet).val();

            let fontSize = $(inputFontSize).val();
            let fontName = $(inputFontName).val();
            let isFontBold = !!$(checkboxBold).prop("checked");
            let padding = $(paddingRange).val();
            let imageSize = $(imageSizeRange).val();

            $(inputWordsQuantity).change( function () {
                wordsQuantity= this.value;
            });
            $(inputLettersQuantityMin).change( function (){
                lettersQuantityMin= this.value;
            });
            $(inputLettersQuantityMax).change( function () {
                lettersQuantityMax= this.value;
            });
            $(inputColumnsNumber).change( function () {
                columnsNumber= this.value;
            });

            $(inputFontSize).on('change', function () {
                fontSize = this.value;
                $(".th-answers").css("font-size", fontSize + "px");
                settings.fontSize = fontSize;
                LocalStorageHelper.saveFontSettings(key, settings);
            });
            $(inputFontName).on('change', function () {
                fontName = this.value;
                $(".th-answers").css("font-family", fontName);
                settings.fontName = fontName;
                LocalStorageHelper.saveFontSettings(key, settings);
            });
            $(paddingRange).change( function () {
                padding = this.value;
                $(".th-result").css({
                    "padding-left": padding + "rem",
                    "padding-right": padding + "rem"
                });
                $(".th-answers").css({
                    "padding-left": padding + "rem",
                    "padding-right": padding + "rem"
                });
            });

            $(imageSizeRange).change( function () {
                imageSize = this.value;
                $(".e-img").css({
                    "width": imageSize + "px"
                });
            });

            $(checkboxBold).change( function () {
                isFontBold = $(checkboxBold).prop("checked");
                $("th").css("font-weight", isFontBold ? "bold" : "normal");
            });
            $(checkboxManual).change( function () {
                isManualInput = $(checkboxManual).prop("checked");
                $("#from-database-controls").css("display", isManualInput ? "none" : "block");
                if (isManualInput) {
                    $("#main-textarea").removeAttr("disabled");
                } else $("#main-textarea").attr("disabled","disabled");
            });

            /**
             * Start encoding
             */
            $(startEncoding).click( ()=> {
                $(answersContent).hide();
                let text = "";
                if (isManualInput){
                    text = $(textarea).val();
                    resultWordsList = text.split(" ");
                } else { //Getting data from DB
                    let wordsList = $("#data").val().split(" ");
                    resultWordsList = RandomizeHelper.getRandomWordsByLength(wordsList, lettersQuantityMin, lettersQuantityMax, wordsQuantity);
                    console.log(`founded ${resultWordsList.length} words with letters <= ${lettersQuantityMin}`);
                }
                showTable(resultWordsList, columnsNumber, encodeSet, imageSize);
                styleTable(fontName, fontSize, padding, isFontBold, imageSize);
            });

            /**
             * Showing answers
             */
            $(showAnswers).click( ()=> {
                $(answersContent).show();
                getAnswers(resultWordsList, columnsNumber);
                styleTable(fontName, fontSize, padding, isFontBold, imageSize);
            });

            showEncode(encodeSet);
        }
        startCount();


        /**
         *
         * @param imageSet
         * @returns {String}
         */
        function getPathToImageByImageSet(imageSet) {
            let imagePath = `../img/@2x/encode/${imageSet}`;
            if(imageSet === "none") return '';
            return imagePath;
        }

        function showEncode(encodeSet) {
            const word = "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯ";
            const wordToLower = word.toLocaleLowerCase('ru-RU');
            const resultContent = "#selected-encode-set";
            let table = '<table id="table-math-examples" class="table">';
            table += '<tbody>';
            table += '<tr>';
            let col = 0;
            for (let j=0; j<word.length; j++){
                table += `<th class="cell-math" style="text-align: center;">`;
                table += word.charAt(j);
                table += getImagesByLetters( wordToLower.charAt(j), encodeSet, false);
                table += `</th>`;
                col++;
                if(col === 10) {
                    table += '</tr><tr>';
                    col = 0;
                }
            }
            table += '</tr></tbody></table>';
            $(resultContent).html(table);
        }

        /**
         * Showing the main task table
         * @param resultList
         * @param columnsNumber
         * @param encodeSet
         * @param imageSize
         */
        function showTable(resultList, columnsNumber, encodeSet, imageSize) {
            const resultContent = "#result";
            const wordsQuantity = resultList.length;
            let column = 0;
            let table = '<table id="table-math-examples" class="table">';
            table += '<tbody>';
            table += '<tr class="tr-result">';
            for (let j=0; j<wordsQuantity; j++){
                if (column < columnsNumber) {
                    table += `<th class="cell-math th-result" style="text-align: left;">`;
                    table += getImagesByLetters(resultList[j], encodeSet);
                    table += `</th>`;
                    column++;
                } else {
                    table += '</tr><tr>';
                    table += `<th class="cell-math th-result" style="text-align: left;">`;
                    table += getImagesByLetters(resultList[j], encodeSet);
                    table += `</th>`;
                    column = 1;
                }
            }
            table += '</tr></tbody></table>';
            $(resultContent).html(table);
        }

        /**
         * Getting a images appropriate to letters, depend on encoding set
         * @param word
         * @param encodeSet
         * @param isImageResized
         * @returns {string}
         */
        function getImagesByLetters(word, encodeSet, isImageResized = true) {
            let images = '';
            let imagePath = getPathToImageByImageSet(encodeSet);
            let len = word.length;
            for (let i=0; i<len; i++){
                let c = word.charAt(i);
                let imageUrl = `${imagePath}/${c}.png`;
                if (isImageResized) images += `<img class="e-img" src="${imageUrl}" style="margin: 5px; padding: 5px; border: solid 1px #e2e3e5"/>`;
                else images += `<img class="img" src="${imageUrl}" style="width: 50px; margin: 5px; padding: 5px; border: solid 1px #e2e3e5"/>`;
            }
            return images;
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
            table += '<tr class="tr-answers">';
            for (let j=0; j<wordsQuantity; j++){
                if (column < columnsNumber) {
                    table += `<th class="cell-math th-answers" style="text-align: left;">`;
                    table += resultList[j];
                    table += `</th>`;
                    column++;
                } else {
                    table += '</tr><tr>';
                    table += `<th class="cell-math th-answers" style="text-align: left;">`;
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
        function styleTable(fontName, fontSize, padding, isFontBold, imageSize) {
            $(".th-answers").css({
                "font-family": fontName,
                "font-size": fontSize + "px",
                "font-weight": isFontBold?"bold":"normal",
                "width": padding + "px",
                "height": padding + "px",
                "text-align": "left !important",
                "padding-left": padding + "rem",
                "padding-right": padding + "rem"
            });
            $(".tr-answers").find("img").css({
                "width": padding/100*90+"px",
                "padding": padding/100*10+"px"
            });
            $(".e-img").css({
                "width": imageSize + "px"
            });
            $(".th-result").css({
                "padding-left": padding + "rem",
                "padding-right": padding + "rem"
            });

        }
    }
});