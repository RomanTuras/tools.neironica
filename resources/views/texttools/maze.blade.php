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
              <option value="#0000ff" style="color: #0000ff">#0000ff</option>
              <option value="#000839" style="color: #000839">#000839</option>
              <option value="#002bdc" style="color: #002bdc">#002bdc</option>
              <option value="#0033c7" style="color: #0033c7">#0033c7</option>
              <option value="#008891" style="color: #008891">#008891</option>
              <option value="#00a8cc" style="color: #00a8cc">#00a8cc</option>
              <option value="#00bcd4" style="color: #00bcd4">#00bcd4</option>
              <option value="#01c5c4" style="color: #01c5c4">#01c5c4</option>
              <option value="#05dfd7" style="color: #05dfd7">#05dfd7</option>
              <option value="#0779e4" style="color: #0779e4">#0779e4</option>
              <option value="#08ffc8" style="color: #08ffc8">#08ffc8</option>
              <option value="#090057" style="color: #090057">#090057</option>
              <option value="#09015f" style="color: #09015f">#09015f</option>
              <option value="#0a043c" style="color: #0a043c">#0a043c</option>
              <option value="#0e49b5" style="color: #0e49b5">#0e49b5</option>
              <option value="#120136" style="color: #120136">#120136</option>
              <option value="#150485" style="color: #150485">#150485</option>
              <option value="#1dd3bd" style="color: #1dd3bd">#1dd3bd</option>
              <option value="#21209c" style="color: #21209c">#21209c</option>
              <option value="#28df99" style="color: #28df99">#28df99</option>
              <option value="#2c003e" style="color: #2c003e">#2c003e</option>
              <option value="#2c061f" style="color: #2c061f">#2c061f</option>
              <option value="#323edd" style="color: #323edd">#323edd</option>
              <option value="#32e0c4" style="color: #32e0c4">#32e0c4</option>
              <option value="#32ff6a" style="color: #32ff6a">#32ff6a</option>
              <option value="#342ead" style="color: #342ead">#342ead</option>
              <option value="#381460" style="color: #381460">#381460</option>
              <option value="#400082" style="color: #400082">#400082</option>
              <option value="#411f1f" style="color: #411f1f">#411f1f</option>
              <option value="#42dee1" style="color: #42dee1">#42dee1</option>
              <option value="#42e6a4" style="color: #42e6a4">#42e6a4</option>
              <option value="#43d8c9" style="color: #43d8c9">#43d8c9</option>
              <option value="#45046a" style="color: #45046a">#45046a</option>
              <option value="#481380" style="color: #481380">#481380</option>
              <option value="#4d089a" style="color: #4d089a">#4d089a</option>
              <option value="#511845" style="color: #511845">#511845</option>
              <option value="#51eaea" style="color: #51eaea">#51eaea</option>
              <option value="#52057b" style="color: #52057b">#52057b</option>
              <option value="#532e1c" style="color: #532e1c">#532e1c</option>
              <option value="#54e346" style="color: #54e346">#54e346</option>
              <option value="#581c0c" style="color: #581c0c">#581c0c</option>
              <option value="#5edfff" style="color: #5edfff">#5edfff</option>
              <option value="#65d6ce" style="color: #65d6ce">#65d6ce</option>
              <option value="#6807f9" style="color: #6807f9">#6807f9</option>
              <option value="#682c0e" style="color: #682c0e">#682c0e</option>
              <option value="#6900ff" style="color: #6900ff">#6900ff</option>
              <option value="#6930c3" style="color: #6930c3">#6930c3</option>
              <option value="#6a097d" style="color: #6a097d">#6a097d</option>
              <option value="#6a197d" style="color: #6a197d">#6a197d</option>
              <option value="#6f0000" style="color: #6f0000">#6f0000</option>
              <option value="#79d70f" style="color: #79d70f">#79d70f</option>
              <option value="#7d0000" style="color: #7d0000">#7d0000</option>
              <option value="#810000" style="color: #810000">#810000</option>
              <option value="#81f5ff" style="color: #81f5ff">#81f5ff</option>
              <option value="#851de0" style="color: #851de0">#851de0</option>
              <option value="#85ef47" style="color: #85ef47">#85ef47</option>
              <option value="#892cdc" style="color: #892cdc">#892cdc</option>
              <option value="#900c3f" style="color: #900c3f">#900c3f</option>
              <option value="#900d0d" style="color: #900d0d">#900d0d</option>
              <option value="#94fc13" style="color: #94fc13">#94fc13</option>
              <option value="#95389e" style="color: #95389e">#95389e</option>
              <option value="#970690" style="color: #970690">#970690</option>
              <option value="#9818d6" style="color: #9818d6">#9818d6</option>
              <option value="#9b45e4" style="color: #9b45e4">#9b45e4</option>
              <option value="#9d0191" style="color: #9d0191">#9d0191</option>
              <option value="#9d65c9" style="color: #9d65c9">#9d65c9</option>
              <option value="#a20a0a" style="color: #a20a0a">#a20a0a</option>
              <option value="#ac4b1c" style="color: #ac4b1c">#ac4b1c</option>
              <option value="#af0069" style="color: #af0069">#af0069</option>
              <option value="#b088f9" style="color: #b088f9">#b088f9</option>
              <option value="#b206b0" style="color: #b206b0">#b206b0</option>
              <option value="#b643cd" style="color: #b643cd">#b643cd</option>
              <option value="#be9fe1" style="color: #be9fe1">#be9fe1</option>
              <option value="#c400c6" style="color: #c400c6">#c400c6</option>
              <option value="#c40b13" style="color: #c40b13">#c40b13</option>
              <option value="#c70039" style="color: #c70039">#c70039</option>
              <option value="#cc0066" style="color: #cc0066">#cc0066</option>
              <option value="#cc0e74" style="color: #cc0e74">#cc0e74</option>
              <option value="#cd4dcc" style="color: #cd4dcc">#cd4dcc</option>
              <option value="#ce0f3d" style="color: #ce0f3d">#ce0f3d</option>
              <option value="#cf1b1b" style="color: #cf1b1b">#cf1b1b</option>
              <option value="#d2e603" style="color: #d2e603">#d2e603</option>
              <option value="#d789d7" style="color: #d789d7">#d789d7</option>
              <option value="#da9ff9" style="color: #da9ff9">#da9ff9</option>
              <option value="#dc2ade" style="color: #dc2ade">#dc2ade</option>
              <option value="#dd0a35" style="color: #dd0a35">#dd0a35</option>
              <option value="#ddf516" style="color: #ddf516">#ddf516</option>
              <option value="#df42d1" style="color: #df42d1">#df42d1</option>
              <option value="#e11d74" style="color: #e11d74">#e11d74</option>
              <option value="#ec0101" style="color: #ec0101">#ec0101</option>
              <option value="#ed0cef" style="color: #ed0cef">#ed0cef</option>
              <option value="#ed1250" style="color: #ed1250">#ed1250</option>
              <option value="#f0134d" style="color: #f0134d">#f0134d</option>
              <option value="#f09ae9" style="color: #f09ae9">#f09ae9</option>
              <option value="#f0a500" style="color: #f0a500">#f0a500</option>
              <option value="#f30e5c" style="color: #f30e5c">#f30e5c</option>
              <option value="#f40552" style="color: #f40552">#f40552</option>
              <option value="#f45905" style="color: #f45905">#f45905</option>
              <option value="#f54291" style="color: #f54291">#f54291</option>
              <option value="#f638dc" style="color: #f638dc">#f638dc</option>
              <option value="#f88f01" style="color: #f88f01">#f88f01</option>
              <option value="#fa0559" style="color: #fa0559">#fa0559</option>
              <option value="#fa1616" style="color: #fa1616">#fa1616</option>
              <option value="#fa163f" style="color: #fa163f">#fa163f</option>
              <option value="#fa26a0" style="color: #fa26a0">#fa26a0</option>
              <option value="#fb0091" style="color: #fb0091">#fb0091</option>
              <option value="#fd0054" style="color: #fd0054">#fd0054</option>
              <option value="#fd2eb3" style="color: #fd2eb3">#fd2eb3</option>
              <option value="#fd3a69" style="color: #fd3a69">#fd3a69</option>
              <option value="#fd5f00" style="color: #fd5f00">#fd5f00</option>
              <option value="#fe346e" style="color: #fe346e">#fe346e</option>
              <option value="#fe91ca" style="color: #fe91ca">#fe91ca</option>
              <option value="#ff0000" style="color: #ff0000">#ff0000</option>
              <option value="#ff008b" style="color: #ff008b">#ff008b</option>
              <option value="#ff00c8" style="color: #ff00c8">#ff00c8</option>
              <option value="#ff0b55" style="color: #ff0b55">#ff0b55</option>
              <option value="#ff427f" style="color: #ff427f">#ff427f</option>
              <option value="#ff577f" style="color: #ff577f">#ff577f</option>
              <option value="#ff7315" style="color: #ff7315">#ff7315</option>
              <option value="#ffcc00" style="color: #ffcc00">#ffcc00</option>
              <option value="#ffd31d" style="color: #ffd31d">#ffd31d</option>
              <option value="#ffd700" style="color: #ffd700">#ffd700</option>
              <option value="#ffe227" style="color: #ffe227">#ffe227</option>
            </select>
          </div>
        </div>

        <div class="dropdown">
          <div class="input-group h-34">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputBgColor">Bg</label>
            </div>
            <select class="color-select" id="inputBgColor">
              <option value="#ffffff" style="color: #000000">White</option>
              <option value="#ededd0" style="color: #ededd0">#ededd0</option>
              <option value="#faf3f3" style="color: #faf3f3">#faf3f3</option>
              <option value="#fffbdf" style="color: #fffbdf">#fffbdf</option>
              <option value="#ffe9d6" style="color: #ffe9d6">#ffe9d6</option>
              <option value="#ffe9d6" style="color: #ffe9d6">#ffe9d6</option>
              <option value="#eeeeee" style="color: #eeeeee">#eeeeee</option>
              <option value="#fefecc" style="color: #fefecc">#fefecc</option>
              <option value="#fcecdd" style="color: #fcecdd">#fcecdd</option>
              <option value="#f4eee8" style="color: #f4eee8">#f4eee8</option>
              <option value="#f8f5f1" style="color: #f8f5f1">#f8f5f1</option>
              <option value="#d5ecc2" style="color: #d5ecc2">#d5ecc2</option>
              <option value="#eeebdd" style="color: #eeebdd">#eeebdd</option>
              <option value="#f8ede3" style="color: #f8ede3">#f8ede3</option>
              <option value="#f7f3e9" style="color: #f7f3e9">#f7f3e9</option>
              <option value="#feffde" style="color: #feffde">#feffde</option>
              <option value="#ddffbc" style="color: #ddffbc">#ddffbc</option>
              <option value="#ffefcf" style="color: #ffefcf">#ffefcf</option>
              <option value="#f3f4ed" style="color: #f3f4ed">#f3f4ed</option>
              <option value="#dbf6e9" style="color: #dbf6e9">#dbf6e9</option>
              <option value="#f8f4e1" style="color: #f8f4e1">#f8f4e1</option>
              <option value="#edffec" style="color: #edffec">#edffec</option>
              <option value="#f2edd7" style="color: #f2edd7">#f2edd7</option>
              <option value="#FBE6C2" style="color: #FBE6C2">#FBE6C2</option>
              <option value="#f0e4d7" style="color: #f0e4d7">#f0e4d7</option>
              <option value="#fefecc" style="color: #fefecc">#fefecc</option>
              <option value="#f3f4ed" style="color: #f3f4ed">#f3f4ed</option>
              <option value="#f8f5f1" style="color: #f8f5f1">#f8f5f1</option>
              <option value="#f8f4e1" style="color: #f8f4e1">#f8f4e1</option>
              <option value="#e4fbff" style="color: #e4fbff">#e4fbff</option>
              <option value="#eaffd0" style="color: #eaffd0">#eaffd0</option>
              <option value="#f4f9f9" style="color: #f4f9f9">#f4f9f9</option>
              <option value="#f7f6e7" style="color: #f7f6e7">#f7f6e7</option>
              <option value="#f6f6f6" style="color: #f6f6f6">#f6f6f6</option>
              <option value="#f8f1f1" style="color: #f8f1f1">#f8f1f1</option>
              <option value="#fff3e6" style="color: #fff3e6">#fff3e6</option>
              <option value="#f5f4f4" style="color: #f5f4f4">#f5f4f4</option>
              <option value="#f8f1f1" style="color: #f8f1f1">#f8f1f1</option>
              <option value="#eff8ff" style="color: #eff8ff">#eff8ff</option>
              <option value="#ffe6e6" style="color: #ffe6e6">#ffe6e6</option>
              <option value="#ffe0d8" style="color: #ffe0d8">#ffe0d8</option>
              <option value="#e6e6e6" style="color: #e6e6e6">#e6e6e6</option>
              <option value="#f3f2da" style="color: #f3f2da">#f3f2da</option>
              <option value="#fcf8ec" style="color: #fcf8ec">#fcf8ec</option>
              <option value="#f4eeed" style="color: #f4eeed">#f4eeed</option>
              <option value="#fffaa4" style="color: #fffaa4">#fffaa4</option>
              <option value="#c6fced" style="color: #c6fced">#c6fced</option>
              <option value="#f8f7de" style="color: #f8f7de">#f8f7de</option>
              <option value="#f8f1f1" style="color: #f8f1f1">#f8f1f1</option>
              <option value="#fff8c1" style="color: #fff8c1">#fff8c1</option>
              <option value="#fbf6f0" style="color: #fbf6f0">#fbf6f0</option>
              <option value="#f9f7cf" style="color: #f9f7cf">#f9f7cf</option>
              <option value="#f3eac2" style="color: #f3eac2">#f3eac2</option>
              <option value="#fceef5" style="color: #fceef5">#fceef5</option>
              <option value="#fcf1f1" style="color: #fcf1f1">#fcf1f1</option>
              <option value="#f1f6f9" style="color: #f1f6f9">#f1f6f9</option>
              <option value="#f1d4d4" style="color: #f1d4d4">#f1d4d4</option>
              <option value="#fff8cd" style="color: #fff8cd">#fff8cd</option>
              <option value="#f6f5f5" style="color: #f6f5f5">#f6f5f5</option>
              <option value="#e8ffff" style="color: #e8ffff">#e8ffff</option>
              <option value="#fff0f0" style="color: #fff0f0">#fff0f0</option>
              <option value="#d9ecf2" style="color: #d9ecf2">#d9ecf2</option>             
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