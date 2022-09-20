<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import {computed, onDeactivated, onMounted, onUnmounted, ref} from "vue";
import LoaderBox from '@/Components/LoaderBox.vue';
import GameCard from '@/Components/games/GameCard.vue';
import GameCategories from '@/Components/games/GameCategory.vue';
import { useStore } from 'vuex'
const store = useStore()

const props = defineProps({
    id: String
})

const games = computed(() => store.getters.getGamesStore)
const category = computed(() => store.getters.getCategoryItem)

let isLoad = ref(true)
let Loader = ref(true)
let isViewSale = ref(false)

onMounted(async () => {
    await store.dispatch("clearGames");
    await store.dispatch("selectPage", 1);
    await store.dispatch("getGamesCategory", props.id);
    window.addEventListener('scroll', handleScroll);
    if(store.getters.getLastPage === store.getters.getPage) {
        Loader.value = false
    }
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
})

const handleScroll = (event) => {
    if (Math.round(window.scrollY) + window.innerHeight >= (document.body.scrollHeight - 700)) {
        if(isLoad.value){
            isLoad.value = false
            setTimeout(limitTimeLoad, 3500);
            if(store.getters.getLastPage > store.getters.getPage) {
                let page = store.getters.getPage + 1
                store.dispatch("getGamesCategory", props.id);
            } else {
                Loader.value = false
            }
        }
    }
}

const limitTimeLoad = () => {
    isLoad.value = true
};

</script>

<template>
    <Head title="Game" />
    <BreezeMainLayout>

        <div class="container cat-games">
            <div class="container-box">

                <div class="cat-games-title">{{ category }}</div>
                <div class="game-list">
                    <div class="game-list-item" v-for="item in games"  data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                        <GameCard :game="item"/>
                    </div>
                </div>
            </div>

            <LoaderBox v-if="Loader"/>

            <GameCategories />

        </div>

    </BreezeMainLayout>
</template>
