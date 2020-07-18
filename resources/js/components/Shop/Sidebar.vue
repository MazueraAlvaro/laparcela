<template>
    <div class="sidebar">
        <div class="sidebar__item">
            <h4>Categorias</h4>
            <ul>
                <li v-for="item in categories" :key="item.id">
                    <a
                        v-text="item.name"
                        :style="{'font-weight': (item.id === activeCategory) ? '600' : 'lighter' }"
                        @click="displayCategory(item.id)"
                    ></a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {mapState, mapMutations} from  "vuex";
    import {SET_CATEGORY} from "../../store/mutation-types";
    import {GET_PRODUCTS} from "../../store/modules/products";
    import EventBus, {CATEGORY_SELECTED, UPDATE_PRODUCT_IMAGES} from "../../eventBus";

    export default {
        name: "Sidebar",
        data(){
            return {

            }
        },
        computed: {
            ...mapState(["categories", "activeCategory"]),
        },
        methods: {
            async displayCategory(catId){
                this.$store.commit(SET_CATEGORY, catId);
                // await this.$store.dispatch('products/'+GET_PRODUCTS);
                EventBus.$emit(CATEGORY_SELECTED);
                EventBus.$emit(UPDATE_PRODUCT_IMAGES);
            }
        }
    }
</script>

<style scoped>
    .sidebar a{
        cursor: pointer;
    }
</style>
