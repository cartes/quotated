 /**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import productContact from "./components/products/productContact";

 require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import {BootstrapVue, IconsPlugin} from "bootstrap-vue";
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

import {ServerTable} from "vue-tables-2";
Vue.use(ServerTable, {}, false, 'bootstrap4', 'default');

import VueResource from "vue-resource";
Vue.use(VueResource);

import Categories from "./components/category/Categories";
Vue.component("categories-list", Categories);

import Users from "./components/user/users";
Vue.component("users-list", Users);

import Ads from "./components/ads/ads";
Vue.component("ads-list", Ads);

import formProducts from "./components/products/formProducts";
Vue.component("form-products", formProducts);

import productDetail from "./components/products/productDetail";
import listProducts from "./components/products/listProducts";
 import productEdit from "./components/products/productEdit";
Vue.component("product-detail", productDetail);

Vue.component('product-list', listProducts);
Vue.component("product-contact", productContact);
Vue.component('product-edit', productEdit);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
