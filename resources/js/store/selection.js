import Repository from "@/repositories/RepositoryFactory";
const SelectionRepository = Repository.get("selection");

export const selectionStore = {
    state: () => ({
        lists: [],
        selection: []
    }),

    actions: {
        async getSelections({ commit }) {
            commit('loadSelections', await SelectionRepository.get());
        },
        async getSelectionItem({ commit }, id) {
            commit('loadGameSelection', await SelectionRepository.getSelectionItem(id));
        },
    },

    mutations: {
        loadSelections: (state, res) => {
            state.lists = res.data
        },
        loadGameSelection: (state, res) => {
            state.selection = res.data
        },

    },

    getters: {
        getSelectionStore( state ){
            return state.lists;
        },
        getSelectionGames( state ){
            return state.selection;
        },
    }
}

