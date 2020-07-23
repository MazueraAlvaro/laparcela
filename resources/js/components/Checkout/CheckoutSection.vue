<template>
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Información de Facturación</h4>
                <form action="#" @submit.prevent="completeOrder" @keydown="keyDown($event)">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <billing-form ref="billing_form"></billing-form>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <checkout-order ref="checkout_order" :loading="loading" @completeOrder="completeOrder"></checkout-order>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
    import BillingForm from "./BillingForm";
    import CheckoutOrder from "./CheckoutOrder";
    import {ORDER_FROM_CART} from "../../store/modules/order";
    import {SC_RETRIEVE} from "../../store/modules/shoppingCart";

    export default {
        name: "CheckoutSection",
        data(){
            return {
                payment: null,
                loading: false
            }
        },
        mounted() {
            this.$store.dispatch("order/"+ORDER_FROM_CART);
        },
        components: {CheckoutOrder, BillingForm},
        methods:{
            completeOrder(){
                this.loading = true;
                this.$refs.billing_form.sendForm().then(this.detailsSent).catch(res => this.loading = false)
                this.payment = this.$refs.checkout_order.getPayment()
            },
            keyDown($event){
                this.$refs.billing_form.formKeyDown($event)
            },
            async detailsSent(res){
                try{
                    const {data} = await axios.post("/api/order/close", {payment_id: this.payment});
                    await this.$store.dispatch("shoppingCart/"+SC_RETRIEVE);
                    this.loading = false;
                    await this.$router.push({name:"checkout-ended", params:{
                            order: data.data.id
                        }});
                }
                catch (e) {

                }
            }
        }
    }
</script>

<style scoped>

</style>
