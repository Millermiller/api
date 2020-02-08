import { Module } from 'vuex-smart-module';
import AppState from '@/store/modules/app/state';
import AppMutations from '@/store/modules/app/mutations';

export default new Module({
  namespaced: false,
  state: AppState,
  mutations: AppMutations,
})
