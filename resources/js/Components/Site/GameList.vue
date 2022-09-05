<script setup>
import {onMounted, computed, onDeactivated, ref} from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import LoaderBox from '@/Components/LoaderBox.vue';
import { useStore } from 'vuex'
import Repository from "@/repositories/RepositoryFactory";


const GameRepository = Repository.get("games");
const store = useStore()

const games = computed(() => store.getters.getGamesStore)

onMounted(async () => {
    await store.dispatch("getGames", { self: this });
    window.addEventListener('scroll', handleScroll);
})

onDeactivated(async () => {
    window.removeEventListener('scroll', handleScroll);
})

let isLoad = ref(true)
let Loader = ref(true)

const handleScroll = (event) => {
    //TODO: Считать погрешность
    if (Math.round(window.scrollY) + window.innerHeight >= (document.body.scrollHeight - 700)) {
        if(isLoad.value){
            isLoad.value = false
            setTimeout(limitTimeLoad, 3500);
            if(store.getters.getLastPage > store.getters.getPage) {
                let page = store.getters.getPage + 1
                store.dispatch("selectPage", page);
                store.dispatch("getGames", { self: this });
            } else {
                Loader.value = false
            }
        }
    }
}

const limitTimeLoad = () => {
    isLoad.value = true
};

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
    <div class="container">
        <div class="container-box">

            <div class="game-list">

                <div class="game-list-item" v-for="item in games"  data-aos="fade-up" data-aos-anchor-placement="top-bottom">

                    <div class="game-list-cover">
                        <Link :href="route('show', item.id)" class="game-list-cover-img" :style="'background-image: url(/uploads/games/'+ item.cover +')'">

                        </Link>
                    </div>
                    <div class="game-list-info">
                        <div class="game-list-info-title">
                            <Link :href="route('show', item.id)">
                                {{ item.title }}
                            </Link>
                        </div>
                        <div class="game-list-info-desc" v-html="reduction(item.desc, 140, '....')"></div>
                        <div class="game-list-bottom">
                            <div class="game-list-price">
                                <span :class="{ active: item.sale }">{{ item.price }} TRY</span>
                                <span class="game-sale" v-if="item.sale">{{ item.sale }} TRY <span class="x-sale">- {{ salePercent(item.price, item.sale) }} %</span></span>
                                / {{ priceFormat(item.price, item.sale, $inertia.page.props.rate) }} RU
                            </div>
                            <div class="game-list-pay">
                                <button class="xt-btn color-2">В корзину</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <LoaderBox v-if="Loader"/>

        </div>
    </div>
</template>
