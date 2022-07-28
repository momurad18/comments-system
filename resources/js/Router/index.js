import Vue from "vue";
import VueRouter from "vue-router";

import Post from ".././Pages/Post";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    routes: [
        {
            path: "/",
            name: "home",
        },
        {
            path: "/posts/:id",
            name: "post",
            component: Post,
        },
    ],
});

export default router;
