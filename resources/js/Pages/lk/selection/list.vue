<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { onMounted, ref } from 'vue'

onMounted(async () => {
    //getSe()
})

defineProps({
    selection: Array
})

const getSe = async () => {
    //TODO: Получение списка изр из выбраной подбори
    let response = await axios.get('/api/get_selection_games/11');
    console.log(response)
}

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Подборки
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Список

                        <div class="">
                            <Link :href="route('selection.create')">
                                Добавить
                            </Link>
                        </div>

                        <div class="table-card">
                            <div v-for="item in selection" class="table-card-item">

                                <div class="table-card-info">
                                    {{ item.title }}
                                    <Link :href="route('selection.edit', item.id)" :id="item.id">
                                        Edit
                                    </Link>
                                    <Link :href="route('selection.destroy', item.id)" method="delete">
                                        Remove
                                    </Link>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
