import Client from './Clients/AxiosClient';

export default {
    payment(rub) {
        return Client.post(`/user/payment/` + rub);
    },
    getOrdersUser() {
        return Client.get(`/user/get_orders`);
    },
    search(data) {
        return Client.get(`/lk/search_order?search=${data}`);
    },
};
