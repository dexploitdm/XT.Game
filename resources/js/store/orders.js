import Repository from "@/repositories/RepositoryFactory";
const OrderRepository = Repository.get("order");
export const ordersStore = {
    state: () => ({
        list_user: []
    }),

    actions: {
        async getOrders({ commit }) {
            commit('ordersUser', await OrderRepository.getOrdersUser())
        },

    },

    mutations: {
        clear_all: (state) => {
            state.carts = []
            localStorage.removeItem("carts")
        },
        ordersUser: (state, res) => {
            state.list_user = res
        },
    },

    getters: {
        getListUser( state ){
            return state.list_user;
        },
    }
}

