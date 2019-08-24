@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">

              <div class="col-md-4">
                <div class="card border-primary mb-3" >
                  <div class="card-header">Преобразователь текста</div>
                  <div class="card-body text-primary">
                      <p class="card-text">Отражение по горизонтали и вертикали, без гласных, буквы вперемешку, настройка шрифтов, цвета и размера.</p>
                      <a href="{{ URL::route('texttools.text-converter') }}" class="btn btn-primary">Перейти</a>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card border-primary mb-3">
                  <div class="card-header">Таблицы Шульте</div>
                  <div class="card-body text-primary">
                      <p class="card-text">Генерация случайных последовательностей, настройка шрифтов, цвета фона и размера.</p>
                      <a href="{{ URL::route('texttools.shulte') }}" class="btn btn-primary">Перейти</a>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card border-primary mb-3" >
                  <div class="card-header">Таблицы Шульте Горбова</div>
                  <div class="card-body text-primary">
                      <p class="card-text">Двухцветное исполнение, настройка шрифтов, цвета фона и размера.</p>
                      <a href="{{ URL::route('texttools.shulte-gorbova') }}" class="btn btn-primary">Перейти</a>
                  </div>
                </div>
              </div>

          </div>

          <div class="row">

            <div class="col-md-4">
              <div class="card border-primary mb-3" >
                <div class="card-header">Генератор лабиринтов</div>
                <div class="card-body text-primary">
                    <p class="card-text">Квадратная и прямоугольная форма, цвет стен, установка начальной точки.</p>
                    <a href="{{ URL::route('texttools.maze') }}" class="btn btn-primary">Перейти</a>
                </div>
              </div>
            </div>

              <div class="col-md-4">
                  <div class="card border-primary mb-3" >
                      <div class="card-header">Примеры по математике</div>
                      <div class="card-body text-primary">
                          <p class="card-text">Сложение и вычитание, умножение и деление, сложность, цвет, столбцы.</p>
                          <a href="{{ URL::route('texttools.math-examples') }}" class="btn btn-primary">Перейти</a>
                      </div>
                  </div>
              </div>

          </div>

        </div>
    </div>
</div>
@endsection
