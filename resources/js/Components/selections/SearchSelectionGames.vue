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
        <input
            type="text"
            v-model="search"
            placeholder="Поиск по названию игры..."
            class="x-input x-input-border"
        />
        <div class="sel-search-list">
            <div v-for="item in games.data" class="sel-search-list_item">
                <div @click="setGame(item)">Выбрать: {{ item.title }}</div>
            </div>
        </div>
        <div class="sel-search-preview">
            <div class="sel-search-preview-item" v-for="item in previewSelectGame" data-aos="fade-up">
                <div class="sel-search-preview_trash" @click="trash(item.id)"><icon-account-box style="font-size: 1.2em; color: white"/></div>
                <div class="sel-search-preview_cover"><img :src="'/uploads/games/' + item.cover" class="cover"></div>
                <div class="sel-search-preview_title"><p>{{ item.title }}</p></div>
            </div>
        </div>
    </div>
</template>
