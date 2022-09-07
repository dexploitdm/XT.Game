<script setup>
import {onMounted, ref, watch} from 'vue';
import IconAccountBox from '~icons/material-symbols/delete-forever-sharp'
import Repository from "@/repositories/RepositoryFactory";
const GameRepository = Repository.get("games");

const props = defineProps({
    list: Array
})

let search = ref('');
let games = ref({});
const selectGame = ref([])
const previewSelectGame = ref([])
const emit = defineEmits(['customChange'])

onMounted(async () => {
    if(props.list) {
        previewSelectGame.value = props.list
    }
    updateList()
})

watch(search, (value) => {
    //Inertia.get("/lk/selection/create", { search: value }, {preserveState: true,});
    getSearch(value);
});

const getSearch = async (key) => {
    let response = await GameRepository.search(key)
    games.value = response.data
}

const setGame = (item) => {
    previewSelectGame.value.push(item)
    updateList()
}

const updateList = () => {
    selectGame.value = []
    previewSelectGame.value.forEach(function(el, i) {
        const id = el.id
        selectGame.value.push({id})
    })
    emit('ids', selectGame.value)
}

const trash = (id) => {
    previewSelectGame.value.forEach(function(el, i) {
        if (el.id === id) previewSelectGame.value.splice(i, 1)
    })
    updateList()
}
</script>
<template>
    <div class="sel-search">

        <div class="sel-search-preview">
            <div class="sel-search-preview-item" v-for="item in previewSelectGame" data-aos="fade-up">
                <div class="sel-search-preview_trash" @click="trash(item.id)"><icon-account-box style="font-size: 1.2em; color: white"/></div>
                <div class="sel-search-preview_cover"><img :src="'/uploads/games/' + item.cover" class="cover"></div>
                <div class="sel-search-preview_title"><p>{{ item.title }}</p></div>
            </div>
        </div>



        <input
            type="text"
            v-model="search"
            placeholder="Search..."
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 p-2.5 "
        />

        <div style="padding: 40px 0;">
            <div  v-for="item in games.data">
                <div @click="setGame(item)">Выбрать: {{ item.title }}</div>
            </div>
        </div>

    </div>
</template>
