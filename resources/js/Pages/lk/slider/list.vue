<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { onMounted, ref } from 'vue'

onMounted(async () => {
    //getSe()
})

defineProps({
    slider: Array
})


</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Слайдер
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Список

                        <div class="">
                            <Link :href="route('slider.create')">
                                Добавить
                            </Link>
                        </div>

                        <div class="table-card">
                            <div v-for="item in slider" class="table-card-item">

                                <div class="table-card-info">
                                    Slide {{ item.id }}
                                    <div class="">
                                        <img :src="'/uploads/slider/' + item.cover" style="max-width: 200px;"/>
                                    </div>
                                    <Link :href="route('slider.edit', item.id)" :id="item.id">
                                        Edit
                                    </Link>
                                    <Link :href="route('slider.destroy', item.id)" method="delete">
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
