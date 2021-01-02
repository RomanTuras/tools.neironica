$(function () {

    if($("#configuration").length){
        function startConfiguration() {

            let settings = {
                'density': 5,
                'padding': 50,
            };
            const key = "configuration";

            let table = [];

            //assign id's of the elements
            const generate = "#generate";
            const answers = "#answers";
            const answersContent = "#answers-content";
            const inputX = "#inputX";
            const inputY = "#inputY";
            const inputImageSet = "#inputImageSet";
            const inputOpenedCells = "#inputOpenedCells";
            const paddingRange = "#paddingRange";
            // const quantityImagesInSet = 0;

            $(answersContent).hide();

            /**
             * Setting controls from local storage or by default
             */
            function setupControlsConfiguration() {
                if (LocalStorageHelper.getFontSettings(key) != null) {
                    settings.openedCells = LocalStorageHelper.getFontSettings(key).openedCells;
                    settings.padding = LocalStorageHelper.getFontSettings(key).padding;
                }
                $(inputOpenedCells).val(settings.openedCells);
                $(paddingRange).val(settings.padding);
            }
            setupControlsConfiguration();

            //values of the controls
            let tableX = $(inputX).val();
            let tableY = $(inputY).val();
            let imagesConfig = $(inputImageSet).val().split(',');
            let imageSet = imagesConfig[0]; //Name of the image set
            $(inputOpenedCells).html(getRangeOfOpenedCells(tableX, tableY));
            let quantityOpenedCells = $(inputOpenedCells).val();
            let padding = $(paddingRange).val();
            let quantityImagesInSet = imagesConfig[1]; //Quantity images from current set


            $(inputX).change(function () {
                tableX= this.value;
                $(inputOpenedCells).html(getRangeOfOpenedCells(tableX, tableY));
                quantityOpenedCells = 2;
                settings.openedCells = quantityOpenedCells;
                LocalStorageHelper.saveFontSettings(key, settings);
            });
            $(inputY).change(function () {
                tableY= this.value;
                $(inputOpenedCells).html(getRangeOfOpenedCells(tableX, tableY));
                quantityOpenedCells = 2;
                settings.openedCells = quantityOpenedCells;
                LocalStorageHelper.saveFontSettings(key, settings);
            });
            $(inputImageSet).change(function () {
                imagesConfig = this.value.split(',');
                imageSet = imagesConfig[0];
                quantityImagesInSet = imagesConfig[1];
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
            $(inputOpenedCells).on('change', function(){
                quantityOpenedCells = this.value;
                settings.openedCells = quantityOpenedCells;
                LocalStorageHelper.saveFontSettings(key, settings);
            });


            /**
             * Generate Table
             */
            $(generate).click(function () {
                table = SudokuHelper.getFilledTableByRangeOfNumbers(quantityImagesInSet, tableX, tableY);
                let openedCellsList = RandomizeHelper.getRandomNumbersFromRange(0, tableX*tableY - 1, quantityOpenedCells);
                showTable(table, tableX, tableY, imageSet, openedCellsList);
                styleTable(padding);
            });

            /**
             * Showing Answers Sudoku
             */
            $(answers).click(function () {
                $("tr").find("th").removeClass("cell-closed");
                $("tr").find("img").removeClass("img-hidden");
            });
        }
        startConfiguration();

        /**
         * Getting html options for selected size of a table
         * @param x
         * @param y
         * @returns {string}
         */
        function getRangeOfOpenedCells(x, y) {
            let options = '';
            for (let i=2; i<x*y; i++){
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
         * @param openedCellsList
         */
        function showTable(resultList, cols, rows, imageSet, openedCellsList) {
            const result = "#res";
            let table = '<table class="table-sudoku">';
            table += '<tbody>';

            let imagePath = getPathToImageByImageSet(imageSet);
            let imageUrl = '';
            let i = 0;
            let counter = 0;

            resultList.forEach(function (row) {
                table += '<tr>';
                row.forEach(function (item) {
                    imageUrl = `${imagePath}/${item}.png`;
                    if(counter === openedCellsList[i]){
                        item = `<img src="${imageUrl}" />`;
                        i++;
                    }else item = `<img class="img-hidden" src="${imageUrl}" />`;
                    table += `<th class="cell-opened">${item}</th>`;
                    counter++;
                });
                table += '</tr>';
            });

            table += '</tbody></table>';
            $(result).html(table);
        }

        /**
         * Stylable table
         * @param padding - Integer
         */
        function styleTable(padding) {
            $("th").css({
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