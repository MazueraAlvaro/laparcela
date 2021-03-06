import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);
const router = new VueRouter({
    routes: [
        {
            path: "/",
            name: "home",
            component: require("./views/Home.vue").default
        },
        {
            path: "/tienda",
            name: "shop",
            component: require("./views/Shop.vue").default
        },
        {
            path: "/contacto",
            name: "contact",
            component: require("./views/Shop.vue").default
        },
        {
            path: "/carro-de-compras",
            name: "cart",
            component: require("./views/Cart.vue").default
        },
        {
            path: "/finalizar-pedido",
            name: "checkout",
            component: require("./views/Checkout.vue").default
        },
        {
            path: "/orden-recibida/:order",
            name: "checkout-ended",
            component: require("./views/CheckoutEnded.vue").default,
            props: true
        }
    ],
    mode: "history",
    scrollBehavior() {
        document.getElementById('app').scrollIntoView();
    }
});

router.beforeEach((to, from, next) => {
    jQuery(".loader").fadeIn();
    jQuery("#preloder").fadeIn();
    setTimeout(next, 500);
});

router.afterEach((to, from, next) => {
    jQuery(".loader").fadeOut();
    jQuery("#preloder").delay(200).fadeOut("slow");
})

export default router;
