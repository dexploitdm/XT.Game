<script setup>
import Logo from '@/Components/Logo.vue';
import { Link } from '@inertiajs/inertia-vue3';
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
        <Logo />

        <div class="header-menu">

            <div class="cart-icon">
                <div class="cart-icon-count">{{ gameInCart.length }}</div>
                <icon-account-box />
            </div>

            <div v-if="canLogin" class="header-menu-auth">


                <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="xt-btn color-11">Личный кабинет</Link>

                <template v-else>
                    <Link :href="route('login')" class="xt-btn color-3 x-marr20">Вход</Link>

                    <Link v-if="canRegister" :href="route('register')" class="xt-btn color-11">Регистрация</Link>
                </template>
            </div>
        </div>

    </header>
    <main>
        <slot />
    </main>
    <footer>
        <h2>footer</h2>
    </footer>
</template>
