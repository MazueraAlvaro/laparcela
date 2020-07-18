<template>
    <div>
        <!-- Breadcrumb Section Begin -->
        <breadcrumb title="Carro de Compras" breadcrumb="carro de compras"></breadcrumb>
        <!-- Breadcrumb Section End -->

        <!-- Product Section Begin -->
            <shopping-cart-section></shopping-cart-section>
        <!-- Product Section End -->
    </div>
</template>

<script>
    import Hero from "../layouts/partials/Hero";
    import Breadcrumb from "../layouts/partials/Breadcrumb";
    import ProductSection from "../components/Shop/ProductSectionComponent";
    import EventBus, {UPDATE_PRODUCT_IMAGES} from "../eventBus";
    import ShoppingCartSection from "../components/Cart/ShoppingCartSection";

    export default {
        name: "Shop",
        components: {ShoppingCartSection, ProductSection, Breadcrumb, Hero},
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
