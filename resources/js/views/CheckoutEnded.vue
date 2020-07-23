<template>
    <div>
        <!-- Breadcrumb Section Begin -->
        <breadcrumb title="Orden recibida" breadcrumb="Orden finalizada"></breadcrumb>
        <!-- Breadcrumb Section End -->

        <!-- Checkout Ended Section Begin -->
        <checkout-ended-section :order="orderElement"></checkout-ended-section>
        <!-- Checkout Ended Section End -->
    </div>
</template>

<script>
    import Breadcrumb from "../layouts/partials/Breadcrumb";
    import CheckoutSection from "../components/Checkout/CheckoutSection";
    import CheckoutEndedSection from "../components/CheckoutEnded/CheckoutEndedSection";
    import EventBus, {UPDATE_PRODUCT_IMAGES} from "../eventBus";
    export default {
        name: "CheckoutEnded",
        props: ["order"],
        components: {CheckoutEndedSection, CheckoutSection, Breadcrumb},
        data: () => ({
            orderElement: {}
        }),
        mounted() {
            EventBus.$emit(UPDATE_PRODUCT_IMAGES)
        },
        created() {
            axios.get("/api/order/"+this.order)
                .then( response => this.orderElement=response.data.data)
                .catch(err => this.$router.push({name:'shop'}))
        }
    }
</script>

<style scoped>

</style>
