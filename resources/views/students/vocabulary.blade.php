@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Добавить в словарь</h1>
</div>

<main role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <label for="selectLanguage">Язык:</label>
                <select id="selectLanguage" class="custom-select custom-select-lg mb-3">
                    @foreach($data['languages'] as $language)
                        <option class="menu-item" value="{{ $language->id }}">{{ $language->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="selectLanguage">Вариант:</label>
                <select id="selectLanguage" class="custom-select custom-select-lg mb-3">
                    @foreach($data['varieties'] as $variety)
                        <option class="menu-item" value="{{ $variety->id }}">{{ $variety->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="selectTheme">Выберите тему:</label>
                <select id="selectTheme" class="custom-select" size="6">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="inputTheme">Добавить тему:</label>
                <div class="input-group mb-3">
                    <input id="inputTheme" type="text" class="form-control" placeholder="Recipient's username" aria-label="Новая тема" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">Добавить</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Выбрана тема: Животные</h3>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="inputText">Введите русское значение</label>
                <input type="text" class="form-control" id="inputText" placeholder="Русское значение">
            </div>

            <div class="form-group col-md-6">
                <label for="inputTranslation">Введите перевод</label>
                <input type="text" class="form-control" id="inputTranslation" placeholder="Перевод">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="inputCode">Введите кодировку</label>
                <input type="text" class="form-control" id="inputCode" placeholder="Кодировка">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Мой словарь:</h3>
                <p>/двойной клик - редактировать запись/</p>
            </div>
            <div class="col-md-10 offset-md-1 text-center">
                <div class="panel-body">
                    <ul class="list-group" style="max-height: 300px; margin-bottom: 10px; overflow-y:scroll; -webkit-overflow-scrolling: touch;">
                        <li class="list-group-item">Lorem ipsum doror sit - Lorem ipsum doror sit - Lorem ipsum doror sit
                        </li>
                        <li class="list-group-item"><strong>Signature
                                Accommodations</strong>(1480m)
                        </li>
                        <li class="list-group-item"><strong>Signature
                                Accommodations</strong>(1480m)
                        </li>
                        <li class="list-group-item"><strong>Signature
                                Accommodations</strong>(1480m)
                        </li>
                        <li class="list-group-item"><strong>Signature
                                Accommodations</strong>(1480m)
                        </li>
                        <li class="list-group-item"><strong>Signature
                                Accommodations</strong>(1480m)
                        </li>
                        <li class="list-group-item"><strong>Signature
                                Accommodations</strong>(1480m)
                        </li>
                        <li class="list-group-item"><strong>Signature
                                Accommodations</strong>(1480m)
                        </li>
                        <li class="list-group-item"><strong>Signature
                                Accommodations</strong>(1480m)
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </div>
</main>

@endsection
