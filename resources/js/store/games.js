export const gamesStore = {
    state: () => ({
        lists: [],
        activeIndex: 1,
        activeSong: {},
        status: 'paused'
    }),

    actions: {
        addLists ({ commit }, data) {
            commit('setGames', {data})
        },
    },

    mutations: {
        setGames (state, pack) {
            state.lists = pack
        },

    },

    getters: {
        getGamesStore( state ){
            return state.lists;
        }
    }
}
