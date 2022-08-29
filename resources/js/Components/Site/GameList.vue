<script setup>
import {onMounted, ref} from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

onMounted(async () => {
    await getGames()
})

let games = ref([])

const salePercent = (price, sale) => {
    const percent = ((price - sale)/price) *100
    return percent.toFixed()
};

const getGames = async () => {
    let response = await axios.get('/api/get_all_games');
    games.value = response.data
}

const tr = (text, length, suffix) => {
    if (text.length > length) {
        return text.substring(0, length) + suffix;
    } else {
        return text;
    }
}

</script>
<template>
    <div class="container">
<!--        {{ item.price * Number($inertia.page.props.rate) }}-->

        <div class="game-list">
            <div class="game-list-item" v-for="item in games">

                <div class="game-list-cover">
<!--                    <a class="game-list-cover-img" :style="'background-image: url(/uploads/games/'+ item.cover +')'">-->

<!--                    </a>-->
                    <Link :href="route('show', item.id)" class="game-list-cover-img" :style="'background-image: url(/uploads/games/'+ item.cover +')'">

                    </Link>
                </div>
                <div class="game-list-info">
                    <div class="game-list-info-title">{{ item.title }}</div>
                    <div class="game-list-info-desc" v-html="tr(item.desc, 150, '....')"></div>

                </div>
            </div>
        </div>
    </div>
</template>
