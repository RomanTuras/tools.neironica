<template>
    <section id="filwords">
        <div class="container">
            <h3 class="tools-title border-c">Филворды</h3>
        </div>
        <div class="jumbotron jumbotron-fluid">
            <div class="row">

                <div class="col-md-1">
                    <div class="row">
                        <div class="col-12">
                            <button type="button" id="generate-filwords" class="btn btn-outline-primary">Generate</button>
                            <button type="button" id="answers-filwords" class="btn btn-outline-secondary">Answers</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">

                    <div class="row">
                        <div class="col-12">
                            <div class="dropdown">
                                <div class="input-group h-34">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputSizeTable">Таблица:</label>
                                    </div>
                                    <select class="font-select" id="inputSizeTable">
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

                        <div class="col-12">
                            <div class="dropdown">
                                <div class="input-group h-34">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputWords">Слова:</label>
                                    </div>
                                    <select class="font-select" id="inputWords">
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
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
                                    <select class="font-select" id="inputLettersMin">
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputLettersMax">до:</label>
                                    </div>
                                    <select class="font-select" id="inputLettersMax">
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-2">

                    <div class="row">

                        <div class="col-12">
                            <div class="dropdown">
                                <div class="input-group h-34">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputBackground">Фон:</label>
                                    </div>
                                    <select class="font-select" id="inputBackground">
                                        <option value="white">white</option>
                                        <option value="alpha">alpha</option>
                                        <option value="betta">betta</option>
                                        <option value="gamma">gamma</option>
                                        <option value="epsilon">epsilon</option>
                                        <option value="#0000ff" style="color: #0000ff">#0000ff</option>
                                        <option value="#000839" style="color: #000839">#000839</option>
                                        <option value="#002bdc" style="color: #002bdc">#002bdc</option>
                                        <option value="#0033c7" style="color: #0033c7">#0033c7</option>
                                        <option value="#008891" style="color: #008891">#008891</option>
                                        <option value="#00a8cc" style="color: #00a8cc">#00a8cc</option>
                                        <option value="#00bcd4" style="color: #00bcd4">#00bcd4</option>
                                        <option value="#01c5c4" style="color: #01c5c4">#01c5c4</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="dropdown">
                                <div class="input-group h-34">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputFontColor">Штифт:</label>
                                    </div>
                                    <select class="font-select" id="inputFontColor">
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
                        </div>

                    </div>

                </div>

                <div class="col-md-2">
                    <div class="row">
                        <div class="col-12">
                            <p>Сложность</p>
                        </div>
                        <div class="col-12">
                            <div class="dropdown">
                                <label class="form-check-label border-c">
                                    <input id="checkboxRow" type="checkbox" class="form-check-input" value="">Строки
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="dropdown">
                                <label class="form-check-label border-c">
                                    <input id="checkboxColumn" type="checkbox" class="form-check-input" value="">Столбцы
                                </label>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-md-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="dropdown">
                                <label class="form-check-label border-c">
                                    <input id="checkboxEmptyCell" type="checkbox" class="form-check-input" value="">Пустая ячейка
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="dropdown">
                                <label class="form-check-label border-c">
                                    <input id="checkboxUppercase" type="checkbox" class="form-check-input" value="">A/a
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="row">

                        <div class="col-12">
                            <div class="dropdown paddingRange border-c float-r">
                                <label for="paddingRange">Padding</label>
                                <input id="paddingRange" class="border-c" type="range" min="20" max="150" step="10" value="50">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="dropdown float-right">
                                <label class="form-check-label border-c">
                                    <input id="checkboxBoldFilwords" type="checkbox" class="form-check-input" value="">Bold
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
                </div>
            </div>
        </div>

    </section>
</template>

<script>
    // SELECT `name` FROM `vocabulary_theme` WHERE CHAR_LENGTH(`name`) <= 5 ORDER BY RAND() LIMIT 10;
    export default {
        name: "FilWordsComponent"
    }
</script>

<style scoped>

</style>