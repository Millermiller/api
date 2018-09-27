import Vue from 'vue'
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';
import VueAwesomeSwiper from 'vue-awesome-swiper';
import VueProgressBar from 'vue-progressbar'
import Meta from 'vue-meta'

import store from './store'
import { router } from './router'

import App from './components/App.vue'
import Element from 'element-ui';

import 'element-ui/lib/theme-chalk/index.css';
import 'element-ui/lib/theme-chalk/display.css';
//import 'smooth-scrollbar/dist/smooth-scrollbar.css';
import 'intro.js/minified/introjs.min.css';
import 'swiper/dist/css/swiper.css'
import './libs';

const options = {
    color: '#20A0FF',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s'
    },
    location: 'top',
}

Vue.use(VueProgressBar, options)
Vue.use(Vuex);
Vue.use(VueAwesomeSwiper);
Vue.use(Element);
Vue.use(VueRouter);
Vue.use(VueResource);
Vue.use(Meta)

Vue.http.options.emulateJSON = true
Vue.http.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;

export default new Vue({
    store,
    el: '#app',
    router,
    components: { App },
    template: '<App/>'
    //render: h => h('router-view')
});