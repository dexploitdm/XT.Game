<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import {computed} from "vue";
import {useStore} from 'vuex'
const store = useStore()

const gameInCart = computed(() => store.getters.getCarts)

</script>

<template>
    <Head title="Покупайте игры по выгодной цене" />
    <BreezeMainLayout>


        <div class="container" style="padding-top: 250px;">
            <div v-for="item in gameInCart">

                {{ item.title }}

                <div class="">
                    <img :src="'/uploads/games/' + item.cover" style="max-width: 200px;"/>
                </div>


            </div>
        </div>






    </BreezeMainLayout>
</template>
