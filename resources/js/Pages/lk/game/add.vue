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
    let cover = '/uploads/games/preview.png'
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
    // const formData = new FormData()
    // formData.append('title', form.value.title)
    // formData.append('desc', form.value.desc)
    // formData.append('content', form.value.content)
    // formData.append('cover', form.value.cover)
    // formData.append('price', form.value.price)
    //
    // axios.post('/api/add_game', formData)
    //     .then((response) => {
    //
    //     })
    //     .catch((error) => {
    //
    //     })
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

                        <input type="text" class="" v-model="form.title"  placeholder="title"/>
                        <div>
                            <QuillEditor theme="snow" v-model:content="form.desc" content-type="html"/>
                        </div>
                        <div>
                            <QuillEditor theme="snow" v-model:content="form.content" content-type="html"/>
                        </div>
                        <input type="number" class="" v-model="form.price"  placeholder="price"/>

                        <input type="number" class="" v-model="form.sale"  placeholder="sale"/>

                        

                        xbox one {{ form.xbox_one}}
                        
                        xbox series {{form.xbox_sx}}
                       

                        <img :src="getCover()" src="" >

                        <input type="file" @change="updateCover" />

                        <button type="button" @click="saveGame()">save</button>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

