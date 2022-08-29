<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import { onMounted, ref } from 'vue'

// let games = ref([])

onMounted(async () => {
    getGames()
})

defineProps({
    games: Array
})

const getGames = async () => {
    let response = await axios.get('/api/get_all_games');
    console.log(response)
    //games.value = response.data
}

const ourImage = (img) => {
    return '/uploads/games/' + img
}


</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Заголовок
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        список игр

                        <div class="">
                            <Link :href="route('game.create')">
                                Добавить
                            </Link>
                        </div>

                        <div class="table-card">

                            <div v-for="item in games.data" class="table-card-item">
                                <div class="table-card-cover">
                                    <img :src="ourImage(item.cover)" class=""  style="max-width: 200px;"/>
                                </div>
                                <div class="table-card-info">
                                    {{ item.title }}
                                    <div v-html="item.desc"></div>
                                    {{ item.price }}
                                    <Link :href="route('game.edit', item.id)" :id="item.id">
                                        Edit
                                    </Link>
                                    <Link :href="route('game.destroy', item.id)" method="delete">
                                        Remove
                                    </Link>
                                </div>
                            </div>

                            <Pagination :links="games.links"/>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
