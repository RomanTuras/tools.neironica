<template>
    <main role="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <label for="selectLanguage">Язык:</label>
                    <select v-model="selectedLang" id="selectLanguage" class="custom-select custom-select-lg mb-3">
                        <option v-for="lang in data.languages" v-bind:value="lang.id" class="menu-item">{{ lang.name }}</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="selectVariety">Вариант:</label>
                    <select v-model="selectedVariety" id="selectVariety" class="custom-select custom-select-lg mb-3">
                        <option v-for="variety in data.varieties" v-bind:value="variety.id" class="menu-item">{{ variety.name }}</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="selectTheme">Выберите тему:</label>
                    <button @click="editTheme" type="button" class="btn btn-info" style="float: right; margin-bottom: 15px"><i class="fa fa-edit" style="font-size: 18px;">изменить</i></button>

                    <div v-if="isEditBlock">
                        <div class="input-group mb-3">
                            <input v-model="inputEditTheme" id="inputThemeNameEdit" type="text" class="form-control" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button v-on:click="updateTheme()" class="btn btn-outline-secondary" type="button">Записать</button>
                            </div>
                        </div>
                        <div v-if="alertEditThemeName.length > 0" class="alert alert-danger" role="alert" style="display:block">
                            {{ alertEditThemeName }}
                        </div>
                    </div>


                    <select v-model="selectedTheme" id="selectTheme" class="custom-select" size="6">
                        <option v-for="theme in themes" v-bind:value="theme">{{ theme.name }}</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputThemeName">Добавить тему:</label>
                    <div class="input-group mb-3">
                        <input v-model="inputNewTheme" id="inputThemeName" type="text" class="form-control" placeholder="Название темы" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button v-on:click="insertTheme()" class="btn btn-outline-secondary" type="button">Записать</button>
                        </div>
                    </div>
                    <div v-if="alertAddNewTheme.length > 0" class="alert alert-danger" role="alert" style="display:block">
                        {{ alertAddNewTheme }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 v-if="selectedTheme.name">Выбрана тема: {{ selectedTheme.name }}</h3>
                    <h3 v-else style="color:coral">Тема не выбрана - сделайте выбор</h3>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="inputText">Введите русское значение</label>
                    <input type="text" class="form-control" id="inputText" placeholder="Русское значение" />
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
                            <li class="list-group-item"><strong>Signature
                                Accommodations</strong>(1480m)
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </main>
</template>

<script>
    import ApiServices from "../services/ApiServices";
    export default {
        data: () => ({
            selectedLang: '1',
            selectedVariety: '1',
            inputEditTheme: '',
            inputNewTheme: '',
            alertEditThemeName: '',
            alertAddNewTheme: '',
            selectedTheme: [],
            themes: [],
            themeId: -1, //A new theme
            isEditBlock: false,
            vocabularyList: [],

        }),
        props: {
            data: {}
        },
        mounted() {
            this.getThemes()
        },
        methods: {
            editTheme: function(){
                if (this.selectedTheme.name) { //Is theme selected
                    this.inputEditTheme = this.selectedTheme.name;
                    this.themeId = this.selectedTheme.id;
                    this.isEditBlock = true;
                }
            },
            updateTheme: function() {
                if (this.inputEditTheme.length > 2 && this.inputEditTheme.length < 255) {
                    ApiServices.updateTheme(this.themeId, this.inputEditTheme).then( response => {
                        this.getThemes();
                        console.log(response.data)
                    }).catch( error => console.log(error) );
                    this.isEditBlock = false;
                    this.alertEditThemeName = '';
                } else {
                    this.alertEditThemeName = 'Введите от 3 до 254 символов';
                }

            },
            insertTheme: function () {
                let userId = this.data.userId;
                let themeName = this.inputNewTheme;
                ApiServices.isThemeNameExist(userId, themeName).then( response => {
                    if (!response.data.data) {
                        if (themeName.length > 2 && themeName.length < 255) {
                            ApiServices.insertTheme(userId, this.selectedLang, themeName).then( response => {
                                this.getThemes();
                            }).catch( error => console.log(error) );
                            this.alertAddNewTheme = '';
                            this.inputNewTheme = '';
                        } else {
                            this.alertAddNewTheme = 'Введите от 3 до 254 символов';
                        }
                    } else {
                        this.alertAddNewTheme = 'Такое название уже есть!';
                    }
                }).catch( error => console.log(error) );
            },
            getThemes() {
                ApiServices.getThemes(this.data.userId).then( response => {
                    this.themes = response.data
                }).catch( error => console.log(error) )
            }
        },
        name: "VocabularyComponent"
    }
</script>

<style scoped>

</style>