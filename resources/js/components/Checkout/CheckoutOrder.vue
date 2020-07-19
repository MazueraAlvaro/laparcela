<template>
   <b-overlay :show="loading">
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
           <div class="checkout__input__checkbox" v-for="paym in payments" :key="paym.id">
               <label :for="'payment'+paym.id">
                   {{paym.name}}
                   <input type="radio" :id="'payment'+paym.id" name="payment" v-model="payment" :value="paym.id">
                   <span class="checkmark"></span>
               </label>
           </div>
           <button type="submit" class="site-btn">FINALIZAR PEDIDO</button>
       </div>
   </b-overlay>
</template>

<script>
    import {mapGetters} from "vuex";
    import {SC_GET_PRODUCTS, SC_GET_TOTAL_F} from "../../store/modules/shoppingCart";

    export default {
        props: ["loading"],
        name: "CheckoutOrder",
        data(){
            return {
                payment: "transfer",
                payments: [],
            }
        },
        created() {
            this.getPayments();
        },
        computed: {
            ...mapGetters('shoppingCart', {products: SC_GET_PRODUCTS, totalF: SC_GET_TOTAL_F})
        },
        methods: {
            getPayment(){
                return this.payment;
            },
            async getPayments(){
                const {data} = await axios.get("/api/payment")
                this.payments = data.data;
                this.payment = this.payments[0].id;
            }
        }
    }
</script>

<style scoped>

</style>
