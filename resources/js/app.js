require('./bootstrap');

window.Vue = require("vue");

Vue.component("app", require("./App.vue").default)
new Vue({
    el: "#app",
    store: require("./store/index").default,
    router: require("./router").default,
})
