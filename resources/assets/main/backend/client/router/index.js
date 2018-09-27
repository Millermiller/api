import Vue from 'vue'
import Router from 'vue-router'
import menuModule from 'vuex-store/modules/menu'
Vue.use(Router)

export default new Router({
  mode: 'hash', // Demo is living in GitHub.io, so required!
  linkActiveClass: 'is-active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    ...generateRoutesFromMenu(menuModule.state.items),
      {
          name: 'Юзер',
          path: '/user/:id',
          meta: {
              icon: 'fa-tachometer',
              link: 'users/edit.vue'
          },
          component: require('../views/users/edit')
      },
      {
          name: 'Статья',
          path: '/article/:id',
          meta: {
              icon: 'fa-tachometer',
              link: 'articles/edit.vue'
          },
          component: require('../views/articles/edit')
      },
      {
          name: 'Страница',
          path: '/page/:id',
          meta: {
              icon: 'fa-tachometer',
              link: 'pages/edit.vue'
          },
          component: require('../views/pages/edit')
      },
      {
          name: 'Добавить страницу',
          path: '/page/add',
          meta: {
              icon: 'fa-tachometer',
              link: 'pages/add.vue'
          },
          component: require('../views/pages/add')
      },
      {
      path: '*',
      redirect: '/'
    }
  ]
})

// Menu should have 2 levels.
function generateRoutesFromMenu (menu = [], routes = []) {
  for (let i = 0, l = menu.length; i < l; i++) {
    let item = menu[i]
    if (item.path) {
      routes.push(item)
    }
    if (!item.component) {
      generateRoutesFromMenu(item.children, routes)
    }
  }
  return routes
}
