<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import {useStore} from 'vuex'
import {computed} from "vue";

const store = useStore()

const props = defineProps({
    game: Object
})

const gameInCart = computed(() => store.getters.getCarts)

const salePercent = (price, sale) => {
    const percent = ((price - sale)/price) *100
    return percent.toFixed()
};

const reduction = (text, length, suffix) => {
    if (text.length > length) {
        return text.substring(0, length) + suffix;
    } else {
        return text;
    }
}

const priceFormat = (price, sale, rate) => {
    let totalPrice = price
    if(sale) {totalPrice = sale}
    return (totalPrice * rate).toFixed(2)
}

const addToCart = async (data) => {
    await store.dispatch("setCarts", data);
    isCart(data.id)
}
const isCart = (id) => {
    return gameInCart.value.some(item => item.id === id);
}
</script>
<template>
    <div class="game-list-cover">
        <Link :href="route('show', game.id)" class="game-list-cover-img" :style="'background-image: url(/uploads/games/'+ game.cover +')'"></Link>
    </div>
    <div class="game-list-info">
        <div class="game-list-info-title">
            <Link :href="route('show', game.id)">
                {{ game.title }}
            </Link>
        </div>
        <div class="game-list-info-desc" v-html="reduction(game.desc, 140, '....')"></div>
        <div class="game-list-bottom">
            <div class="game-list-price">
                <span :class="{ active: game.sale }">{{ game.price }} TRY</span>
                <span class="game-sale" v-if="game.sale">{{ game.sale }} TRY <span class="x-sale">- {{ salePercent(game.price, game.sale) }} %</span></span>
                / {{ priceFormat(game.price, game.sale, $inertia.page.props.rate) }} RU
            </div>
            <div class="game-list-pay">
                <Link v-if="isCart(game.id)" :href="route('cart')">
                    <button class="xt-btn color-8">В корзине</button>
                </Link>
                <button v-else class="xt-btn color-2" @click="addToCart(game)">В корзину</button>
            </div>
        </div>
    </div>
</template>
