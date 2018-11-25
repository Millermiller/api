import VueRouter from 'vue-router';
import Vue    from 'vue'
import Main   from './components/mainpage/index.vue';
import Learn  from './components/learnpage/index.vue';
import Tests  from './components/testpage/index.vue';
import Login  from './components/login.vue';
import Cards  from './components/cardspage/index.vue';
import Texts  from './components/textpage/index.vue';
import Text   from './components/textpage/text.vue';
import Puzzle from './components/puzzle/index.vue';

import store from './store'

const requireAuth = (to, _from, next) => {
    if(store.getters.auth === false){
        Vue.http.get('/check').then((response) => {
            store.commit('setAuth', response.body.auth)
            if(response.body.auth === false){
                next({ name: 'login', })
            }
            else{
                store.commit('setStore', response.body.state);
                store.commit('setSelection', 0)
                next()
            }
        }, (response) => {
            console.log(response);
        });
    }
    else{
        next()
    }
};

export const router = new VueRouter({
    mode: 'hash',
    routes: [
        {
            path: '/',
            name: 'main',
            component: Main,
            beforeEnter: requireAuth,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            beforeEnter (to, from, next){
                if(store.getters.auth){
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
            beforeEnter: requireAuth
        },
        {
            path: '/learn',
            name: 'learnHome',
            component: Learn,
            beforeEnter: requireAuth
        },
        {
            path: '/test',
            name: 'testHome',
            component: Tests,
            beforeEnter: requireAuth
        },
        {
            path: '/test/:id',
            name: 'test',
            component: Tests,
            beforeEnter: requireAuth
        },
        {
            path: '/cards',
            name: 'cards',
            component: Cards,
            beforeEnter: requireAuth
        },
        {
            path: '/translates',
            name: 'texts',
            component: Texts,
            beforeEnter: requireAuth
        },
        {
            path: '/translates/:id',
            name: 'text',
            component: Text,
            beforeEnter: requireAuth
        },
        {
            path: '/puzzle',
            name: 'puzzle',
            component: Puzzle,
            beforeEnter: requireAuth
        },
        {
            path: '*',
            redirect: '/'
        }
        // {
          //  path: '/logout',
          //  beforeEnter (to, from, next) {
          //      auth.logout(Main);
          //      next({ path: '/login' })
          //  }
       // },
    ]
});