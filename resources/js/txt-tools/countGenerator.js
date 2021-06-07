$(function () {

    if($("#count").length){
        function startCount() {

            let settingsObject = {
                'inputFontName': 'Arial',
                'inputFontSize': 18,
                'inputImageSet': 'Airplanes-4,4',
                'paddingRange': 50,
                'inputX': 3,
                'inputY': 3,
                'checkboxBold': false,
                'checkboxGrid': true,
                'inputNumberImages': 2,
            };

            const key = "count";

            let table = [];

            //assign id's of the elements
            const generateCount = "#generate-count";
            const answersCount = "#answers-count";
            const answersContent = "#answers-content";

            const mInputX = "#inputX";
            const mInputY = "#inputY";
            const inputNumberImages = "#inputNumberImages";
            const mInputImageSet = "#inputImageSet";
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
                if (LocalStorageHelper.getFontSettings(key) != null
                    && LocalStorageHelper.getFontSettings(key).hasOwnProperty('inputImageSet')
                    && LocalStorageHelper.getFontSettings(key).inputImageSet != null) {
                    settingsObject.inputX = LocalStorageHelper.getFontSettings(key).inputX;
                    settingsObject.inputY = LocalStorageHelper.getFontSettings(key).inputY;
                    settingsObject.inputFontName = LocalStorageHelper.getFontSettings(key).inputFontName;
                    settingsObject.inputImageSet = LocalStorageHelper.getFontSettings(key).inputImageSet;
                    settingsObject.inputFontSize = LocalStorageHelper.getFontSettings(key).inputFontSize;
                    settingsObject.checkboxBold = LocalStorageHelper.getFontSettings(key).checkboxBold;
                    settingsObject.checkboxGrid = LocalStorageHelper.getFontSettings(key).checkboxGrid;
                    settingsObject.paddingRange = LocalStorageHelper.getFontSettings(key).paddingRange;
                    // settingsObject.inputNumberImages = LocalStorageHelper.getFontSettings(key).inputNumberImages;
                }
                $(mInputX).val(settingsObject.inputX);
                $(mInputY).val(settingsObject.inputY);
                $(inputFontName).val(settingsObject.inputFontName);
                $(mInputImageSet).val(settingsObject.inputImageSet);
                $(inputFontSize).val(settingsObject.inputFontSize);
                $(paddingRange).val(settingsObject.paddingRange);
                // $(inputNumberImages).val(settingsObject.inputNumberImages);
                $(checkboxBold).prop("checked", settingsObject.checkboxBold);
                $(checkboxGrid).prop("checked", settingsObject.checkboxGrid);
                console.log(settingsObject);
            }
            setupControlsSudokuExamples();

            function saveControls() {
                settingsObject.inputX = $(mInputX).val();
                settingsObject.inputY = $(mInputY).val();
                // settingsObject.inputNumberImages = $(inputNumberImages).val();
                settingsObject.inputImageSet = $(mInputImageSet).val();
                settingsObject.inputFontName = $(inputFontName).val();
                settingsObject.inputFontSize = $(inputFontSize).val();
                settingsObject.checkboxBold = $(checkboxBold).prop("checked");
                settingsObject.checkboxGrid = $(checkboxGrid).prop("checked");
                settingsObject.paddingRange = $(paddingRange).val();
                LocalStorageHelper.saveFontSettings(key, settingsObject);
            }
            //values of the controls
            let tableX = $(mInputX).val();
            let tableY = $(mInputY).val();
            let imagesConfig = $(mInputImageSet).val().split(',');
            let imageSet = imagesConfig[0]; //Name of the image set
            let quantityImagesInSet = imagesConfig[1]; //Quantity images from current set
            $(inputNumberImages).html(getRangeOfQuantityImages(quantityImagesInSet));
            let numberImages = $(inputNumberImages).val();
            let fontSize = $(inputFontSize).val();
            let fontName = $(inputFontName).val();
            let padding = $(paddingRange).val();
            let isFontBold = !!$(checkboxBold).prop("checked");
            let isGridEnabled = !!$(checkboxGrid).prop("checked");

            $(mInputX).change(function () {
                tableX= this.value.split(',');
            });
            $(mInputY).change(function () {
                tableY= this.value.split(',');
            });
            $(inputNumberImages).change(function () {
                numberImages= this.value.split(',');
            });
            $(mInputImageSet).change(function () {
                imagesConfig = this.value.split(',');
                imageSet = imagesConfig[0];
                quantityImagesInSet = imagesConfig[1];
                $(inputNumberImages).html(getRangeOfQuantityImages(quantityImagesInSet));
                if (quantityImagesInSet < numberImages) {
                    $(inputNumberImages).val(2);
                    numberImages = 2;
                }else {
                    $(inputNumberImages).val(numberImages);
                }
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
            });
            $(inputFontSize).on('change', function(){
                fontSize = this.value;
                $("th").css("font-size", fontSize + "px");
            });
            $(inputFontName).on('change', function(){
                fontName = this.value;
                $("th").css("font-family", fontName);
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
                saveControls(key, settingsObject);
                table = SudokuHelper.getFilledTableByRangeOfNumbers(numberImages, tableX, tableY);
                if (quantityImagesInSet < numberImages) {
                    alert(`В выбранном наборе ${quantityImagesInSet} картинок, пожалуйста уменьшите значение N`);
                    $(inputNumberImages).val(2);
                }else {
                    showTable(table, tableX, tableY, imageSet, isGridEnabled);
                    styleTable(fontName, fontSize, padding, isFontBold);
                    $(answersContent).hide();
                }
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