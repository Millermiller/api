import { Module } from 'vuex-smart-module';
import MenuState from '@/store/modules/menu/state';
import MenuMutations from '@/store/modules/menu/mutations';

export default new Module({
  namespaced: false,
  state: MenuState,
  mutations: MenuMutations,
})
