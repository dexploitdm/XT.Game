<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import IconCreate from '~icons/carbon/intent-request-create'
import IconEdit from '~icons/material-symbols/edit-document-outline'
import IconRemove from '~icons/material-symbols/delete-forever-outline-sharp'

defineProps({
    selection: Array
})

const ourImage = (img) => {
    return '/uploads/selection/' + img
}
</script>
<template>
    <Head title="Dashboard" />
    <BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="xt-lk-title">Список подборок</div>
                        <Link :href="route('selection.create')" class="xt-lk-create">
                            <Icon-Create />
                            Добавить
                        </Link>
                        <div class="table-card grid grid_x3 m-center">
                            <div v-for="item in selection" class="table-card-item">
                                <div class="table-card-cover">
                                    <img :src="ourImage(item.cover)" />
                                </div>
                                <div class="table-card-info">
                                    <div class="table-card-info_title">{{ item.title }}</div>
                                    <div class="table-card-info_actions">
                                        <Link :href="route('selection.edit', item.id)" :id="item.id" class="edit">
                                            <Icon-Edit />
                                        </Link>
                                        <Link :href="route('selection.destroy', item.id)" method="delete" class="delete">
                                            <Icon-Remove />
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
