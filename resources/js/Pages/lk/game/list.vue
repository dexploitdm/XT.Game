<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination.vue'
import IconCreate from '~icons/carbon/intent-request-create'
import IconEdit from '~icons/material-symbols/edit-document-outline'
import IconRemove from '~icons/material-symbols/delete-forever-outline-sharp'
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    games: Array
})

const ourImage = (img) => {
    return '/uploads/games/' + img
}
</script>
<template>
    <Head title="Dashboard" />
    <BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="xt-lk-title">Список игр</div>
                        <div>
                            <Link :href="route('game.create')"  class="xt-lk-create">
                                <Icon-Create />
                                <p>Добавить</p>
                            </Link>
                        </div>
                        <div class="table-card">
                            <div v-for="item in games.data" class="table-card-item">
                                <div class="table-card-cover">
                                    <img :src="ourImage(item.cover)" />
                                </div>
                                <div class="table-card-info">
                                    <div class="table-card-info_title">{{ item.title }}</div>
                                    <div v-html="item.desc"></div>

                                    <div class="table-card-info_price">{{ item.price }} TL</div>
                                    <div class="table-card-info_actions">
                                        <Link :href="route('game.edit', item.id)" :id="item.id" class="edit">
                                            <Icon-Edit />
                                        </Link>
                                        <Link :href="route('game.destroy', item.id)" method="delete" class="delete">
                                            <Icon-Remove />
                                        </Link>
                                    </div>
                                </div>
                            </div>
                            <Pagination :links="games.links"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
