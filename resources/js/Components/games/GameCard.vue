<script setup>
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    game: Array
})

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
                <button class="xt-btn color-2">В корзину</button>
            </div>
        </div>
    </div>
</template>
