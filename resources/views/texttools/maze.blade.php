@extends('layouts.app')

@section('content')

<section id="maze">
  <div class="container">
    <h3 class="tools-title border-c">Генератор лабиринтов</h3>
  </div>
  <div class="jumbotron jumbotron-fluid">
    <div class="row">
      <div class="col-md-1">
        <button type="button" id="generate-maze" class="btn btn-outline-primary">Generate</button>
      </div>
      <div class="col-md-2 padding-0">
        <div class="dropdown border-c float-r">
          <label for="rangeWallMaze">Wall</label>
          <input id="rangeWallMaze" class="border-c rangeMaze" type="range" min=3 max=30 step=1 value=3>
        </div>
      </div>
      <div class="col-md-2 padding-0">
        <div class="dropdown border-c float-r">
          <label for="rangeTunnelMaze">Tunnel</label>
          <input id="rangeTunnelMaze" class="border-c rangeMaze" type="range" min="10" max="110" step="2" value="10">
        </div>
      </div>

      <div class="col-md-2">

        <div class="dropdown">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">x:y</span>
            </div>
              <input id="inputRowsMaze" type="number" class="form-control" value=10>
              <input id="inputColsMaze" type="number" class="form-control" value=10>
          </div>
        </div>

      </div>

      <div class="col-md-4">

        <div class="dropdown">
          <div class="input-group h-34">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputWallColor">Wall</label>
            </div>
            <select class="color-select" id="inputWallColor">
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
          <div class="input-group h-34">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputBgColor">Bg</label>
            </div>
            <select class="color-select" id="inputBgColor">
              <option value="white" style="color: black">white</option>
              <option value="snow" style="background: snow">snow</option>
              <option value="honeydew" style="background: honeydew">honeydew</option>
              <option value="mintcream" style="background: mintcream">mintcream</option>
              <option value="azure" style="background: azure">azure</option>
              <option value="aliceblue" style="background: aliceblue">aliceblue</option>
              <option value="ghostwhite" style="background: ghostwhite">ghostwhite</option>
              <option value="whitesmoke" style="background: whitesmoke">whitesmoke</option>
              <option value="seashell" style="background: seashell">seashell</option>
              <option value="beige" style="background: beige">beige</option>
              <option value="oldlace" style="background: oldlace">oldlace</option>
              <option value="floralwhite" style="background: floralwhite">floralwhite</option>
              <option value="ivory" style="background: ivory">ivory</option>
              <option value="antiquewhite" style="background: antiquewhite">antiquewhite</option>
              <option value="linen" style="background: linen">linen</option>
              <option value="lavenderblush" style="background: lavenderblush">lavenderblush</option>
              <option value="mistyrose" style="background: mistyrose">mistyrose</option>
            </select>
          </div>
        </div>

      </div>

      <div class="col-md-1">
        <div class="dropdown">
          <div class="input-group h-34">
            <div class="input-group-prepend">
              {{-- <label class="input-group-text" for="inputPoint">Point</label> --}}
            </div>
            <select class="color-select" id="inputPoint">
              <option value="center">Center</option>
              <option value="left-top">Left-top</option>
              <option value="left-bottom">Left-bottom</option>
              <option value="right">Right</option>
            </select>
          </div>
        </div>
      </div>

    </div>
  </div>
  
  <div id="result-content" class="container margin-0">
    <div class="row">
      <div class="col-md-12 offset-0 center-h">
        <p id="res"></p>
          {{-- <div class="stat">steps: <span id="step">0</span> complete: <span id="complete">0</span></div> --}}
          <canvas id="maze-canvas"></canvas>
        </div>
      </div>
    </div>
  </div>

</section>

@endsection