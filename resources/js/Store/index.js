import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        comments: [],
        perPage: process.env.MIX_COMMENT_PER_PAGE,
    },
    mutations: {
        SET_COMMENTS(state, comments) {
            state.comments = comments;
        },
    },
    actions: {
        async getComments({ commit, state }, id) {
            const response = await axios.get(`/api/comments/${id}`);
            commit("SET_COMMENTS", response.data.comments || []);
            return state.comments;
        },
        async sendComment({ commit }, payload) {
            const response = await axios.post("/api/comments", payload);
            return response;
        },
    },
    getters: {
        comments(state) {
            return state.comments || [];
        },
        perPage(state) {
            return state.perPage;
        },
    },
});

export default store;
