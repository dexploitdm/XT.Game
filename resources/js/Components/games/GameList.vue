<script setup>
import {onMounted, onUnmounted, computed, onDeactivated, ref} from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import LoaderBox from '@/Components/LoaderBox.vue';
import GameCard from '@/Components/games/GameCard.vue';
import SaleCheckbox from '@/Components/Checkbox.vue';
import { useStore } from 'vuex'
import Repository from "@/repositories/RepositoryFactory";
const GameRepository = Repository.get("games");
const store = useStore()

const games = computed(() => store.getters.getGamesStore)

onMounted(async () => {
    await store.dispatch("clearGames");
    await store.dispatch("getGames", { self: this });
    window.addEventListener('scroll', handleScroll);
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
})

let isLoad = ref(true)
let Loader = ref(true)
let isViewSale = ref(false)

const handleScroll = (event) => {
    if (Math.round(window.scrollY) + window.innerHeight >= (document.body.scrollHeight - 700)) {
        if(isLoad.value){
            isLoad.value = false
            setTimeout(limitTimeLoad, 3500);
            if(store.getters.getLastPage > store.getters.getPage) {
                moreGames()
            } else {
                Loader.value = false
            }
        }
    }
}

const limitTimeLoad = () => {
    isLoad.value = true
};

const moreGames = async () => {
    let page = store.getters.getPage + 1
    await store.dispatch("selectPage", page);
    await getSelectGames()
}

const getSelectGames = async () => {
    let payload = { self: this }
    if(isViewSale.value) {
        payload = 'sale'
    }
    await store.dispatch("getGames", payload);
}

const checkSale = async () => {
    await store.dispatch("clearGames");
    await store.dispatch("selectPage", 1);
    await getSelectGames()
}

</script>
<template>
    <div class="container">
        <div class="container-box">
            <label class="x-game-sale flex items-center bg-w">
                <SaleCheckbox name="remember" v-model:checked="isViewSale" @update:checked="checkSale"/>
                <span class="ml-2 text-sm text-gray-600">Показывать только со скидкой</span>
            </label>
        </div>
        <div class="container-box">

            <div class="game-list">
                <div class="game-list-item" v-for="item in games"  data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <GameCard :game="item"/>
                </div>

            </div>

            <LoaderBox v-if="Loader"/>

        </div>
    </div>
</template>
