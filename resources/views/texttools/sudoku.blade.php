@extends('layouts.app')

@section('content')

<section id="sudoku">
  <div class="container">
    <h3 class="tools-title border-c">Генератор Sudoku</h3>
  </div>
  <div class="jumbotron jumbotron-fluid">
    <div class="row">
        <div class="col-md-1">
            <button type="button" id="generate-sudoku" class="btn btn-outline-primary">Generate</button>
        </div>
        <div class="col-md-1">
            <button type="button" id="answers-sudoku" class="btn btn-outline-secondary">Answers</button>
        </div>

        <div class="col-md-4">

            <div class="dropdown">
                <div class="input-group h-34">
                    <div class="input-group-prepend">
                         <label class="input-group-text" for="inputSizeTable">Size:</label>
                    </div>
                    <select class="font-select" id="inputSizeTable">
                        <option value="2,2">4 x 4</option>
                        <option value="3,2">6 x 6</option>
                        <option value="3,3">9 x 9</option>
                    </select>
                </div>
            </div>

            <div class="dropdown">
                <div class="input-group h-34">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputImageSet">Images:</label>
                    </div>
                    <select class="font-select" id="inputImageSet">
                        <option value="none">none</option>
                        <option value="Airplanes-4">Самолеты</option>
                        <option value="Airplanes-4-2">Самолеты-2</option>
                        <option value="Airships-4">Дирижабли</option>
                        <option value="Air-transport-4">Воздушный</option>
                        <option value="Balls-4">Мячи</option>
                        <option value="Balls-4-2">Мячи-2</option>
                        <option value="Balls-4-3">Мячи-3</option>
                        <option value="Balls-4-4">Мячи-4</option>
                        <option value="Cars-4">Машины</option>
                        <option value="Cars-4-2">Машины-2</option>
                        <option value="Flowers-4">Цветы</option>
                        <option value="Flowers-4-2">Цветы-2</option>
                        <option value="Flowers-4-3">Цветы-3</option>
                        <option value="Flowers-4-4">Цветы-4</option>
                        <option value="Geometric-6" style="color: blue;">Фигуры</option>
                        <option value="Helicopters-4">Вертолеты</option>
                        <option value="Helicopters-4-2">Вертолеты-2</option>
                        <option value="Motorcycles-4">Мотоциклы</option>
                        <option value="Ships-4">Корабли</option>
                        <option value="Ships-4-2">Корабли-2</option>
                        <option value="Tractors-4">Тракторы</option>
                        <option value="Berries-4">Ягоды</option>
                        <option value="Berries-4-2">Ягоды-2</option>
                        <option value="Fruits-4">Фрукты</option>
                        <option value="Fruits-4-2">Фрукты-2</option>
                        <option value="Numbers-4">Числа</option>
                        <option value="Numbers-4-2">Числа-2</option>
                        <option value="Numbers-4-3">Числа-3</option>
                        <option value="Numbers-4-4">Числа-4</option>
                        <option value="Numbers-4-5">Числа-5</option>
                        <option value="Vegetables-4">Овощи</option>
                        <option value="Vegetables-4-2">Овощи-2</option>
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
                    <select class="font-select" id="inputFontNameSudoku">
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
                    <select class="font-select" id="inputFontSizeSudoku">
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
                    <input id="checkboxBoldSudoku" type="checkbox" class="form-check-input" value="">Bold
                </label>
            </div>

        </div>

        <div class="col-md-2">
            <div class="dropdown paddingRange border-c float-r">
                {{-- <label for="paddingRange">Padding</label> --}}
                <input id="paddingRangeSudoku" class="border-c" type="range" min="40" max="150" step="10" value="50">
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
