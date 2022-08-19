/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');
 import Vue from 'vue'; // if this is not work add this =>  window.Vue = require('vue');
 console.log(Vue.version);

 import axios from 'axios';
 import VueAxios from 'vue-axios';
 import Auth from './Auth.js';
 
 import VueQRCodeComponent from 'vue-qrcode-component';
 Vue.component('qr-code', VueQRCodeComponent);

 Vue.prototype.auth = Auth;
 Vue.use(VueAxios, axios);

 import VueQrcodeReader from "vue-qrcode-reader";
 Vue.use(VueQrcodeReader);
 
 import VueSweetalert2 from 'vue-sweetalert2';
 import 'sweetalert2/dist/sweetalert2.min.css';
 Vue.use(VueSweetalert2);
 
 import App from './App.vue';
 import router from './routes';
 
 const app = new Vue({
     el: '#app',
     router,
     render: h => h(App),
 });