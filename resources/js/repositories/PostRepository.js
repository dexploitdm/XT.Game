import Client from './Clients/AxiosClient';
const resource = '/posts';

export default {
    get() {
        return Client.get(`/api/get_all_games`);
    },
    getPost(id) {
        return Client.get(`${resource}/${id}`);
    },
    create(payload) {
        return Client.post(`${resource}`, payload);
    },
    update(payload, id) {
        return Client.put(`${resource}/${id}`, payload);
    },
    delete(id) {
        return Client.delete(`${resource}/${id}`)
    },

    // MANY OTHER ENDPOINT RELATED STUFFS
};
