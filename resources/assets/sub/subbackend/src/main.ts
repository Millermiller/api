import Vue from 'vue'
import Buefy from 'buefy'
import VueProgressBar from 'vue-progressbar'
// import VueFroala from 'vue-froala-wysiwyg'
import App from './App.vue'
import router from './router'
import store from './store'
import 'buefy/dist/buefy.css'


require('froala-editor/js/froala_editor.pkgd.min')
// Require Froala Editor css files.
require('froala-editor/css/froala_editor.pkgd.min.css')
// require('font-awesome/css/font-awesome.css')
require('froala-editor/css/froala_style.min.css')

Vue.use(Buefy)
// Vue.use(VueFroala)
Vue.use(VueProgressBar, {
  color: '#7957d5',
  failedColor: '#ff3860',
  transition: {
    speed: '0.2s',
    opacity: '0.1s',
  },
})
Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
