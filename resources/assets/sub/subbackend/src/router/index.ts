import Vue from 'vue';
import VueRouter from 'vue-router';
import Texts from '@/views/Texts.vue'
import Intro from '@/views/Intro.vue'
import Dashboard from '@/views/Dashboard.vue'
import Assets from '@/views/Assets.vue'
import Upload from '@/views/Upload.vue'
import Puzzles from '@/views/Puzzles.vue'
import Settings from '@/views/Settings.vue'
import Edit from '@/components/intro/Edit.vue'


Vue.use(VueRouter);

const routes = [
  {
    name: 'Dashboard',
    path: '/',
    meta: {
      icon: 'fa-tachometer',
      link: 'dashboard/index.vue',
    },
    component: Dashboard,
  },
  {
    name: 'Словари',
    path: '/assets',
    meta: {
      icon: 'fa-book',
      link: 'assets/index.vue',
    },
    component: Assets,
  },
  {
    name: 'Загрузка',
    path: '/upload',
    meta: {
      icon: 'fa-upload',
      link: 'upload/index.vue',
    },
    component: Upload,
  },
  {
    name: 'Тексты',
    path: '/texts',
    meta: {
      icon: 'fa-file-text',
      link: 'texts/index.vue',
    },
    component: Texts,
  },
  {
    name: 'Паззлы',
    path: '/puzzles',
    meta: {
      icon: 'fa-puzzle-piece ',
      link: 'puzzles/index.vue',
    },
    component: Puzzles,
  },
  {
    name: 'Introjs',
    path: '/intro',
    meta: {
      icon: 'fa-info',
      link: 'intro/index.vue',
    },
    component: Intro,
  },
  {
    name: 'Настройки',
    path: '/settings',
    meta: {
      icon: 'fa-sliders',
      link: 'settings/index.vue',
    },
    component: Settings,
  },
  {
    name: 'textedit',
    path: '/text/:id',
    meta: {
      icon: 'fa-tachometer',
      link: 'texts/textedit/index.vue',
    },
    component: Texts,
  },
  {
    name: 'Intro',
    path: '/intro/:id',
    meta: {
      icon: 'fa-tachometer',
      link: 'intro/edit.vue',
    },
    component: Edit,
  },
  {
    path: '*',
    redirect: '/',
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
});

export default router;
