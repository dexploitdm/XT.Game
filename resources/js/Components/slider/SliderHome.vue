<script setup>
import { ref } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';

const sliders = ref([
    {
        'cover': '/images/demo/forza5.jpg',
        'bg': '/images/demo/forza_w.jpg',
        'title': 'Forza 5 Standart Edition',
        'desc': 'Вас ждёт бесконечный калейдоскоп приключений Horizon! Совершайте увлекательные поездки по невероятно красивому и самобытному миру Мексики за рулём величайших автомобилей в истории.',
        'price': '468.99',
        'sale': '200.99',
        'xbox_one': true,
        'xbox_sx': true
    },
    {
        'cover': '/images/demo/halo_i.jpg',
        'bg': '/images/demo/halo_w.jpg',
        'title': 'Halo Infinite (Campaign)',
        'desc': 'Когда всякая надежда потеряна и судьба человечества висит на волоске, Мастер Чиф готов противостоять самому безжалостному врагу, с которым он когда-либо сталкивался. Шагните в доспехи величайшего героя человечества, чтобы испытать эпическое приключение и исследовать огромные масштабы кольца Halo. Чтобы испытать кампанию, купите Halo Infinite.',
        'price': '469',
        'sale': '420',
        'xbox_one': true,
        'xbox_sx': true

    },
    {
        'cover': '/images/demo/fs.jpg',
        'bg': '/images/demo/mf_w.png',
        'title': 'Microsoft Flight Simulator',
        'desc': 'Microsoft Flight Simulator — это новое поколение в самой популярной серии авиасимуляторов. Вас ждёт множество детально воссозданных воздушных судов — от лёгких самолётов до широкофюзеляжных авиалайнеров — в невероятно живом и реалистичном мире. Составьте свой маршрут и отправляйтесь в любую точку земного шара. Летайте в любое время суток и готовьтесь противостоять всем капризам погоды в реальном времени.',
        'price': '300',
        'sale': null,
        'xbox_one': true,
        'xbox_sx': true
    },
    {
        'cover': '/images/demo/std2.jpg',
        'bg': '/images/demo/sod_w.jpg',
        'title': 'State of decay 2',
        'desc': 'Когда восстали мертвые, цивилизация пала, и даже армия не смогла остановить толпы зомби. Теперь вам предстоит призвать на помощь до трех друзей, собрать выживших, найти ресурсы и построить сообщество в постапокалиптическом мире. В этом крутом симуляторе зомби-апокалипсиса вы сами решаете, как выживать, и каждый ваш поступок влияет на результат.',
        'price': '300',
        'sale': null,
        'xbox_one': true,
        'xbox_sx': true
    },
])


const onSwiper = (swiper) => {
    // console.log(swiper);
};
const salePercent = (price, sale) => {
    const percent = ((price - sale)/price) *100
    return percent.toFixed()
};
const onSlideChange = () => {
    // console.log('slide change');
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
                <div class="x-screen-content">
                    <h1>Покупка игр для xbox через Турцию</h1>
                    <p>Какой нибудь текст</p>
                    <ul>
                        <li>Только цифровые ключи.</li>
                        <li>Самые интересные предложения игр по скидкам всегда в наличии.</li>
                        <li>Пожизненная гарантия на игры.</li>
                        <li>Гарантия честности сделки.</li>
                    </ul>
                    <div class="ex-pixel"></div>
                    <a class="xt-btn xt-btn__blue" href="http://exlv/login">Вход</a>
                </div>
                <div class="x-screen-cover">
                    <picture>
                        <source srcset="/images/gamepad.webp" type="image/webp">
                        <img src="/images/gamepad.png" alt="gamepad" />
                    </picture>
                </div>


<!--                <div v-for="item in sliders">-->
<!--                    {{ item.title }}-->
<!--                </div>-->
            </div>
        </div>
    </div>
</template>
