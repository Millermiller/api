import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '@/views/Home.vue'
import Learn from '@/views/Learn.vue'
import Tests from '@/views/Tests.vue'
import Login from '@/views/Login.vue'
import Cards from '@/views/Cards.vue'
import Texts from '@/views/Texts.vue'
import TextItem from '@/views/Text.vue'
import Puzzles from '@/views/Puzzles.vue'
import { store } from '@/store'
import commonAPI from '@/api/commonAPI'

Vue.use(VueRouter)

const requireAuth = (to: any, _from: any, next: any) => {
  if (store.getters.auth === false) {
    commonAPI.check().then((response) => {
      store.commit('setAuth', response.data.auth)
      if (response.data.auth === false) {
        next({ name: 'login' })
      } else {
        store.dispatch('setStore', response.data.state)
        store.commit('setSelection', 0)
        next()
      }
    }, (response) => {
      console.log(response)
    })
  } else {
    next()
  }
}

const routes = [
  {
    path: '/',
    name: 'main',
    meta: {
      title: 'page401',
      noCache: true,
    },
    component: Home,
    beforeEnter: requireAuth,
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    beforeEnter(to: any, from: any, next: any) {
      if (store.getters.auth) {
        next({ path: '/' })
      } else {
        next()
      }
    },
  },
  {
    path: '/learn/:id',
    name: 'learn',
    component: Learn,
    beforeEnter: requireAuth,
  },
  {
    path: '/learn',
    name: 'learnHome',
    component: Learn,
    beforeEnter: requireAuth,
  },
  {
    path: '/test',
    name: 'testHome',
    component: Tests,
    beforeEnter: requireAuth,
  },
  {
    path: '/test/:id',
    name: 'test',
    component: Tests,
    beforeEnter: requireAuth,
  },
  {
    path: '/cards',
    name: 'cards',
    component: Cards,
    beforeEnter: requireAuth,
  },
  {
    path: '/translates',
    name: 'texts',
    component: Texts,
    beforeEnter: requireAuth,
  },
  {
    path: '/translates/:id',
    name: 'text',
    component: TextItem,
    beforeEnter: requireAuth,
  },
  {
    path: '/puzzle',
    name: 'puzzle',
    component: Puzzles,
    beforeEnter: requireAuth,
  },
  {
    path: '*',
    redirect: '/',
  },

  // {
  //  path: '/about',
  //  name: 'about',
  // route level code-splitting
  // this generates a separate chunk (about.[hash].js) for this route
  // which is lazy-loaded when the route is visited.
  // component: () => import(/* webpackChunkName: "about" */ '../views/About.vue'),
  // }
]

const router = new VueRouter({
  mode: 'hash',
  base: process.env.BASE_URL,
  routes,
})

export default router
