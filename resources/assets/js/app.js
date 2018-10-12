
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vuex from 'vuex';
import Router from 'vue-router';
import VueSession from 'vue-session';
import VeeValidate from 'vee-validate';
import router from './router'
import { store } from './store.js';
import VueRouter from 'vue-router'; // importing Vue router library


require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
// Vue.component('login', require('./components/users/loginComponent.vue'));
Vue.component('login', require('./components/masterComponent.vue'));
Vue.component('home', require('./components/home/homeComponent.vue'));
export const bus = new Vue()


Vue.use(bus)
Vue.use(Vuex)
Vue.use(Router)
Vue.use(VueSession)
Vue.use(VueRouter)
Vue.use(VeeValidate, { fieldsBagName: 'veeFields' })
Vue.prototype.$url = 'http://127.0.0.1:8000/'
//Vue.prototype.$url = 'http://stn.sprocketmedia.com/public/'


const app = new Vue({
    el: '#app',
    mode: 'history',
    store,
    router,
});
