/**
 * Main function of "Math Examples"
 * Starting only when "math-examples" template is attached
 * Depends from classes:
 * - RandomizeHelper.js
 */
$(function () {
    if ($("#number-generator").length) {

        function startNumbers() {
            let settingsNumbersObject = { //default settings for "math-examples"
                'fontName': 'Arial',
                'fontSize': 18,
            };
            const keyNumbers = "numbers";

            //assign id's of the elements
            const inputFirstNumberType = "#inputFirstNumberType";
            const inputColumnsNumber = "#inputColumnsNumber";
            const inputExamplesNumber = "#inputExamplesNumber";
            const inputTextColor = "#inputTextColor";
            const inputFontSize = "#inputFontSize";
            const inputFontName = "#inputFontName";
            const paddingRange = "#paddingRange";
            const start = "#generate-numbers";
            const checkBoxBold = "#checkboxBold";

            /**
             * Setting controls from local storage or by default
             */
            function setupControlsMathExamples() {
                if (LocalStorageHelper.getFontSettings(keyNumbers) != null) {
                    settingsNumbersObject.fontName = LocalStorageHelper.getFontSettings(keyNumbers).fontName;
                    settingsNumbersObject.fontSize = LocalStorageHelper.getFontSettings(keyNumbers).fontSize;
                }
                $(inputFontName).val(settingsNumbersObject.fontName);
                $(inputFontSize).val(settingsNumbersObject.fontSize);
            }
            setupControlsMathExamples();

            //values of the controls
            let firstNumberRange = $(inputFirstNumberType).val().split(','); //range for number
            let columnsNumber = $(inputColumnsNumber).val();
            let examplesNumber = $(inputExamplesNumber).val();
            let fontColor = $(inputTextColor).val();
            let fontSize = $(inputFontSize).val();
            let fontName = $(inputFontName).val();
            let padding = $(paddingRange).val();
            let resultList = [];
            let isFontBold = !!$(checkBoxBold).prop("checked");

            //events of controls
            $(inputFirstNumberType).change(function () {
                firstNumberRange = this.value.split(',');
            });
            $(inputColumnsNumber).change(function () {
                columnsNumber = this.value;
            });
            $(inputExamplesNumber).change(function () {
                examplesNumber = this.value;
            });
            $(inputTextColor).change(function () {
                fontColor = this.value;
                $("th").css("color", fontColor);
            });
            $(paddingRange).change(function () {
                padding = this.value;
                $("th").css({
                    "padding-left": padding + "rem",
                    "padding-right": padding + "rem"
                });
            });
            $(inputFontSize).on('change', function(){
                fontSize = this.value;
                $("th").css("font-size", fontSize + "px");
                settingsNumbersObject.fontSize = fontSize;
                LocalStorageHelper.saveFontSettings(keyNumbers, settingsNumbersObject);
            });
            $(inputFontName).on('change', function(){
                fontName = this.value;
                $("th").css("font-family", fontName);
                settingsNumbersObject.fontName = fontName;
                LocalStorageHelper.saveFontSettings(keyNumbers, settingsNumbersObject);
            });
            $(checkBoxBold).change(function () {
                isFontBold = $(checkBoxBold).prop("checked");
                $("th").css("font-weight", isFontBold ? "bold" : "normal");
            });

            /**
             * Generate a new math examples
             */
            $(start).click(function () {
                let totalExamples = parseInt(examplesNumber) * parseInt(columnsNumber);
                resultList = getListExamples(totalExamples, firstNumberRange);
                showTable(resultList, columnsNumber, examplesNumber);
                styleTable(fontName, fontSize, fontColor, padding, isFontBold);
            })
        }
        startNumbers();

        /**
         * Stylable table
         * @param fontName - String
         * @param fontSize - Integer
         * @param fontColor - String
         * @param padding - Integer
         * @param isFontBold - boolean
         */
        function styleTable(fontName, fontSize, fontColor, padding, isFontBold) {
            $("th").css({
                "font-family": fontName,
                "font-size": fontSize + "px",
                "color": fontColor,
                "font-weight": isFontBold?"bold":"normal",
                "padding-left": padding + "rem",
                "padding-right": padding + "rem"
            });
        }

        /**
         * Showing a table with math examples
         * @param resultList - Array of math examiles
         * @param columnsNumber - Integer
         * @param examplesNumber - Integer
         */
        function showTable(resultList, columnsNumber, examplesNumber) {
            const result = "#res";
            let table = '<table id="table-math-examples" class="table table-striped">';
            table += '<tbody>';
            let i = 0;
            for (let example=0; example<examplesNumber; example++){
                table += '<tr>';
                for (let column=0; column<columnsNumber; column++){
                    table += `<th class="cell-math">${resultList[i]}</th>`;
                    i++;
                }
                table += '</tr>';
            }
            table += '</tbody></table>'
            $(result).html(table);
        }

        /**
         * Separate by three digit by space
         * Working only with numbers < 10 digit
         * @param number
         * @returns {string}
         */
        function formatNumber(number) {
            let charsArray = number.toString().split("");
            let newNumber = [];
            let n = 0;
            for (let i = charsArray.length - 1; i > -1; i--) {
                if (n === 3) {
                    newNumber.push(" ");
                    n = 0;
                }
                newNumber.push(charsArray[i]);
                n++;
            }
            let reverse = newNumber.reverse();
            return reverse.join("");
        }

        /**
         * Getting filled array of examples, depends from operations
         * @param totalExamples - Integer, numbers of examples
         * @param firstNumberRange - Array, range of min and max numbers in examples
         * @returns {[]} - Array
         */
        function getListExamples(totalExamples, firstNumberRange) {
            let resultList = [];
            let firstNumber = 0;
            for (let i=0; i<totalExamples; i++){
                firstNumber = RandomizeHelper.getRandomInt(firstNumberRange[0], firstNumberRange[1]);
                firstNumber = formatNumber(firstNumber);
                resultList.push(`${firstNumber}`);
            }
            return resultList;
        }


    }
});
