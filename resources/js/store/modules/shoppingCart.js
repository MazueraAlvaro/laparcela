import products from "./products";

export const SC_RETRIEVE = "retrieveShoppingCartProducts";
export const SC_SET_PRODUCTS = "setShoppingCartProducts";
export const SC_GET_Q_PRODUCTS = "getTotalShoppingCartProducts";
export const SC_GET_TOTAL_F = "getTotalShoppingCartFormatted";
export const SC_ADD_PRODUCT = "addProductToShoppingCart";
export const SC_GET_PRODUCTS = "getShoppingCartProducts";
export const SC_CHANGE_PRODUCT_QTY = "changeShoppingCartProductQuantity";
export const SC_UPDATE_PRODUCT_QTY = "updateShoppingCartProductQuantity";
export const SC_DELETE_PRODUCT = "deleteShoppingCartProduct";
export default {
    namespaced: true,
    state: () => ({
        cart: {
            formatted_total: "$0"
        },
        modified: false
    }),
    mutations: {
        [SC_SET_PRODUCTS]: (state, products) => {
            state.products = products;
        },
        [SC_CHANGE_PRODUCT_QTY]: (state, product) => {
            const index = state.cart.products.findIndex(_product => product.id === _product.id);
            if(index !== -1)
                Vue.set(state.cart.products, index, product)
        },
        [SC_DELETE_PRODUCT] : (state, product) => {
            state.cart.products = state.cart.products.filter(pro => pro.id !== product);
        }
    },
    getters:{
        [SC_GET_Q_PRODUCTS]: (state) => (state.cart.products) ? state.cart.products.length : 0,
        [SC_GET_TOTAL_F]: (state) => {
            if(!state.modified)
                return state.cart.formatted_total;
            const total = state.cart.products.reduce((total, product) => total + (product.quantity * product.price),0)
            return "$" + new Intl.NumberFormat('de-DE',
                {useGrouping: true, minimumFractionDigits: 2})
                .format(total);
        },
        [SC_GET_PRODUCTS]: (state) => (state.cart.products) ? state.cart.products : [],
    },
    actions: {
        [SC_RETRIEVE]: async ({state, dispatch}) => {
            try {
                const {data} = await axios.get("/api/shoppingCart");
                state.cart = data.data;
            }
            catch (e) {
                setTimeout(dispatch, 1000, SC_RETRIEVE)
            }
        },
        [SC_ADD_PRODUCT]: ({state, dispatch}, data) => {
            return axios.post(`/api/shoppingCart/${state.cart.id}/products`, data);
        },
        [SC_UPDATE_PRODUCT_QTY]: async ({state, commit}, product) => {
            return new Promise(async (resolve, reject) => {
                try{
                    const {data} = await axios.put(`/api/shoppingCart/${state.cart.id}/products/${product.id}`, {quantity: product.quantity})
                    commit(SC_CHANGE_PRODUCT_QTY, data.data);
                    resolve("Carrito actualizado exitosamente");
                    state.modified = true;
                }catch (e) {
                    reject("Sucedió un error al actualizar el carro de compras")
                }
            });
        },
        [SC_DELETE_PRODUCT] : async ({state, commit}, id) => {
            return new Promise(async (resolve, reject) => {
                try {
                    await axios.delete(`/api/shoppingCart/${state.cart.id}/products/${id}`);
                    commit(SC_DELETE_PRODUCT, id)
                    resolve("Producto eliminado del carro de compras exitosamente");
                    state.modified = true;
                }
                catch (e) {
                    reject("Hubo un problema actualizando el carro de compras")
                }
            })
        }
    }
}
