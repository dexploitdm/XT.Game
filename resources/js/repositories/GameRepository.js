import Client from './Clients/AxiosClient';
const resource = '/posts';

export default {
    get(id, select) {
        return Client.get(`/api/get_all_games?page=${id}&select=${select}`);
    },
    search(data) {
        return Client.get(`/api/search?search=${data}`);
    },
    getCategories() {
        return Client.get('/api/get_categories');
    },
    getGamesCategory(page, id) {
        return Client.get(`/api/get_cat_games/${id}?page=${page}`);
    },

    // MANY OTHER ENDPOINT RELATED STUFFS
};
