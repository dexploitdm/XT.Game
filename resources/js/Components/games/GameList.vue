<script setup>
import {onMounted, computed, onDeactivated, ref} from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import LoaderBox from '@/Components/LoaderBox.vue';
import GameCard from '@/Components/games/GameCard.vue';
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
</script>
<template>
    <div class="container">
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
