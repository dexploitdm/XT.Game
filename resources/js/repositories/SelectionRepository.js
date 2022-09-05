import Client from './Clients/AxiosClient';

export default {
    get() {
        return Client.get(`/api/get_selections`);
    },
    getSelectionItem(id) {
        return Client.get(`get_selection/${id}`);
    }
};
