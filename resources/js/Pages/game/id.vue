<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import {onMounted, ref} from "vue";

const props = defineProps({
    id: Number
})

let game = ref([])

onMounted(async () => {
    await getGames(props.id)
})

const getGames = async (id) => {
    let response = await axios.get(`/api/get_game/${id}`);
    game.value = response.data
}

</script>

<template>
    <Head title="Game" />
    <BreezeMainLayout>
       this {{ props.id }}

        <div class="container bg-w" style="margin-top: 50px;">
            <div>{{ game.title }}</div>

            <div class="buttons" style="max-width: 700px; margin: auto;">
                <button class="xt-btn color-1">Приобрести</button>


            </div>

        </div>



    </BreezeMainLayout>
</template>
