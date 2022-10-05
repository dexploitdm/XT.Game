<script setup>
import { Link } from '@inertiajs/inertia-vue3';
const props = defineProps({
    link: Boolean
})
</script>
<template>
    <div class="logo-box" :class="{ not_link: link }">
        <Link :href="route('home')">
            <img class="logo-box-xg" src="/uploads/others/xt_logo.png" width="44" height="44" alt="Logo XT.Game">
            <div class="logo-box-text">XT.Game#999</div>
        </Link>
    </div>
</template>
