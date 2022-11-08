<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import { Head } from '@inertiajs/inertia-vue3';
import LoaderBox from '@/Components/LoaderBox.vue';
import IconReload from '~icons/ion/reload-circle'
import {computed, onMounted, ref} from "vue";
import {useStore} from 'vuex'
const store = useStore()

const list = computed(() => store.getters.getListUser)
const isReload = ref(false)

onMounted(async () => {
    await store.dispatch("getOrders");
})

const reload = async () => {
    isReload.value = true
    await store.dispatch("getOrders");
    setTimeout(() => isReload.value = false, 2000);
}

</script>

<template>
    <Head title="Покупайте игры по выгодной цене" />
    <BreezeMainLayout>

        <div class="page-layout">
            <div class="layout">
                <div class="layout-box">
                    <div class="bg-w xt-box xt-order">
                        <h1 class="xt-title-1 dark">Список заказов</h1>
                        <div v-if="$page.props.flash.message" class="alert alert-success shadow-lg">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {{ $page.props.flash.message }}
                            </div>
                        </div>
                        <div class="xt-order-block">
                            <div class="xt-order-reload">
                                 <p><span v-if="isReload">Обновление...</span><span v-else>Обновить</span></p><Icon-Reload @click="reload"/>
                            </div>
                        </div>
                        <div class="xt-order-block xt-order-table">
                            <div class="xt-order-table-flex table-container" role="table" aria-label="Destinations">
                                <div class="flex-table header" role="rowgroup">
                                    <div class="flex-row" role="columnheader">Список игр</div>
                                    <div class="flex-row" role="columnheader">Платежный код</div>
                                    <div class="flex-row" role="columnheader">Сумма</div>
                                    <div class="flex-row" role="columnheader">Код активации</div>
                                    <div class="flex-row" role="columnheader">Статус</div>
                                </div>
                                <div class="flex-table row" role="rowgroup" v-for="(item, i) in list.data">
                                    <div class="flex-row" role="cell">
                                        <div v-for="game in JSON.parse(item.game_list)">
                                            {{game.title}}
                                        </div>
                                    </div>
                                    <div class="flex-row" role="cell">{{ item.uid_payment }}</div>
                                    <div class="flex-row" role="cell">{{ item.total_price }}</div>
                                    <div class="flex-row" role="cell">
                                        <span class="code-green" v-if="item.code">{{ item.code }}</span>
                                        <span v-else-if="isReload">
                                                <LoaderBox/>
                                            </span>
                                        <span v-else>Ожидайте..</span>
                                    </div>
                                    <div class="flex-row xt-order-status" role="cell">
                                        <span :class="{ active: item.active }" v-if="item.active">Активен</span>
                                        <span v-else>Закрыт</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="xt-order-block">
                            Чтобы активировать код игры:
                            1. Установите на компьютер или телефон VPN приложение.
                            Для телефона рекомендуем - Urban Vpn, VPN.lat, Turkey VPN, Windscribe, Seed4me, X-VPN, Express VPN, Touch VPN, Free VPN и др.
                            Для компьютера подходят Urban VPN, Hola VPN или браузер со встроенным VPN или установленным плагином.
                            2. Авторизуйтесь на сайте www.xbox.com. Далее выберите в меню сайта "Игры" - "Все игры" - "Активировать код" Перекинет на страницу redeem.microsoft.com.
                            3. Запустите установленную программу VPN и выберите регион Аргентина (или Турция или Бразилия или США или Колумбия или Индия - уточните у продавца регион где была приобретена игра). Скопируйте в поле или введите присланный Вам код и нажмите Далее! (⚠Дефисы вводить не нужно, система позаботится о них автоматически)
                            ВСЕ ГОТОВО!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeMainLayout>
</template>
