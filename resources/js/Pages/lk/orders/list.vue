<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia"
import SearchOrders from '@/Components/other/SearchOrders.vue'
import IconEdit from '~icons/clarity/note-edit-line'
import { ref } from 'vue'

defineProps({
    orders: Object
})

const editOrder = ref([])
const viewFlashMsg = ref(false)
let searchData = ref({});

const formatDate = (dateString) => {
    const date = new Date(dateString)
    const options = {
        year: 'numeric', month: 'numeric', day: 'numeric',
        hour: 'numeric', minute: 'numeric', second: 'numeric',
        hour12: false
    };
    return new Intl.DateTimeFormat('default', options).format(date)
}
const openModal = (data) => {
    editOrder.value = data
}
const clear = () => {
    viewFlashMsg.value = false
}
const updateOrder = () => {
    Inertia.post(`/lk/orders/${editOrder.value.id}`, {
        _method: 'put',
        id: editOrder.value.id,
        code: editOrder.value.code
    })
    viewFlashMsg.value = true
}
const listSearch = (e) => {
    searchData.value = e.data
}
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Заявки
            </h2>
        </template>

        <input type="checkbox" id="my-modal-1" class="modal-toggle" />
        <div class="modal xt-order-modal">
            <div v-if="editOrder.game_list" class="modal-box relative">
                <label for="my-modal-1" class="btn btn-sm btn-circle absolute right-2 top-2" @click="clear">✕</label>
                <h3 class="font-bold text-lg">Редактирование</h3>
                <div v-if="$page.props.flash.message && viewFlashMsg" class="alert alert-success shadow-lg">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        {{ $page.props.flash.message }}
                    </div>
                </div>
                <div class="xt-order-modal-item">

                    <div class="xt-order-modal-item_block">
                        <p>Список игр</p>
                        <div v-for="game in JSON.parse(editOrder.game_list)">
                            {{game.title}}
                        </div>
                    </div>
                    <div class="xt-order-modal-item_block">
                        <div class="font-bold">{{JSON.parse(editOrder.user).name}}</div>
                        <div class="text-sm opacity-50">{{JSON.parse(editOrder.user).email}}</div>
                    </div>

                </div>
                <div class="xt-order-modal-item">
                    <div class="xt-order-modal-item_block big">
                        <p>Код</p>
                        <input type="text" v-model="editOrder.code" placeholder="Код" class="input input-bordered w-full max-w-xs" />
                    </div>
                </div>

                <div class="modal-action">
                    <button class="xt-btn color-5" @click="updateOrder()">Сохранить</button>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <div class="xt-order-search_x1">
                            <Search-orders v-on:data="listSearch" />
                            <div v-if="searchData" class="xt-order-search">
                                <div v-for="item in searchData" class="xt-order-search-item">
                                    <div class="xt-order-search_block">
                                        <div>{{JSON.parse(item.user).name}}</div>
                                        {{JSON.parse(item.user).email}}
                                    </div>
                                    <div class="xt-order-search_block">
                                        Платежный код: <br> {{ item.uid_payment }}
                                    </div>
                                    <div class="xt-order-search_block">
                                        Сумма: <br> {{ item.total_price }}
                                    </div>
                                    <div class="xt-order-search_block">
                                        <div class="avatar-group -space-x-6">
                                            <div class="avatar" v-for="game in JSON.parse(item.game_list)">
                                                <div class="w-12">
                                                    <img :src="'/uploads/games/'+ game.cover" />
                                                </div>
                                            </div>
                                        </div>

                                        <div v-for="game in JSON.parse(item.game_list)">
                                            {{game.title}} <br>
                                        </div>
                                    </div>
                                    <div class="xt-order-search_block">
                                        Код: <br> {{ item.code }}
                                    </div>
                                    <div class="xt-order-search_block flex">
                                        <div class="flex-row xt-order-status" role="cell">
                                            <span :class="{ active: item.active }" v-if="item.active">Активен</span>
                                            <span v-else>Закрыт</span>
                                        </div>
                                        <div class="xt-order-code">
                                            <label for="my-modal-1"><Icon-edit @click="openModal(item)"/></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto w-full">
                            <table class="table w-full table-ws_off">
                                <!-- head -->
                                <thead>
                                <tr>
                                    <th>Пользователь</th>
                                    <th>Список игр</th>
                                    <th>Платежный код</th>
                                    <th>Сумма</th>
                                    <th style="max-width: 250px;">Код активации</th>
                                    <th>Дата/время</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr  v-for="(item, i) in orders.data">
                                    <td>
                                        <div class="flex items-center space-x-3">
                                            <div>
                                                <div class="font-bold">{{JSON.parse(item.user).name}}</div>
                                                <div class="text-sm opacity-50">{{JSON.parse(item.user).email}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="max-width: 140px;">
                                        <div v-for="game in JSON.parse(item.game_list)">
                                            {{game.title}}
                                        </div>
                                    </td>
                                    <td>{{ item.uid_payment }}</td>
                                    <td>{{ item.total_price }}</td>
                                    <td style="max-width: 250px;">
                                        <div class="flex-row xt-order-status" role="cell">
                                           Статус заявки: <span :class="{ active: item.active }" v-if="item.active">Активен</span>
                                            <span v-else>Закрыт</span>
                                        </div>

                                        <div class="xt-order-code">
                                            <label for="my-modal-1"><Icon-edit @click="openModal(item)"/></label>
                                            <span> Код: {{ item.code }}</span>
                                        </div>

                                    </td>
                                    <td>
                                        <div>Открыт</div>
                                        {{ formatDate(item.created_at) }}
                                        <div>Изменен</div>
                                        {{ formatDate(item.updated_at) }}
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <Pagination :links="orders.links"/>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
