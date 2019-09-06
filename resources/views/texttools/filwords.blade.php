@extends('layouts.app')

@section('content')

<section id="filwords">
  <div class="container">
    <h3 class="tools-title border-c">Филворды</h3>
  </div>
  <div class="jumbotron jumbotron-fluid">
    <div class="row">
        <div class="col-md-1">
            <button type="button" id="generate-filwords" class="btn btn-outline-primary">Generate</button>
        </div>
        <div class="col-md-1">
            <button type="button" id="answers-filwords" class="btn btn-outline-secondary">Answers</button>
        </div>

        <div class="col-md-4">

            <div class="dropdown">
                <div class="input-group h-34">
                    <div class="input-group-prepend">
                         <label class="input-group-text" for="inputSizeTable">Size:</label>
                    </div>
                    <select class="font-select" id="inputSizeTable">
                        <option value="5">5 x 5</option>
                        <option value="6">6 x 6</option>
                        <option value="7">7 x 7</option>
                        <option value="8">8 x 8</option>
                        <option value="9">9 x 9</option>
                        <option value="10">10 x 10</option>
                        <option value="11">11 x 11</option>
                        <option value="12">12 x 12</option>
                        <option value="13">13 x 13</option>
                        <option value="14">14 x 14</option>
                        <option value="15">15 x 15</option>
                        <option value="16">16 x 16</option>
                    </select>
                </div>
            </div>

            <div class="dropdown">
                <div class="input-group h-34">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputWords">Theme:</label>
                    </div>
                    <select class="font-select" id="inputWords">
                        <option value="мама,мыла,мылом,морду">Простой</option>
                        <option value="берег,море,пальма,кокос">Отдых</option>
                        <option value="вирус,доброй,улитки,боба">Шутке</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="col-md-3">
            <div class="dropdown">
                <div class="input-group h-34">
                    <div class="input-group-prepend">
                        {{-- <label class="input-group-text" for="inputFontName">Font</label> --}}
                    </div>
                    <select class="font-select" id="inputFontNameFilwords">
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
                    <select class="font-select" id="inputFontSizeFilwords">
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

            <div class="dropdown float-right">
                <label class="form-check-label border-c">
                    <input id="checkboxBoldFilwords" type="checkbox" class="form-check-input" value="">Bold
                </label>
            </div>

        </div>

        <div class="col-md-2">
            <div class="dropdown paddingRange border-c float-r">
                {{-- <label for="paddingRange">Padding</label> --}}
                <input id="paddingRangeFilwords" class="border-c" type="range" min="40" max="150" step="10" value="50">
            </div>
        </div>


    </div>
  </div>

  <div id="result-content">
    <div class="row">
      <div id="res" class="col-md-12">
    </div>
  </div>


  </div>

</section>

@endsection
