import './bootstrap';
import '../scss/app.scss';

import { createApp, h } from 'vue';
import { createStore } from 'vuex'
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import "@/api.js";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

// import store from './store'
import { gamesStore } from './store/games.js';

const store = createStore({
    modules: {
        gamesStore
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
