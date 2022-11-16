<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { ref, watch } from 'vue'
import { Inertia } from "@inertiajs/inertia";
import SearchSelectionGames from '@/Components/selections/SearchSelectionGames.vue';

const props = defineProps({
    selection: Array,
    listSelectGame: Array
})

let form = useForm({
    id: props.selection.id,
    title: props.selection.title,
    cover: props.selection.cover,
    game_ids: props.selection.game_ids
})

const getCover = () => {
    let cover = '/uploads/selection/preview.jpg'
    if(form.cover) {
        console.log(form.cover)
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

const getIDs = (e) => {
    form.game_ids = e
}

const saveSelection = () => {
    Inertia.post(`/lk/selection/${props.selection.id}`, {
        _method: 'put',
        id: form.id,
        title: form.title,
        cover: form.cover,
        game_ids: form.game_ids
    })
}
</script>
<template>
    <Head title="Добавить категорию" />
    <BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="xt-lk-title">Редактирование подборки</div>
                        <div class="xt-form">
                            <div class="x-form-control">
                                <label>Название сборника</label>
                                <input type="text" class="x-input x-input-border" v-model="form.title"  placeholder="Название"/>
                            </div>
                            <div class="x-form-control x-form-control_upload full m-auto">
                                <label>Обложка</label>
                                <img :src="getCover()" src="" >
                                <input type="file" @change="updateCover" />
                            </div>
                            <div class="x-form-control">
                                <label>Выберите игры</label>
                                <SearchSelectionGames v-on:ids="getIDs" :list="listSelectGame"/>
                            </div>
                        </div>
                        <button class="xt-btn color-10" @click="saveSelection()">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
