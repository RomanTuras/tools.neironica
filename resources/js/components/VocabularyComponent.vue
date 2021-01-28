<template>
    <main role="main">
        <div class="container">
            <div class="container text-center my-section">
                <h1 v-if="isOneStudentPage">Добавить в словарь</h1>
                <h1 v-else>Студенты</h1>
            </div>

            <div v-if="!isOneStudentPage" class="row">
                <div class="col-md-8 offset-md-2 my-card">
                    <label class="my-title" for="selectStudent">Выберите имя студента:</label>
                    <select v-model="currentStudent" id="selectStudent" class="custom-select custom-select-lg mb-3">
                        <option v-for="student in data.students" v-bind:value="student" class="menu-item">{{ student.name }}, {{ student.email }}</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 my-card">
                    <label class="my-title" for="selectLanguage">Язык:</label>
                    <select v-model="selectedLang" id="selectLanguage" class="custom-select custom-select-lg mb-3">
                        <option v-for="lang in data.languages" v-bind:value="lang.id" class="menu-item">{{ lang.name }}</option>
                    </select>
                </div>
                <div class="col-md-5 offset-md-1 my-card">
                    <label class="my-title" for="selectVariety">Вариант:</label>
                    <select v-model="selectedVariety" id="selectVariety" class="custom-select custom-select-lg mb-3">
                        <option v-for="variety in data.varieties" v-bind:value="variety.id" class="menu-item">{{ variety.name }}</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 my-card">
                    <label class="my-title" for="selectTheme">Выберите тему:</label>
                    <button @click="editTheme" type="button" class="btn my-btn" style="float: right; margin-bottom: 15px"><i class="fa fa-edit" style="font-size: 18px;"></i></button>

                    <div v-if="isEditBlock">
                        <div class="input-group mb-3">
                            <input v-model.trim="inputEditTheme" id="inputThemeNameEdit" type="text" class="form-control my-text" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button v-on:click="updateTheme()" class="btn my-btn" type="button">Записать</button>
                            </div>
                        </div>
                        <div v-if="alertEditThemeName.length > 0" class="alert alert-danger" role="alert" style="display:block">
                            {{ alertEditThemeName }}
                        </div>
                    </div>


                    <select v-model="selectedTheme" id="selectTheme" class="custom-select" size="6">
                        <option class="my-text" @click="onThemeClick()" v-for="theme in themes" v-bind:value="theme">{{ theme.name }}</option>
                    </select>
                </div>
                <div class="col-md-5 offset-md-1 my-card">
                    <label class="my-title" for="inputThemeName">Добавить тему:</label>
                    <div class="input-group mb-3">
                        <input v-model.trim="inputNewTheme" id="inputThemeName" type="text" class="form-control my-text" placeholder="Название темы" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button v-on:click="insertTheme()" class="btn  my-btn" type="button">Записать</button>
                        </div>
                    </div>
                    <div v-if="alertAddNewTheme.length > 0" class="alert alert-danger" role="alert" style="display:block">
                        {{ alertAddNewTheme }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center my-section">
                    <h3 v-if="selectedTheme.name">Выбрана тема: {{ selectedTheme.name }}</h3>
                    <h3 v-else style="color:#cb4c07">Тема не выбрана - сделайте выбор</h3>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-5 my-card">
                    <label class="my-title" for="inputText">Введите русское значение</label>
                    <input v-model.trim="inputText" type="text" class="form-control my-text" id="inputText" placeholder="Русское значение" />
                </div>

                <div class="form-group col-md-5 offset-md-1 my-card">
                    <label class="my-title" for="inputTranslation">Введите перевод</label>
                    <input v-model.trim="inputTranslation" type="text" class="form-control my-text" id="inputTranslation" placeholder="Перевод">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-5 my-card">
                    <label class="my-title" for="inputCode">Введите кодировку</label>
                    <input v-model.trim="inputEncode" type="text" class="form-control my-text" id="inputCode" placeholder="Кодировка">
                </div>

                <div class="form-group col-md-5 offset-md-1">
                    <div v-if="alertAddText.length > 0" class="alert alert-danger" role="alert" style="display:block">
                        {{ alertAddText }}
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button :disabled="!selectedTheme.name" v-on:click="addTextTranslate" type="submit" class="btn my-btn" style="width: 90%; font-size: 18px">Сохранить в словарь</button>
                        </div>

                        <div class="col-md-12 text-center">
                            <button data-toggle="collapse" data-target="#copy-theme-block" aria-expanded="false" aria-controls="copy-theme-block"
                                    :disabled="!selectedTheme.name"
                                    v-if="!isOneStudentPage" v-on:click="" type="submit" class="btn my-btn"
                                    style="width: 90%; font-size: 18px; margin-top: 30px;">Копирование темы</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="copy-theme-block" class="row collapse">
                <div class="col-md-8 offset-md-2 my-card">
                    <label class="my-title" for="studentForCopy">Выберите, кому добавить тему:</label>
                    <select v-model="selectedStudentForCopy" id="studentForCopy" class="custom-select custom-select-lg mb-3">
                        <option :disabled="currentStudent.id === student.id"
                                v-for="student in data.students"
                                v-bind:value="student"
                                class="menu-item">{{ student.name }}, {{ student.email }}</option>
                    </select>
                </div>
                <div class="col-md-8 offset-md-2 my-card text-center" style="padding-top: 20px; padding-bottom: 30px;">
                    <h4 v-if="selectedStudentForCopy.name">Внимание, тема "{{ selectedTheme.name }}" будет добавлена студенту {{ selectedStudentForCopy.name }}</h4>
                    <h4 v-else>Студент не выбран</h4>
                    <button :disabled="!selectedStudentForCopy.name" v-on:click="copyTheme" type="submit" class="btn my-btn" style="width: 90%; font-size: 18px; margin-top: 30px;">ДОБАВИТЬ</button>
                </div>
            </div>



            <div class="row my-card">
                <div class="col-md-12 text-center">
                    <h3 v-if="isOneStudentPage">Мой словарь:</h3>
                    <h3 v-else>Словарь студента: {{ currentStudent.name }}</h3>
                </div>
                <div class="col-md-10 offset-md-1">
                    <button v-if="vocabularyList.length > 0" @click="editTranslation" type="button" class="btn my-btn" style="float: right; margin-bottom: 15px"><i class="fa fa-edit" style="font-size: 18px;"></i></button>
                </div>
                <div class="col-md-10 offset-md-1 text-center">
                    <div class="list-group">
                        <ul v-model="selectedVocabularyString" class="list-group" style="max-height: 300px; margin-bottom: 10px; overflow-y:scroll; -webkit-overflow-scrolling: touch;">
                            <li
                                    v-for="vc in vocabularyList"
                                    v-on:click="selectedVocabularyString = vc"
                                    class="list-group-item list-group-item-action my-text" :class=" vc.id === selectedVocabularyString.id ? 'active' : ''">
                                {{ vc.text_ru }} &nbsp; &#10132; &nbsp; {{ vc.translation }} &nbsp; &#10132; &nbsp; {{ vc.encoding }}
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="font-weight: bold;">
                            <i v-if="isModalErrorWindow" id="error-icon" class="fa fa-times-circle" aria-hidden="true"></i>
                            <i v-else id="success-icon" class="fa fa-check-circle" aria-hidden="true"></i>
                            {{ modalTitle }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ modalMsg }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
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
            themeId: 0,
            selectedVocabularyString: [],
            selectedTheme: [],
            currentStudent: [],
            selectedStudentForCopy: [],
            themes: [],
            vocabularyList: [],
            inputEditTheme: '',
            inputNewTheme: '',
            inputText: '',
            inputTranslation: '',
            inputEncode: '',
            alertEditThemeName: '',
            alertAddNewTheme: '',
            alertAddText: '',
            isEditBlock: false,
            isEditTranslateMode: false,
            isEditThemePressed: false,
            isCopyThemeBlockOpen: false,
            isOneStudentPage: true, //Trigger is component for One user or for Teacher with list users
            isModalErrorWindow: true,
            modalMsg: '',
            modalTitle: '',
        }),
        props: {
            data: {}
        },
        mounted() {
            // $('#resultModal').modal('show');
            // this.modalTitle = this.isModalErrorWindow ? 'Ошибка' : 'Успешно';
            this.getThemes();
            this.isOneStudentPage = this.data.students.length === 0;
        },
        watch: {
            currentStudent: function() {
                this.data.userId = this.currentStudent.id;
                this.getThemes();
            },
            selectedLang: function() {
                this.getVocabulary();
            },
            selectedVariety: function() {
                this.getVocabulary();
            },
        },
        methods: {
            addTextTranslate: function() {
                if ((this.inputText.length > 0 && this.inputText.length < 255)
                    && (this.inputTranslation.length > 0 && this.inputTranslation.length < 255)
                    && (this.inputEncode.length > 0 && this.inputEncode.length < 255)) {
                    this.alertAddText = '';
                    let user_id = this.data.userId;
                    let language_id = this.selectedLang;
                    let theme_id = this.selectedTheme.id;
                    let variety_id = this.selectedVariety;
                    let text_ru = this.inputText;
                    let transl = this.inputTranslation;
                    let encode = this.inputEncode;

                    if (this.isEditTranslateMode) { //Edit current translation
                        this.isEditTranslateMode = false;
                        let translation_id = this.selectedVocabularyString.id;
                        ApiServices.updateTranslation(translation_id, text_ru, transl, encode).then( response => {
                        }).catch( error => console.log(error) );

                    } else { //Add a new translation
                        ApiServices.insertTranslation(user_id, language_id, theme_id, variety_id, text_ru, transl, encode).then( response => {
                        }).catch( error => console.log(error) );
                    }
                    this.getVocabulary();
                    this.inputText = '';
                    this.inputTranslation = '';
                    this.inputEncode = '';
                } else this.alertAddText = 'Введите от 3 до 254 символов';
            },
            onThemeClick: function() {
                this.getVocabulary()
            },
            copyTheme: function() {
                let userToId = this.selectedStudentForCopy.id;
                let userFromId = this.data.userId;
                let themeName = this.selectedTheme.name;
                let themeId = this.selectedTheme.id;
                let languageId = this.selectedLang;
                let varietyId = this.selectedVariety;
                ApiServices.copyTheme(userToId, userFromId, themeName, themeId, languageId, varietyId).then( response => {
                    this.modalMsg = response.data.data.response;
                    this.isModalErrorWindow = response.data.data.error;
                    this.modalTitle = this.isModalErrorWindow ? 'Ошибка!' : 'Успешно!';
                    $('#resultModal').modal('show');
                });
            },
            editTranslation: function() {
                this.isEditTranslateMode = true;
                this.inputText = this.selectedVocabularyString.text_ru;
                this.inputTranslation = this.selectedVocabularyString.translation;
                this.inputEncode = this.selectedVocabularyString.encoding;
            },
            editTheme: function(){
                if (this.selectedTheme.name) { //Is theme selected
                    this.isEditBlock = !this.isEditBlock;
                    this.inputEditTheme = this.selectedTheme.name;
                    this.themeId = this.selectedTheme.id;
                    this.alertAddNewTheme = '';
                    this.inputNewTheme = '';
                }
            },
            updateTheme: function() {
                if (this.inputEditTheme.length > 2 && this.inputEditTheme.length < 255) {
                    // ApiServices.updateTheme(this.themeId, this.inputEditTheme).then( response => {
                    // const params = new URLSearchParams();
                    // params.append('theme_id', this.themeId);
                    // params.append('name', this.inputEditTheme);
                        ApiServices.updateTheme(this.themeId, this.inputEditTheme).then( response => {
                        this.getThemes();
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
                this.isEditBlock = false;
                this.alertEditThemeName = '';
                if (themeName.length > 2 && themeName.length < 255) {
                    ApiServices.isThemeNameExist(userId, themeName).then( response => {
                        if (!response.data.data) {
                            ApiServices.insertTheme(userId, this.selectedLang, themeName).then( response => {
                                this.getThemes();
                            }).catch( error => console.log(error) );
                            this.alertAddNewTheme = '';
                            this.inputNewTheme = '';
                        } else {
                            this.alertAddNewTheme = 'Такое название уже есть!';
                        }
                    }).catch( error => console.log(error) );
                } else {
                    this.alertAddNewTheme = 'Введите от 3 до 254 символов';
                }
            },
            getThemes() {
                ApiServices.getThemes(this.data.userId).then( response => {
                    this.themes = response.data
                }).catch( error => console.log(error) )
            },
            getVocabulary() {
                ApiServices.getUserVocabulary(this.data.userId, this.selectedLang, this.selectedTheme.id, this.selectedVariety)
                    .then(response => {
                        this.vocabularyList = response.data
                    }).catch( error => console.log(error))
            },
        },
        name: "VocabularyComponent"
    }
</script>

<style scoped>
    main {
        background-color: #e6f5f1;
        padding-bottom: 100px;
        margin-top: -23px;
        margin-bottom: -30px;
    }
    h1 {
        padding-top: 20px;
    }
    .my-card {
        margin-bottom: 50px;
        padding-top: 20px;
        padding-bottom: 20px;
        background-color: #fefefe;
        border-radius: 10px;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
    }
    .my-card .my-title {
        font-size: 22px;
    }
    .my-text {
        font-size: 1.25rem;
    }

    .list-group-item.active {
        background-color: #4eb799;
        border-color: #4eb799;
    }

    .my-btn {
        border: solid 1px #4eb799;
        background-color: #4eb799;
    }
    .my-btn:hover {
        color: #fefefe;
    }

    .my-section {
        margin-bottom: 50px;
    }
    select option:after {
        background: #2a9055;
    }
    #error-icon {
        font-size: 24px;
        color: red;
        margin-right: 30px;
    }
    #success-icon {
        font-size: 24px;
        color: green;
        margin-right: 30px;
    }

</style>