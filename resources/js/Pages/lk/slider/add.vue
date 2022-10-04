<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import {computed, onMounted, ref, watch} from 'vue'
import { Inertia } from "@inertiajs/inertia";
import SearchGames from '@/Components/selections/SearchSelectionGames.vue';

let form = useForm({
    cover: null,
    game_id: null
})

const getCover = () => {
    let cover = '/uploads/selection/preview.jpg'
    if(form.cover) {
        if(form.cover.indexOf('base64') !== -1 ) {
            cover = form.cover
        } else {
            cover = '/uploads/selection/' + form.cover
        }
    }
    return cover
}

const updateCover = (e) => {
    let file = e.target.files[0];
    let reader = new FileReader();
    let limit = 1024 * 1024 * 2;
    if(file['size'] > limit) {
        return false
    }
    reader.onloadend = (file) => {
        form.cover = reader.result;
    }
    reader.readAsDataURL(file);
}

const saveSlider = () => {
    form.post('/lk/slider')
}
const getIDs = (e) => {
    if(e[0]) {
        form.game_id = e[0].id
    }
}
</script>
<template>
    <Head title="Добавить категорию" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Добавить подборку игр
                <pre>
                    {{ form.game_id }}
                </pre>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        поиск игр

                        <div>
                            <SearchGames v-on:ids="getIDs"/>
                        </div>


                        <img :src="getCover()" src="" >

                        <input type="file" @change="updateCover" />


                        <button type="button" @click="saveSlider()">save</button>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

