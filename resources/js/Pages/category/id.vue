<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import {computed, onDeactivated, onMounted, ref} from "vue";
import LoaderBox from '@/Components/LoaderBox.vue';
import GameCard from '@/Components/games/GameCard.vue';
import { useStore } from 'vuex'
const store = useStore()

const props = defineProps({
    id: Number
})

const games = computed(() => store.getters.getGamesStore)
const category = computed(() => store.getters.getCategoryItem)

onMounted(async () => {
    await store.dispatch("clearGames");
    await store.dispatch("selectPage", 1);
    await store.dispatch("getGamesCategory", props.id);
    window.addEventListener('scroll', handleScroll);
})

onDeactivated(async () => {
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
       this {{ props.id }} / {{ category }}

        <div class="container bg-w" style="margin-top: 50px;">

            <div class="game-list">
                <div class="game-list-item" v-for="item in games"  data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                    <GameCard :game="item"/>
                </div>

            </div>

            <LoaderBox v-if="Loader"/>

        </div>



    </BreezeMainLayout>
</template>
