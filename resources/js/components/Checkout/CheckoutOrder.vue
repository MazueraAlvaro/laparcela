<template>
    <div class="checkout__order">
        <h4>Su Pedido</h4>
        <div class="checkout__order__products">Productos <span>Total</span></div>
        <ul>
            <li v-for="product in products" :key="product.id">{{product.name}} <span v-text="product.formatted_total">$75.99</span></li>
        </ul>
        <div class="checkout__order__subtotal">Subtotal <span v-text="totalF"></span></div>
        <div class="checkout__order__total">Total <span v-text="totalF"></span></div>
        <p>
            Por favor seleccione el método de pago a utilizar:
        </p>
        <div class="checkout__input__checkbox">
            <label for="payment">
                Transferencia Bancaria
                <input type="radio" id="payment" name="payment" v-model="payment" value="transfer">
                <span class="checkmark"></span>
            </label>
        </div>
        <div class="checkout__input__checkbox">
            <label for="paypal">
                Pago Contra Entrega
                <input type="radio" id="paypal" name="payment" v-model="payment" value="cod">
                <span class="checkmark"></span>
            </label>
        </div>
        <button type="submit" class="site-btn">FINALIZAR PEDIDO</button>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import {SC_GET_PRODUCTS, SC_GET_TOTAL_F} from "../../store/modules/shoppingCart";

    export default {
        name: "CheckoutOrder",
        data(){
            return {
                payment: "transfer"
            }
        },
        computed: {
            ...mapGetters('shoppingCart', {products: SC_GET_PRODUCTS, totalF: SC_GET_TOTAL_F})
        },
        methods: {
            completeOrder(){
                this.$emit("completeOrder");
            }
        }
    }
</script>

<style scoped>

</style>
