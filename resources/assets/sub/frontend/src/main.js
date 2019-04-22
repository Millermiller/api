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

import {
    Button,
    Select,
    Dialog,
    Dropdown,
    Input,
    Checkbox,
    Menu,
    MenuItem,
    Option,
    Tooltip,
    Form,
    Tabs,
    TabPane,
    Row,
    Col,
    FormItem,
    Card,
    Collapse,
    CollapseItem,
    Container,
    Main,
    Progress,
    MessageBox,
    Loading,
    Notification,
    Message,
    Popover,
    Tag
} from 'element-ui';

import VueDragDrop from 'vue-drag-drop';

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
Vue.config.devtools = true
Vue.use(VueProgressBar, options)
Vue.use(Vuex)
Vue.use(VueAwesomeSwiper)

Vue.use(Button);
Vue.use(Select)
Vue.use(Dialog)
Vue.use(Dropdown)
Vue.use(Input)
Vue.use(Checkbox)
Vue.use(Menu)
Vue.use(MenuItem)
Vue.use(Option)
Vue.use(Tooltip)
Vue.use(Form)
Vue.use(Tabs)
Vue.use(TabPane)
Vue.use(Row)
Vue.use(Col)
Vue.use(FormItem)
Vue.use(Card)
Vue.use(Collapse)
Vue.use(CollapseItem)
Vue.use(Container)
Vue.use(Main)
Vue.use(Progress)
Vue.use(Popover)
Vue.use(Tag)

Vue.use(Loading.directive);

Vue.prototype.$loading = Loading.service;
Vue.prototype.$msgbox = MessageBox;
Vue.prototype.$alert = MessageBox.alert;
Vue.prototype.$confirm = MessageBox.confirm;
Vue.prototype.$prompt = MessageBox.prompt;
Vue.prototype.$notify = Notification;
Vue.prototype.$message = Message;

Vue.use(VueRouter);
Vue.use(VueResource);
Vue.use(Meta)
Vue.use(VueDragDrop);

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