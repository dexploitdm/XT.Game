<script setup>
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
    <div v-if="canLogin" class="header-content">
        <div class="header-menu">
            <div class="header-menu-auth">
                <template  v-if="$page.props.auth.user">
                    <Link v-if="$page.props.auth.user.id === 1" :href="route('dashboard')" class="xt-btn color-10 lk-enter" >
                        Личный кабинет
                    </Link>
                    <Link :href="route('orders')" class="xt-btn color-5">
                        Мои заказы
                    </Link>
                    <Link :href="route('logout')" method="post" class="xt-btn color-10 lg:hidden">
                        Выход
                    </Link>
                </template>

                <template v-else>
                    <Link :href="route('login')" class="xt-btn color-10 x-marr20">Вход</Link>
                    <Link v-if="canRegister" :href="route('register')" class="xt-btn color-5">Регистрация</Link>
                </template>
            </div>
        </div>

        <div v-if="$page.props.auth.user" class="profile dropdown dropdown-end hidden lg:block">
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
</template>
