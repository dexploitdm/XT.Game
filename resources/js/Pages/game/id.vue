<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import SelectionList from '@/Components/selections/SelectionList.vue';
import LoaderBox from '@/Components/LoaderBox.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';
import {computed, onMounted, onUnmounted, ref} from "vue";
import {useStore} from 'vuex'

const store = useStore()

const props = defineProps({
    id: String
})

const game = computed(() => store.getters.getGameItem)
const gameInCart = computed(() => store.getters.getCarts)

onMounted(async () => {
    await store.dispatch("getGameItem", props.id);
})

onUnmounted(async () => {
    await store.dispatch("clearGameItem");
})

const salePercent = (price, sale) => {
    const percent = ((price - sale)/price) *100
    return percent.toFixed()
};

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
    <Head title="Game"/>
    <BreezeMainLayout>

        <div class="bg-w single-game-box">

            <div class="layout">
                <div class="layout-box">

                    <div class="single-game-layout">
                        <div v-if="game.cover" class="single-game">
                            <div class="single-game-cover">
                                <img :src="'/uploads/games/' + game.cover">
                            </div>
                            <div class="single-game-content">
                                <div class="single-game-content_title">{{ game.title }}</div>
                                <div class="single-game-content_desc" v-html="game.desc"></div>
                                <div class="single-game-content_text" v-html="game.content"></div>
                                <div class="single-game-info">
                                    <div class="single-game-info_price">
                                        <span :class="{ active: game.sale }">{{ game.price }} TRY</span>
                                        <span class="game-sale" v-if="game.sale">{{ game.sale }} TRY <span class="x-sale">- {{ salePercent(game.price, game.sale) }} %</span></span>
                                        / {{ priceFormat(game.price, game.sale, $inertia.page.props.rate) }} RU
                                    </div>
                                    <Link v-if="isCart(game.id)" :href="route('cart')">
                                        <button class="xt-btn color-8">Перейти к оформлению</button>
                                    </Link>
                                    <button v-else type="button" class="xt-btn color-3" @click="addToCart(game)">Добавить в корзину</button>
                                </div>

                            </div>
                        </div>
                        <div v-else class="single-game-load">
                            <LoaderBox  />
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <SelectionList/>

    </BreezeMainLayout>
</template>
