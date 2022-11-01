import Client from './Clients/AxiosClient';

export default {
    payment(rub) {
        return Client.post(`/api/payment/` + rub);
    }
};
