<template>
        <div>
            <!-- Breadcrumb Section Begin -->
            <breadcrumb title="Mi orden" breadcrumb="Orden de compra"></breadcrumb>
            <!-- Breadcrumb Section End -->

            <!-- Checkout Section Begin -->
            <checkout-section></checkout-section>
            <!-- Checkout Section End -->
        </div>
</template>

<script>
    import CheckoutSection from "../components/Checkout/CheckoutSection";
    import Breadcrumb from "../layouts/partials/Breadcrumb";
    import EventBus, {UPDATE_PRODUCT_IMAGES} from "../eventBus";
    export default {
        name: "Checkout",
        components: {Breadcrumb, CheckoutSection},
        mounted() {
            EventBus.$emit(UPDATE_PRODUCT_IMAGES)
        }
    }
</script>

<style scoped>

</style>
