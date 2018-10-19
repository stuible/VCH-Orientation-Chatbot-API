
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './routes';
import Vuetify from 'vuetify';
import wysiwyg from "vue-wysiwyg";

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuetify)
Vue.use(wysiwyg, {
    hideModules: { 
        "justifyLeft": true,
        "justifyCenter": true,
        "justifyRight": true,
        "separator": true,
        "headings": true,
        "image": true,
    },
});


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('synonyms', require('./components/Synonyms.vue'));
Vue.component('intents', require('./components/Intents.vue'));
Vue.component('breadcrumbs', require('./components/Breadcrumbs.vue'));
Vue.component('navigation', require('./components/Navigation.vue'));

const app = new Vue({
    el: '#app',
    router,
    data: () => ({
        drawer: null,
    })
});
