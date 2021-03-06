require("./bootstrap");

window.Vue = require("vue");
import axios from "axios";
import Vue from "vue";
import Vuex from "vuex";
import VueRouter from "vue-router";
import storeData from "./store";
import { routes } from "./routes";
import MaintApp from "./components/MainApp.vue";
import { initialize } from "./helper/general";
import common from "./helper/comon";
import numeral from 'numeral';
import numFormat from 'vue-filter-number-format';
import Swal from "sweetalert2";
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: true,
    onOpen: toast => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});
window.Swal = Swal;
window.Toast = Toast;
Vue.filter('numFormat', numFormat(numeral));
Vue.use(axios);
Vue.mixin(common);
Vue.use(VueRouter);
const router = new VueRouter({
    routes,
    mode: "history"
});
const store = new Vuex.Store(storeData);
initialize(store, router);
// axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

const app = new Vue({
    el: "#app",
    router,
    store,
    components: {
        MaintApp
    }
});