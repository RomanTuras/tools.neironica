<template>
    <section id="filwords">
        <div class="container">
            <h3 class="tools-title border-c">Филворды</h3>
        </div>
        <div class="jumbotron jumbotron-fluid">
            <div class="row">

<!--                Buttons -->
                <div class="col-md-1">
                    <div class="row">
                        <div class="col-12">
                            <button type="button" v-on:click="start" class="btn btn-outline-primary mb-1">Generate</button>
                            <button type="button" v-on:click="answers" class="btn btn-outline-secondary">Answers</button>
                        </div>
                    </div>
                </div>

<!--                Size table, words-->
                <div class="col-md-3">

                    <div class="row">
                        <div class="col-12 mb-1">
                            <div class="dropdown">
                                <div class="input-group h-34">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputSizeTable">Таблица:</label>
                                    </div>
                                    <select v-model="settings.sizeTable" id="inputSizeTable">
                                        <option value="3">3 x 3</option>
                                        <option value="4">4 x 4</option>
                                        <option value="5">5 x 5</option>
                                        <option value="6">6 x 6</option>
                                        <option value="7">7 x 7</option>
                                        <option value="8">8 x 8</option>
                                        <option value="9">9 x 9</option>
                                        <option value="10">10 x 10</option>
                                        <option value="11">11 x 11</option>
                                        <option value="12">12 x 12</option>
                                        <option value="13">13 x 13</option>
                                        <option value="14">14 x 14</option>
                                        <option value="15">15 x 15</option>
                                        <option value="16">16 x 16</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-1">
                            <div class="dropdown">
                                <div class="input-group h-34">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputWords">Слова:</label>
                                    </div>
                                    <select v-model="settings.wordCount" id="inputWords">
                                        <option v-for="n in 20" :value=n >{{ n }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="dropdown">
                                <div class="input-group h-34">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputLettersMin">Буквы от:</label>
                                    </div>
                                    <select v-model="settings.numberLettersMin" id="inputLettersMin">
                                        <option v-for="n in 30" :value=n >{{ n }}</option>
                                    </select>
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputLettersMax">до:</label>
                                    </div>
                                    <select v-model="settings.numberLettersMax" id="inputLettersMax">
                                        <option v-for="n in 30" :value=n >{{ n }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

<!--                Font color, Bg color, Font Size-->
                <div class="col-md-2">

                    <div class="row">

                        <div class="col-12 mb-1">
                            <div class="dropdown">
                                <div class="input-group h-34">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputBackground">Фон:</label>
                                    </div>
                                    <select v-model="settings.background" id="inputBackground">
                                        <option value="white">white</option>
                                        <option value="#ff8f00,#a345f9,#37ce2b,#54ecfd,#fbfb0b,transparent">alpha</option>
                                        <option value="#fbfb0b,#04c715,#47dbf5,#0a7def,#f52b90,transparent">beta</option>
                                        <option value="#ffff82,#5aff95,#54ecfd,#0ea4f7,#dc4aff,transparent">gamma</option>
                                        <option value="#fd3a5f,#fbfb0b,#0a7def,#54ecfd,#3eff83,transparent">delta</option>
                                        <option value="#00ffef,#fe6cff,#be03ea,#ffff82,#04ef6f,transparent">epsilon</option>
                                        <option value="#d026f9,#fbfb0b,#0a7def,#54ecfd,#3eff83,transparent">zeta</option>
                                        <option value="#fbfb0b,#f92c53,#3f88f9,#49fd61,#06d20d,transparent">eta</option>
                                        <option value="#48e4ff,#fbfb0b,#f92c53,#3f88f9,#06d20d,transparent">theta</option>
                                        <option value="#c10bec,#fbfb0b,#f92c53,#3f88f9,#06d20d,transparent">iota</option>
                                        <option value="#0000ff" style="color: #0000ff">#0000ff</option>
                                        <option value="#000839" style="color: #000839">#000839</option>
                                        <option value="#002bdc" style="color: #002bdc">#002bdc</option>
                                        <option value="#0033c7" style="color: #0033c7">#0033c7</option>
                                        <option value="#008891" style="color: #008891">#008891</option>
                                        <option value="#00a8cc" style="color: #00a8cc">#00a8cc</option>
                                        <option value="#00bcd4" style="color: #00bcd4">#00bcd4</option>
                                        <option value="#01c5c4" style="color: #01c5c4">#01c5c4</option>
                                        <option value="#fff3e6" style="color: #fff3e6">#fff3e6</option>
                                        <option value="#f5f4f4" style="color: #f5f4f4">#f5f4f4</option>
                                        <option value="#f8f1f1" style="color: #f8f1f1">#f8f1f1</option>
                                        <option value="#eff8ff" style="color: #eff8ff">#eff8ff</option>
                                        <option value="#ffe6e6" style="color: #ffe6e6">#ffe6e6</option>
                                        <option value="#ffe0d8" style="color: #ffe0d8">#ffe0d8</option>
                                        <option value="#fcf8ec" style="color: #fcf8ec">#fcf8ec</option>
                                        <option value="#f4eeed" style="color: #f4eeed">#f4eeed</option>
                                        <option value="#fffaa4" style="color: #fffaa4">#fffaa4</option>
                                        <option value="#c6fced" style="color: #c6fced">#c6fced</option>
                                        <option value="#f8f1f1" style="color: #f8f1f1">#f8f1f1</option>
                                        <option value="#fff8c1" style="color: #fff8c1">#fff8c1</option>
                                        <option value="#fbf6f0" style="color: #fbf6f0">#fbf6f0</option>
                                        <option value="#fceef5" style="color: #fceef5">#fceef5</option>
                                        <option value="#fcf1f1" style="color: #fcf1f1">#fcf1f1</option>
                                        <option value="#f1f6f9" style="color: #f1f6f9">#f1f6f9</option>
                                        <option value="#fff8cd" style="color: #fff8cd">#fff8cd</option>
                                        <option value="#f6f5f5" style="color: #f6f5f5">#f6f5f5</option>
                                        <option value="#e8ffff" style="color: #e8ffff">#e8ffff</option>
                                        <option value="#fff0f0" style="color: #fff0f0">#fff0f0</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-1">
                            <div class="dropdown">
                                <div class="input-group h-34">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputFontColor">Штифт:</label>
                                    </div>
                                    <select v-model="settings.fontColor" id="inputFontColor">
                                        <option value="black">black</option>
                                        <option value="white">white</option>
                                        <option value="red">red</option>
                                        <option value="blue">blue</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="dropdown">
                                <div class="input-group h-34">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputFontSize">Размер:</label>
                                    </div>
                                    <select v-model="settings.fontSize" id="inputFontSize">
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
                        </div>

                    </div>

                </div>

                <div class="col-md-2">
                    <div class="row">
                        <div class="col-12">
                            <p>Сложность</p>
                        </div>
                        <div class="col-12 mb-1">
                            <div class="dropdown">
                                <label class="form-check-label border-c">
                                    <input v-model="settings.isRowDirection" id="checkboxRow" type="checkbox" class="form-check-input" value="">Строки
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="dropdown">
                                <label class="form-check-label border-c">
                                    <input v-model="settings.isColumnDirection" id="checkboxColumn" type="checkbox" class="form-check-input" value="">Столбцы
                                </label>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-md-2">
                    <div class="row">
                        <div class="col-12 mb-1">
                            <div class="dropdown">
                                <label class="form-check-label border-c">
                                    <input v-model="settings.isEmptyCell" id="checkboxEmptyCell" type="checkbox" class="form-check-input" value="">Пустая ячейка
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="dropdown">
                                <label class="form-check-label border-c">
                                    <input v-model="settings.isUpperCase" id="checkboxUppercase" type="checkbox" class="form-check-input" value="">A/a
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="row">

                        <div class="col-12 mb-1">
                            <div class="dropdown paddingRange border-c float-r">
                                <label for="paddingRange">Padding</label>
                                <input v-model="settings.padding" id="paddingRange" class="border-c" type="range" min="10" max="200" step="1" value="10">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="dropdown float-right">
                                <label class="form-check-label border-c">
                                    <input v-model="settings.isBold" id="checkboxBoldFilwords" type="checkbox" class="form-check-input" value="">Bold
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div id="result-content">
            <div class="row">
                <div id="res" class="col-md-12">
                    <table class="result-table">
                        <tbody>
                            <tr v-for="row in tableRows">
                                <td
                                        v-for="char in row"
                                        v-bind:style="{
                                            color: settings.fontColor,
                                            backgroundColor: randomBackground(),
                                            fontSize: settings.fontSize + 'px',
                                            width: settings.padding + 'px',
                                            height: settings.padding + 'px',
                                            fontWeight: settings.isBold ? 'bold' : 'normal',
                                            fontFamily: 'Arial',
                                        }">
                                    {{ char === '@' ? (settings.isEmptyCell ? '  ' : randomChar()) : char  }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div v-if="isAnswers" id="answers">
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <span
                            v-for="word in words"
                            v-bind:style="{
                                fontSize: settings.fontSize + 'px',
                                fontWeight: settings.isBold ? 'bold' : 'normal',
                                fontFamily: 'Arial',
                            }">
                        {{ settings.isUpperCase ? word.toUpperCase() : word.toLowerCase() }} <br>
                    </span>
                </div>
            </div>
        </div>

    </section>
</template>

<script>
    import { readSettings, saveSettings } from '../../helpers/storageHelper'
    import { wordSearch, getTableRows } from './filwords/functions'
    import ApiServices from '../../services/ApiServices'

    export default {
        name: "FilWordsComponent",
        data: () => ({
            key: 'filwords',
            words: [],
            tableRows: [],
            settings: {
                'sizeTable': 3,
                'wordCount': 2,
                'numberLettersMin': 3,
                'numberLettersMax': 3,
                'background': 'white',
                'fontColor': 'black',
                'fontSize': 26,
                'padding': 50,
                'isRowDirection': false,
                'isColumnDirection': false,
                'isEmptyCell': false,
                'isUpperCase': false,
                'isBold': true,
            },
            isAnswers: false,
            savedIsEmptyCell: null,
            savedBackground: null,
            savedFontColor: null,
        }),
        mounted() {
            let storedSettings = readSettings(this.key);
            if (storedSettings != null) {
                this.settings = storedSettings;
            }
        },
        methods: {
            start: function () {
                this.isAnswers = false;
                this.restoreStyles();
                this.words = [];
                this.saveControls();
                if (this.validateMaxWordSize()) {
                    this.getWords();
                } else {
                    alert('Размер таблицы: '
                        + this.settings.sizeTable
                        + ',\nменьше размера слова: '
                        + this.settings.numberLettersMax);
                }
            },
            getWords: function () {
                ApiServices
                    .getRandomWords(this.settings.wordCount, this.settings.numberLettersMin, this.settings.numberLettersMax)
                    .then( (response) => {
                        if (response.data) {
                            let objects = response.data;
                            for (let i = 0; i < objects.length; i++){
                                this.words.push(objects[i].text);
                            }
                            let cells = wordSearch(
                                this.words,
                                parseInt(this.settings.sizeTable),
                                this.settings.isRowDirection,
                                this.settings.isColumnDirection
                            );
                            this.tableRows = getTableRows(
                                cells,
                                parseInt(this.settings.sizeTable),
                                this.settings.isUpperCase
                            );
                        }
                    }).catch( error => console.log(error) );
            },
            answers: function () {
                this.saveStyles();
                this.isAnswers = true;
                this.settings.isEmptyCell = true;
                this.settings.background = 'white';
                this.settings.fontColor = 'black';
            },
            saveStyles: function () {
                this.savedIsEmptyCell = this.settings.isEmptyCell;
                this.savedBackground = this.settings.background;
                this.savedFontColor = this.settings.fontColor;
            },
            restoreStyles() {
                if (this.savedIsEmptyCell != null) this.settings.isEmptyCell = this.savedIsEmptyCell;
                if (this.savedBackground != null) this.settings.background = this.savedBackground;
                if (this.savedFontColor != null) this.settings.fontColor = this.savedFontColor;
                this.savedIsEmptyCell = null;
                this.savedBackground = null;
                this.savedFontColor = null;
            },
            saveControls: function () {
                saveSettings(this.key, this.settings);
            },
            validateMaxWordSize: function () {
                return (parseInt(this.settings.numberLettersMax) <= parseInt(this.settings.sizeTable));
            },
            randomChar: function () {
                let letters = ["Й", "Ц", "У", "К", "Е", "Н", "Г", "Ш", "Щ", "З", "Х", "Ъ", "Ё", "Ф", "Ы", "В", "А", "П", "Р", "О", "Л", "Д", "Ж", "Э", "Я", "Ч", "С", "М", "И", "Т", "Ь", "Б", "Ю"];
                return this.settings.isUpperCase ? letters[Math.floor(Math.random()*letters.length)] : letters[Math.floor(Math.random()*letters.length)].toLowerCase();
            },
            randomBackground: function() {
                let value = this.settings.background;
                let colors = value.split(',');
                return colors[Math.floor(Math.random()*colors.length)];
            },
            getRandomInt(min, max) {
                min = Math.ceil(min);
                max = Math.floor(max);
                return Math.floor(Math.random() * (max - min + 1)) + min;
            },

        }
    }
</script>

<style scoped>
    .result-table {
        margin-left: auto;
        margin-right: auto;
    }
    tbody {
        border: 3px solid #666;
        text-align: center;
    }
    td {
        text-align: inherit;
        min-width: 40px;
        height: 40px;
        border: 2px solid #ccc;
    }
</style>