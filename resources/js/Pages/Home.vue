<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import SliderHome from '@/Components/slider/SliderHome.vue';
import GameList from '@/Components/games/GameList.vue';
import SelectionList from '@/Components/selections/SelectionList.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';



</script>

<template>
    <Head title="Покупайте игры по выгодной цене" />
    <BreezeMainLayout>


        <SliderHome />

        <SelectionList />

        <GameList />


        <div class="container bg-w" style="margin-top: 50px;">
            <div>Игры</div>

            <div class="buttons" style="max-width: 700px; margin: auto;">
                <button class="xt-btn color-1">Приобрести</button>



                <button class="xt-btn color-1">BUTTON</button>
                <button class="xt-btn color-2">BUTTON</button>
                <button class="xt-btn color-3">BUTTON</button>
                <button class="xt-btn color-4">BUTTON</button>
                <button class="xt-btn color-5">BUTTON</button>

                <button class="xt-btn color-7">BUTTON</button>
                <button class="xt-btn color-8">BUTTON</button>
                <button class="xt-btn color-9">BUTTON</button>
                <button class="xt-btn color-10">BUTTON</button>
                <button class="xt-btn color-11">BUTTON</button>
            </div>

        </div>



    </BreezeMainLayout>
</template>
