<template>
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> info@laparcela.com</li>
                                <li>Envío gratis para ordenes mayores a $200.000</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="#"><i class="fa fa-user"></i> Ingreso</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html"><img :src="'/img/logo.png'" alt="'"></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <router-link :to="{name: 'home'}" exact-active-class="active" tag="li" exact><a>Inicio</a></router-link>
                            <router-link :to="{name: 'shop'}" exact-active-class="active" tag="li" exact><a>Tienda</a></router-link>
                            <router-link :to="{name: 'cart'}" exact-active-class="active" tag="li" exact><a>Carro</a></router-link>
                            <router-link :to="{name: 'contact'}" exact-active-class="active" tag="li" exact><a>Contacto</a></router-link>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li>
                                <router-link :to="{name: 'cart'}">
                                    <i class="fa fa-shopping-bag"></i> <span v-text="totalProducts"></span>
                                </router-link>
                            </li>
                        </ul>
                        <div class="header__cart__price">Total: <span v-text="totalF"></span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
</template>

<script>
    import {SC_GET_Q_PRODUCTS, SC_GET_TOTAL_F} from "../../store/modules/shoppingCart";
    import {mapGetters} from "vuex";

    export default {
        name: "HeaderLayout",
        methods: {
            activeClass(name){
                return this.$router.name === name;
            }
        },
        computed:{
            ...mapGetters('shoppingCart', {totalProducts: SC_GET_Q_PRODUCTS, totalF: SC_GET_TOTAL_F}),
        }
    }
</script>

<style scoped>

</style>
