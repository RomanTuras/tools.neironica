/**
 * Main function of "Shulte Table"
 * Starting only when "Shulte" template is attached
 * Depends from classes:
 * - LocalStorageHelper.js
 * - RandomizeHelper.js
 * - ShuffleHelper.js
 */

$(function() {
  //default settings for "Shulte Table"
  let settingsObject = JSON.parse('{"fontFamily": "Arial","fontSize": "18","inputType": "1","cellPaddingX": "17","cellPaddingY": "17","rows": 3,"cols": 3,"bgImage": false,"inputColorSchema": "no","isBold": false,"isColored": false,"fontColor": "#0000ff" }');

  if ($("#shulte-table").length) {
    const key = "shulte-table";
    if (LocalStorageHelper.getFontSettings(key) != null) {
      if (LocalStorageHelper.getFontSettings(key).hasOwnProperty('rows')) {
        settingsObject = LocalStorageHelper.getFontSettings(key);
      }
    }
    setupControls(key, settingsObject);
    startShulte();
    listenIvents(key, settingsObject);


    let val = $("#inputColorSchema").val();
    let listColors = val.split(',');
    paintTableBackground("#shulte-table", listColors);
    let isColored = $("#checkboxColored").prop("checked") === true;
    styleTable(isColored);
  }
});

/**
 * Processing Shulte table
 */
function startShulte() {
  $("#generate-shulte").unbind().click(function() {
    let rows = $("#inputRowsShulte").val();
    let cols = $("#inputColsShulte").val();
    let isColored = $("#checkboxColored").prop("checked") === true;
    let type = $("#inputType").val();
    let offset = 0;
    let isError = false;
    switch (type) { // type == 1 -- Numbers
      case '2': { // Russian alphabet big letter
        offset = 1039;
        if (rows*cols > 32) isError = true;
      }
        break;
      case '3': { // English alphabet big letter
        offset = 64;
        if (rows*cols > 26) isError = true;
      }
        break;
      case '4': { // German alphabet big letter
        offset = 64;
        if (rows*cols > 30) isError = true;
      }
        break;
      case '5': { // Russian alphabet small letter
        offset = 1071;
        if (rows*cols > 32) isError = true;
      }
        break;
      case '6': { // English alphabet small letter
        offset = 96;
        if (rows*cols > 26) isError = true;
      }
        break;
      case '7': { // German alphabet small letter
        offset = 96;
        if (rows*cols > 30) isError = true;
      }
        break;
    }

    if (!isError) {
      let filledArray = [];
      if (type == 4) filledArray = fillGermanyArray(rows * cols, offset, true); //Germany alphabet Big letters
      else if (type == 7) filledArray = fillGermanyArray(rows * cols, offset, false); //Germany alphabet Small letters
      else filledArray = fillArray(rows * cols, offset);
      let mixedArray = ShuffleHelper.shuffleArray(filledArray);
      createTable(rows, cols, mixedArray, type);
      styleTable(isColored);
    } else alert("Ошибка! Размерность таблицы больше количества букв выбранного алфавита!");

    // $("#inputBgImage").val("");
  });
}

/**
 * Setting controls from local storage or by default
 * @param {String} key specific string to local storage
 * @param {json} settingsObject 
 */
function setupControls(key, settingsObject) {
  let fontFamily = settingsObject.fontFamily;
  let fontSize = settingsObject.fontSize;
  let cellPaddingX = settingsObject.cellPaddingX;
  let cellPaddingY = settingsObject.cellPaddingY;
  let inputType = settingsObject.inputType;
  let rows = settingsObject.rows;
  let cols =settingsObject.cols;
  let bgImage = settingsObject.bgImage;
  let colorSchema = settingsObject.inputColorSchema;
  let isBold = settingsObject.isBold;
  let isColored = settingsObject.isColored;
  let fontColor = settingsObject.fontColor;

  if (LocalStorageHelper.getFontSettings(key) != null) {
    fontFamily = LocalStorageHelper.getFontSettings(key).fontFamily;
    fontSize = LocalStorageHelper.getFontSettings(key).fontSize;
    cellPaddingX = LocalStorageHelper.getFontSettings(key).cellPaddingX;
    cellPaddingY = LocalStorageHelper.getFontSettings(key).cellPaddingY;
    inputType = LocalStorageHelper.getFontSettings(key).inputType;
    rows = LocalStorageHelper.getFontSettings(key).rows;
    cols = LocalStorageHelper.getFontSettings(key).cols;
    bgImage = LocalStorageHelper.getFontSettings(key).bgImage;
    fontColor = LocalStorageHelper.getFontSettings(key).fontColor;
    colorSchema = LocalStorageHelper.getFontSettings(key).inputColorSchema;
    isBold = LocalStorageHelper.getFontSettings(key).isBold;
    isColored = LocalStorageHelper.getFontSettings(key).isColored;
  }

  $("#inputFontNameShulte").val(fontFamily);
  $("#inputFontSizeShulte").val(fontSize);
  $("#paddingRangeShulteX").val(cellPaddingX);
  $("#paddingRangeShulteY").val(cellPaddingY);
  $("#inputType").val(inputType);
  $("#inputRowsShulte").val(rows);
  $("#inputColsShulte").val(cols);
  $("#inputColorSchema").val(colorSchema);
  if (bgImage) $("#inputBgImage").val(bgImage);
  $("#checkboxColored").prop("checked", isColored);
  $("#checkboxBoldShulte").prop("checked", isBold);
  $("#inputFontColorShulte").val(fontColor);
}

/**
 * Processing events from controls
 * @param {String} key specific string to local storage
 * @param {json} settingsObject 
 */
function listenIvents(key, settingsObject) {

  $("#inputBgImage").on('change', function() {
    settingsObject.bgImage = this.value;
    LocalStorageHelper.saveFontSettings(key, this.settingsObject);
  });

  $("#inputColorSchema").on('change', function() {
    settingsObject.inputColorSchema = this.value;
    LocalStorageHelper.saveFontSettings(key, this.settingsObject);
  });

  $("#inputFontColorShulte").on('change', function() {
    settingsObject.fontColor = this.value;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  $("#inputColsShulte").on('change', function() {
    settingsObject.cols = this.value;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  $("#inputRowsShulte").on('change', function() {
    settingsObject.rows = this.value;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  // Set selected font size
  $("#inputFontSizeShulte").on('change', function() {
    let fontSize = this.value;
    $(".cell").css("font-size", fontSize + "px");
    settingsObject.fontSize = fontSize;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  // Set selected font family
  $("#inputFontNameShulte").on('change', function() {
    let fontName = this.value;
    $(".cell").css("font-family", fontName);
    settingsObject.fontFamily = fontName;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  $("#inputType").on('change', function() {
    settingsObject.inputType = this.value;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  // Set selected font size
  $("#inputFontColorShulte").on('change', function() {
    let fontColor = this.value;
    $(".cell").css("color", fontColor);
  });

  // Set selected paddingX
  $("#paddingRangeShulteX").on('change', function() {
    let cellPaddingX = this.value;
    $(".cell").css("padding-left", cellPaddingX + "px");
    $(".cell").css("padding-right", cellPaddingX + "px");
    settingsObject.cellPaddingX = cellPaddingX;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  // Set selected paddingY
  $("#paddingRangeShulteY").on('change', function() {
    let cellPaddingY = this.value;
    $(".cell").css("padding-top", cellPaddingY + "px");
    $(".cell").css("padding-bottom", cellPaddingY + "px");
    settingsObject.cellPaddingY = cellPaddingY;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  //Bold text - checkbox event handler
  $("#checkboxBoldShulte").change(function() {
    if ($("#checkboxBoldShulte").prop("checked") === true) {
      settingsObject.isBold = true;
      $(".cell").css("font-weight", "bold");
    } else {
      settingsObject.isBold = false;
      $(".cell").css("font-weight", "normal");
    }
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  $("#checkboxColored").change(function() {
    let isColored = $("#checkboxColored").prop("checked");
    settingsObject.isColored = isColored;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
    paintTableColor("#shulte-table", isColored);
  });

  //Background color -  event handler
  $("#inputColorSchema").change(function() {
    let listColors = this.value.split(',');
    settingsObject.colorSchema = listColors;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
    paintTableBackground("#shulte-table", listColors);
  });


  //St background image
  $("#inputBgImage").change(function() {
    let pathImage = this.value;
    settingsObject.bgImage = pathImage;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
    $("table").css('background-image', `url('${pathImage}')`);
  })
}

/**
 * Random painting background to each <td>
 * @param {String} table Element
 * @param listColors
 */
function paintTableBackground(table, listColors) {
  // const listColors = ['aqua', 'coral', 'cornflowerblue', 'transparent', 'chartreuse', 'fuchsia'];
  $(table).each(function(index, tr) {
    let lines = $('td', tr).map(function(index, td) {
      let n = RandomizeHelper.getRandomInt(0, listColors.length);
      let color = (listColors.length > 1) ? listColors[n] : "transparent";
      $(td).css("background", color);
    });
  });
}

/**
 * Random colored font from the table
 * @param table
 * @param isColored
 */
function paintTableColor(table, isColored) {
  const listColors = ['aqua', 'coral', 'cornflowerblue', 'blueviolet', 'chartreuse', 'fuchsia'];
  $(table).each(function(index, tr) {
    $('td', tr).map(function(index, td) {
      let n = RandomizeHelper.getRandomInt(0, listColors.length-1);
      let color = (isColored) ? listColors[n] : "black";
      $(td).css("color", color);
    });
  });
}

/**
 * Filled n-elements array from "1" to "n+1" numbers by sequential numbers with offset depended on selected alphabet
 * @param {number} n
 * @param offset
 * @returns Array
 */
function fillArray(n, offset) {
  let arr = [];
  for (let i = 1; i <= n; i++) {
    arr.push(i + offset);
  }
  return arr;
}

/**
 * Filled n-elements array from "1" to "n+1" numbers by sequential numbers for German alphabet only
 * @param n
 * @param offset
 * @param isBigLetters
 * @returns {[]}
 */
function fillGermanyArray(n, offset, isBigLetters) {
  let arr = [];
  if (n >= 9 && n < 15) n = n - 2; //Will be added 2 different letters in to the Eng alphabet
  else if(n >= 15 && n < 21) n = n - 3; //Will be added 3 different letters in to the Eng alphabet
  else n = n - 4;  //Will be added 4 different letters in to the Eng alphabet

  for (let i=1; i<=n; i++) {
    arr.push(i + offset);
    if (i === 1) {
      if (isBigLetters) arr.push(196);
      else arr.push(228)
    }
    else if (i === 2) arr.push(223);
    else if (i === 15) {
      if (isBigLetters) arr.push(214);
      else arr.push(246)
    }
    else if (i === 21) {
      if (isBigLetters) arr.push(220);
      else arr.push(252)
    }
  }
  return arr;
}


/**
 * Creating a table
 * @param {Int} rows
 * @param {Int} cols
 * @param mixedArray
 * @param type
 */
function createTable(rows, cols, mixedArray, type) {
  let table_body = '<table align="center" id="shulte-table">';
  let c = 0;
  for (let i = 0; i < rows; i++) {
    table_body += '<tr id="tr">';
    for (let j = 0; j < cols; j++) {
      table_body += '<td class="cell">';
      if (type == 1) table_body += mixedArray[c++]; //Type is Numbers
      else table_body += '&#' + mixedArray[c++] + ';'; //Type is Letters
      table_body += '</td>';
    }
    table_body += '</tr>';
  }
  table_body += '</table>';
  $('#result').html(table_body);
}

/**
 * Accepting styles to result table, depends from control
 */
function styleTable(isColored) {
  $(".cell").css("font-family", $("#inputFontNameShulte").val());
  $(".cell").css("color", $("#inputFontColorShulte").val());
  $(".cell").css("font-size", $("#inputFontSizeShulte").val() + "px");

  let paddingX =  $("#paddingRangeShulteX").val();
  let paddingY =  $("#paddingRangeShulteY").val();
  $(".cell").css("padding-left", paddingX + "px");
  $(".cell").css("padding-right", paddingX + "px");
  $(".cell").css("padding-top", paddingY + "px");
  $(".cell").css("padding-bottom", paddingY + "px");

  if ($("#checkboxBoldShulte").prop("checked") == true) {
    $(".cell").css("font-weight", "bold");
  } else {
    $(".cell").css("font-weight", "normal");
  }
  let listColors = $("#inputColorSchema").val().split(',');
  paintTableBackground("#shulte-table", listColors);

  if (isColored) paintTableColor("#shulte-table" ,isColored);

  let pathImage = $("#inputBgImage").val();
  $("table").css('background-image', `url('${pathImage}')`);
}