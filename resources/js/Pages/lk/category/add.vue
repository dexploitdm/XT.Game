<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { onMounted, ref } from 'vue'

let form = useForm({
    title: null
})

const saveCat = () => {
    form.post('/lk/category')
}

</script>
<template>
    <Head title="Добавить категорию" />
    <BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="xt-lk-title">Добавление категории</div>
                        <div class="xt-form">
                            <div class="x-form-control">
                                <label>Название категории</label>
                                <input type="text" class="x-input x-input-border" v-model="form.title"  placeholder="Название"/>
                            </div>
                        </div>
                        <button class="xt-btn color-10" @click="saveCat()">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

