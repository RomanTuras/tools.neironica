<template>
    <main role="main">

        <div class="container">
            <div class="container text-center my-section">
                <h1>Пазлы - панель управления</h1>
                <h4 style="color: coral;">Требования к картинкам:</h4>
                <p>Ширина не менее <b>800</b>px и не более <b>2000</b>px;
                <br>Формат: горизонтальный (ширина больше высоты);
                    <br>Тип: JPEG, JPG;
                    <br>Вес: <b>не более 2 мегабайт</b>.</p>
            </div>

        <div class="row">

            <div class="col-md-5 my-card">
                <label class="my-title" for="selectFolder">Выберите папку:</label>
                <button @click="editFolderName" type="button" class="btn my-btn" style="float: right; margin-bottom: 15px"><i class="fa fa-edit" style="font-size: 18px;"></i></button>
                <div v-if="isEditBlock">
                    <div class="input-group mb-3">

                        <input v-model.trim="inputEditFolderName" id="inputFolderNameEdit" type="text" class="form-control my-text" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button v-on:click="updateFolderName()" class="btn my-btn" type="button">Записать</button>
                        </div>
                    </div>
                    <div v-if="alertEditFolderName.length > 0" class="alert alert-danger" role="alert" style="display:block">
                        {{ alertEditFolderName }}
                    </div>
                </div>
            <select v-model="selectedFolder" id="selectFolder" class="custom-select custom-select-lg mb-3" size="12">
                <option v-for="folder in folders" v-bind:value="folder" class="menu-item">{{ folder.name }}</option>
            </select>
            </div>

            <div class="col-md-5 offset-md-1 my-card">
                <label class="my-title" for="inputFolderName">Добавить папку:</label>
                <div class="input-group mb-3">
                    <input v-model.trim="inputNewFolderName" @focus="folderNameFocus()" id="inputFolderName" type="text" class="form-control my-text" placeholder="Название папки" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button v-on:click="insertFolderName()" class="btn my-btn" type="button">Записать</button>
                    </div>
                </div>
                <div v-if="alertAddNewFolder.length > 0" class="alert alert-danger" role="alert" style="display:block">
                    {{ alertAddNewFolder }}
                </div>

                <label class="my-title" for="inputFolderName">Картинка папки:</label>
                <div v-if="isImageBlock" class="input-group mb-3">
                    <img :src=image alt="Нет картинки">
                    <div v-if="isFolderSpinnerRunning" class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <form id="addFolderImage" enctype="multipart/form-data" style="margin-top:20px;">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="filename" class="custom-file-input" id="inputFileUpload"
                                   v-on:change="onFileChange" accept=".jpg, .jpeg|image/*">
                                <label class="custom-file-label" for="inputFileUpload">Выберите картинку</label>
                            </div>
                            <div class="input-group-append">
                                <button v-on:click="submitForm" class="btn btn-info" type="button">Загрузить</button>
                            </div>
                        </div>
                        <br>
                        <p class="text-info">{{ alertUploadFile }}</p>
                    </form>
                </div>


            </div>
        </div>

            <div class="row">
                <div class="col-md-12 text-center my-section">
                    <h3 v-if="selectedFolder.name">Выбрана папка: {{ selectedFolder.name }}</h3>
                    <h3 v-else style="color:#cb4c07">Выберите или добавьте папку</h3>
                </div>
            </div>

            <div v-if="selectedFolder.name" class="row my-card">
                <div class="col-md-12 text-center">
                    <h3>Пазлов в папке: {{ selectedFolder.puzzles }}</h3>
                </div>

                <div class="col-md-8 offset-md-2">
                    <button :disabled="selectedPuzzle.length == 0" @click="deletePuzzle" type="button" class="btn btn-danger " style="float: right; margin-bottom: 15px; margin-left: 20px;"><i class="fa fa-trash" style="font-size: 18px;"></i></button>
                    <button @click="addPuzzle" type="button" class="btn my-btn" style="float: right; margin-bottom: 15px; margin-left: 20px;"><i class="fa fa-plus" style="font-size: 18px;"></i></button>
                </div>
                <div v-if="isPuzzleBlock" class="col-md-8 offset-md-2">
                    <form id="addPuzzleImage" enctype="multipart/form-data" style="margin-top:20px; float: right;">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="filename" class="custom-file-input" id="inputPuzzleFile"
                                       v-on:change="onPuzzleFileChange" accept=".jpg, .jpeg|image/*">
                                <label class="custom-file-label" for="inputFileUpload">{{ labelPuzzleUpload }}</label>
                            </div>
                            <div class="input-group-append">
                                <button v-on:click="submitPuzzleForm" class="btn btn-info" type="button">Загрузить</button>
                            </div>
                        </div>
                        <br>
                        <div v-if="isPuzzleSpinnerRunning" class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="text-info">{{ alertUploadPuzzleFile }}</p>
                    </form>
                </div>
                <div class="col-md-8 offset-md-2 text-center">
                    <div class="list-group">
                        <ul v-model="selectedPuzzle" class="list-group" style="max-height: 450px; margin-bottom: 10px; overflow-y:scroll; -webkit-overflow-scrolling: touch;">
                            <li
                                    v-for="(puzzle, index) in puzzles"
                                    v-on:click="puzzleSelect(puzzle, index)"
                                    class="list-group-item list-group-item-action my-text" :class=" puzzle.id === selectedPuzzle.id ? 'active' : ''">
                                {{ index + 1 }} ) &nbsp;
                                <img :src=puzzle.preview_image alt="image">
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>

        <!-- Modal Delete Puzzle -->
        <div class="modal fade" id="deletePuzzleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-weight: bold;"><i class="fa fa-trash trash-icon" style="margin-right: 15px;"></i>Удалить</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5><b>Внимание!</b></h5>
                        <p>Вы действительно хотите удалить этот пазл:</p>
                        <img :src=selectedPuzzle.preview_image alt="image">
                    </div>
                    <div class="modal-footer">
                        <button @click="confirmDelete" type="button" class="btn btn-primary" data-dismiss="modal">Удалить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
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
            maxFileSize: 2000000,
            selectedFolder: [],
            selectedPuzzle: [],
            folders: [],
            puzzles: [],
            image: '',
            inputNewFolderName: '',
            inputEditFolderName: '',
            file: '',
            puzzleFile: '',
            isEditBlock: false,
            isImageBlock: false,
            isPuzzleBlock: false,
            isFolderSpinnerRunning: false,
            isPuzzleSpinnerRunning: false,
            isAddMode: true,
            alertAddNewFolder: '',
            alertEditFolderName: '',
            alertUploadFile: '',
            alertUploadPuzzleFile: '',
            folderId: 0,
            puzzleId: 0,
            labelPuzzleUpload: 'Добавьте картинку пазла'
        }),
        props: {
            data: {}
        },
        watch: {
            isAddMode: function() {
                // this.labelPuzzleUpload = this.isAddMode ? 'Добавьте картинку пазла' : 'Изменить изображение';
            },
            selectedFolder: function () {
                this.isEditBlock = false;
                this.isImageBlock = true;
                this.image = this.selectedFolder.image;
                this.alertUploadFile = '';
                this.file = '';
                this.getPuzzles();
            }
        },
        mounted() {
            this.getFolders();
        },
        methods: {
            confirmDelete: function() {
                ApiServices.deletePuzzle(this.selectedPuzzle.id, this.selectedFolder.id).then( () => {
                    this.getPuzzles();
                    this.selectedFolder.puzzles--;
                    this.alertUploadPuzzleFile = 'Пазл удален!';
                });
            },
            deletePuzzle: function() {
                this.isPuzzleBlock = false;
                $('#deletePuzzleModal').modal('show');
            },
            addPuzzle: function() {
                this.labelPuzzleUpload = 'Добавьте картинку пазла';
                this.isPuzzleBlock = true;
                this.isAddMode = true; //Insert Puzzle mode
                this.selectedPuzzle = [];
                this.alertUploadPuzzleFile = '';
            },
            puzzleSelect: function(puzzle, index) {
                this.selectedPuzzle = puzzle;
                this.isPuzzleBlock = true;
                this.isAddMode = false; //Edit mode
                this.labelPuzzleUpload = 'Изменить картинку № ' + ++index;
                this.alertUploadPuzzleFile = '';
            },
            folderNameFocus: function(){
                this.isEditBlock = false;
                this.isImageBlock = false;
                this.alertUploadFile = '';
                this.file = '';
            },
            submitForm: function(e) {//upload an image folder
                if(this.file.size < this.maxFileSize) {
                    this.isFolderSpinnerRunning = true;
                    let formData = new FormData();
                    formData.append('file', this.file);
                    let folderId = this.selectedFolder.id;
                    ApiServices.uploadImage(formData, folderId).then(response => {
                        if (!response.data.error) {
                            this.getFolders();
                            this.image = null;
                            this.image = response.data.image;
                            this.isFolderSpinnerRunning = false;
                        }
                        this.alertUploadFile = response.data.response;
                    });
                    e.preventDefault();
                }
            },
            submitPuzzleForm: function(e) {//upload an puzzle image
                if(this.puzzleFile.size < this.maxFileSize) {
                    this.isPuzzleSpinnerRunning = true;
                    let formData = new FormData();
                    formData.append('file', this.puzzleFile);
                    let folderId = this.selectedFolder.id;

                    if (this.isAddMode) { //Add a new puzzle
                        ApiServices.uploadPuzzleImage(formData, folderId).then(response => {
                            if (!response.data.error) {
                                this.getPuzzles();
                                this.selectedFolder.puzzles++;
                                this.isPuzzleSpinnerRunning = false;
                            }
                            this.alertUploadPuzzleFile = response.data.response;
                        });
                    } else {//Edit puzzle image
                        let puzzleId = this.selectedPuzzle.id;
                        ApiServices.updatePuzzleImage(formData, folderId, puzzleId).then(response => {
                            if (!response.data.error) {
                                this.getPuzzles();
                            }
                            this.alertUploadPuzzleFile = response.data.response;
                        });
                    }



                    e.preventDefault();
                }
            },
            onFileChange(e) {
                this.file = e.target.files[0];
                if(this.file.size > this.maxFileSize) {
                    this.alertUploadFile = "Файл слишком большой!";
                } else {
                    this.alertUploadFile = "Выбран файл: " + e.target.files[0].name;
                }
            },
            onPuzzleFileChange(e) {
                this.puzzleFile = e.target.files[0];
                if(this.puzzleFile.size > this.maxFileSize) {
                    this.alertUploadPuzzleFile = "Файл слишком большой!";
                } else {
                    this.alertUploadPuzzleFile = "Выбран файл: " + e.target.files[0].name;
                }
            },
            insertFolderName: function () {
                this.isImageBlock = false;
                let folderName = this.inputNewFolderName;
                if(folderName.length > 2 && folderName.length < 255) {
                    ApiServices.insertFolderName(this.inputNewFolderName).then(response => {
                        if(response.data.error) {
                            this.alertAddNewFolder = 'Такое название уже есть!';
                        } else {
                            this.getFolders();
                            this.alertAddNewFolder = '';
                            this.inputNewFolderName = '';
                        }
                    });
                } else {
                    this.alertAddNewFolder = 'Введите от 3 до 254 символов';
                }
            },
            editFolderName: function () {
                if(this.selectedFolder.name){
                    this.isEditBlock = !this.isEditBlock;
                    this.isImageBlock = false;
                    this.inputEditFolderName = this.selectedFolder.name;
                    this.folderId = this.selectedFolder.id;
                    this.alertAddNewFolder = '';
                    this.alertEditFolderName = '';
                    this.inputNewFolderName = '';
                }
            },
            updateFolderName: function () {
                if (this.inputEditFolderName.length > 2 && this.inputEditFolderName.length < 255) {
                    ApiServices.updateFolderName(this.folderId, this.inputEditFolderName).then( response => {
                        this.getFolders();
                    }).catch( error => console.log(error) );
                    this.isEditBlock = false;
                    this.alertEditFolderName = '';
                } else {
                    this.alertEditFolderName = 'Введите от 3 до 254 символов';
                }
            },
            getFolders: function () {
                ApiServices.getPuzzleFolders().then(response => {
                    this.folders = response.data;
                }).catch( error => console.log(error) );
            },
            getPuzzles: function () {
                ApiServices.getAllPuzzles(this.selectedFolder.id).then( response => {
                    this.puzzles = response.data;
                }).catch( error => console.log(error) );
            }
        },
        name: "PuzzleComponent"
    }
</script>

<style scoped>
    main {
        background-color: #f1f1e6;
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
</style>