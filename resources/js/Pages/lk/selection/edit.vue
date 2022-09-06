<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { onMounted, ref, watch } from 'vue'
import { Inertia } from "@inertiajs/inertia";
import Repository from "@/repositories/RepositoryFactory";
const GameRepository = Repository.get("games");

const props = defineProps({
    selection: Array,
    listSelectGame: Array
})


const selectGame = ref([])

let form = useForm({
    id: props.selection.id,
    title: props.selection.title,
    cover: props.selection.cover,
    game_ids: selectGame.value
})

onMounted(async () => {
    const jsonObj = JSON.parse('[' + props.selection.game_ids + ']');
    selectGame.value = jsonObj[0]
})

let search = ref('');
let games = ref({});


watch(search, (value) => {
    // Inertia.get(
    //     "/lk/selection/create",
    //     { search: value },
    //     {
    //         preserveState: true,
    //     }
    // );
    getSearch(value);
});

const getSearch = async (key) => {
    let response = await GameRepository.search(key)
    games.value = response.data
}

const setGame = (id) => {
    selectGame.value.push({id})
}

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

const saveSelection = () => {
    Inertia.post(`/lk/selection/${props.selection.id}`, {
        _method: 'put',
        id: form.id,
        title: form.title,
        cover: form.cover,
        game_ids: selectGame.value
    })
}

</script>
<template>
    <Head title="Добавить категорию" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Добавить категорию
                <pre>
                    {{selectGame}}
                </pre>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        form

                        <input
                            type="text"
                            v-model="search"
                            placeholder="Search..."
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 p-2.5 "
                        />

                        <input type="text" class="" v-model="form.title" />


                        <img :src="getCover()" src="" >

                        <input type="file" @change="updateCover" />


                        <div style="padding: 40px 0;">
                            <div  v-for="item in games.data">
                                <div @click="setGame(item.id)">Выбрать: {{ item.title }}</div>
                            </div>
                        </div>




                        <button type="button" @click="saveSelection()">save</button>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

