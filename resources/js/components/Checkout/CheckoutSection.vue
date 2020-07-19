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

    export default {
        name: "CheckoutSection",
        data(){
            return {
                payment: null,
                loading: false
            }
        },
        mounted() {
          axios.post("/api/order/fromCart");
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
                    await axios.post("/api/order/close", {payment_id: this.payment});
                    this.loading = false;
                }
                catch (e) {

                }
            }
        }
    }
</script>

<style scoped>

</style>
