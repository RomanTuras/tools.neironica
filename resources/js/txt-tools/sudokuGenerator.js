$(function () {

    if($("#sudoku").length){
        function startSudoku() {

            let settingsSudokuExamplesObject = { //default settings for "sudoku-examples"
                'fontName': 'Arial',
                'fontSize': 18,
                'padding': 50,
            };
            const keySudokuExamples = "sudoku-examples";

            //assign id's of the elements
            const generateSudoku = "#generate-sudoku";
            const answersSudoku = "#answers-sudoku";
            const inputSizeTable = "#inputSizeTable";
            const inputImageSet = "#inputImageSet";
            const inputFontNameSudoku = "#inputFontNameSudoku";
            const inputFontSizeSudoku = "#inputFontSizeSudoku";
            const checkboxBoldSudoku = "#checkboxBoldSudoku";
            const paddingRangeSudoku = "#paddingRangeSudoku";

            /**
             * Setting controls from local storage or by default
             */
            function setupControlsSudokuExamples() {
                if (LocalStorageHelper.getFontSettings(keySudokuExamples) != null) {
                    settingsSudokuExamplesObject.fontName = LocalStorageHelper.getFontSettings(keySudokuExamples).fontName;
                    settingsSudokuExamplesObject.fontSize = LocalStorageHelper.getFontSettings(keySudokuExamples).fontSize;
                    settingsSudokuExamplesObject.padding = LocalStorageHelper.getFontSettings(keySudokuExamples).padding;
                }
                $(inputFontNameSudoku).val(settingsSudokuExamplesObject.fontName);
                $(inputFontSizeSudoku).val(settingsSudokuExamplesObject.fontSize);
                $(paddingRangeSudoku).val(settingsSudokuExamplesObject.padding);
            }
            setupControlsSudokuExamples();

            //values of the controls
            let sizeTable= $(inputSizeTable).val().split(','); //sizeTable[0] = cols, sizeTable[1] = rows
            let fontSize = $(inputFontSizeSudoku).val();
            let fontName = $(inputFontNameSudoku).val();
            let padding = $(paddingRangeSudoku).val();
            let imageSet = $(inputImageSet).val();
            let isFontBold = !!$(checkboxBoldSudoku).prop("checked");

            $(inputSizeTable).change(function () {
                sizeTable= this.value.split(',');
            });
            $(inputImageSet).change(function () {
                imageSet = this.value;
            });
            $(paddingRangeSudoku).change(function () {
                padding = this.value;
                $("th").css({
                    "width": padding + "px",
                    "height": padding + "px"
                });
                $("tr").find("img").css({
                    "width": padding/100*90+"px",
                    "padding": padding/100*10+"px"
                });
                settingsSudokuExamplesObject.padding = padding;
                LocalStorageHelper.saveFontSettings(keySudokuExamples, settingsSudokuExamplesObject);
            });
            $(inputFontSizeSudoku).on('change', function(){
                fontSize = this.value;
                $("th").css("font-size", fontSize + "px");
                settingsSudokuExamplesObject.fontSize = fontSize;
                LocalStorageHelper.saveFontSettings(keySudokuExamples, settingsSudokuExamplesObject);
            });
            $(inputFontNameSudoku).on('change', function(){
                fontName = this.value;
                $("th").css("font-family", fontName);
                settingsSudokuExamplesObject.fontName = fontName;
                LocalStorageHelper.saveFontSettings(keySudokuExamples, settingsSudokuExamplesObject);
            });
            $(checkboxBoldSudoku).change(function () {
                isFontBold = $(checkboxBoldSudoku).prop("checked");
                $("th").css("font-weight", isFontBold ? "bold" : "normal");
            });

            /**
             * Generate Sudoku Table
             */
            $(generateSudoku).click(function () {
                let cols = sizeTable[0];
                let rows = sizeTable[1];
                let table = SudokuHelper.getTablePattern(cols, rows);
                table = SudokuHelper.mix(table, cols, rows, 13);

                // let imagePath = getPathToImageByImageSet(imageSet);

                showTable(table, cols, rows, imageSet);
                styleTable(fontName, fontSize, padding, isFontBold);
            });

            /**
             * Showing Answers Sudoku
             */
            $(answersSudoku).click(function () {
                $("tr").find("th").removeClass("cell-closed");
                $("tr").find("img").removeClass("img-hidden");
            });
        }
        startSudoku();

        /**
         *
         * @param imageSet
         * @returns {String}
         */
        function getPathToImageByImageSet(imageSet) {
            let imagePath = `../img/@2x/sudoku/${imageSet}`;
            if(imageSet === "none") return '';
            return imagePath;
        }

        /**
         * Checking is file image exist
         * @param url String - path to image
         * @return {boolean}
         */
        function imageExist(url) {
            let img = new Image();
            img.src = url;
            return (img.height !== 0);
        }

        /**
         * Showing the table
         * @param resultList
         * @param cols
         * @param rows
         * @param imageSet String
         */
        function showTable(resultList, cols, rows, imageSet) {
            let isImagesEnabled = (imageSet !== 'none');

            const result = "#res";
            let table = '<table class="table-sudoku">';
            table += '<tbody>';
            let i = 0;
            let rightBorderIndicator = 0;
            let leftBorderIndicator = 0;
            let imagePath = getPathToImageByImageSet(imageSet);
            let imageUrl = '';
            resultList.forEach(function (row) {
                if(leftBorderIndicator === rows-1){
                    table += '<tr class="brd-bottom">';
                    leftBorderIndicator = -1;
                }else table += '<tr>';
                leftBorderIndicator++;
                row.forEach(function (item) {
                    imageUrl = `${imagePath}/${item}.png`;

                    if(rightBorderIndicator === cols-1){
                        if(Math.random() * 10 > 5){
                            if(isImagesEnabled) item = `<img src="${imageUrl}" />`;
                            table += `<th class="cell-opened brd-right">${item}</th>`;
                        }else{
                            if(isImagesEnabled) item = `<img class="img-hidden" src="${imageUrl}" />`;
                            table += `<th class="cell-closed brd-right">${item}</th>`;
                        }
                        rightBorderIndicator = -1;
                    }else {
                        if(Math.random() * 10 > 5) {
                            if(isImagesEnabled) item = `<img src="${imageUrl}" />`;
                            table += `<th class="cell-opened">${item}</th>`;
                        }else {
                            if(isImagesEnabled) item = `<img class="img-hidden" src="${imageUrl}" />`;
                            table += `<th class="cell-closed">${item}</th>`;
                        }
                    }
                    rightBorderIndicator++;
                    i++;
                });
                table += '</tr>';
            });

            table += '</tbody></table>';
            $(result).html(table);
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
});