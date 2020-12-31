@extends('layouts.app')

@section('content')

<section id="count">
  <div class="container">
    <h3 class="tools-title border-c">Подсчет</h3>
  </div>
  <div class="jumbotron jumbotron-fluid">
    <div class="row">
        <div class="col-md-1">
            <button type="button" id="generate-count" class="btn btn-outline-primary">Generate</button>
        </div>
        <div class="col-md-1">
            <button type="button" id="answers-count" class="btn btn-outline-secondary">Answers</button>
        </div>

        <div class="col-md-4">

            <div class="dropdown">
                <div class="input-group h-34">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputX">X,Y:</label>
                    </div>
                    <select class="color-select" id="inputX">
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
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                    </select>
                    <select class="color-select" id="inputY">
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
                <div class="input-group h-34">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputImageSet">Images:</label>
                    </div>
                    <select class="font-select" id="inputImageSet">
                        <option class="six" value="Vegetables-6">Овощи</option>
                    </select>
                </div>
            </div>

            <div class="dropdown">
                <div class="input-group h-34">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputNumberImages">N:</label>
                    </div>
                    <select class="color-select" id="inputNumberImages">
                        <option value="2">2</option>
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

            <div class="dropdown float-right">
                <label class="form-check-label border-c">
                    <input id="checkboxBold" type="checkbox" class="form-check-input" value="">Bold
                </label>
            </div>

        </div>

        <div class="col-md-2">
            <div class="dropdown paddingRange border-c float-r">
                {{-- <label for="paddingRange">Padding</label> --}}
                <input id="paddingRange" class="border-c" type="range" min="40" max="150" step="10" value="50">
            </div>
        </div>


    </div>
  </div>

  <div id="result-content">
    <div class="row">
      <div id="res" class="col-md-12"></div>
    </div>
  </div>


    <div id="answers-content" class="row">
        <div class="col-md-12">
            <br><br>
            <h3 class="tools-title border-c">Ответы:</h3>
            <br>
        </div>
        <div id="answers" class="col-md-12"></div>
    </div>




</section>

@endsection
