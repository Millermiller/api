import * as types from '../../mutation-types'
import lazyLoading from './lazyLoading'

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
            name: 'Словари',
            path: '/assets',
            meta: {
                icon: 'fa-book',
                link: 'assets/index.vue'
            },
            component: lazyLoading('assets', true)
        },
        {
            name: 'Загрузка',
            path: '/upload',
            meta: {
                icon: 'fa-upload',
                link: 'upload/index.vue'
            },
            component: lazyLoading('upload', true)
        }
        ,
        {
            name: 'Тексты',
            path: '/texts',
            meta: {
                icon: 'fa-file-text',
                link: 'texts/index.vue'
            },
            component: lazyLoading('texts', true)
        }
        ,
        {
            name: 'Паззлы',
            path: '/puzzles',
            meta: {
                icon: 'fa-puzzle-piece ',
                link: 'puzzles/index.vue'
            },
            component: lazyLoading('puzzles', true)
        },
        {
            name: 'Introjs',
            path: '/intro',
            meta: {
                icon: 'fa-info',
                link: 'intro/index.vue'
            },
            component: lazyLoading('intro', true)
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
