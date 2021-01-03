@extends('layouts.app')

@section('content')

<section id="shulte-gorbova-table">
  <div class="container">
    <h3 class="tools-title border-c">Таблица Горбова-Шульте</h3>
  </div>
  <div class="jumbotron jumbotron-fluid">
    <div class="row">
      <div class="col-md-1">
        <button type="button" id="generate-shulte-gorbova" class="btn btn-outline-primary">Generate</button>
      </div>
{{--      <div class="col-md-2">--}}
{{--        <div class="dropdown paddingRange border-c float-r">--}}
{{--          --}}{{-- <label for="paddingRange">Padding</label> --}}
{{--          <input id="paddingRange" class="border-c" type="range" min="5" max="55" step="1" value="17">--}}
{{--        </div>--}}
{{--      </div>--}}
      <div class="col-md-2">
        <div class="dropdown paddingRangeX border-c float-r">
          <label for="paddingRangeX">X:</label>
          <input id="paddingRangeX" class="border-c" type="range" min="5" max="55" step="1" value="18">
        </div>

        <div class="dropdown paddingRangeY border-c float-r">
          <label for="paddingRangeY">Y:</label>
          <input id="paddingRangeY" class="border-c" type="range" min="5" max="55" step="1" value="18">
        </div>
      </div>
      <div class="col-md-2 padding-0">
        <div class="dropdown">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputRows">Table</label>
            </div>
            <select class="rows-select" id="inputRows">
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
            </select>
          </div>
        </div>

        <div class="dropdown">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputCols">:</label>
            </div>
            <select class="rows-select" id="inputCols">
              <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
            </select>
          </div>
        </div>
        <label id="labelIsGorbova" class="form-check-label">
          <input id="checkboxIsGorbova" type="checkbox" class="form-check-input" value="" checked>1/2
        </label>
      </div>

      <div class="col-md-4">
        <div class="dropdown">
          <div class="input-group h-34">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputColorFontSchema">Font color</label>
            </div>
            <select class="font-color-schema-select" id="inputColorFontSchema">
              <option value="black,black">Black</option>
              <option value="white,white">White</option>
              <option value="red,black">Red-Black</option>
              <option value="blue,black">Blue-Black</option>
            </select>
          </div>
        </div>
        <div class="dropdown">
          <div class="input-group h-34">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputBgColor">Bg color</label>
            </div>
            <select class="color-select" id="inputBgColor">
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
      </div>

      <div class="col-md-2 padding-0">
        <div class="dropdown">
          <div class="input-group h-34">
            <div class="input-group-prepend">
              {{-- <label class="input-group-text" for="inputFontName">Font</label> --}}
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
          <div class="input-group h-34">
            <div class="input-group-prepend">
              {{-- <label class="input-group-text" for="inputFontSize">Size</label> --}}
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

      <div class="col-md-1">
        <div class="dropdown">
          <label class="form-check-label border-c">
            <input id="checkboxBold" type="checkbox" class="form-check-input" value="">Bold
          </label>
        </div>
      </div>

      {{-- </div> --}}
    </div>
  </div>
  
  <div id="result-content" class="container">
    <div class="row">
      <div class="col-md-12">
        <div id="result"></div>
      </div>
    </div>
  </div>

</section>

@endsection