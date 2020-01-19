import * as types from "../../mutation-types"
import lazyLoading from "./lazyLoading"

// show: meta.label -> name
// name: component name
// meta.label: display label

const state = {
    items: [
        {
            name: 'Dashboard',
            path: '/',
            meta: {
                icon: 'fa-tachometer',
                link: 'dashboard/index.vue'
            },
            component: lazyLoading('dashboard', true)
        },
        {
            name: 'Юзеры',
            path: '/users',
            meta: {
                icon: 'fa-users',
                link: 'users/index.vue'
            },
            component: lazyLoading('users', true)
        },
        {
            name: 'Статьи',
            //path: '/articles',
            meta: {
                icon: 'fa-book',
                expanded: false,
                //link: 'articles/index.vue'
            },
            //component: lazyLoading('articles', true),
            children: [
                {
                    name: 'Все статьи',
                    path: '/articles/index',
                    component: lazyLoading('articles', 'index'),
                    meta: {
                        link: 'articles/index.vue'
                    }
                },
                {
                    name: 'Добавить статью',
                    path: '/articles/add',
                    component: lazyLoading('articles/add'),
                    meta: {
                        link: 'articles/add.vue'
                    }
                },
                {
                    name: 'Категории',
                    path: '/articles/category',
                    component: lazyLoading('articles/category'),
                    meta: {
                        link: 'articles/category.vue'
                    }
                },
                {
                    name: 'Комментарии',
                    path: '/articles/comments',
                    component: lazyLoading('articles/comments'),
                    meta: {
                        link: 'articles/comments.vue'
                    }
                }
            ]
        }
        ,
        {
            name: 'Страницы',
            path: '/pages',
            meta: {
                icon: 'fa-file-text',
                link: 'pages/index.vue'
            },
            component: lazyLoading('pages', true)
        }
        ,
        {
            name: 'Настройки',
            path: '/settings',
            meta: {
                icon: 'fa-sliders',
                link: 'settings/index.vue'
            },
            component: lazyLoading('settings', true)
        }
        ,
        {
            name: 'Почта',
            path: '/mails',
            meta: {
                icon: 'fa-sliders',
                link: 'mails/index.vue'
            },
            component: lazyLoading('mails', true)
        }
        ,
        {
            name: 'Тарифы',
            path: '/plans',
            meta: {
                icon: 'fa-sliders',
                link: 'plans/index.vue'
            },
            component: lazyLoading('plans', true)
        }
        ,
        {
            name: 'Сообщения',
            path: '/messages',
            meta: {
                icon: 'fa-sliders',
                link: 'messages/index.vue'
            },
            component: lazyLoading('messages', true)
        }
    ]
}

const mutations = {
    [types.EXPAND_MENU] (state, menuItem) {
        if (menuItem.index > -1) {
            if (state.items[menuItem.index] && state.items[menuItem.index].meta) {
                state.items[menuItem.index].meta.expanded = menuItem.expanded
            }
        } else if (menuItem.item && 'expanded' in menuItem.item.meta) {
            menuItem.item.meta.expanded = menuItem.expanded
        }
    }
}

export default {
    state,
    mutations
}
