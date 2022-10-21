<script setup>
import Logo from '@/Components/Logo.vue';
import Menu from '@/Components/other/Menu.vue';
import Cart from '@/Components/other/Cart.vue';
import IconAccountBox from '~icons/el/shopping-cart-sign'
</script>
<template>
    <header>
        <div class="navbar bg-base-100">
            <div class="flex-1">
                <Logo/>
            </div>
            <Cart />
            <div class="hidden lg:block">
                <Menu />
            </div>
            <div class="flex-none lg:hidden">
                <div class="dropdown dropdown-end">
                    <button class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                    </button>
                    <div tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                        <Menu />
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <slot/>
    </main>
    <footer>
        <div class="layout">
            <div class="layout-box">
                <div class="footer">
                    <div class="f-logo">
                        <Logo :link="true"/>
                    </div>
                    <div class="f-desc">
                        XT.Game ©Copyright 2022
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
