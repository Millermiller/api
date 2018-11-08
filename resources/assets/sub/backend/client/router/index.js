import Vue from "vue"
import Router from "vue-router"
import menuModule from "vuex-store/modules/menu"
Vue.use(Router)

export default new Router({
    mode: 'hash', // Demo is living in GitHub.io, so required!
    linkActiveClass: 'is-active',
    scrollBehavior: () => ({y: 0}),
    routes: [
        ...generateRoutesFromMenu(menuModule.state.items),
        {
            name: 'textedit',
            path: '/text/:id',
            meta: {
                icon: 'fa-tachometer',
                link: 'texts/textedit/index.vue'
            },
            component: require('../views/texts/textedit/index')
        },
        {
            name: 'Intro',
            path: '/intro/:id',
            meta: {
                icon: 'fa-tachometer',
                link: 'intro/edit.vue'
            },
            component: require('../views/intro/edit')
        },
        {
            path: '*',
            redirect: '/'
        }
    ]
})

// Menu should have 2 levels.
function generateRoutesFromMenu(menu = [], routes = []) {
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