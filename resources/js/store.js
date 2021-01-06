import axios from "axios";
import { getLocalUser } from "./helper/auth";

const user = getLocalUser();
export default {
    state: {
        currentUser: user,
        isLoginedIn: !!user,
        loading: false,
        auth_error: null,
        customers: [],
        countCustomers:0,

    },
    getters: {
        isLoading(state) {
            return state.isLogin;
        },
        isLoginedIn(state) {
            return state.isLoginedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        customers(state) {

            return state.customers;
        },
        countCustomer(state){
            return state.countCustomers;
        }

    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        LoginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoginedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {
                token: payload.access_token
            });
            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        LoginFail(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoginedIn = false;
            state.currentUser = null;
        },
        updateCustomer(state, payload) {
            state.customers = payload;
            state.countCustomer = payload.length;
            console.log(payload.length)

        },

    },
    actions: {
        login(context) {
            context.commit("login");
        },
        getCustomers(context) {
            axios.get("/api/customers/all").then(response => {
                context.commit("updateCustomer", response.data.customers);
            });
        }

    }
};