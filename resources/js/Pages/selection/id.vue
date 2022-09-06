<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import {computed, onMounted, ref} from "vue";
import {useStore} from "vuex";
const store = useStore()

const props = defineProps({
    id: Number
})

const selection = computed(() => store.getters.getSelectionGames)

onMounted(async () => {
    await store.dispatch("getSelectionItem", props.id);
})
</script>

<template>
    <Head title="Game" />
    <BreezeMainLayout>
       this {{ props.id }}

        <div class="container bg-w" style="margin-top: 50px;">
            <div v-if="selection.data">{{ selection.data.title }}</div>
            <br>
            <hr>
            <br>

            <div v-for="item in selection.listSelectGame">
                {{ item.title }}
            </div>

            <div class="buttons" style="max-width: 700px; margin: auto;">
                <button class="xt-btn color-1">Приобрести</button>


            </div>

        </div>



    </BreezeMainLayout>
</template>
