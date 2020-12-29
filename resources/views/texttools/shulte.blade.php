@extends('layouts.app')

@section('content')

<section id="shulte-table">
  <div class="container">
    <h3 class="tools-title border-c">Таблица Шульте</h3>
  </div>
  <div class="jumbotron jumbotron-fluid">
    <div class="row">
      <div class="col-md-1">
        <button type="button" id="generate-shulte" class="btn btn-outline-primary">Generate</button>
      </div>
      <div class="col-md-2">
        <div class="dropdown paddingRange border-c float-r">
          {{-- <label for="paddingRange">Padding</label> --}}
          <input id="paddingRangeShulte" class="border-c" type="range" min="5" max="55" step="1" value="18">
        </div>
      </div>
      <div class="col-md-2">
        <div class="dropdown">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputRowsShulte">Table</label>
            </div>
            <select class="rows-select" id="inputRowsShulte">
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
              <label class="input-group-text" for="inputColsShulte">:</label>
            </div>
            <select class="rows-select" id="inputColsShulte">
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
      </div>

      <div class="col-md-3">
        <div class="dropdown">
          <div class="input-group">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputBgImage">Bg:</label>
            </div>
            <select class="image-select" id="inputBgImage">
              <option value="">No image</option>
              <option value="../img/@2x/blue_bubbels.jpg">Blue bubbles</option>
            </select>
          </div>
        </div>

        <div class="dropdown">
          <div class="dropdown">
            <div class="input-group h-34">
              <select class="font-select" id="inputColorSchema">
                <option value="no">No theme</option>
                <option value="#ff8f00,#a345f9,#37ce2b,#54ecfd,#fbfb0b,transparent">alpha</option>
                <option value="#fbfb0b,#04c715,#47dbf5,#0a7def,#f52b90,transparent">beta</option>
                <option value="#ffff82,#5aff95,#54ecfd,#0ea4f7,#dc4aff,transparent">gamma</option>
                <option value="#fd3a5f,#fbfb0b,#0a7def,#54ecfd,#3eff83,transparent">delta</option>
                <option value="#00ffef,#fe6cff,#be03ea,#ffff82,#04ef6f,transparent">epsilon</option>
                <option value="#d026f9,#fbfb0b,#0a7def,#54ecfd,#3eff83,transparent">zeta</option>
                <option value="#fbfb0b,#f92c53,#3f88f9,#49fd61,#06d20d,transparent">eta</option>
                <option value="#48e4ff,#fbfb0b,#f92c53,#3f88f9,#06d20d,transparent">theta</option>
                <option value="#c10bec,#fbfb0b,#f92c53,#3f88f9,#06d20d,transparent">iota</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 padding-0">
        <div class="dropdown">
          <div class="input-group h-34">
            <div class="input-group-prepend">
              {{-- <label class="input-group-text" for="inputFontName">Font</label> --}}
            </div>
            <select class="font-select" id="inputFontNameShulte">
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
            <select class="font-select" id="inputFontSizeShulte">
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
 
        <div class="dropdown">
          <div class="input-group h-34">
            <div class="input-group-prepend">
              {{-- <label class="input-group-text" for="inputFontColor">Color</label> --}}
            </div>
            <select class="color-select" id="inputFontColorShulte">
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

        <div class="dropdown float-r">
          <label class="form-check-label border-c">
            <input id="checkboxBoldShulte" type="checkbox" class="form-check-input" value="">Bold
          </label>
        </div>

      </div>

      {{-- </div> --}}
    </div>
  </div>
  
  <div id="result-content" class="container">
    <div class="row">
      <div class="col-md-8 offset-2">
        <div id="result"></div>
      </div>
    </div>
  </div>

</section>

@endsection