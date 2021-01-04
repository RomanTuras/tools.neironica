$(function () {

    if($("#arrange").length){
        function startArrange() {

            let settings = { //default settings for "sudoku-examples"
                'fontName': 'Arial',
                'fontSize': 18,
                'padding': 50,
            };
            const key = "arrange";

            let table = [];
            let arrayForTable = [];

            //assign id's of the elements
            const generateArrange = "#generate-btn";
            const answersArrange = "#answers-btn";
            const answersContent = "#answers-content";
            const inputX = "#inputX";
            const inputY = "#inputY";
            const inputNumber = "#inputNumber";
            const inputFontName = "#inputFontName";
            const inputFontColor = "#inputFontColor";
            const inputBgColor = "#inputBgColor";
            const inputFontSize = "#inputFontSize";
            const checkboxBold = "#checkboxBold";
            const checkboxColored = "#checkboxColored";
            const paddingRange = "#paddingRange";

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
            let tableX = $(inputX).val();
            let tableY = $(inputY).val();
            let numbers = $(inputNumber).val();
            let fontSize = $(inputFontSize).val();
            let fontName = $(inputFontName).val();
            let fontColor = $(inputFontColor).val();
            let bgColor = $(inputBgColor).val();
            let padding = $(paddingRange).val();
            let isFontBold = !!$(checkboxBold).prop("checked");
            let isColored = !!$(checkboxColored).prop("checked");

            $(inputX).change(function () {
                tableX= this.value;
            });
            $(inputY).change(function () {
                tableY= this.value;
            });
            $(inputNumber).change(function () {
                numbers= this.value;
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
            $(inputFontColor).on('change', function(){
                fontColor = this.value;
                $("th").css("color", fontColor);
            });

            $(inputBgColor).on('change', function(){
                bgColor = this.value;
                $("th").css("background-color", bgColor);
            });

            $(checkboxBold).change(function () {
                isFontBold = $(checkboxBold).prop("checked");
                $("th").css("font-weight", isFontBold ? "bold" : "normal");
            });


            /**
             * Generate Arrange Table
             */
            $(generateArrange).click(function () {
                if (numbers > (tableX * tableY)) {
                    arrayForTable = RandomizeHelper.getRandomNumbersFromRange(1, numbers, numbers);
                    table = SudokuHelper.fillTableFromArray(arrayForTable, tableX, tableY);
                    showTable(table, tableX, tableY);
                    styleTable(fontName, fontSize, padding, isFontBold, fontColor, bgColor);
                    $(answersContent).hide();
                } else {
                    alert(`Ёмкость таблицы (X*Y) НЕ должна быть больше выбранного числа N!`);
                }
            });

            /**
             * Generate answers table
             */
            $(answersArrange).click(function () {
                $(answersContent).show();
                let answersTable = SudokuHelper.getArrangeTable(table, tableX, tableY);
                showAnswers(answersTable);
                styleTable(fontName, fontSize, padding, isFontBold, fontColor, bgColor);
            });

            /**
             * Showing Answers Sudoku
             */
            $(answersArrange).click(function () {
                $("tr").find("th").removeClass("cell-closed");
                $("tr").find("img").removeClass("img-hidden");
            });
        }
        startArrange();

        /**
         * Showing the table
         * @param resultList
         * @param cols
         * @param rows
         * @param imageSet String
         */
        function showTable(resultList, cols, rows) {
            const result = "#res";
            let table = '';
            table = '<table id="main-table" class="table-sudoku">';
            table += '<tbody>';
            let i = 0;
            resultList.forEach(function (row) {
                table += '<tr>';
                row.forEach(function (item) {
                    table += `<th class="cell-opened result-th">${item}</th>`;
                    i++;
                });
                table += '</tr>';
            });

            table += '</tbody></table>';
            $(result).html(table);
        }

        function showAnswers(array) {
            const result = "#answers";
            let table = '';
            table = '<table id="main-table" class="table-sudoku">';
            table += '<tbody>';
            let i = 0;
            array.forEach(function (row) {
                table += '<tr>';
                row.forEach(function (item) {
                    table += `<th class="cell-opened answer-th">${item}</th>`;
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
         * @param fontColor
         */
        function styleTable(fontName, fontSize, padding, isFontBold, fontColor, bgColor) {
            $(".result-th").css({
                "font-family": fontName,
                "font-size": fontSize + "px",
                "color": fontColor,
                "background-color":bgColor,
                "font-weight": isFontBold?"bold":"normal",
                "width": padding + "px",
                "height": padding + "px"
            });
            $(".answer-th").css({
                "font-family": fontName,
                "font-size": fontSize + "px",
                "color": "black",
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