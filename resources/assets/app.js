/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import {createApp} from 'vue'
import App from './components/App'
import router from './router'
import VueEasyLightbox from 'vue-easy-lightbox'




import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { fas } from '@fortawesome/free-solid-svg-icons'
library.add(fas);
import { fab } from '@fortawesome/free-brands-svg-icons';
library.add(fab);
import { far } from '@fortawesome/free-regular-svg-icons';
library.add(far);
import { dom } from "@fortawesome/fontawesome-svg-core";
dom.watch();



// library.add(faCheck, faTimes,faSortAlphaUp,faSortAlphaDown,faTrash,faFilter,faSearch)
// import i18n from "./i18n";
// import store from './store'



const app = createApp(App)
    // .use(i18n)
    // .use(store)
    .use(router)
    .use(library)
    .use(FontAwesomeIcon)
    .use(VueEasyLightbox)
    // .use(AudioRecorder)




app.component("font-awesome-icon", FontAwesomeIcon);
app.mount('#app')
