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
                        <option class="four" value="Airplanes-4,4">Самолеты</option>
                        <option class="four" value="Airplanes-4-2,4">Самолеты-2</option>
                        <option class="four" value="Airships-4,4">Дирижабли</option>
                        <option class="four" value="Air-transport-4,4">Воздушный</option>
                        <option class="four" value="Balls-4,4">Мячи</option>
                        <option class="four" value="Balls-4-2,4">Мячи-2</option>
                        <option class="four" value="Balls-4-3,4">Мячи-3</option>
                        <option class="four" value="Balls-4-4,4">Мячи-4</option>
                        <option class="four" value="Cars-4,4">Машины</option>
                        <option class="four" value="Cars-4-2,4">Машины-2</option>
                        <option class="four" value="Cars-4-3,4">Машины-3</option>
                        <option class="four" value="Flowers-4,4">Цветы</option>
                        <option class="four" value="Flowers-4-2,4">Цветы-2</option>
                        <option class="four" value="Flowers-4-3,4">Цветы-3</option>
                        <option class="four" value="Flowers-4-4,4">Цветы-4</option>
                        <option class="four" value="Helicopters-4,4">Вертолеты</option>
                        <option class="four" value="Helicopters-4-2,4">Вертолеты-2</option>
                        <option class="four" value="Motorcycles-4,4">Мотоциклы</option>
                        <option class="four" value="Ships-4,4">Корабли</option>
                        <option class="four" value="Ships-4-2,4">Корабли-2</option>
                        <option class="four" value="Tractors-4,4">Тракторы</option>
                        <option class="four" value="Berries-4,4">Ягоды</option>
                        <option class="four" value="Berries-4-2,4">Ягоды-2</option>
                        <option class="four" value="Berries-4-3,4">Ягоды-3</option>
                        <option class="four" value="Berries-4-4,4">Ягоды-4</option>
                        <option class="four" value="Berries-4-5,4">Ягоды-5</option>
                        <option class="four" value="Berries-4-6,4">Ягоды-6</option>
                        <option class="four" value="Fruits-4,4">Фрукты</option>
                        <option class="four" value="Fruits-4-2,4">Фрукты-2</option>
                        <option class="four" value="Fruits-4-3,4">Фрукты-3</option>
                        <option class="four" value="Fruits-4-4,4">Фрукты-4</option>
                        <option class="four" value="Fruits-4-5,4">Фрукты-5</option>
                        <option class="four" value="Fruits-4-6,4">Фрукты-6</option>
                        <option class="four" value="Fruits-4-7,4">Фрукты-7</option>
                        <option class="four" value="Fruits-4-8,4">Фрукты-8</option>
                        <option class="four" value="Fruits-4-9,4">Фрукты-9</option>
                        <option class="four" value="Fruits-4-10,4">Фрукты-10</option>
                        <option class="four" value="Fruits-4-11,4">Фрукты-11</option>
                        <option class="four" value="Fruits-4-12,4">Фрукты-12</option>
                        <option class="four" value="Numbers-4,4">Числа</option>
                        <option class="four" value="Numbers-4-2,4">Числа-2</option>
                        <option class="four" value="Numbers-4-3,4">Числа-3</option>
                        <option class="four" value="Numbers-4-4,4">Числа-4</option>
                        <option class="four" value="Numbers-4-5,4">Числа-5</option>
                        <option class="four" value="Vegetables-4,4">Овощи</option>
                        <option class="four" value="Vegetables-4-2,4">Овощи-2</option>
                        <option class="six" value="Geometric-6,6">Фигуры</option>
                        <option class="six" value="Berries-6,6">Ягоды</option>
                        <option class="six" value="Berries-6-1,6">Ягоды-1</option>
                        <option class="six" value="Berries-6-2,6">Ягоды-2</option>
                        <option class="six" value="Berries-6-3,6">Ягоды-3</option>
                        <option class="six" value="Berries-6-4,6">Ягоды-4</option>
                        <option class="six" value="Fruits-6,6">Фрукты</option>
                        <option class="six" value="Fruits-6-2,6">Фрукты-2</option>
                        <option class="six" value="Fruits-6-3,6">Фрукты-3</option>
                        <option class="six" value="Fruits-6-4,6">Фрукты-4</option>
                        <option class="six" value="Vegetables-6,6">Овощи</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="dropdown">
            <div class="input-group h-34">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputOpenedCells">Quantity:</label>
                </div>
                <select class="color-select" id="inputOpenedCells">
                    <option value="2">2</option>
                </select>
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
