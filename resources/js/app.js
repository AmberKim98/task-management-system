import VueRouter from "vue-router";
import router from "./routes/routes";
import Vue from 'vue/dist/vue.esm.js';
import VueAxios from 'vue-axios';
import axios from 'axios';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import App from "./components/layouts/App.vue";
import Header from "./components/layouts/partials/HeaderComponent.vue";
import Footer from "./components/layouts/partials/FooterComponent.vue";
import Vuelidate from "vuelidate";

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueAxios, axios);
Vue.use(Vuelidate);

require('./bootstrap');
window.Vue = Vue;

Vue.prototype.$axios = axios;

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('layout', App);
Vue.component('my-header', Header);
Vue.component('my-footer', Footer);

const app = new Vue({
    el: '#app',
    router
})