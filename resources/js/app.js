import "./bootstrap";
import Vue from "vue";

import App from "./Container/App.vue";
import router from "./Router";
import store from "./Store";

const app = new Vue({
    store,
    router,
    el: "#app",
    render: (h) => h(App),
});
