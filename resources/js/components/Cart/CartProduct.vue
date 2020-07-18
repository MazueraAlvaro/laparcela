<template>
        <tr>
            <td class="shoping__cart__item">
                <img :src="product.main_image" width="100px" alt="">
                <h5 v-text="product.name"></h5>
            </td>
            <td class="shoping__cart__price" v-text="formatted_price">
            </td>
            <td class="shoping__cart__quantity">
                <div class="quantity">
                    <div class="pro-qty">
                        <span @click="changeQty(-1)" class="dec qtybtn">-</span>
                        <input type="text" v-model="quantity" readonly>
                        <span @click="changeQty(1)" class="inc qtybtn">+</span>
                    </div>
                </div>
            </td>
            <td class="shoping__cart__total" v-text="formatted_total">
            </td>
            <td class="shoping__cart__item__close">
                <span class="icon_close" @click="remove"></span>
            </td>
            <b-overlay :show="loading" no-wrap>
            </b-overlay>
        </tr>
</template>

<script>
    import {SC_DELETE_PRODUCT, SC_UPDATE_PRODUCT_QTY} from "../../store/modules/shoppingCart";

    export default {
        name: "CartProduct",
        props: ["product"],
        data(){
            return {
                quantity: this.product.quantity,
                timer: null,
                loading: false
            }
        },
        computed:{
            formatted_price(){
                return this.product.formatted_price + "/" +this.product.unit.unit;
            },
            formatted_total(){
                return (this.quantity !== this.product.quantity) ? this.formatValue(this.getRawTotal()) : this.product.formatted_total;
            },
        },
        methods:{
            changeQty(val){
                let qty = this.quantity;
                qty += val * this.product.unit.increment
                this.quantity = (qty <= 0) ? 0 : qty;
                this.updateProduct();
            },
            getRawTotal(){
                return this.product.price * this.quantity;
            },
            formatValue(value){
                return "$" + new Intl.NumberFormat('de-DE',
                    {useGrouping: true, minimumFractionDigits: 2})
                        .format(value);
            },
            updateProduct(){
                if(this.timer) clearTimeout(this.timer)
                this.timer = setTimeout(() => {
                    this.loading = true;
                    this.$store.dispatch("shoppingCart/"+SC_UPDATE_PRODUCT_QTY,
                        {id:this.product.id, quantity:this.quantity})
                    .then(res => {
                        this.$toastr.s(res);
                        this.loading = false;
                    })
                    .catch(res => {
                        this.$toastr.e(res);
                        this.loading = false;
                    });
                }, 1000);
            },
            remove(){
                this.loading = true;
                this.$store.dispatch("shoppingCart/"+SC_DELETE_PRODUCT, this.product.id)
                    .then(res => {
                        this.$toastr.s(res)
                        this.loading = false;
                    })
                    .catch(res => {
                        this.$toastr.e(res);
                        this.loading = false;
                    });
            },
        }
    }
</script>

<style scoped>
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
