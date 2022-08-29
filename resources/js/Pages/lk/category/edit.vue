<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia"


const props = defineProps({
    category: Array
})

let form = useForm({
    id: props.category.id,
    title: props.category.title
})

const updateCategory = () => {
    Inertia.post(`/lk/category/${props.category.id}`, {
        _method: 'put',
        id: form.id,
        title: form.title,
    })
}

</script>
<template>
    <Head title="Добавить игру" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Добавить игру
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        form

                        <input type="text" class="" v-model="form.title"/>

                        <button type="button" @click="updateCategory()">updateCategory</button>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

