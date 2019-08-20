/**
 * Main function of "Shulte Table"
 * Starting only when "Shulte" template is attached
 * Depends from classes:
 * - LocalStorageHelper.js
 * - RandomizeHelper.js
 * - ShuffleHelper.js
 */
$(function() {
  if ($("#shulte-table").length) {
    const key = "shulte-table";
    let settingsObject = { //default settings for "Shulte Table"
      'fontFamily': 'Arial',
      'fontSize': 18,
      'cellPadding': 17,
    }
    setupControls(key, settingsObject);
    startShulte();
    listenIvents(key, settingsObject);
  }
});

/**
 * Processing Shulte table
 */
function startShulte() {
  $("#generate-shulte").click(function() {
    let rows = $("#inputRowsShulte").val();
    let cols = $("#inputColsShulte").val();
    let filledArray = fillArray(rows * cols);
    let mixedArray = ShuffleHelper.shuffleArray(filledArray);
    createTable(rows, cols, mixedArray);
    styleTable();
    $("#inputBgImage").val("");
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
  let cellPadding = settingsObject.cellPadding;

  if (LocalStorageHelper.getFontSettings(key) != null) {
    fontFamily = LocalStorageHelper.getFontSettings(key).fontFamily;
    fontSize = LocalStorageHelper.getFontSettings(key).fontSize;
    cellPadding = LocalStorageHelper.getFontSettings(key).cellPadding;
  }

  $("#inputFontNameShulte").val(fontFamily);
  $("#inputFontSizeShulte").val(fontSize);
  $("#paddingRangeShulte").val(cellPadding);
}

/**
 * Processing events from controls
 * @param {String} key specific string to local storage
 * @param {json} settingsObject 
 */
function listenIvents(key, settingsObject) {

  // Set selected font size
  $("#inputFontSizeShulte").on('change', function() {
    var fontSize = this.value;
    $(".cell").css("font-size", fontSize + "px");
    settingsObject.fontSize = fontSize;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  // Set selected font family
  $("#inputFontNameShulte").on('change', function() {
    var fontName = this.value;
    $(".cell").css("font-family", fontName);
    settingsObject.fontFamily = fontName;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  // Set selected font size
  $("#inputFontColorShulte").on('change', function() {
    var fontColor = this.value;
    $(".cell").css("color", fontColor);
  });

  // Set selected padding
  $("#paddingRangeShulte").on('change', function() {
    var cellPadding = this.value;
    $(".cell").css("padding", cellPadding + "px");
    settingsObject.cellPadding = cellPadding;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  //Bold text - checkbox event handler
  $("#checkboxBoldShulte").change(function() {
    if ($("#checkboxBoldShulte").prop("checked") == true) {
      $(".cell").css("font-weight", "bold");
    } else {
      $(".cell").css("font-weight", "normal");
    }
  });

  //Background color -  event handler
  $("#inputColorSchema").change(function() {
    let listColors = this.value.split(',');
    paintTable("#shulte-table", listColors);
  });


  //St backgroung image
  $("#inputBgImage").change(function() {
    let pathImage = this.value;
    $("table").css('background-image', `url('${pathImage}')`);
  })
}

/**
 * Random painting backgroung to each <td>
 * @param {String} table Element
 * @param {Boolean} isColorPaint 
 */
function paintTable(table, listColors) {
  // const listColors = ['aqua', 'coral', 'cornflowerblue', 'transparent', 'chartreuse', 'fuchsia'];
  $(table).each(function(index, tr) {
    var lines = $('td', tr).map(function(index, td) {
      let n = RandomizeHelper.getRandomInt(0, listColors.length);
      let color = (listColors.length > 1) ? listColors[n] : "transparent";
      $(td).css("background", color);
    });
  });
}

/**
 * Filled n-elements array from "1" to "n+1" numbers
 * @param {Int} n 
 * @returns Array
 */
function fillArray(n) {
  let arr = new Array(n);
  for (let i = 0; i < n; i++) {
    arr[i] = i + 1;
  }
  return arr;
}

/**
 * Creating a table
 * @param {Int} rows 
 * @param {Int} cols
 * @param {Int} number of array elements 
 */
function createTable(rows, cols, mixedArray) {
  var table_body = '<table align="center" id="shulte-table">';
  var c = 0;
  for (var i = 0; i < rows; i++) {
    table_body += '<tr id="tr">';
    for (var j = 0; j < cols; j++) {
      table_body += '<td class="cell">';
      table_body += mixedArray[c++];
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
function styleTable() {
  $(".cell").css("font-family", $("#inputFontNameShulte").val());
  $(".cell").css("color", $("#inputFontColorShulte").val());
  $(".cell").css("font-size", $("#inputFontSizeShulte").val() + "px");
  $(".cell").css("padding", $("#paddingRangeShulte").val() + "px");
  if ($("#checkboxBoldShulte").prop("checked") == true) {
    $(".cell").css("font-weight", "bold");
  } else {
    $(".cell").css("font-weight", "normal");
  }
  let listColors = $("#inputColorSchema").val().split(',');
  paintTable("#shulte-table", listColors);
}