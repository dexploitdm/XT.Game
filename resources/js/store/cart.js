export const cartStore = {
    state: () => ({
        carts: [],
    }),

    actions: {
        async setCarts({ commit }, payload) {
            commit('loadCarts', payload);
        },
        async deleteItem({ commit }, payload) {
            commit('removeItemCarts', payload);
        },
    },

    mutations: {
        loadCarts: (state, payload) => {
            const game = {
                id: payload.id,
                title: payload.title,
                cover: payload.cover,
                price: payload.price,
                sale: payload.sale,
            }
            state.carts.push(game)
            localStorage.setItem('carts', JSON.stringify(state.carts));
        },
        removeItemCarts: (state, payload) => {
            state.carts.forEach(function(el, i) {
                if (el.id == payload) state.carts.splice(i, 1)
            })
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

