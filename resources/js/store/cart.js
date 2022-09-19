export const cartStore = {
    state: () => ({
        carts: [],
    }),

    actions: {
        async setCarts({ commit }, payload) {
            commit('loadCarts', payload);
        },
    },

    mutations: {
        loadCarts: (state, payload) => {
            const game = {
                id: payload.id,
                title: payload.title,
                cover: payload.cover
            }
            state.carts.push(game)
            localStorage.setItem('carts', JSON.stringify(state.carts));
        },

    },

    getters: {
        getCarts( state ){
            if(state.carts.length === 0 && localStorage.getItem('carts')) {
                state.carts = JSON.parse(localStorage.getItem('carts'))
            }

            return state.carts;
        },
    }
}
