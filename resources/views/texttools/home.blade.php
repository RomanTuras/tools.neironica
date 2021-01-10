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

              <div class="col-md-4">
                  <div class="card border-primary mb-3" >
                      <div class="card-header">Sudoku генератор</div>
                      <div class="card-body text-primary">
                          <p class="card-text">Генератор Sudoku различной сложности, цифры, картинки, различный шрифт.</p>
                          <a href="{{ URL::route('texttools.sudoku') }}" class="btn btn-primary">Перейти</a>
                      </div>
                  </div>
              </div>

          </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="card border-primary mb-3" >
                        <div class="card-header">Филворды</div>
                        <div class="card-body text-primary">
                            <p class="card-text">Генератор Филвордов различной сложности, стиль, различный шрифт.</p>
                            <a href="{{ URL::route('texttools.filwords') }}" class="btn btn-primary">Перейти</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-primary mb-3" >
                        <div class="card-header">Генератор чисел</div>
                        <div class="card-body text-primary">
                            <p class="card-text">Генератор чисел различной разрядности, стиль, различный шрифт.</p>
                            <a href="{{ URL::route('texttools.numbers') }}" class="btn btn-primary">Перейти</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-primary mb-3" >
                        <div class="card-header">Подсчет</div>
                        <div class="card-body text-primary">
                            <p class="card-text">Генератор таблиц с картинками для их подсчета.</p>
                            <a href="{{ URL::route('texttools.count') }}" class="btn btn-primary">Перейти</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="card border-primary mb-3" >
                        <div class="card-header">Запомнить конфигурацию</div>
                        <div class="card-body text-primary">
                            <p class="card-text">Генератор конфигураций различной сложности, стиль, различный шрифт.</p>
                            <a href="{{ URL::route('texttools.configuration') }}" class="btn btn-primary">Перейти</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-primary mb-3" >
                        <div class="card-header">Расставить числа</div>
                        <div class="card-body text-primary">
                            <p class="card-text">Генератор последовательностей чисел различной сложности, стиль, различный шрифт.</p>
                            <a href="{{ URL::route('texttools.arrange') }}" class="btn btn-primary">Перейти</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-primary mb-3" >
                        <div class="card-header">Кодировка - Алфавит</div>
                        <div class="card-body text-primary">
                            <p class="card-text">Кодировка слов различной длины, стиль, различный шрифт.</p>
                            <a href="{{ URL::route('texttools.encoding-alphabet') }}" class="btn btn-primary">Перейти</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="card border-primary mb-3" >
                        <div class="card-header">Кодировка - числа</div>
                        <div class="card-body text-primary">
                            <p class="card-text">Кодировка слов в числа по согласным, стиль, различный шрифт.</p>
                            <a href="{{ URL::route('texttools.encoding-numbers') }}" class="btn btn-primary">Перейти</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
