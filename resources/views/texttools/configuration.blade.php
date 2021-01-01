@extends('layouts.app')

@section('content')

<section id="configuration">
  <div class="container">
    <h3 class="tools-title border-c">Запомнить конфигурацию</h3>
  </div>
  <div class="jumbotron jumbotron-fluid">
    <div class="row">
        <div class="col-md-1">
            <button type="button" id="generate" class="btn btn-outline-primary">Generate</button>
        </div>

        <div class="col-md-4">

            <div class="dropdown">
                <div class="input-group h-34">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputX">X,Y:</label>
                    </div>
                    <select class="color-select" id="inputX">
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
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                    </select>
                    <select class="color-select" id="inputY">
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
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>

                    </select>
                </div>
            </div>

            <div class="dropdown">
                <div class="input-group h-34">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputImageSet">Images:</label>
                    </div>
                    <select class="font-select" id="inputImageSet">
                        <option class="six" value="Vegetables">Овощи</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="col-md-3">
            <div class="dropdown paddingRange border-c float-r">
                <label for="densityRange" style="display: inline;">Density:</label>
                <input id="densityRange" class="border-c" type="range" min="1" max="9" step="1" value="5">
                <p title="Чем больше этот показатель, тем меньше вероятность плотности заполнения и наоборот"
                   style="display: inline; cursor: pointer; border: 1px solid #999; border-radius: 10px; padding: 1px 7px;">?</p>
            </div>

        </div>



        <div class="col-md-3">
            <div class="dropdown paddingRange border-c float-r">

                <label for="paddingRange" style="display: inline;">Padding:</label>
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


</section>

@endsection
