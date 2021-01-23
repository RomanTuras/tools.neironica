<template>
    <main role="main">
        <div class="container">
            <div class="container text-center my-section">
                <h1>Упражнения</h1>
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
                    <select v-model="selectedTheme" id="selectTheme" class="custom-select" size="6">
                        <option class="my-text" v-for="theme in themes" v-bind:value="theme">{{ theme.name }}</option>
                    </select>
                </div>
                <div class="col-md-5 offset-md-1 my-card">
                    <label class="my-title" for="selectVariety">Направление:</label>
                    <select v-model="selectedDirection" id="selectDirection" class="custom-select custom-select-lg mb-3">
                        <option class="menu-item" value="1">Русский</option>
                        <option class="menu-item" value="2">Иностранный</option>
                        <option class="menu-item" value="3">Кодировка</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center my-section">
                    <h3 v-if="selectedTheme.name">Выбрана тема: {{ selectedTheme.name }}</h3>
                    <h3 v-else style="color:#cb4c07">Тема не выбрана - сделайте выбор</h3>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6 offset-md-3 my-card">
                    <label class="my-title text-center" for="inputNumberRows" style="width: 100%">Введите количество строк для показа:</label>
                    <div class="input-group mb-3">
                        <input v-model="inputRowsNumber" id="inputNumberRows" type="number" min="1" max="1000" class="form-control my-text" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button :disabled="!selectedTheme.name" v-on:click="startExercise()" class="btn  my-btn" type="button">Показать</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row my-card">
                <div class="col-md-12 text-center">
                    <h3>Мой словарь:</h3>
                </div>
                <div class="col-md-10 offset-md-1">
                    <button v-if="taskList.length > 0" @click="isAnswersShow = true" type="button" class="btn my-btn" style="float: right; margin-bottom: 15px"><i class="fa fa-info-circle" style="font-size: 18px;"></i></button>
                    <button v-if="taskList.length > 0" @click="startExercise()" type="button" class="btn my-btn" style="float: right; margin-bottom: 15px; margin-right: 20px;"><i class="fa fa-refresh" style="font-size: 18px;"></i></button>
                </div>
                <div class="col-md-10 offset-md-1 text-center">
                    <div class="list-group">
                        <ul v-model="vocabularyList" class="list-group" style="max-height: 300px; margin-bottom: 10px; overflow-y:scroll; -webkit-overflow-scrolling: touch;">
                            <li v-for="vc in vocabularyList" class="list-group-item list-group-item-action my-text">
                                <span v-if="selectedDirection == 1 && !isAnswersShow">{{ vc.text_ru }}</span>
                                <span v-else-if="selectedDirection == 2 && !isAnswersShow">{{ vc.translation }}</span>
                                <span v-else-if="selectedDirection == 3 && !isAnswersShow">{{ vc.encoding }}</span>
                                <span v-else-if="isAnswersShow">{{ vc.text_ru }} &nbsp; &#10132; &nbsp; {{ vc.translation }} &nbsp; &#10132; &nbsp; {{ vc.encoding }}</span>
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
    const russianDirection = 1;
    const translationDirection = 2;
    const encodingDirection = 3;
    export default {
        data: () => ({
            selectedLang: '1',
            selectedVariety: '1',
            selectedDirection: russianDirection,
            selectedVocabularyString: '',
            inputRowsNumber: 10,
            selectedTheme: [],
            themes: [],
            vocabularyList: [],
            taskList: [],
            isAnswersShow: false,
        }),
        props: {
            data: {}
        },
        mounted() {
            this.getThemes()
        },
        watch: {
            selectedLang: function() {

            },
            selectedVariety: function() {

            },
            vocabularyList: function () {

            },
        },
        methods: {
            showAnswers: function() {
                this.isAnswersShow = true;
            },
            startExercise: function() {
                this.isAnswersShow = false;
                this.getVocabulary();
            },
            prepareTaskList: function() {
                this.taskList = [];
                this.vocabularyList.map( (item) => {
                    if (this.selectedDirection == russianDirection) {
                        this.taskList.push(item.text_ru);
                    }else if (this.selectedDirection == translationDirection) {
                        this.taskList.push(item.translation);
                    }else if (this.selectedDirection == encodingDirection) {
                        this.taskList.push(item.encoding);
                    }
                });
            },
            getThemes() {
                ApiServices.getThemes(this.data.userId).then( response => {
                    this.themes = response.data
                }).catch( error => console.log(error) )
            },
            getVocabulary() {
                ApiServices.getUserExercise(this.data.userId, this.selectedLang, this.selectedTheme.id, this.selectedVariety, this.inputRowsNumber)
                    .then(response => {
                        this.vocabularyList = response.data;
                        this.prepareTaskList();
                    }).catch( error => console.log(error))
            },
        },
        name: "VocabularyExerciseComponent"
    }
</script>

<style scoped>
    main {
        background-color: #e6f5f1;
        padding-bottom: 100px;
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

</style>