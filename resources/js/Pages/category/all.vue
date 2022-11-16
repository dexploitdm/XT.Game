<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import {onMounted, onUnmounted, computed, onDeactivated, ref} from 'vue';
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
    <Head title="Game" />
    <BreezeMainLayout>
        <div class="layout cat-games">
            <div class="layout-box layout-box_x1">
                <label class="x-game-sale flex items-center bg-w">
                    <input type="checkbox" checked="checked" v-model="isViewSale" class="checkbox"  @change="checkSale()"/>
                    <span class="ml-2 text-sm text-gray-600">Показывать только со скидкой</span>
                </label>
                <div class="game-list">
                    <div class="game-list-item" v-for="item in games"  data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        <GameCard :game="item"/>
                    </div>

                </div>

                <LoaderBox v-if="Loader"/>
            </div>
        </div>
    </BreezeMainLayout>
</template>
