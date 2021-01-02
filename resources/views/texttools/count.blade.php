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
                        <option class="three" value="Airplanes-4">Самолеты</option>
                        <option class="three" value="Airplanes-4-2">Самолеты-2</option>
                        <option class="three" value="Airships-4">Дирижабли</option>
                        <option class="three" value="Air-transport-4">Воздушный</option>
                        <option class="three" value="Balls-4">Мячи</option>
                        <option class="three" value="Balls-4-2">Мячи-2</option>
                        <option class="three" value="Balls-4-3">Мячи-3</option>
                        <option class="three" value="Balls-4-4">Мячи-4</option>
                        <option class="three" value="Cars-4">Машины</option>
                        <option class="three" value="Cars-4-2">Машины-2</option>
                        <option class="three" value="Cars-4-3">Машины-3</option>
                        <option class="three" value="Flowers-4">Цветы</option>
                        <option class="three" value="Flowers-4-2">Цветы-2</option>
                        <option class="three" value="Flowers-4-3">Цветы-3</option>
                        <option class="three" value="Flowers-4-4">Цветы-4</option>
                        <option class="three" value="Helicopters-4">Вертолеты</option>
                        <option class="three" value="Helicopters-4-2">Вертолеты-2</option>
                        <option class="three" value="Motorcycles-4">Мотоциклы</option>
                        <option class="three" value="Ships-4">Корабли</option>
                        <option class="three" value="Ships-4-2">Корабли-2</option>
                        <option class="three" value="Tractors-4">Тракторы</option>
                        <option class="three" value="Berries-4">Ягоды</option>
                        <option class="three" value="Berries-4-2">Ягоды-2</option>
                        <option class="three" value="Berries-4-3">Ягоды-3</option>
                        <option class="three" value="Berries-4-4">Ягоды-4</option>
                        <option class="three" value="Berries-4-5">Ягоды-5</option>
                        <option class="three" value="Berries-4-6">Ягоды-6</option>
                        <option class="three" value="Fruits-4">Фрукты</option>
                        <option class="three" value="Fruits-4-2">Фрукты-2</option>
                        <option class="three" value="Fruits-4-3">Фрукты-3</option>
                        <option class="three" value="Fruits-4-4">Фрукты-4</option>
                        <option class="three" value="Fruits-4-5">Фрукты-5</option>
                        <option class="three" value="Fruits-4-6">Фрукты-6</option>
                        <option class="three" value="Fruits-4-7">Фрукты-7</option>
                        <option class="three" value="Fruits-4-8">Фрукты-8</option>
                        <option class="three" value="Fruits-4-9">Фрукты-9</option>
                        <option class="three" value="Fruits-4-10">Фрукты-10</option>
                        <option class="three" value="Fruits-4-11">Фрукты-11</option>
                        <option class="three" value="Fruits-4-12">Фрукты-12</option>
                        <option class="three" value="Numbers-4">Числа</option>
                        <option class="three" value="Numbers-4-2">Числа-2</option>
                        <option class="three" value="Numbers-4-3">Числа-3</option>
                        <option class="three" value="Numbers-4-4">Числа-4</option>
                        <option class="three" value="Numbers-4-5">Числа-5</option>
                        <option class="three" value="Vegetables-4">Овощи</option>
                        <option class="three" value="Vegetables-4-2">Овощи-2</option>
                        <option class="four" value="Airplanes-4">Самолеты</option>
                        <option class="four" value="Airplanes-4-2">Самолеты-2</option>
                        <option class="four" value="Airships-4">Дирижабли</option>
                        <option class="four" value="Air-transport-4">Воздушный</option>
                        <option class="four" value="Balls-4">Мячи</option>
                        <option class="four" value="Balls-4-2">Мячи-2</option>
                        <option class="four" value="Balls-4-3">Мячи-3</option>
                        <option class="four" value="Balls-4-4">Мячи-4</option>
                        <option class="four" value="Cars-4">Машины</option>
                        <option class="four" value="Cars-4-2">Машины-2</option>
                        <option class="four" value="Cars-4-3">Машины-3</option>
                        <option class="four" value="Flowers-4">Цветы</option>
                        <option class="four" value="Flowers-4-2">Цветы-2</option>
                        <option class="four" value="Flowers-4-3">Цветы-3</option>
                        <option class="four" value="Flowers-4-4">Цветы-4</option>
                        <option class="four" value="Helicopters-4">Вертолеты</option>
                        <option class="four" value="Helicopters-4-2">Вертолеты-2</option>
                        <option class="four" value="Motorcycles-4">Мотоциклы</option>
                        <option class="four" value="Ships-4">Корабли</option>
                        <option class="four" value="Ships-4-2">Корабли-2</option>
                        <option class="four" value="Tractors-4">Тракторы</option>
                        <option class="four" value="Berries-4">Ягоды</option>
                        <option class="four" value="Berries-4-2">Ягоды-2</option>
                        <option class="four" value="Berries-4-3">Ягоды-3</option>
                        <option class="four" value="Berries-4-4">Ягоды-4</option>
                        <option class="four" value="Berries-4-5">Ягоды-5</option>
                        <option class="four" value="Berries-4-6">Ягоды-6</option>
                        <option class="four" value="Fruits-4">Фрукты</option>
                        <option class="four" value="Fruits-4-2">Фрукты-2</option>
                        <option class="four" value="Fruits-4-3">Фрукты-3</option>
                        <option class="four" value="Fruits-4-4">Фрукты-4</option>
                        <option class="four" value="Fruits-4-5">Фрукты-5</option>
                        <option class="four" value="Fruits-4-6">Фрукты-6</option>
                        <option class="four" value="Fruits-4-7">Фрукты-7</option>
                        <option class="four" value="Fruits-4-8">Фрукты-8</option>
                        <option class="four" value="Fruits-4-9">Фрукты-9</option>
                        <option class="four" value="Fruits-4-10">Фрукты-10</option>
                        <option class="four" value="Fruits-4-11">Фрукты-11</option>
                        <option class="four" value="Fruits-4-12">Фрукты-12</option>
                        <option class="four" value="Numbers-4">Числа</option>
                        <option class="four" value="Numbers-4-2">Числа-2</option>
                        <option class="four" value="Numbers-4-3">Числа-3</option>
                        <option class="four" value="Numbers-4-4">Числа-4</option>
                        <option class="four" value="Numbers-4-5">Числа-5</option>
                        <option class="four" value="Vegetables-4">Овощи</option>
                        <option class="four" value="Vegetables-4-2">Овощи-2</option>
                        <option class="six" value="Geometric-6">Фигуры</option>
                        <option class="six" value="Berries-6">Ягоды</option>
                        <option class="six" value="Berries-6-1">Ягоды-1</option>
                        <option class="six" value="Berries-6-2">Ягоды-2</option>
                        <option class="six" value="Berries-6-3">Ягоды-3</option>
                        <option class="six" value="Berries-6-4">Ягоды-4</option>
                        <option class="six" value="Fruits-6">Фрукты</option>
                        <option class="six" value="Fruits-6-2">Фрукты-2</option>
                        <option class="six" value="Fruits-6-3">Фрукты-3</option>
                        <option class="six" value="Fruits-6-4">Фрукты-4</option>
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
