$(function() {
  if( $("#text-converter").length ){
  // Font Settings section ******************************
  const key = "text-converter";
  let settingsObject = { //default settings for "Text Converter"
    'fontFamily': 'Arial',
    'fontSize': 18
  }
  let fontFamily = settingsObject.fontFamily;
  let fontSize = settingsObject.fontSize;

  if(LocalStorageHelper.getFontSettings(key) != null){
    fontFamily = LocalStorageHelper.getFontSettings(key).fontFamily;
    fontSize = LocalStorageHelper.getFontSettings(key).fontSize;
  }

  $("#result").css("font-family", fontFamily + ", sans-serif");
  $("#result").css("font-size", fontSize + "px");

  $("#inputFontName").val(fontFamily);
  $("#inputFontSize").val(fontSize);

  // Set selected font family
  $("#inputFontName").on('change', function(){
    var fontName = this.value;
    $("#result").css("font-family", fontName);
    settingsObject.fontFamily = fontName;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  // Set selected font size
  $("#inputFontSize").on('change', function(){
    var fontSize = this.value;
    $("#result").css("font-size", fontSize + "px");
    settingsObject.fontSize = fontSize;
    LocalStorageHelper.saveFontSettings(key, settingsObject);
  });

  // Set selected font size
  $("#inputFontColor").on('change', function(){
    var fontColor = this.value;
    $("#result").css("color", fontColor);
  });

  //Bold text - checkbox event handler
  $("#checkboxBold").change(function(){
    if($("#checkboxBold").prop("checked") == true){
      $("#result").css("font-weight", "bold");
    }else{
      $("#result").css("font-weight", "normal");
    }
  });

  //Italic text - checkbox event handler
  $("#checkboxItalic").change(function(){
    if($("#checkboxItalic").prop("checked") == true){
      $("#result").css("font-style", "italic");
    }else{
      $("#result").css("font-style", "normal");
    }
  });
  // END Font settings section ******************************


  //Event section *************************
    //Checkout on event "Paste"
    $("textarea").bind('paste', autosize);

    /**
     * Autosizing text area, depends on pasted text
     */
    function autosize(){
      var el = this;
      setTimeout(function(){
        el.style.cssText = 'height:auto; padding:0';
        // for box-sizing other than "content-box" use:
        // el.style.cssText = '-moz-box-sizing:content-box';
        let h = el.scrollHeight + 35;
        el.style.cssText = 'height:' + h + 'px';
      },0);
    }

  /**
   * Scrolling to top
   * @param  {[String]} aid [id of scrolled element]
   */
    function scrollToAnchor(aid) {
      var aTag = $("div[id='" + aid + "']");
      $('html,body').animate({scrollTop: aTag.offset().top}, 500);
    }


    // Mixing chars
    // Mixing chars between first and last letters
    // US, UA, RU - included
    $("#mix-chars").click(function(){
      var text = prepareText($('#main-textarea').val());
      var listWords = text.split(' ');
      for (var i = 0; i < listWords.length; i++) {
        if (listWords[i].length > 3){
          var fullArray = listWords[i].split('');
          var listChars = listWords[i].split('');
          listChars.shift(); // Remove first letter
          listChars.pop(); // Remove last char

          if(listWords[i].slice(-1) == "," ||
            listWords[i].slice(-1) == "." ||
            listWords[i].slice(-1) == "~"){
            listChars.pop(); // Remove last char again
          }

          var mixedMiddleCharsArray = ShuffleHelper.shuffleArray(listChars);
          fullArray = replaceMiddle(fullArray, mixedMiddleCharsArray);
          listWords[i] = fullArray.join('');
        }
      }
      text = listWords.join(' ');
      removeAllClasses("#result");
      
      showResult(text);
    });

  /**
   * Cutting html tags, and marking break line
   * @param  {[String]} text
   * @return {[String]}
   */
    function prepareText(text){
      text = text.replace(/<[^>]*>?/gm, '');//strip HTML tags
      text = text.replace(/\r|\n/gi, '~');//marking break line
      return text;
    }


  /**
   * Replacing chars between first and last letters
   * @param  {[Array]} fullArray   [origin array]
   * @param  {[Array]} middleArray [mixed middle section]
   * @return {[Array]}             [result]
   */
    function replaceMiddle(fullArray, middleArray) {
      for(var i=0; i < middleArray.length; i++){
        fullArray[i + 1] = middleArray[i];
      }
      return fullArray;
    }

    // No vowels
    // Words of two and shorter characters will not be processed.
    // US, UA, RU - included
    $("#no-vowels").click(function(){
      var text = prepareText($('#main-textarea').val());
      var listWords = text.split(' ');
      for (var i = 0; i < listWords.length; i++) {
        if (listWords[i].length > 2){
          var regex = /[euioaуеыаоэяиюёїє]/gi;
          listWords[i] = listWords[i].replace(regex, '_');
        }
      }
      text = listWords.join(' ');
      removeAllClasses("#result");
      regex = / /gi;
      text = text.replace(regex, ' &nbsp;&nbsp;');//addind a inteval between words
      showResult(text);
    });

    // Rotate to the left
    $("#left-rotate").click(function(){
      var text = prepareText($('#main-textarea').val());
      removeAllClasses("#result");
      addSpecialClass("#result", "rotate-left");
      showResult(text);
    });

    // Vertical mirror 
    $("#vertical-mirror").click(function(){
      var text = prepareText($('#main-textarea').val());
      addSpecialClass("#result", "vertical-mirror");
      showResult(text);
    });

    // Horizontal mirror 
    $("#horizontal-mirror").click(function(){
      var text = prepareText($('#main-textarea').val());
      addSpecialClass("#result", "horizontal-mirror");
      showResult(text);
    });

    //Horizontal + Vertical mirror
    $("#h-v-mirror").click(function(){
      var text = prepareText($('#main-textarea').val());
      addSpecialClass("#result", "h-v-mirror");
      showResult(text);
    });

    /**
     * Adding class to element
     * @param {[String]} selector
     * @param {[String]} className
     */
    function addSpecialClass(selector, className) {
      removeAllClasses(selector);
      $(selector).addClass(className);
    }

  /**
   * Showing text in destination element
   * @param  {[String]} text [some text]
   */
    function showResult(text){
      text = text.replace(/~/gi, '<br>');//change '~' marker to break line tag
      $("#result").html(text);
      scrollToAnchor('result-content');
    }

  /**
   * Clearing all classes of the element
   * @param  {[String]} selector [name id or class]
   */
    function removeAllClasses(selector) {
      $(selector).attr('class', '');
    }
  }
});
