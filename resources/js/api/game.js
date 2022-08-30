export default axios => ({
    // forgotPassword(email) {
    //     return axios.post("/auth/password/forgot", { email });
    // },
    //
    // login(email, password) {
    //     return axios.post("/auth/login", { email, password });
    // },

    getLists() {
        return axios.get("/api/get_all_games");
    },
    //
    // register(payload) {
    //     return axios.post("/auth/register", payload);
    // },
    //
    // resetPassword(password, passwordConfirmation, resetToken) {
    //     return axios.post("/auth/password/reset", {
    //         password: password,
    //         password_confirmation: passwordConfirmation,
    //         token: resetToken
    //     });
    // }
});
