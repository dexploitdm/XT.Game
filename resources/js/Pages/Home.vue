<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import SliderHome from '@/Components/slider/SliderHome.vue';
import GameList from '@/Components/games/GameList.vue';
import SelectionList from '@/Components/selections/SelectionList.vue';
import GameCategories from '@/Components/games/GameCategory.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';



</script>

<template>
    <Head title="Покупайте игры по выгодной цене" />
    <BreezeMainLayout>

        <SliderHome />

        <SelectionList />

        <GameCategories />

        <GameList />

    </BreezeMainLayout>
</template>
