<template>
    <div>
        <div class="filter__item">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="filter__sort">
                        <span>Ordenar por:</span>
                        <select v-model="orderBy">
                            <option value="price">Precio</option>
                            <option value="most_buy">Más comprado</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="filter__found">
                        <h6><span v-text="total"></span> Productos encontrados</h6>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3">
                    <div class="filter__option">
                        <span class="icon_grid-2x2"></span>
                        <span class="icon_ul"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6" v-for="product in products" :key="product.id">
                <div class="product__item">
                    <div class="product__item__pic set-bg" :data-setbg="product.main_image">
                        <ul class="product__item__pic__hover">
                            <li><a @click="addProduct(product)"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#" v-text="product.name"></a></h6>
                        <h5 v-text="product.regular_price_formatted"></h5>/<span v-text="product.unit.unit"></span>
                    </div>
                </div>
            </div>
        </div>
        <infinite-loading @infinite="getProducts" :identifier="identifier">
            <div slot="no-more">No hay más productos</div>
            <div slot="no-results">No hay más productos</div>
        </infinite-loading>
        <b-modal id="addProductModal" title="Añadir Producto" centered :hide-footer="true">
            <add-product-modal @successAddProduct="successAddProduct" :product="selectedProduct"></add-product-modal>
        </b-modal>
    </div>
</template>

<script>
    import {mapState, mapActions} from "vuex"
    import InfiniteLoading from "vue-infinite-loading"
    import {GET_PRODUCTS} from "../../store/modules/products";
    import EventBus, {CATEGORY_SELECTED, UPDATE_PRODUCT_IMAGES} from "../../eventBus";
    import AddProductModal from "./AddProductModal";
    export default {
        name: "ProductGrid",
        components: {AddProductModal},
        comments: {InfiniteLoading},
        data() {
            return {
                orderBy: "most_buy",
                identifier: +new Date(),
                selectedProduct: null
            }
        },
        mounted() {
            EventBus.$on(CATEGORY_SELECTED, () => {
                 this.identifier += 1
            });
        },
        computed:{
            ...mapState('products',['total', 'products'])
        },
        methods: {
            async getProducts($state){
                const resp = await this.$store.dispatch('products/'+GET_PRODUCTS);
                if(resp) $state.loaded();
                else $state.complete();
                EventBus.$emit(UPDATE_PRODUCT_IMAGES);

            },
            addProduct(product){
                //SetProductOnModal
                this.selectedProduct = product;
                //OpenModal
                this.$bvModal.show("addProductModal");
            },
            successAddProduct(){
                console.log("Success ADD")
                this.$bvModal.hide('addProductModal')
            }
        }
    }
</script>
<style scoped>
    .product__item__text h5{
        display: inline;
    }
    .product__item__pic__hover a{
        cursor: pointer;
    }
</style>
