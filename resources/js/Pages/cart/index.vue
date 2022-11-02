<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import IconTrash from '~icons/fluent/delete-arrow-back-20-filled'
import {computed, onMounted, ref} from "vue";
import {useStore} from 'vuex'
const store = useStore()

const gameInCart = ref({})
const countActive = ref(0)
const totalActive = ref(0)
const isActivePay = ref(false)

let form = useForm({
    game_list: null,
    total_price: null,
    uid_payment: null
})

onMounted(async () => {
    await formatList()
})

const formatList = async () => {
    let storeList = await computed(() => store.getters.getCarts)
    let list = []
    if(storeList){
        storeList.value.forEach(function(item){
            const game = {check: true, data: item}
            list.push(game)
        })
    }
    gameInCart.value = list
    calcTotal()
}

const calcTotal = (e) => {
    let total = 0
    let count = 0
    gameInCart.value.forEach(function(item){
        if(item.check) {
            let price = item.data.price
            if(item.data.sale) {
                price = item.data.sale
            }
            total += price
            count += 1
        }

    })
    total > 0 ? isActivePay.value = true : isActivePay.value = false
    totalActive.value = total
    countActive.value = count
}
const checkGame = () => {
    calcTotal()
}
const priceFormat = (price, sale, rate) => {
    let totalPrice = price
    if(sale) {totalPrice = sale}
    return (totalPrice * rate).toFixed(2)
}
const salePercent = (price, sale) => {
    const percent = ((price - sale)/price) *100
    return percent.toFixed()
};
const deleteItemCart = async (id) => {
    await store.dispatch("deleteItem", id);
    await formatList()
}
const payment = async (rub) => {
    //Pay
    await store.dispatch("payment", rub);
    const payStatus = await store.getters.getPayStatus
    if(payStatus) {
        //Save Order
        const list = []
        gameInCart.value.forEach(function(item){
            if(item.check) {
               list.push(item.data)
            }
        })
        form.game_list = list
        form.total_price = totalActive.value + ' TL / ' + rub + 'рублей'
        form.uid_payment = payStatus
        await store.dispatch("clearCart");
        form.post('/lk/order')
    }
}
</script>

<template>
    <Head title="Покупайте игры по выгодной цене" />
    <BreezeMainLayout>

        <div class="bg-w page-layout">
            <div class="layout">
                <div class="layout-box">
                    <div class="xt-cart">
                        <h1 class="xt-title-1 dark">Выбраный список</h1>
                        <div class="xt-cart-box">
                            <div class="xt-cart-list">
                                <div class="xt-cart-list-item" v-for="item in gameInCart">
                                    <div class="xt-cart-list-check">
                                        <input type="checkbox" checked="checked" v-model="item.check" class="checkbox"  @change="checkGame()"/>
                                    </div>
                                    <div class="xt-cart-list-cover">
                                        <img :src="'/uploads/games/' + item.data.cover" :alt="item.data.title"/>
                                    </div>
                                    <div class="xt-cart-list-content">
                                        <div class="xt-cart-list-content_title">{{ item.data.title }}</div>
                                        <div class="xt-cart-list-content_price">{{ item.data.price }}
                                            <span :class="{ active: item.data.sale }">{{ item.data.price }} TRY</span>
                                            <span class="game-sale" v-if="item.data.sale">{{ item.data.sale }} TRY <span class="x-sale">- {{ salePercent(item.data.price, item.data.sale) }} %</span></span>
                                            / {{ priceFormat(item.data.price, item.data.sale, $inertia.page.props.rate) }} RU
                                        </div>

                                    </div>
                                    <div class="xt-cart-actions" @click="deleteItemCart(item.data.id)">
                                        <Icon-trash />
                                    </div>
                                </div>
                            </div>
                            <div class="xt-cart-info">
                                <div class="xt-cart-info-box">
                                    <div class="xt-cart-info-item">Количество: <span class="xt-cart-info-item_val">{{countActive}}</span></div>
                                    <div class="xt-cart-info-item">Общая сумма (TL): <span class="xt-cart-info-item_val">{{totalActive}} TL</span></div>
                                    <div class="xt-cart-info-item">К оплате: <span class="xt-cart-info-item_val">{{priceFormat(totalActive, null, $inertia.page.props.rate)}} RU</span></div>
                                    <label v-if="isActivePay" for="my-modal" class="xt-btn color-5">Оплатить</label>
                                    <input type="checkbox" id="my-modal" class="modal-toggle" />
                                    <div class="modal">
                                        <div class="modal-box">
                                            <div v-if="$page.props.auth.user">
                                                <h3 class="font-bold text-lg">Демо версия оплаты!</h3>
                                                <p class="py-4">Произойдет симуляция оплаты, так как сайт в тестовом режиме</p>
                                                <div class="modal-action">
                                                    <label for="my-modal" class="btn" @click="payment(priceFormat(totalActive, null, $inertia.page.props.rate))">Дальше</label>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <h3 class="font-bold text-lg">Прежде чем продолжить, пожалуйста авторизуйтесь!</h3>
                                                <p class="py-4">Все выбраные игры останутся здесь после авторизации.</p>
                                                <div class="modal-action">
                                                    <label for="my-modal" class="btn">Ок!</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="xt-cart-info-desc">
                                    <p>После оплаты Вас перекинет на страницу заказов, где Вы сможете получить купленые коды, когда заказ будет обработан и готов.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>









    </BreezeMainLayout>
</template>
