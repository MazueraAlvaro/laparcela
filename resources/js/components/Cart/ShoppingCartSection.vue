<template>
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                            <tr>
                                <th class="shoping__product">Productos</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                <cart-product v-for="product in products" :product="product" :key="product.id"></cart-product>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <router-link :to="{name:'shop'}" class="primary-btn cart-btn">CONTINUAR COMPRANDO</router-link>
                        <a href="#" class="primary-btn cart-btn cart-btn-right">
                            <span class="icon_loading"></span>
                            ACTUALIZAR CARRO
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">

                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Total Carro de Compras</h5>
                        <ul>
                            <li>Subtotal <span v-text="totalF"></span></li>
                            <li>Total <span v-text="totalF"></span></li>
                        </ul>
                        <router-link :to="{name:'checkout'}" class="primary-btn">PROCESAR ORDEN</router-link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import CartProduct from "./CartProduct";
    import {mapGetters} from "vuex";
    import {SC_GET_PRODUCTS, SC_GET_TOTAL_F} from "../../store/modules/shoppingCart";
    export default {
        name: "ShoppingCartSection",
        components: {CartProduct},
        computed: {
            ...mapGetters('shoppingCart', {products: SC_GET_PRODUCTS, totalF: SC_GET_TOTAL_F})
        }
    }
</script>

<style scoped>

</style>
