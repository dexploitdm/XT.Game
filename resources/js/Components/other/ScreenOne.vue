<script setup>
import { ref } from 'vue';
</script>
<template>
    <div class="layout">
        <div class="layout-box">
            <div class="x-screen">
                <div class="x-screen-item">
                    <h1>Покупка игр для xbox через Турцию</h1>
                    <div class="x-screen-content">
                        <p>Какой нибудь текст</p>
                        <ul>
                            <li>Только цифровые ключи.</li>
                            <li>Самые интересные предложения игр по скидкам всегда в наличии.</li>
                            <li>Пожизненная гарантия на игры.</li>
                            <li>Гарантия честности сделки.</li>
                        </ul>
                    </div>
                </div>
                <div class="x-screen-cover">
                    <picture>
                        <source srcset="/images/gamepad.webp" type="image/webp">
                        <img src="/images/gamepad.png" alt="gamepad"  width="520px" height="436px"/>
                    </picture>
                </div>
            </div>
        </div>
    </div>
</template>
