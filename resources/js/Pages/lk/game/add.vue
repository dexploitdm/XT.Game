<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { onMounted, ref } from 'vue'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const props = defineProps({
    category: Array
})

let form = useForm({
    title: null,
    desc: null,
    content: null,
    cover: null,
    category_id: null,
    price: null,
    sale: null,
    xbox_one: true,
    xbox_sx: false
})

const getCover = () => {
    let cover = '/uploads/games/preview.webp'
    if(form.cover) {
        if(form.cover.indexOf('base64') !== -1 ) {
            cover = form.cover
        } else {
            cover = '/uploads/games/' + form.cover
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

const saveGame = () => {
    form.post('/lk/game')
}
</script>
<template>
    <Head title="Добавить игру" />
    <BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="xt-lk-title">Добавление игры</div>
                        <div class="xt-form">
                            <div class="x-form-control">
                                <label>Название игры</label>
                                <input type="text" class="x-input x-input-border" v-model="form.title"  placeholder="Название"/>
                            </div>
                            <div class="x-form-control">
                                <label>Описание</label>
                                <QuillEditor theme="snow" v-model:content="form.desc" content-type="html"/>
                            </div>
                            <div class="x-form-control">
                                <label>Контент</label>
                                <QuillEditor theme="snow" v-model:content="form.content" content-type="html"/>
                            </div>
                            <div class="x-form-double">
                                <div class="x-form-control full">
                                    <label>Цена</label>
                                    <input type="number" class="x-input x-input-border" v-model="form.price"  placeholder="price"/>
                                </div>
                                <div class="x-form-control full">
                                    <label>Цена по текущей скидке</label>
                                    <input type="number" class="x-input x-input-border" v-model="form.sale"  placeholder="sale"/>
                                </div>
                            </div>
                            <div class="x-form-double">
                                <div class="x-form-control line">
                                    <label>Версия для xbox one</label>
                                    <input type="checkbox"   class="checkbox" :value="form.xbox_one" v-model="form.xbox_one" />
                                </div>
                                <div class="x-form-control line">
                                    <label>Версия для xbox series</label>
                                    <input type="checkbox"   class="checkbox" :value="form.xbox_sx" v-model="form.xbox_sx" />
                                </div>
                            </div>
                            <div class="x-form-control x-form-control_upload full">
                                <img :src="getCover()" src="" >
                                <input type="file" @change="updateCover" />
                            </div>
                        </div>
                        <button class="xt-btn color-10" @click="saveGame()">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
