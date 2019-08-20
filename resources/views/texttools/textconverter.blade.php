@extends('layouts.app')

@section('content')

<section id="text-converter">
  <div class="container">
    <h3 class="tools-title border-c">Текстовый преобразователь</h3>
  </div>
  <div class="jumbotron jumbotron-fluid nav-right">
    <div class="row">
      <div class="col-md-12">
        <div class="dropdown">
          <label class="form-check-label border-c">
            <input id="checkboxBold" type="checkbox" class="form-check-input" value="">Bold
          </label>
          <label class="form-check-label margin-l-30 border-c">
            <input id="checkboxItalic" type="checkbox" class="form-check-input" value="">Italic
          </label>
        </div>

        <div class="dropdown">
          <div class="input-group margin-l-30">
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
          <div class="input-group margin-l-30">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputFontColor">Color</label>
            </div>
            <select class="color-select" id="inputFontColor">
              <option value="black" style="color: black">black</option>
              <option value="white" style="color: black">white</option>
              <option value="red" style="color: red">red</option>
              <option value="crimson" style="color: crimson">crimson</option>
              <option value="brown" style="color: brown">brown</option>
              <option value="green" style="color: green">green</option>
              <option value="blue" style="color: blue">blue</option>
              <option value="blueviolet" style="color: blueviolet">blueviolet</option>
              <option value="magenta" style="color: magenta">magenta</option>
              <option value="deeppink" style="color: deeppink">deeppink</option>
              <option value="darkred" style="color: darkred">darkred</option>
              <option value="indigo" style="color: indigo">indigo</option>
              <option value="indianred" style="color: indianred">indianred</option>
              <option value="coral" style="color: coral">coral</option>
              <option value="tomato" style="color: tomato">tomato</option>
              <option value="orangered" style="color: orangered">orangered</option>
              <option value="orange" style="color: orange">orange</option>
              <option value="darkorange" style="color: darkorange">darkorange</option>
              <option value="lime" style="color: lime">lime</option>
              <option value="limegreen" style="color: limegreen">limegreen</option>
              <option value="forestgreen" style="color: forestgreen">forestgreen</option>
              <option value="darkgreen" style="color: darkgreen">darkgreen</option>
              <option value="steelblue" style="color: steelblue">steelblue</option>
              <option value="royalblue" style="color: royalblue">royalblue</option>
              <option value="mediumblue" style="color: mediumblue">mediumblue</option>
              <option value="darkblue" style="color: darkblue">darkblue</option>
              <option value="navy" style="color: navy">navy</option>
              <option value="violet" style="color: violet">violet</option>
              <option value="orchid" style="color: orchid">orchid</option>
              <option value="fuchsia" style="color: fuchsia">fuchsia</option>
              <option value="mediumorchid" style="color: mediumorchid">mediumorchid</option>
              <option value="mediumpurple" style="color: mediumpurple">mediumpurple</option>
              <option value="darkviolet" style="color: darkviolet">darkviolet</option>
              <option value="darkorchid" style="color: darkorchid">darkorchid</option>
              <option value="darkmagenta" style="color: darkmagenta">darkmagenta</option>
              <option value="hotpink" style="color: hotpink">hotpink</option>
              <option value="palevioletred" style="color: palevioletred">palevioletred</option>
              <option value="mediumvioletred" style="color: mediumvioletred">mediumvioletred</option>
              <option value="rosybrown" style="color: rosybrown">rosybrown</option>
              <option value="sandybrown" style="color: sandybrown">sandybrown</option>
              <option value="goldenrod" style="color: goldenrod">goldenrod</option>
              <option value="peru" style="color: peru">peru</option>
              <option value="chocolate" style="color: chocolate">chocolate</option>
              <option value="saddlebrown" style="color: saddlebrown">saddlebrown</option>
              <option value="sienna" style="color: sienna">sienna</option>
              <option value="brown" style="color: brown">brown</option>
              <option value="maroon" style="color: maroon">maroon</option>
            </select>
          </div>
        </div>
        
        <div class="dropdown">
          <div class="input-group margin-l-30">
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
              <option value="28">28</option>
              <option value="36">36</option>
              <option value="42">42</option>
              <option value="48">48</option>
              <option value="50">50</option>
              <option value="56">56</option>
              <option value="60">60</option>
              <option value="72">72</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="input-group">
        <div class="input-group-prepend">
        </div>
        <textarea id="main-textarea" class="form-control" aria-label="main-textarea"></textarea>
      </div>
    </div>
    <div id="control-panel" class="container">
      <button type="button" id="vertical-mirror" class="btn btn-outline-primary">Верх ногами</button>
      <button type="button" id="horizontal-mirror" class="btn btn-outline-secondary">Зеркально</button>
      <button type="button" id="h-v-mirror" class="btn btn-outline-primary">Верх ногами + Зеркально</button>
      <button type="button" id="no-vowels" class="btn btn-outline-secondary">Без гласных</button>
      <button type="button" id="mix-chars" class="btn btn-outline-primary">Перепутать</button>
      <button type="button" id="left-rotate" class="btn btn-outline-secondary">Повернуть</button>
    </div>
  </div>

  <div id="result-content" class="container">
    <div class="row">
      <div class="col-md-8 offset-2">
        <p id="result"></p>
      </div>
    </div>
  </div>

</section>

@endsection