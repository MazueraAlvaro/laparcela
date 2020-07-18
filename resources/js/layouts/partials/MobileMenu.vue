<template>
    <div>
        <div class="humberger__menu__overlay"></div>
        <div class="humberger__menu__wrapper">
            <div class="humberger__menu__logo">
                <a href="#"><img :src="'/img/logo.png'" alt=""></a>
            </div>
            <div class="humberger__menu__cart">
                <ul>
                    <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                </ul>
                <div class="header__cart__price">Total: <span>$150.00</span></div>
            </div>
            <div class="humberger__menu__widget">
                <div class="header__top__right__auth">
                    <a href="#"><i class="fa fa-user"></i>Ingreso</a>
                </div>
            </div>
            <nav class="humberger__menu__nav mobile-menu">
                <ul>
                    <li class="active"><a href="./index.html">Inicio</a></li>
                    <li><a href="./shop-grid.html">Tienda</a></li>
                    <li><a href="./contact.html">Contacto</a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
            <div class="header__top__right__social">
                <a href="https://www.instagram.com/laparcela_cali/" target="_blank">@laparcela_cali <i class="fa fa-instagram"></i></a>
<!--                <a href="#"><i class="fa fa-twitter"></i></a>-->
<!--                <a href="#"><i class="fa fa-linkedin"></i></a>-->
<!--                <a href="#"><i class="fa fa-pinterest-p"></i></a>-->
            </div>
            <div class="humberger__menu__contact">
                <ul>
                    <li><i class="fa fa-envelope"></i> info@laparcela.com</li>
                    <li>Envío gratis para ordenes mayores a $200.000</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MobileMenu"
    }
</script>

<style scoped>

</style>
