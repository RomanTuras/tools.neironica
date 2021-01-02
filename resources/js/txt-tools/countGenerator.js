$(function () {

    if($("#count").length){
        function startCount() {

            let settings = { //default settings for "sudoku-examples"
                'fontName': 'Arial',
                'fontSize': 18,
                'padding': 50,
            };
            const key = "count";

            let table = [];

            //assign id's of the elements
            const generateCount = "#generate-count";
            const answersCount = "#answers-count";
            const answersContent = "#answers-content";
            const inputX = "#inputX";
            const inputY = "#inputY";
            const inputNumberImages = "#inputNumberImages";
            const inputImageSet = "#inputImageSet";
            const inputFontName = "#inputFontName";
            const inputFontSize = "#inputFontSize";
            const checkboxBold = "#checkboxBold";
            const checkboxGrid = "#checkboxGrid";
            const paddingRange = "#paddingRange";

            $(answersContent).hide();

            /**
             * Setting controls from local storage or by default
             */
            function setupControlsSudokuExamples() {
                if (LocalStorageHelper.getFontSettings(key) != null) {
                    settings.fontName = LocalStorageHelper.getFontSettings(key).fontName;
                    settings.fontSize = LocalStorageHelper.getFontSettings(key).fontSize;
                    settings.padding = LocalStorageHelper.getFontSettings(key).padding;
                }
                $(inputFontName).val(settings.fontName);
                $(inputFontSize).val(settings.fontSize);
                $(paddingRange).val(settings.padding);
            }
            setupControlsSudokuExamples();

            //values of the controls
            let tableX = $(inputX).val();
            let tableY = $(inputY).val();
            let imagesConfig = $(inputImageSet).val().split(',');
            let imageSet = imagesConfig[0]; //Name of the image set
            let quantityImagesInSet = imagesConfig[1]; //Quantity images from current set
            $(inputNumberImages).html(getRangeOfQuantityImages(quantityImagesInSet));
            let numberImages = $(inputNumberImages).val();
            let fontSize = $(inputFontSize).val();
            let fontName = $(inputFontName).val();
            let padding = $(paddingRange).val();
            let isFontBold = !!$(checkboxBold).prop("checked");
            let isGridEnabled = !!$(checkboxGrid).prop("checked");

            $(inputX).change(function () {
                tableX= this.value.split(',');
            });
            $(inputY).change(function () {
                tableY= this.value.split(',');
            });
            $(inputNumberImages).change(function () {
                numberImages= this.value.split(',');
            });
            $(inputImageSet).change(function () {
                imagesConfig = this.value.split(',');
                imageSet = imagesConfig[0];
                quantityImagesInSet = imagesConfig[1];
                $(inputNumberImages).html(getRangeOfQuantityImages(quantityImagesInSet));
                numberImages = 2;
            });
            $(paddingRange).change(function () {
                padding = this.value;
                $("th").css({
                    "width": padding + "px",
                    "height": padding + "px"
                });
                $("tr").find("img").css({
                    "width": padding/100*90+"px",
                    "padding": padding/100*10+"px"
                });
                settings.padding = padding;
                LocalStorageHelper.saveFontSettings(key, settings);
            });
            $(inputFontSize).on('change', function(){
                fontSize = this.value;
                $("th").css("font-size", fontSize + "px");
                settings.fontSize = fontSize;
                LocalStorageHelper.saveFontSettings(key, settings);
            });
            $(inputFontName).on('change', function(){
                fontName = this.value;
                $("th").css("font-family", fontName);
                settings.fontName = fontName;
                LocalStorageHelper.saveFontSettings(key, settings);
            });
            $(checkboxBold).change(function () {
                isFontBold = $(checkboxBold).prop("checked");
                $("th").css("font-weight", isFontBold ? "bold" : "normal");
            });
            $(checkboxGrid).change(function () {
                isGridEnabled = $(checkboxGrid).prop("checked");
                if (isGridEnabled) {
                    $("#main-table").addClass("table-sudoku").removeClass("table-count");
                }else {
                    $("#main-table").addClass("table-count").removeClass("table-sudoku");
                }
            });


            /**
             * Generate Count Table
             */
            $(generateCount).click(function () {
                table = SudokuHelper.getFilledTableByRangeOfNumbers(numberImages, tableX, tableY);
                showTable(table, tableX, tableY, imageSet, isGridEnabled);
                styleTable(fontName, fontSize, padding, isFontBold);
                $(answersContent).hide();
            });

            /**
             * Generate answers table
             */
            $(answersCount).click(function () {
                $(answersContent).show();
                showAnswers(table, numberImages, imageSet);
                styleTable(fontName, fontSize, padding, isFontBold);
            });

            /**
             * Showing Answers Sudoku
             */
            $(answersCount).click(function () {
                $("tr").find("th").removeClass("cell-closed");
                $("tr").find("img").removeClass("img-hidden");
            });
        }
        startCount();

        /**
         * Getting html options for selected size of a table
         * @param x
         * @param y
         * @returns {string}
         */
        function getRangeOfQuantityImages(q) {
            let options = '';
            for (let i=2; i<=q; i++){
                options += `<option value=${i}>${i}</option>`;
            }
            return options;
        }

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
        function showTable(resultList, cols, rows, imageSet, isGridEnabled) {
            const result = "#res";
            let table = '';
            if (isGridEnabled) table = '<table id="main-table" class="table-sudoku">';
            else table = '<table id="main-table" class="table-count">';
            table += '<tbody>';
            let i = 0;
            let imagePath = getPathToImageByImageSet(imageSet);
            let imageUrl = '';
            resultList.forEach(function (row) {
                table += '<tr>';
                row.forEach(function (item) {
                    imageUrl = `${imagePath}/${item}.png`;
                    item = `<img src="${imageUrl}" />`;
                    table += `<th class="cell-opened">${item}</th>`;
                    i++;
                });
                table += '</tr>';
            });

            table += '</tbody></table>';
            $(result).html(table);
        }

        function showAnswers(array, numbers, imageSet) {
            let answerList = SudokuHelper.countOccurrences(array, numbers);

            const result = "#answers";
            let table = '<table class="table-sudoku">';
            table += '<tbody>';
            let i = 0;
            let imagePath = getPathToImageByImageSet(imageSet);
            let imageUrl = '';
            answerList.forEach(function (row) {

            let item = "";
            imageUrl = `${imagePath}/${row[0]}.png`;
            item = `<img src="${imageUrl}" />`;
            table += `<th class="cell-opened">${item}</th><th class="cell-opened">${row[1]}</th>`;
            i++;
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