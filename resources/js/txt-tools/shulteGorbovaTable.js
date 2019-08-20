/**
 * Main function of "Shulte Gorbova Table"
 * Starting only when "Shulte Gorbova" template is attached
 * Depends from classes:
 * - LocalStorageHelper.js
 * - RandomizeHelper.js
 * - ShuffleHelper.js
 */
$(function() {
  let settingsObject = { //default settings for "Shulte Gorbova Table"
    'fontFamily': 'Arial',
    'fontSize': 18,
    'cellPadding': 17,
  }

  const key = "shulte-gorbova-table";

  if( $("#shulte-gorbova-table").length ){
    const shulteGorbova = new ShulteGorbova(settingsObject, key);
    shulteGorbova.setupControls();
  }

  function generateTable(){
    const shulteGorbova = new ShulteGorbova();
    let isGorbovaAlgorithm = $("#checkboxIsGorbova").prop("checked");
    // if($("#checkboxIsGorbova").prop("checked") == false) isGorbovaAlgorithm = false;
    let filledArray = shulteGorbova.fillArray(shulteGorbova.rows * shulteGorbova.cols, isGorbovaAlgorithm);
    let mixedArray = ShuffleHelper.shuffleArray(filledArray);
    shulteGorbova.createTable(mixedArray);
    ShulteGorbova.styleTable();
  }


/**
 * Processing events from controls
 */
// function listenIvents(shulteGorbova){
  $("#generate-shulte-gorbova").click(generateTable);

  $("#inputColorFontSchema").on('change', generateTable);

  // Set selected font size
  $("#inputFontSize").on('change', function(){
    var fontSize = $("#inputFontSize").value;
    $(".cell").css("font-size", fontSize + "px");
    settingsObject.fontSize = fontSize;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  // Set selected font family
  $("#inputFontName").on('change', function(){
    var fontName = $("#inputFontName").value;
    $(".cell").css("font-family", fontName);
    settingsObject.fontFamily = fontName;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  // Set selected padding
  $("#paddingRange").on('change', function(){
    var cellPadding = $("#paddingRange").value;
    $(".cell").css("padding", cellPadding + "px");
    settingsObject.cellPadding = cellPadding;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  //Bold text - checkbox event handler
  $("#checkboxBold").change(function(){
    if($("#checkboxBold").prop("checked") == true){
      $(".cell").css("font-weight", "bold");
    }else{
      $(".cell").css("font-weight", "normal");
    }
  });

  //Set backgroung color
  $("#inputBgColor").change(function(){
    let color = this.value;
    ShulteGorbova.paintBgTable(color);
  })

  //Switch between Shulte algorithm and Gorbova
  $("#checkboxIsGorbova").change(generateTable);

});
// }


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
    let cellPadding = this.settingsObject.cellPadding;
    if(LocalStorageHelper.getFontSettings(this.key) != null){
      fontFamily = LocalStorageHelper.getFontSettings(this.key).fontFamily;
      fontSize = LocalStorageHelper.getFontSettings(this.key).fontSize;
      cellPadding = LocalStorageHelper.getFontSettings(this.key).cellPadding;
    }
    $("#inputFontName").val(fontFamily);
    $("#inputFontSize").val(fontSize);
    $("#paddingRange").val(cellPadding);
  }

  /**
   * Filled n-elements array from "1" to "n+1" numbers
   * @param {Int} n 
   * @returns Array of objects
   */
  fillArray (arrayLenght, isGorbovaAlgorithm){
    let arr = new Array(arrayLenght);
    let counter = 1;
    let color = this.listColors[0];
    for(let i=0; i<arrayLenght; i++){
      arr[i] = { 
        'number' : counter, 
        'color': color 
      };
      if(counter == Math.trunc(arrayLenght/2) && isGorbovaAlgorithm) {
        counter = 0;
        color = this.listColors[1];
        isGorbovaAlgorithm = false;
      }
      counter++;
    }
    // console.log(arr);
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
   * @param {Int} number of array elements 
   */
  createTable(mixedArray) {
    var table_body = '<table align="center" id="shulte-grobova-table">';
    var c = 0;
    for(var i=0;i<this.rows;i++){
      table_body+='<tr id="tr">';
      for(var j=0;j<this.cols;j++){
          table_body +=`<td class="cell" style="color: ${mixedArray[c].color}">`;
          table_body += mixedArray[c].number;
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
    if(color == "white"){
      $(".cell").css("border-color", "gray");
    }
    $(".cell").css("background-color", color);
  }

  static paintFontTable(table, paintArray){
    paintArray = ShuffleHelper.shuffleArray(paintArray);
    $(table).each(function(index, tr) {
      var lines = $('td', tr).map(function(index, td) {
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
    $(".cell").css("padding", $("#paddingRange").val() + "px");
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