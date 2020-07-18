import Vue from "vue";
import Vuex, {Store} from "vuex";
import products from "./modules/products";
import shoppingCart from "./modules/shoppingCart";
import {SET_CATEGORIES, SET_CATEGORY} from "./mutation-types";

Vue.use(Vuex);

export default new Store({
    state: {
        categories: [],
        activeCategory: 0,
    },
    mutations:{
        [SET_CATEGORIES] (state, categories){
            state.categories = categories;
        },
        [SET_CATEGORY] (state, category){
            state.activeCategory = category;
            state.products.page = 0;
            state.products.products = [];
        },
    },
    modules: {
        products,
        shoppingCart
    },
    actions: {
        async retrieveCategories({commit, dispatch}){
            try{
                const {data} = await axios.get("/api/category");
                data.data.unshift({
                    "id": 0,
                    "name": "Todas",
                    "code": "Todas",
                    "description": "Todos los productos",
                });
                commit("setCategories", data.data);
            }catch (e) {
                setTimeout(() => {
                        dispatch("retrieveCategories")
                }, 1000);
            }
        }
    }
})
