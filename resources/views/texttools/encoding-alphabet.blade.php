@extends('layouts.app')

@section('content')

<section id="encoding-alphabet">
  <div class="container">
    <h3 class="tools-title border-c">Кодировка - Алфавит</h3>
  </div>
  <div class="jumbotron jumbotron-fluid">

    <div class="row">

      <div class="col-md-2">
        <div class="dropdown">
          <div class="input-group h-34">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputEncode">Encode:</label>
            </div>
            <select class="font-select" id="inputEncode">
              <option value="alphabet">Код-1</option>
              <option value="Airplanes-4-2">Код-2</option>
            </select>
          </div>
        </div>
      </div>

      <div id="from-database-controls" class="col-md-3">
        <div class="dropdown">
          <div class="input-group h-34">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputWordsQuantity">Words:</label>
            </div>
            <select class="color-select" id="inputWordsQuantity">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputLettersQuantityMin">Letters:</label>
            </div>
            <select class="color-select" id="inputLettersQuantityMin">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
            <select class="color-select" id="inputLettersQuantityMax">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="dropdown">
          <div class="input-group h-34">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputColumnsNumber">Col:</label>
            </div>
            <select class="color-select" id="inputColumnsNumber">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="dropdown">
          <label class="form-check-label border-c">
            <input id="checkboxBold" type="checkbox" class="form-check-input" value="">Bold
          </label>
        </div>

        <div class="dropdown">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputFontName">Font</label>
            </div>
            <select class="font-select" id="inputFontName">
              <option value="Arial">Arial</option>
              <option value="Times new Roman">Times new Roman</option>
              <option value="Roboto">Roboto</option>
              <option value="Courier New">Courier New</option>
              <option value="Impact">Impact</option> 
              <option value="Comic Sans MS">Comic Sans MS</option>
            </select>
          </div>
        </div>

        <div class="dropdown">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputFontSize">Size</label>
            </div>
            <select class="font-select" id="inputFontSize">
              <option value="10">10</option>
              <option value="12">12</option>
              <option value="14">14</option>
              <option value="18">18</option>
              <option value="22">22</option>
              <option value="26">26</option>
              <option value="30">30</option>
              <option value="34">34</option>
              <option value="38">38</option>
              <option value="42">42</option>
              <option value="46">46</option>
              <option value="50">50</option>
              <option value="54">54</option>
              <option value="58">58</option>
              <option value="62">62</option>
              <option value="66">66</option>
              <option value="70">70</option>
              <option value="74">74</option>
              <option value="78">78</option>
              <option value="82">82</option>
              <option value="86">86</option>
              <option value="90">90</option>
              <option value="94">94</option>
              <option value="98">98</option>
              <option value="102">102</option>
              <option value="106">106</option>
              <option value="110">110</option>
              <option value="114">114</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="container">
          <div class="input-group">
            <div class="input-group-prepend">
            </div>
            <textarea id="main-textarea" class="form-control" aria-label="main-textarea" placeholder="Вводите слова через пробел, без запятых и без нажатия Enter..."></textarea>
          </div>
        </div>
        <div id="control-panel" class="container">
          <div class="dropdown float-left">
            <label class="form-check-label border-c">
              <input id="checkboxManual" type="checkbox" class="form-check-input" value="">Ручной ввод
            </label>
          </div>
          <button type="button" id="encoding-btn" class="btn btn-outline-primary" style="margin-right: 20px;">Закодировать</button>
          <button type="button" id="answer-btn" class="btn btn-outline-success">Ответ</button>

          <div class="border-c float-right">
            <div class="input-group-prepend">
              <label class="input-group-text" for="paddingRange">Padding:</label>
            </div>
            <input id="paddingRange" class="border-c" type="range" min="1" max="6" step="0.5" value="3">
          </div>
          <div class="border-c float-right">
            <div class="input-group-prepend">
              <label class="input-group-text" for="imageSizeRange">Image Size:</label>
            </div>
            <input id="imageSizeRange" class="border-c" type="range" min="10" max="100" step="10" value="50">
          </div>

        </div>
      </div>
    </div>

  </div>

{{--  Words from database--}}
  <select class="font-select" id="data" style="display: none">
    <option id="data" value="{{ $words }}"></option>
  </select>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h5 class="tools-title border-c">Кодировка:</h5>
        <div id="selected-encode-set"></div>
      </div>
    </div>
  </div>

  <div id="result-content" class="container">
    <div class="row">
      <div class="col-md-12">
      <h5 class="tools-title border-c">Задание:</h5>
        <div id="result"></div>
      </div>
    </div>
  </div>

  <div id="answers-content" class="container">
    <div class="row">
      <div class="col-md-12">
      <h5 class="tools-title border-c">Ответ:</h5>
        <div id="answers"></div>
      </div>
    </div>
  </div>

</section>

@endsection