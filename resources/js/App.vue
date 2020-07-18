<template>
    <div>
        <component :is="layout">
            <router-view></router-view>
<!--            <router-view :layout.sync="layout"></router-view>-->
        </component>
    </div>
</template>
<script>
    import Vue from "vue";
    import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
    import VueToastr from "vue-toastr";
    import DefaultLayout from "./layouts/default";
    import {SC_RETRIEVE} from "./store/modules/shoppingCart";

    Vue.use(VueToastr);
    Vue.use(BootstrapVue);
    import 'bootstrap-vue/dist/bootstrap-vue.css';
    export default {
        name: "App",
        data(){
            return {
                layout: DefaultLayout
            }
        },
        created() {
            this.$store.dispatch("retrieveCategories");
            this.$store.dispatch("shoppingCart/"+SC_RETRIEVE)
        },
        mounted() {
            this.$toastr.defaultClassNames = ["animated", "zoomInUp"];
            this.$toastr.defaultPosition = "toast-bottom-center";
        }
    }
</script>
