/**
 * Main function of "Shulte Gorbova Table"
 * Starting only when "Shulte Gorbova" template is attached
 * Depends from classes:
 * - LocalStorageHelper.js
 * - RandomizeHelper.js
 * - ShuffleHelper.js
 */
$(function() {
  // let settingsObject = { //default settings for "Shulte Gorbova Table"
  //   'fontFamily': 'Arial',
  //   'fontSize': 18,
  //   'inputType': 1,
  //   'cellPaddingX': 17,
  //   'cellPaddingY': 17
  // };

  let settingsObject = JSON.parse('{"fontFamily": "Arial","fontSize": "18","inputType": "1","cellPaddingX": "17","cellPaddingY": "17","rows": 3,"cols": 3,"bgColor": "white","colorSchema": "black,black","isBold": false,"isGorbova": true}');
  const key = "shulte-gorbova-table";

  if( $("#shulte-gorbova-table").length ){
    const shulteGorbova = new ShulteGorbova(settingsObject, key);
    shulteGorbova.setupControls();
  }

  function generateTable(){
    const shulteGorbova = new ShulteGorbova();
    let isGorbovaAlgorithm = $("#checkboxIsGorbova").prop("checked");
    let type = $("#inputType").val();
    let offset = 0;
    let isError = false;
    let n = shulteGorbova.rows * shulteGorbova.cols;
    switch (type) { // type == 1 -- Numbers
      case '2': { // Russian alphabet big letter
        offset = 1039;
        if (n > 32) isError = true;
      }
        break;
      case '3': { // English alphabet big letter
        offset = 64;
        if (n > 26) isError = true;
      }
        break;
      case '4': { // German alphabet big letter
        offset = 64;
        if (n > 30) isError = true;
      }
        break;
      case '5': { // Russian alphabet small letter
        offset = 1071;
        if (n > 32) isError = true;
      }
        break;
      case '6': { // English alphabet small letter
        offset = 96;
        if (n > 26) isError = true;
      }
        break;
      case '7': { // German alphabet small letter
        offset = 96;
        if (n > 30) isError = true;
      }
        break;
    }

    if (!isError) {
      let filledArray = [];
      if (type == 4) filledArray = shulteGorbova.fillGermanyArray(n, isGorbovaAlgorithm,true); //Germany alphabet Big letters
      else if (type == 7) filledArray = shulteGorbova.fillGermanyArray(n, isGorbovaAlgorithm, false); //Germany alphabet Big letters
      else filledArray = shulteGorbova.fillArray(n, isGorbovaAlgorithm, offset);
      let mixedArray = ShuffleHelper.shuffleArray(filledArray);
      shulteGorbova.createTable(mixedArray, type);
      ShulteGorbova.styleTable();
    } else alert("Ошибка! Размерность таблицы больше количества букв выбранного алфавита!");
  }


/**
 * Processing events from controls
 */

  $("#generate-shulte-gorbova").unbind().click(generateTable);

  $("#inputRows").on('change', function () {
    settingsObject.rows = this.value;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  $("#inputCols").on('change', function () {
    settingsObject.cols = this.value;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  $("#inputColorFontSchema").on('change', function () {
    settingsObject.colorSchema = this.value;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
    generateTable();
  });

  // Set selected font size
  $("#inputFontSize").on('change', function(){
    let fontSize = this.value;
    $(".cell").css("font-size", fontSize + "px");
    settingsObject.fontSize = fontSize;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  // Set selected font family
  $("#inputFontName").on('change', function(){
    var fontName = this.value;
    $(".cell").css("font-family", fontName);
    settingsObject.fontFamily = fontName;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  $("#inputType").on('change', function() {
    settingsObject.inputType = this.value;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  // Set selected paddingX
  $("#paddingRangeX").on('change', function(){
    let cellPaddingX = this.value;
    $(".cell").css("padding-left", cellPaddingX + "px");
    $(".cell").css("padding-right", cellPaddingX + "px");
    settingsObject.cellPaddingX = cellPaddingX;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  // Set selected paddingY
  $("#paddingRangeY").on('change', function(){
    let cellPaddingY = this.value;
    $(".cell").css("padding-top", cellPaddingY + "px");
    $(".cell").css("padding-bottom", cellPaddingY + "px");
    settingsObject.cellPaddingY = cellPaddingY;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  //Bold text - checkbox event handler
  $("#checkboxBold").change(function(){
    if($("#checkboxBold").prop("checked") == true){
      settingsObject.isBold = true;
      $(".cell").css("font-weight", "bold");
    }else{
      settingsObject.isBold = false;
      $(".cell").css("font-weight", "normal");
    }
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  $("#checkboxIsGorbova").change(function(){
    if($("#checkboxIsGorbova").prop("checked") == true){
      settingsObject.isGorbova = true;
    }else{
      settingsObject.isGorbova = false;
    }
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  //Set backgroung color
  $("#inputBgColor").change(function(){
    let color = this.value;
    settingsObject.bgColor = color;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
    ShulteGorbova.paintBgTable(color);
  });

  //Switch between Shulte algorithm and Gorbova
  $("#checkboxIsGorbova").change(generateTable);

});


class ShulteGorbova{

  constructor(settingsObject, key){
    this.key = key;
    this.settingsObject = settingsObject; //default settings for "Shulte Gorbova Table"
    this.rows = $("#inputRows").val();
    this.cols = $("#inputCols").val();
    this.listColors = $("#inputColorFontSchema").val().split(",");
  }


  /**
   * Setting controls from local storage or by default
   */
  setupControls(){
    let fontFamily = this.settingsObject.fontFamily;
    let fontSize = this.settingsObject.fontSize;
    let cellPaddingX = this.settingsObject.cellPaddingX;
    let cellPaddingY = this.settingsObject.cellPaddingY;
    let inputType = this.settingsObject.inputType;

    let rows = this.settingsObject.rows;
    let cols = this.settingsObject.cols;
    let bgColor = this.settingsObject.bgColor;
    let isBold = this.settingsObject.isBold;
    let isGorbova = this.settingsObject.isGorbova;
    let colorSchema = this.settingsObject.colorSchema;

    if(LocalStorageHelper.getFontSettings(this.key) != null){
      fontFamily = LocalStorageHelper.getFontSettings(this.key).fontFamily;
      fontSize = LocalStorageHelper.getFontSettings(this.key).fontSize;
      cellPaddingX = LocalStorageHelper.getFontSettings(this.key).cellPaddingX;
      cellPaddingY = LocalStorageHelper.getFontSettings(this.key).cellPaddingY;
      inputType = LocalStorageHelper.getFontSettings(this.key).inputType;
      if (LocalStorageHelper.getFontSettings(this.key).hasOwnProperty('rows')) {
        rows = LocalStorageHelper.getFontSettings(this.key).rows;
        cols = LocalStorageHelper.getFontSettings(this.key).cols;
        bgColor = LocalStorageHelper.getFontSettings(this.key).bgColor;
        isBold = LocalStorageHelper.getFontSettings(this.key).isBold;
        isGorbova = LocalStorageHelper.getFontSettings(this.key).isGorbova;
        colorSchema = LocalStorageHelper.getFontSettings(this.key).colorSchema;
      }
    }
    $("#inputFontName").val(fontFamily);
    $("#inputFontSize").val(fontSize);
    $("#paddingRangeX").val(cellPaddingX);
    $("#paddingRangeY").val(cellPaddingY);
    $("#inputType").val(inputType);

    $("#inputRows").val(rows);
    $("#inputCols").val(cols);
    $("#inputBgColor").val(bgColor);

    $("#checkboxIsGorbova").prop("checked", isGorbova);
    $("#checkboxBold").prop("checked", isBold);
    $("#inputColorFontSchema").val(colorSchema);
  }

  /**
   * Filled n-elements array from "1" to "n+1" numbers
   * @param {Int} n
   * @param isGorbovaAlgorithm
   * @returns Array of objects
   */
  fillArray (n, isGorbovaAlgorithm, offset){
    let arr = new Array(n);
    let counter = 1;
    let color = this.listColors[0];
    for(let i=0; i<n; i++){
      arr[i] = {
        'number' : counter + offset,
        'color': color 
      };
      if(counter === Math.trunc(n/2) && isGorbovaAlgorithm) {
        counter = 0;
        color = this.listColors[1];
        isGorbovaAlgorithm = false;
      }
      counter++;
    }
    return arr;
  }

  fillGermanyArray (n, isGorbovaAlgorithm, isBigLetters){
    let alphabetBig = [65,196,66,223,67,68,69,70,71,72,73,74,75,76,77,78,79,214,80,81,82,83,84,85,220,86,87,88,89,90,91];
    let alphabetSmall = [97,228,98,223,99,100,101,102,103,104,105,106,107,108,109,110,246,111,112,113,114,115,116,252,117,118,119,120,121,122];
    let arr = [];
    let counter = 1;
    let color = this.listColors[0];
    for(let i=0; i<n; i++){
      arr.push({
        'number' : isBigLetters ? alphabetBig[counter-1] : alphabetSmall[counter-1],
        'color': color
      });
      if(counter === Math.trunc(n/2) && isGorbovaAlgorithm) {
        counter = 0;
        color = this.listColors[1];
        isGorbovaAlgorithm = false;
      }
      counter++;
    }
    return arr;
  }

  /**
   * Filled array in half by 0 and 1
   * @param {Int} this.rows 
   * @param {Int} this.cols 
   */
  static preparePaintArray(){
    let arr = new Array(this.rows*this.cols);
    let colorSwitch = false;
    for(let i=0; i<(this.rows*this.cols); i++){
      arr[i] = colorSwitch ? 1 : 0;
      colorSwitch = !colorSwitch;
    }
    return arr;
  }

  /**
   * Creating a table
   * @param {Int} this.rows
   * @param {Int} this.cols
   * @param mixedArray
   * @param type
   */
  createTable(mixedArray, type) {
    let table_body = '<table align="center" id="shulte-grobova-table">';
    let c = 0;
    for(let i=0;i<this.rows;i++){
      table_body+='<tr id="tr">';
      for(let j=0;j<this.cols;j++){
        table_body +=`<td class="cell" style="color: ${mixedArray[c].color}">`;
        if (type == 1) table_body += mixedArray[c].number; //Type is Numbers
        else table_body += '&#' + mixedArray[c].number + ';'; //Type is Letters

        table_body +='</td>';
        c++;
      }
      table_body+='</tr>';
    }
      table_body+='</table>';
    $('#result').html(table_body);
  }

  static paintBgTable(color){
    $(".cell").css("border-color", "white");

    $(".cell").css("background-color", color);
    if(color == "white"){
      $(".cell").css("border-color", "gray");
    }
  }

  static paintFontTable(table, paintArray){
    paintArray = ShuffleHelper.shuffleArray(paintArray);
    $(table).each(function(index, tr) {
      let lines = $('td', tr).map(function(index, td) {
        let n = paintArray[index];
        let color = this.listColors[n];
        $(td).css("color", color);
      });
    });
  }

  /**
   * Accepting styles to result table, depends from control
   */
  static styleTable(){
    $(".cell").css("font-family", $("#inputFontName").val());
    $(".cell").css("font-size", $("#inputFontSize").val() + "px");

    let paddingX =  $("#paddingRangeX").val();
    let paddingY =  $("#paddingRangeY").val();
    $(".cell").css("padding-left", paddingX + "px");
    $(".cell").css("padding-right", paddingX + "px");
    $(".cell").css("padding-top", paddingY + "px");
    $(".cell").css("padding-bottom", paddingY + "px");

    if($("#checkboxBold").prop("checked") == true){
      $(".cell").css("font-weight", "bold");
    }else{
      $(".cell").css("font-weight", "normal");
    }

    // let paintArray = ShulteGorbova.preparePaintArray(this.rows, this.cols);
    // ShulteGorbova.paintFontTable("#shulte-grobova-table", paintArray);

    let color = $("#inputBgColor").val();
    ShulteGorbova.paintBgTable(color);
  }

}