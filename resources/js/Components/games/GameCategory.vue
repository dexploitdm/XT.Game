<script setup>
import {onMounted, computed, ref} from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { useStore } from 'vuex'
const store = useStore()

const categories = computed(() => store.getters.getCategories)

onMounted(async () => {
    await store.dispatch("categoriesList", { self: this });
})

</script>
<template>
    <div class="layout">
        <div class="layout-box">
            <div class="category-lists">
                <div class="category-lists_item">
                    <Link :href="route('showAll')">
                        <button type="button" class="xt-btn color-7">Все сразу</button>
                    </Link>
                </div>
                <div class="category-lists_item" v-for="item in categories">
                    <Link :href="route('showCat', item.id)">
                        <button type="button" class="xt-btn color-5">{{ item.title }}</button>
                    </Link>
                </div>
            </div>
        </div>
    </div>

</template>
