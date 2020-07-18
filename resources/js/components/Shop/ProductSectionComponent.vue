<template>
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <sidebar></sidebar>
                </div>
                <div class="col-lg-9 col-md-7">
                    <product-grid></product-grid>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Sidebar from "./Sidebar";
    import ProductGrid from "./ProductGrid";
    export default {
        name: "ProductSectionComponent",
        components: {ProductGrid, Sidebar}
    }
</script>

<style scoped>

</style>
