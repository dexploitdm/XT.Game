<script setup>
import Logo from '@/Components/Logo.vue';
import { Link } from '@inertiajs/inertia-vue3';
import {onMounted, ref} from "vue";

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
