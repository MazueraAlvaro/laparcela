export const ORDER_FROM_CART = "getOrderFromShoppingCart";
export const ORDER_MYSELF = "getMyOrder";
export const ORDER_NUMBER_GETTER = "getOrderNumber_";
export const ORDER_DEFAULT_NUMBER = "0000000";

export default {
    namespaced: true,
    state: () => ({
        order: null
    }),
    mutations: {
        setOrder: (state, order) => {
            state.order = order;
        }
    },
    getters: {
        [ORDER_NUMBER_GETTER]: (state) => {
            return (state.order) ? state.order.number : ORDER_DEFAULT_NUMBER;
        }
    },
    actions: {
        [ORDER_FROM_CART]: async ({commit, state}) => {
           const {data} = await axios.post("/api/order/fromCart");
           commit("setOrder", data.data);
        },
        [ORDER_MYSELF] : async ({commit}) => {
            try{
                const {data} = await axios.get("/api/order/1");
                commit("setOrder", data.data);
            }catch (e) {
                // await router.push({name:'shop'})
            }
        }
    }
}
