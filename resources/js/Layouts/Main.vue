<script setup>
import Logo from '@/Components/Logo.vue';
import {Link} from '@inertiajs/inertia-vue3';
import IconAccountBox from '~icons/el/shopping-cart-sign'
import {computed, onMounted, ref} from "vue";
import {useStore} from 'vuex'

const store = useStore()

const gameInCart = computed(() => store.getters.getCarts)

let canLogin = ref([])
let canRegister = ref([])

onMounted(async () => {
    getInfo()
})

const getInfo = async () => {
    let response = await axios.get('/api/get_info');
    canLogin.value = response.data.canLogin
    canRegister.value = response.data.canRegister
}

</script>

<template>
    <header>
        <div class="navbar bg-base-100">
            <div class="flex-1">
                <Logo/>
            </div>
            <div v-if="canLogin" class="flex-none">
                <div class="header-menu">
                    <div class="header-menu-auth">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="xt-btn color-5">
                            Личный кабинет
                        </Link>
                        <template v-else>
                            <Link :href="route('login')" class="xt-btn color-10 x-marr20">Вход</Link>
                            <Link v-if="canRegister" :href="route('register')" class="xt-btn color-5">Регистрация</Link>
                        </template>
                    </div>
                </div>
                <div class="cart dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-circle">
                        <div class="indicator">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="badge badge-sm indicator-item">{{ gameInCart.length }}</span>
                        </div>
                    </label>
                    <div tabindex="0" class="mt-3 card card-compact dropdown-content w-52 bg-base-100 shadow">
                        <div class="card-body">
                            <span class="font-bold">Количество продуктов: {{ gameInCart.length }}</span>
                            <div class="card-actions">
                                <Link :href="route('cart')">
                                    <button class="xt-btn color-10">Посмотреть корзину</button>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="$page.props.auth.user" class="profile dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <picture>
                                <img src="/images/people2.webp" alt="avatar"/>
                            </picture>
                        </div>
                    </label>
                    <ul tabindex="0"
                        class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                        <li>
                            <a class="justify-between">
                                Мои заказы
                                <span class="badge">New</span>
                            </a>
                        </li>
                        <li><a>Настройки</a></li>
                        <li>
                            <Link :href="route('logout')" method="post">
                                Выход
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <main>
        <slot/>
    </main>
    <footer>
        <div class="f-logo">
            <Logo :link="true"/>
        </div>
        <div class="f-desc">
            XT.Game ©Copyright 2022
        </div>
    </footer>
</template>
