import Repository from "@/repositories/RepositoryFactory";
const GameRepository = Repository.get("games");

export const gamesStore = {
    state: () => ({
        lists: [],
        page: 1,
        last_page: 1,
        categories: [],
        category_item: []
    }),

    actions: {
        async getGames({ state, commit }, payload) {
            commit('loadGames', await GameRepository.get(state.page, payload))
        },
        selectPage ({ commit }, data) {
            commit('setPage', data)
        },
        async categoriesList ({ state, commit }) {
            if(state.categories.length === 0) {
                commit('loadCategories', await GameRepository.getCategories())
            }
            commit('setPage')
        },
        async getGamesCategory({ state, commit }, id) {
            const info = await GameRepository.getGamesCategory(state.page, id)
            commit('loadGames', info.data)
            commit('setCategory', info.data )
        },
        clearGames ({ commit }) {
            commit('setClear')
        },
    },

    mutations: {
        loadGames: (state, res) => {
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
        setPage (state, page) {
            state.page = page
        },
        loadCategories (state, res) {
            state.categories = res.data
        },
        setCategory (state, payload) {
            state.category_item = payload.data.title
        },
        setClear (state) {
            state.lists = []
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
        },
        getCategories( state ){
            return state.categories;
        },
        getCategorySelect( state ){
            return state.selectCategory;
        }
    }
}
