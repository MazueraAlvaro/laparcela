<template>
    <div>
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        <!-- Humberger Begin - Mobile Menu  -->
        <mobile-menu></mobile-menu>
        <!-- Humberger End -->

        <!-- Header Section Begin -->
        <header-layout></header-layout>
        <!-- Header Section End -->

        <slot></slot>

        <!-- Footer Section Begin -->
        <footer-layout></footer-layout>
        <!-- Footer Section End -->

    </div>
</template>

<script>

    import MobileMenu from "./partials/MobileMenu";
    import HeaderLayout from "./partials/HeaderLayout";
    import FooterLayout from "./partials/FooterLayout";
    export default {
        name: "default",
        components: {FooterLayout, HeaderLayout, MobileMenu}
    }
</script>
