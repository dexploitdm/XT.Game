<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import ScreenOne from '@/Components/other/ScreenOne.vue';
import SelectionList from '@/Components/selections/SelectionList.vue';
import GameCategories from '@/Components/games/GameCategory.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';



</script>

<template>
    <Head title="Покупайте игры по выгодной цене" />
    <BreezeMainLayout>

        <ScreenOne />

        <SelectionList />

        <GameCategories />

    </BreezeMainLayout>
</template>
