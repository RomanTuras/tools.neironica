$(function () {

    if($("#configuration").length){
        function startCcnfiguration() {

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
            const inputDensity = "#densityRange";
            const paddingRange = "#paddingRange";
            const colorsQuantity = 7;

            $(answersContent).hide();

            /**
             * Setting controls from local storage or by default
             */
            function setupControlsConfiguration() {
                if (LocalStorageHelper.getFontSettings(key) != null) {
                    settings.density = LocalStorageHelper.getFontSettings(key).density;
                    settings.padding = LocalStorageHelper.getFontSettings(key).padding;
                }
                $(inputDensity).val(settings.density);
                $(paddingRange).val(settings.padding);
            }
            setupControlsConfiguration();

            //values of the controls
            let tableX = $(inputX).val();
            let tableY = $(inputY).val();
            let density = $(inputDensity).val();
            let padding = $(paddingRange).val();
            let imageSet = $(inputImageSet).val();

            $(inputX).change(function () {
                tableX= this.value.split(',');
            });
            $(inputY).change(function () {
                tableY= this.value.split(',');
            });
            $(inputImageSet).change(function () {
                imageSet = this.value;
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
            $(inputDensity).on('change', function(){
                density = this.value;
                settings.density = density;
                LocalStorageHelper.saveFontSettings(key, settings);
            });


            /**
             * Generate Table
             */
            $(generate).click(function () {
                table = SudokuHelper.getFilledTableByRangeOfNumbers(colorsQuantity, tableX, tableY);
                showTable(table, tableX, tableY, imageSet, density);
                styleTable(padding);
                $(answersContent).hide();
            });

            /**
             * Showing Answers Sudoku
             */
            $(answers).click(function () {
                $("tr").find("th").removeClass("cell-closed");
                $("tr").find("img").removeClass("img-hidden");
            });
        }
        startCcnfiguration();

        /**
         *
         * @param imageSet
         * @returns {String}
         */
        function getPathToImageByImageSet(imageSet) {
            let imagePath = `../img/@2x/config/${imageSet}`;
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
        function showTable(resultList, cols, rows, imageSet, density) {
            const result = "#res";
            let table = '<table class="table-sudoku">';
            table += '<tbody>';
            let i = 0;
            let imagePath = getPathToImageByImageSet(imageSet);
            let imageUrl = '';
            resultList.forEach(function (row) {
                table += '<tr>';
                row.forEach(function (item) {
                    imageUrl = `${imagePath}/${item}.png`;
                    if(Math.random() * 10 > density){
                        item = `<img src="${imageUrl}" />`;
                    }else item = `<img class="img-hidden" src="${imageUrl}" />`;
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