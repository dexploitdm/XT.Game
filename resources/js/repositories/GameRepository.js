import Client from './Clients/AxiosClient';
const resource = '/posts';

export default {
    get(id) {
        return Client.get(`/api/get_all_games?page=${id}`);
    },
    search(data) {
        return Client.get(`/api/search?search=${data}`);
    },

    // MANY OTHER ENDPOINT RELATED STUFFS
};
