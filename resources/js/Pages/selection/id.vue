<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import GameCard from '@/Components/games/GameCard.vue';
import SelectionList from '@/Components/selections/SelectionList.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';
import {computed, onMounted, ref} from "vue";
import {useStore} from "vuex";

const store = useStore()

const props = defineProps({
    id: String
})

const selection = computed(() => store.getters.getSelectionGames)

onMounted(async () => {
    await store.dispatch("getSelectionItem", props.id);
})
</script>

<template>
    <Head title="Game"/>
    <BreezeMainLayout>
        <div class="layout cat-games">
            <div class="layout-box">
                <div v-if="selection.data" class="cat-games-title">{{ selection.data.title }}</div>
                <div class="game-list">
                    <div class="game-list-item" v-for="item in selection.listSelectGame" data-aos="fade-up"
                         data-aos-anchor-placement="top-bottom">
                        <GameCard :game="item"/>
                    </div>
                </div>
            </div>
        </div>
        <SelectionList/>
    </BreezeMainLayout>
</template>
