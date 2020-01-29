import Vue from 'vue'
import * as Vuex from 'vuex'
import { createStore } from 'vuex-smart-module'
import VueAwesomeSwiper from 'vue-awesome-swiper'
import VueProgressBar from 'vue-progressbar'
//  import VueBus from 'vue-eventbus'
//  Vue.use(VueBus)
import Meta from 'vue-meta'
//  import 'element-ui/types/notification'
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
  Tag,
} from 'element-ui'
import VueRouter from 'vue-router'
import VueDragDrop from 'vue-drag-drop'
import { store } from '@/store'
import router from './router'
import App from './App.vue'
import 'element-ui/lib/theme-chalk/index.css'
import 'element-ui/lib/theme-chalk/display.css'
import 'swiper/css/swiper.css'
import './libs'

Vue.use(VueProgressBar, {
  color: '#20A0FF',
  failedColor: '#874b4b',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
  },
  location: 'top',
})
Vue.use(Vuex)
Vue.use(VueAwesomeSwiper)
Vue.config.productionTip = false
Vue.use(Loading.directive)
Vue.prototype.$loading = Loading.service
Vue.prototype.$msgbox = MessageBox
Vue.prototype.$alert = MessageBox.alert
Vue.prototype.$confirm = MessageBox.confirm
Vue.prototype.$prompt = MessageBox.prompt
Vue.prototype.$notify = Notification
Vue.prototype.$message = Message

Vue.prototype.$eventHub = new Vue()

Vue.use(VueRouter)
Vue.use(Meta)
Vue.use(VueDragDrop)
Vue.use(Button)
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

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
