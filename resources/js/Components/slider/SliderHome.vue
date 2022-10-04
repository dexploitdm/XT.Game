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
    <div class="x-slide">
        <swiper
            slides-per-view="auto"
            :slides-per-group="1"
            :loop="true"
            :space-between="20"
            :autoHeight="true"
            :freeMode="true"
            @swiper="onSwiper"
            @slideChange="onSlideChange"
        >
<!--            :style="'background-image: url('+ item.bg +')'"-->
            <swiper-slide v-for="item in sliders">
                <div class="x-slide-item">
                    <div class="x-slide-item-box">
                        <div class="x-slide-content">
                            <div class="x-slide-content_title">{{ item.title }}
                                <div class="x-slide-content_title__mini">(Xbox One / Xbox Series S,X)</div>
                            </div>
                            <div class="x-slide-content_desc">{{ item.desc }}</div>
                            <div class="x-slide-info">
                                <div class="x-slide-info-box">
                                    <div class="x-slide-info_price">
                                        <div class="x-slide-info_price__all">
                                            {{ priceFormat(item.price, item.sale, $inertia.page.props.rate) }} RU (<span  :class="{ active: item.sale }">{{ item.price }} TRY</span>)
                                        </div>
                                        <div class="x-slide-info_price__sale" v-if="item.sale">
                                            {{ item.sale }} TRY   <span class="x-sale">- {{ salePercent(item.price, item.sale) }} %</span>
                                        </div>
                                    </div>
                                    <button type="button" class="xt-btn color-3">Приобрести</button>
                                </div>


                            </div>
                        </div>
                        <div class="x-slide-cover">
                            <img :src="item.cover" />
                        </div>
                    </div>
                </div>
            </swiper-slide>


        </swiper>
    </div>
</template>
