<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import {computed, onMounted, ref} from "vue";
import { useStore } from 'vuex'
const store = useStore()

const props = defineProps({
    id: Number
})

const game = computed(() => store.getters.getGameItem)

onMounted(async () => {
    await store.dispatch("getGameItem", props.id);
})


</script>

<template>
    <Head title="Game" />
    <BreezeMainLayout>
       this {{ props.id }}

        <div class="container bg-w" style="margin-top: 50px;">
            <div>{{ game.title }}</div>
<!--            <div :style="'background-image: url(/uploads/games/'+ game.cover +')'"></div>-->
            <img :src="'/uploads/games/' + game.cover" style="max-width: 200px">
            <div v-html="game.content"></div>

        </div>



    </BreezeMainLayout>
</template>
