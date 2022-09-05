<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { onMounted, ref } from 'vue'
import { Inertia } from "@inertiajs/inertia"
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

onMounted(async () => {
    getSingGame()
})

const props = defineProps({
    game: Array,
    category: Array
})

let form = useForm({
    id: props.game.id,
    title: props.game.title,
    desc: props.game.desc,
    content: props.game.content,
    cover: props.game.cover,
    price: props.game.price,
    sale: props.game.sale,
    category_id: props.game.category_id,
    xbox_one: String(props.game.xbox_one),
    xbox_sx: String(props.game.xbox_sx)
})

const getSingGame = async () => {
    // let response = await axios.get(`/api/get_edit_game/`);
    // form.value = response.data
}



const getCover = () => {
    console.log('getCover')
    let cover = '/uploads/games/preview.png'
    if(form.cover) {
        console.log(form.cover)
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

const updateGame = () => {
    Inertia.post(`/lk/game/${props.game.id}`, {
        _method: 'put',
        id: form.id,
        title: form.title,
        desc: form.desc,
        content: form.content,
        cover: form.cover,
        price: form.price,
        sale: form.sale,
        category_id: form.category_id,
        xbox_one: form.xbox_one,
        xbox_sx: form.xbox_sx,
    })
    // const formData = new FormData()
    // formData.append('title', form.value.title)
    // formData.append('desc', form.value.desc)
    // formData.append('content', form.value.content)
    // formData.append('cover', form.value.cover)
    // formData.append('price', form.value.price)
    //
    // axios.post(`/api/update_game/${form.value.id}`, formData)
    //     .then((response) => {
    //         // ${this.$route.params.id}
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

                        <input type="text" class="" v-model="form.title" placeholder="title"/>
                        <div>
                            <QuillEditor theme="snow" v-model:content="form.desc" content-type="html"/>
                        </div>
                        <div>
                            <QuillEditor theme="snow" v-model:content="form.content" content-type="html"/>
                        </div>
                        <input type="number" class="" v-model="form.price"  placeholder="price"/>

                        <input type="number" class="" v-model="form.sale"  placeholder="sale"/>

                        <el-select v-model="form.category_id" placeholder="Select">
                            <el-option
                                v-for="item in category"
                                :key="item.id"
                                :label="item.title"
                                :value="item.id"
                            />
                        </el-select>

                        xbox one
                        <el-switch
                            v-model="form.xbox_one"
                            class="mt-2"
                            style="margin-left: 24px"
                            inline-prompt
                            active-value="1"
                            inactive-value="0"
                            :active-icon="Check"
                            :inactive-icon="Close"
                        />
                        xbox series form:
                        <el-switch
                            v-model="form.xbox_sx"
                            class="mt-2"
                            style="margin-left: 24px"
                            inline-prompt
                            active-value="1"
                            inactive-value="0"
                            :active-icon="Check"
                            :inactive-icon="Close"
                        />

                        <img :src="getCover()" src="" >

                        <input type="file" @change="updateCover" />

                        <button type="button" @click="updateGame()">updateGame</button>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

