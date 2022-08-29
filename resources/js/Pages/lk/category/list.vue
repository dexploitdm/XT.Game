<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { onMounted, ref } from 'vue'

onMounted(async () => {

})

defineProps({
    category: Array
})
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Категории игр
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Список

                        <div class="">
                            <Link :href="route('category.create')">
                                Добавить
                            </Link>
                        </div>

                        <div class="table-card">
                            <div v-for="item in category" class="table-card-item">

                                <div class="table-card-info">
                                    {{ item.title }}
                                    <Link :href="route('category.edit', item.id)" :id="item.id">
                                        Edit
                                    </Link>
                                    <Link :href="route('category.destroy', item.id)" method="delete">
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
