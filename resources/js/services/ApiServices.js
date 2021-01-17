import axios from "axios"

const apiClient = axios.create({
    // baseURL: `http://tools.neironica.com/`,
    baseURL: `http://127.0.0.1:8000/`,
    withCredentials: false, // This is the default
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
    },
    timeout: 10000,
});

export default {
    token: '',
    async getThemes(user_id) {
        return apiClient("/api/vocabulary-get-themes/" + user_id);
    },
    async updateTheme(theme_id, name) {
        return await apiClient
            .post("/api/vocabulary-update-theme/" + theme_id + '/' + name)
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
    }
}

