import axios from "axios"

const baseUrl = `http://127.0.0.1:8000/`;
// const baseUrl = `http://tools.neironica.com/`;
const apiClient = axios.create({
    baseURL: baseUrl,
    withCredentials: false, // This is the default
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
    },
    timeout: 10000,
});

const apiClientForFile = axios.create({
    baseURL: baseUrl,
    withCredentials: false, // This is the default
    headers: {
        Accept: "multipart/form-data",
        "Content-Type": "multipart/form-data",
    },
    timeout: 10000,
});

export default {
    token: '',
    async getUserExercise(user_id, language_id, theme_id, variety_id, number) {
        return apiClient("/api/get-user-exercise/" + user_id + '/' + language_id + '/' + theme_id + '/' + variety_id + '/' + number);
    },
    async getUserVocabulary(user_id, language_id, theme_id, variety_id) {
        return apiClient("/api/get-user-vocabulary/" + user_id + '/' + language_id + '/' + theme_id + '/' + variety_id);
    },
    async isThemeNameExist(user_id, name) {
        return apiClient("/api/vocabulary-is-theme-exist/" + user_id + '/' + name);
    },
    async getThemes(user_id) {
        return apiClient("/api/vocabulary-get-themes/" + user_id);
    },
    async getUsers() {
        return apiClient("/api/users/");
    },
    async deleteUser(userId) {
        return await apiClient
            .post("/api/users/delete-user/" + userId)
            .catch(function(error) {
                return error.response;
            });
    },
    async changeUserRole(userId, role) {
        return await apiClient
            .post("/api/users/change-role/" + userId + '/' + role)
            .catch(function(error) {
                return error.response;
            });
    },
    async copyTheme(user_to, user_from, theme_name, theme_id, language_id, variety_id) {
        return await apiClient
            .post("/api/vocabulary-copy-theme/" + user_to + '/' + user_from + '/' + theme_name + '/' + theme_id  + '/' + language_id + '/' + variety_id)
            .catch(function(error) {
                return error.response;
            });
    },
    async updateTranslation(id, text_ru, transl, encode) {
        return await apiClient
            .post("/api/vocabulary-update-translation/" + id + '/' + text_ru + '/' + transl + '/' + encode)
            .catch(function(error) {
                return error.response;
            });
    },
    async insertTranslation(user_id, language_id, theme_id, variety_id, text_ru, transl, encode) {
        return await apiClient
            .post("/api/vocabulary-insert-translation/" + user_id + '/' + language_id + '/' + theme_id + '/' + variety_id + '/' + text_ru + '/' + transl + '/' + encode)
            .catch(function(error) {
                return error.response;
            });
    },
    async updateTheme(theme_id, name) { //object
        return await apiClient
            .post("/api/vocabulary-update-theme/" + theme_id + '/' + name)
            // .post("/api/vocabulary-update-theme/" + object)
            .catch(function(error) {
                return error.response;
            });
    },
    async insertTheme(user_id, language_id, name) {
        return await apiClient
            .post("/api/vocabulary-insert-theme/" + user_id + '/' + language_id + '/' + name)
            .catch(function(error) {
                if (error.response) {
                    // Request made and server responded
                    // console.log(error.response.data);
                    // console.log(error.response.status);
                    // console.log(error.response.headers);
                } else if (error.request) {
                    // The request was made but no response was received
                    // console.log(error.request);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    // console.log('Error', error.message);
                }
                return error.response;
            });
    },
    async insertFolderName(name) {
        return await apiClient
            .post("/api/puzzle-insert-folder/" + name)
            .catch(function(error) {
                return error.response;
            });
    },
    async updateFolderName(id, name) {
        return await apiClient
            .post("/api/puzzle-update-folder-name/" + id + '/' + name)
            .catch(function(error) {
                return error.response;
            });
    },
    async getPuzzleFolders() {
        return await apiClient
            .get("/api/puzzle-folders")
            .catch(function(error) {
            return error.response;
        });
    },
    async uploadImage(formData, folderId) {//Storing a folder image
        return await apiClientForFile
            .post("api/puzzle/store-image/" + folderId, formData)
            .catch(function (error) {
                return error.response;
            });
    },
    async uploadPuzzleImage(formData, folderId) {//Storing a puzzle image
        return await apiClientForFile
            .post("api/puzzle/store-puzzle-image/" + folderId, formData)
            .catch(function (error) {
                return error.response;
            });
    },
    async updatePuzzleImage(formData, folderId, puzzleId) {//Storing a puzzle image
        return await apiClientForFile
            .post("api/puzzle/update-puzzle-image/" + puzzleId + '/' + folderId, formData)
            .catch(function (error) {
                return error.response;
            });
    },
    async getAllPuzzles(folderId) {
        return await apiClient
            .get("/api/puzzle/" + folderId)
            .catch(function(error) {
                return error.response;
            });
    },
    async deletePuzzle(puzzleId, folderId) {
        return await apiClient
            .delete("/api/puzzle/delete-puzzle/" + puzzleId + '/' + folderId)
            .catch(function(error) {
                return error.response;
            });
    },
}

