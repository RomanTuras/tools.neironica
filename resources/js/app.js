require('./bootstrap');

window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('user-action-component', require('./components/UserActionComponent').default);
Vue.component('vocabulary-component', require('./components/VocabularyComponent.vue').default);
Vue.component('vocabulary-exercise-component', require('./components/VocabularyExerciseComponent.vue').default);

const app = new Vue({
    el: '#app',
});
