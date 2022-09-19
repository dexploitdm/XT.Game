<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
<template>
    <div class="logo-box">
        <Link :href="route('home')">
            <img class="logo-box-xg" src="/uploads/others/xt_logo.png">
            <div class="logo-box-text">XT.Game#999</div>
        </Link>
    </div>
</template>
