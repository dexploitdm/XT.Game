<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import IconTrash from '~icons/fluent/delete-arrow-back-20-filled'
import {computed, onMounted, ref} from "vue";
import {useStore} from 'vuex'
const store = useStore()



onMounted(async () => {

})

</script>

<template>
    <Head title="Покупайте игры по выгодной цене" />
    <BreezeMainLayout>

        <div class="bg-w page-layout">
            <div class="layout">
                <div class="layout-box">
                    <div class="xt-cart">
                        <h1 class="xt-title-1 dark">Выбраный список</h1>
                     hfgh
                        <div v-if="$page.props.flash.message" class="alert">
                            {{ $page.props.flash.message }}
                        </div>
                    </div>
                </div>
            </div>
        </div>









    </BreezeMainLayout>
</template>
