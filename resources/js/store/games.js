import Repository from "@/repositories/RepositoryFactory";
const GameRepository = Repository.get("games");

export const gamesStore = {
    state: () => ({
        lists: [],
        page: 1,
        last_page: 1
    }),

    actions: {
        async getGames({state, commit }, payload) {
            commit('loadGames', await GameRepository.get(state.page, payload))
        },

        selectPage ({ commit }, data) {
            commit('setPage', data)
        },
        clearGames ({ commit }) {
            commit('setClear')
        },
    },

    mutations: {
        setClear (state) {
            state.lists = []
        },
        setPage (state, page) {
            state.page = page
        },
        loadGames: (state, res) => {
            console.log(res)
            state.page = res.data.current_page
            state.last_page = res.data.last_page
            const { data } = res.data;
            let arr = []
            const prevData = state.lists
            if(prevData.length > 0) {
                for (let i = 0; i < prevData.length; i++) {
                    arr.push(prevData[i])
                }
            }
            for (let i = 0; i < data.length; i++) {
                    arr.push(data[i])
            }
            state.lists = arr
        },

    },

    getters: {
        getGamesStore( state ){
            return state.lists;
        },
        getPage( state ){
            return state.page;
        },
        getLastPage( state ){
            return state.last_page;
        }
    }
}
