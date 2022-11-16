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
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="xt-lk-title">Редактирование категории</div>
                        <div class="xt-form">
                            <div class="x-form-control">
                                <label>Название категории</label>
                                <input type="text" class="x-input x-input-border" v-model="form.title"  placeholder="Название"/>
                            </div>
                        </div>
                        <button class="xt-btn color-10" @click="updateCategory()">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

