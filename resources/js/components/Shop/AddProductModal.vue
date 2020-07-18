<template>
    <div class="text-center ">
            <div class="product__item mx-auto">
                <div class="product__item__pic set-bg" :data-setbg="product.main_image">

                </div>
                <div class="product__item__text">
                    <h6><a href="#" v-text="product.name"></a></h6>
                    <h5 v-text="product.regular_price_formatted"></h5>/<span v-text="product.unit.unit"></span>
                </div>
        </div>
        <div class="product__details__text">
            <div class="product__details__quantity">
                <div class="quantity">
                    <div class="pro-qty">
                        <span @click="changeQty(-1)" class="dec qtybtn">-</span>
                        <input type="text" v-model="qty" readonly>
                        <span @click="changeQty(1)" class="inc qtybtn">+</span>
                    </div>
                </div>
            </div>
            <a href="" @click.prevent="addProductToCart" class="primary-btn">AÑADIR</a>
        </div>
    </div>
</template>

<script>
    import EventBus, {UPDATE_PRODUCT_IMAGES} from "../../eventBus";
    import {SC_ADD_PRODUCT, SC_RETRIEVE} from "../../store/modules/shoppingCart";
    export const SUCCES_ADD_PRODUCT = "successAddProduct";
    export default {
        name: "AddProductModal",
        props: ["product"],
        data(){
            return {
                qty: this.product.unit.increment
            }
        },
        mounted(){
            EventBus.$emit(UPDATE_PRODUCT_IMAGES);
        },
        methods:{
            async addProductToCart(){
                try{
                    const {data} = await this.$store.dispatch("shoppingCart/"+SC_ADD_PRODUCT, {product_id: this.product.id, quantity: this.qty})
                    this.$store.dispatch("shoppingCart/"+SC_RETRIEVE);
                    this.$toastr.s("Producto Agregado Exitosamente");
                    this.$emit(SUCCES_ADD_PRODUCT);
                }
                catch (e) {
                    console.log(e)
                }
            },
            changeQty(val){
                let qty = this.qty;
                qty += val * this.product.unit.increment
                this.qty = (qty <= 0) ? 0 : qty;
            }
        }
    }
</script>

<style scoped>
    .product__item{
        height: 300px;
        width: 300px;
    }
    .product__item__text h5{
        display: inline;
    }
    .pro-qty {
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome, Edge, Opera and Firefox */
    }
</style>
