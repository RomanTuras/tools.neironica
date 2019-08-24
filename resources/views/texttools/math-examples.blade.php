@extends('layouts.app')

@section('content')

<section id="math-examples">
  <div class="container">
    <h3 class="tools-title border-c">Примеры по математике</h3>
  </div>
  <div class="jumbotron jumbotron-fluid">
    <div class="row">
      <div class="col-md-1">
        <button type="button" id="generate-math-examples" class="btn btn-outline-primary">Generate</button>
      </div>
      <div class="col-md-1 padding-0">
          <div class="dropdown">
              <div class="input-group h-34">
                  <div class="input-group-prepend">
                      <label class="input-group-text" for="inputOperation">Type</label>
                  </div>
                  <select class="color-select" id="inputOperation">
                      <option value="plus">&plus;</option>
                      <option value="minus">&minus;</option>
                      <option value="multiply">&times;</option>
                      <option value="divide">&divide;</option>
                  </select>
              </div>
          </div>
      </div>
        <div class="col-md-4">

            <div class="dropdown">
                <div class="input-group h-34">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputFirstNumberType">Style:</label>
                    </div>
                    <select class="color-select" id="inputFirstNumberType">
                        <option value=1,9>1..9</option>
                        <option value=1,20>1..20</option>
                        <option value=1,40>1..40</option>
                        <option value=1,50>1..50</option>
                        <option value=1,70>1..70</option>
                        <option value=1,99>1..99</option>
                        <option value=100,999>3x значн</option>
                        <option value=1000,9999>4x значн</option>
                        <option value=10000,99999>5x значн</option>
                        <option value=100000,999999>6x значн</option>
                        <option value=1000000,9999999>7x значн</option>
                        <option value=10000000,99999999>8x значн</option>
                        <option value=100000000,999999999>9x значн</option>
                    </select>
                    <select class="color-select" id="inputSecondNumberType">
                        <option value=1,9>1..9</option>
                        <option value=1,20>1..20</option>
                        <option value=1,40>1..40</option>
                        <option value=1,50>1..50</option>
                        <option value=1,70>1..70</option>
                        <option value=1,99>1..99</option>
                        <option value=100,999>3x значн</option>
                        <option value=1000,9999>4x значн</option>
                        <option value=10000,99999>5x значн</option>
                        <option value=100000,999999>6x значн</option>
                        <option value=1000000,9999999>7x значн</option>
                        <option value=10000000,99999999>8x значн</option>
                        <option value=100000000,999999999>9x значн</option>
                    </select>
                </div>
            </div>

          <div class="dropdown">
              <div class="input-group h-34">
                  <div class="input-group-prepend">
                      <label class="input-group-text" for="inputColumnsNumber">X,Y:</label>
                  </div>
                  <select class="color-select" id="inputColumnsNumber">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                  </select>
                  <select class="color-select" id="inputExamplesNumber">
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                  </select>
              </div>
          </div>

            <div class="dropdown float-r">
                <label class="form-check-label border-c">
                    <input id="checkboxNegativeResult" type="checkbox" class="form-check-input" value="">&minus;
                </label>
            </div>

      </div>

        <div class="col-md-4 padding-0">
            <div class="dropdown">
                <div class="input-group h-34">
                    <div class="input-group-prepend">
                        {{-- <label class="input-group-text" for="inputFontName">Font</label> --}}
                    </div>
                    <select class="font-select" id="inputFontNameMath">
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
                    <select class="font-select" id="inputFontSizeMath">
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
                    <select class="color-select" id="inputTextColor">
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
                    <input id="checkboxBoldMath" type="checkbox" class="form-check-input" value="">Bold
                </label>
            </div>

        </div>

        <div class="col-md-2">
            <div class="dropdown paddingRange border-c float-r">
                {{-- <label for="paddingRange">Padding</label> --}}
                <input id="paddingRangeMath" class="border-c" type="range" min="1" max="6" step="0.5" value="3">
            </div>
        </div>

    </div>
  </div>

  <div id="result-content">
    <div class="row">
      <div id="res" class="col-md-12"></div>
      </div>
    </div>
  </div>

</section>

@endsection
