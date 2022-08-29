<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { onMounted, ref, watch } from 'vue'
import { Inertia } from "@inertiajs/inertia";


const selectGame = ref([])

let form = useForm({
    title: null,
    cover: null,
    game_ids: selectGame.value
})



const props = defineProps({
    games: {
        type: Object,
        default: () => ({}),
    },
});

let search = ref('');
watch(search, (value) => {
    Inertia.get(
        "/lk/selection/create",
        { search: value },
        {
            preserveState: true,
        }
    );
});

const setGame = (id) => {
    selectGame.value.push({id})
}

const saveSelection = () => {
    form.post('/lk/selection')
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

