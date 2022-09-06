<script setup>
import {onMounted, computed, ref} from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import {useStore} from "vuex";
const store = useStore()

const selections = computed(() => store.getters.getSelectionStore)

onMounted(async () => {
    await store.dispatch("getSelections", { self: this });
})



</script>
<template>
    <div class="container">
        <div class="container-box">

            <div v-for="item in selections">
                <Link :href="route('showSelection', item.id)">
                    {{ item.title}}
                </Link>

            </div>
        </div>
    </div>
</template>
