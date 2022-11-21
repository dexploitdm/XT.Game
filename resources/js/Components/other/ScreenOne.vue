<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import SearchGame from '@/Components/other/SearchGame.vue';

let searchData = ref({});

const listSearch = (e) => {
    searchData.value = e.data
}

const salePercent = (price, sale) => {
    const percent = ((price - sale)/price) *100
    return percent.toFixed()
};

const priceFormat = (price, sale, rate) => {
    let totalPrice = price
    if(sale) {totalPrice = sale}
    return (totalPrice * rate).toFixed(2)
}

</script>
<template>
    <div class="layout">
        <div class="layout-box">
            <div class="x-screen">
                <div class="x-screen-item">
                    <h1>Покупка игр для xbox через Турцию</h1>
                    <div class="x-screen-content">
                        <div class="x-screen-content_desc">
                            <p>Какой нибудь текст</p>
                            <ul>
                                <li>Только цифровые ключи.</li>
                                <li>Самые интересные предложения игр по скидкам всегда в наличии.</li>
                                <li>Пожизненная гарантия на игры.</li>
                                <li>Гарантия честности сделки.</li>
                            </ul>
                        </div>
                        <div class="x-screen-search">
                            <div class="dropdown dropdown-hover">
                                <SearchGame v-on:data="listSearch"/>
                                <ul v-if="searchData.length > 0" tabindex="0" class="x-screen-search-list dropdown-content menu p-2 shadow bg-base-100 rounded-box">
                                    <li v-for="item in searchData">
                                        <Link :href="route('show', item.id)">
                                            <img class="x-screen-search_cover" :src="'/uploads/games/' + item.cover"/>
                                            <div class="x-screen-search_desc">
                                                <p>{{item.title}}</p>
                                                <span :class="{ active: item.sale }">{{ item.price }} TRY</span>
                                                <span class="game-sale" v-if="item.sale">{{ item.sale }} TRY <span class="x-sale">- {{ salePercent(item.price, item.sale) }} %</span></span>
                                                / {{ priceFormat(item.price, item.sale, $inertia.page.props.rate) }} RU
                                            </div>
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
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
