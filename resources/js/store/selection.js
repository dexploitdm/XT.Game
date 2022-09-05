import Repository from "@/repositories/RepositoryFactory";
const SelectionRepository = Repository.get("selection");

export const selectionStore = {
    state: () => ({
        lists: [],
        select: []
    }),

    actions: {
        async getSelections({commit }) {
            commit('loadSelections', await SelectionRepository.get());
        },
    },

    mutations: {
        loadSelections: (state, res) => {
            state.lists = res.data
        },

    },

    getters: {
        getSelectionStore( state ){
            return state.lists;
        },
    }
}

