/**
 * Main function of "Math Examples"
 * Starting only when "math-examples" template is attached
 * Depends from classes:
 * - RandomizeHelper.js
 */
$(function () {
    if ($("#math-examples").length) {

        function startMathExamples() {
            let settingsMathExamplesObject = { //default settings for "math-examples"
                'fontName': 'Arial',
                'fontSize': 18,
            };
            const keyMathExamples = "math-examples";

            //assign id's of the elements
            const inputOperation = "#inputOperation";
            const inputFirstNumberType = "#inputFirstNumberType";
            const inputSecondNumberType = "#inputSecondNumberType";
            const inputColumnsNumber = "#inputColumnsNumber";
            const inputExamplesNumber = "#inputExamplesNumber";
            const inputTextColor = "#inputTextColor";
            const inputFontSizeMath = "#inputFontSizeMath";
            const inputFontNameMath = "#inputFontNameMath";
            const paddingRangeMath = "#paddingRangeMath";
            const start = "#generate-math-examples";
            const checkBoxBold = "#checkboxBoldMath";
            const checkBoxNegativeResult = "#checkboxNegativeResult";

            /**
             * Setting controls from local storage or by default
             */
            function setupControlsMathExamples() {
                if (LocalStorageHelper.getFontSettings(keyMathExamples) != null) {
                    settingsMathExamplesObject.fontName = LocalStorageHelper.getFontSettings(keyMathExamples).fontName;
                    settingsMathExamplesObject.fontSize = LocalStorageHelper.getFontSettings(keyMathExamples).fontSize;
                }
                $(inputFontNameMath).val(settingsMathExamplesObject.fontName);
                $(inputFontSizeMath).val(settingsMathExamplesObject.fontSize);
            }
            setupControlsMathExamples();

            //values of the controls
            let operation = $(inputOperation).val();
            let firstNumberRange = $(inputFirstNumberType).val().split(','); //range for first number
            let secondNumberRange= $(inputSecondNumberType).val().split(','); //range for second number
            let columnsNumber = $(inputColumnsNumber).val();
            let examplesNumber = $(inputExamplesNumber).val();
            let fontColor = $(inputTextColor).val();
            let fontSize = $(inputFontSizeMath).val();
            let fontName = $(inputFontNameMath).val();
            let padding = $(paddingRangeMath).val();
            let resultList = [];
            let isFontBold = !!$(checkBoxBold).prop("checked");
            let isNegativeResult = !!$(checkBoxNegativeResult).prop("checked");

            //events of controls
            $(inputOperation).change(function () {
                operation = this.value;
            });
            $(inputFirstNumberType).change(function () {
                firstNumberRange = this.value.split(',');
            });
            $(inputSecondNumberType).change(function () {
                secondNumberRange = this.value.split(',');
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
            $(paddingRangeMath).change(function () {
                padding = this.value;
                $("th").css({
                    "padding-left": padding + "rem",
                    "padding-right": padding + "rem"
                });
            });
            $(inputFontSizeMath).on('change', function(){
                fontSize = this.value;
                $("th").css("font-size", fontSize + "px");
                settingsMathExamplesObject.fontSize = fontSize;
                LocalStorageHelper.saveFontSettings(keyMathExamples, settingsMathExamplesObject);
            });
            $(inputFontNameMath).on('change', function(){
                fontName = this.value;
                $("th").css("font-family", fontName);
                settingsMathExamplesObject.fontName = fontName;
                LocalStorageHelper.saveFontSettings(keyMathExamples, settingsMathExamplesObject);
            });
            $(checkBoxBold).change(function () {
                isFontBold = $(checkBoxBold).prop("checked");
                $("th").css("font-weight", isFontBold ? "bold" : "normal");
            });

            $(checkBoxNegativeResult).change(function () {
                isNegativeResult = $(checkBoxNegativeResult).prop("checked");
            });

            /**
             * Generate a new math examples
             */
            $(start).click(function () {
                let totalExamples = parseInt(examplesNumber) * parseInt(columnsNumber);
                resultList = getListExamples(operation, totalExamples, firstNumberRange, secondNumberRange, isNegativeResult);
                showTable(resultList, columnsNumber, examplesNumber);
                styleTable(fontName, fontSize, fontColor, padding, isFontBold);
            })
        }
        startMathExamples();

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
         * @param operation - String, math operator
         * @param totalExamples - Integer, numbers of examples
         * @param firstNumberRange - Array, range of min and max numbers in examples
         * @param secondNumberRange - Array, range of min and max numbers in examples
         * @returns {[]} - Array
         */
        function getListExamples(operation, totalExamples, firstNumberRange, secondNumberRange, isNegativeResult) {
            let resultList = [];
            let firstNumber = 0;
            let secondNumber = 0;
            for (let i=0; i<totalExamples; i++){
                firstNumber = RandomizeHelper.getRandomInt(firstNumberRange[0], firstNumberRange[1]);
                secondNumber = RandomizeHelper.getRandomInt(secondNumberRange[0], secondNumberRange[1]);

                switch (operation) {
                    case 'plus':
                        firstNumber = formatNumber(firstNumber);
                        secondNumber = formatNumber(secondNumber);
                        resultList.push(`${firstNumber} &plus; ${secondNumber}`);
                        break;
                    case 'minus':
                        if (isNegativeResult){ //check switch of applying a negative result example
                            if ((firstNumber - secondNumber) < 0){
                                firstNumber = formatNumber(firstNumber);
                                secondNumber = formatNumber(secondNumber);
                                resultList.push(`${secondNumber} &minus; ${firstNumber}`);
                            }else {
                                firstNumber = formatNumber(firstNumber);
                                secondNumber = formatNumber(secondNumber);
                                resultList.push(`${firstNumber} &minus; ${secondNumber}`);
                            }
                        }else {
                            firstNumber = formatNumber(firstNumber);
                            secondNumber = formatNumber(secondNumber);
                            resultList.push(`${firstNumber} &minus; ${secondNumber}`);
                        }
                        break;
                    case 'multiply':
                        firstNumber = formatNumber(firstNumber);
                        secondNumber = formatNumber(secondNumber);
                        resultList.push(`${firstNumber} &times; ${secondNumber}`);
                        break;
                    case 'divide':
                        let divideResult = firstNumber / secondNumber;
                        if (divideResult < 1) { //exchange first and second variables
                            let temp = firstNumber;
                            firstNumber = secondNumber;
                            secondNumber = temp;
                            divideResult = firstNumber / secondNumber;
                        }
                        let solid = Math.trunc(divideResult) + 1;
                        firstNumber = secondNumber * solid;
                        firstNumber = formatNumber(firstNumber);
                        secondNumber = formatNumber(secondNumber);
                        resultList.push(`${firstNumber} &divide; ${secondNumber}`);
                        break;
                }

            }
            return resultList;
        }



    }
});
