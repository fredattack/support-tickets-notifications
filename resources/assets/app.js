/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import {createApp} from 'vue'
import App from './components/App'
import router from './router'
import store from './store'
import VueEasyLightbox from 'vue-easy-lightbox'

import {createI18n} from 'vue-i18n';
import fr from '../lang/fr'

import {dom, library} from "@fortawesome/fontawesome-svg-core";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {fas} from '@fortawesome/free-solid-svg-icons'
import {fab} from '@fortawesome/free-brands-svg-icons';
import {far} from '@fortawesome/free-regular-svg-icons';

library.add(fas);
library.add(fab);
library.add(far);
dom.watch();
// const { RayPlugin } = require('vue-ray');

const i18n = createI18n({
    messages : {
        fr:fr
    },
    fallbackLocale: 'fr',
})

const app = createApp(App)
    .use(store)
    .use(router)
    .use(i18n)
    .use(library)
    .use(FontAwesomeIcon)
    .use(VueEasyLightbox)
    // .use(RayPlugin, {
    //     interceptErrors: true,
    //     port: 23517,
    //     showComponentEvents: ['created', 'mounted'],
    //     nodeRaySettings: {
    //         interceptConsoleLog: true,
    //     },
    // });



app.component("font-awesome-icon", FontAwesomeIcon);
app.mount('#app')
