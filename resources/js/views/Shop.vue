<template>
    <div>
        <!-- Hero Section Begin -->
        <hero></hero>
        <!-- Hero Section End -->

        <!-- Breadcrumb Section Begin -->
        <breadcrumb title="Tienda La Parcela" breadcrumb="Tienda"></breadcrumb>
        <!-- Breadcrumb Section End -->

        <!-- Product Section Begin -->
        <product-section></product-section>
        <!-- Product Section End -->
    </div>
</template>

<script>
    import Hero from "../layouts/partials/Hero";
    import Breadcrumb from "../layouts/partials/Breadcrumb";
    import ProductSection from "../components/Shop/ProductSectionComponent";
    import EventBus, {UPDATE_PRODUCT_IMAGES} from "../eventBus";

    export default {
        name: "Shop",
        components: {ProductSection, Breadcrumb, Hero},
        mounted() {
            EventBus.$emit(UPDATE_PRODUCT_IMAGES)
        }
    }
</script>

<style scoped>
    .hero{
        padding-bottom: 0;
    }
</style>
