import './bootstrap';
import '../scss/app.scss';

import AOS from 'aos';
import 'aos/dist/aos.css';
AOS.init();

import { createApp, h } from 'vue';
import { createStore } from 'vuex'
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

import { gamesStore } from './store/games.js';
import { selectionStore } from './store/selection.js';
import { cartStore } from './store/cart.js';

const store = createStore({
    modules: {
        gamesStore,
        selectionStore,
        cartStore
    }
})

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(store)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
