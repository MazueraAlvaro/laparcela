<template>
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Información de Facturación</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <billing-form></billing-form>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <checkout-order @completeOrder="completeOrder"></checkout-order>
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
        mounted() {
          axios.post("/api/order/fromCart");
        },
        components: {CheckoutOrder, BillingForm},
        methods:{
            completeOrder(payment){

            }
        }
    }
</script>

<style scoped>

</style>
