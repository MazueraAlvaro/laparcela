export const APPEND_PRODUCTS = "appendProducts";
export const GET_PRODUCTS = "getProducts";
export const INCREMENT_PAGE = "incrementPage";
export default {
    namespaced: true,
    state: () => ({
        products: [],
        page: 0,
        total: 0
    }),
    mutations: {
        setProducts: (state, products) => state.products = products,
        [APPEND_PRODUCTS]: (state, products) => state.products.push(...products),
        [INCREMENT_PAGE] : (state) => state.page++
    },
    actions: {
        [GET_PRODUCTS]: async ({commit, state, rootState, dispatch}) => {
            try {
                const {data} = await axios.get(`/api/category/${rootState.activeCategory}/products`, {params: {page: state.page + 1}})
                commit(INCREMENT_PAGE);
                state.total = data.meta.total;
                commit(APPEND_PRODUCTS, data.data);
                return data.data.length > 0;
            }
            catch (e) {
                const timeout = new Promise((res, rej) => setTimeout( resolve(dispatch(GET_PRODUCTS)), 1000))
                return await timeout;
            }
        }
    }
}
