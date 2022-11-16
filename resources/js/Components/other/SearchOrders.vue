<script setup>
import {ref, watch} from 'vue';
import Repository from "@/repositories/RepositoryFactory";
const OrderRepository = Repository.get("order");

let search = ref('');
const emit = defineEmits(['dataSearch'])

watch(search, (value) => {
    getSearch(value);
});

const getSearch = async (key) => {
    let response = await OrderRepository.search(key)
    let data = response.data
    if(!key.length) {
        data = {}
    }
    emit('data', data)
}
</script>
<template>
    <div class="search">
        <input
            type="text"
            v-model="search"
            placeholder="Поиск по платежному коду"
            class="x-input-green bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 p-2.5 "
        />
    </div>
</template>
