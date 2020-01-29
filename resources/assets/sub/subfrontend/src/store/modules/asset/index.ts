import { Module } from 'vuex-smart-module';
import State from '@/store/modules/asset/state';
import AssetMutations from '@/store/modules/asset/mutations';
import AssetGetters from '@/store/modules/asset/getters';
import AssetActions from '@/store/modules/asset/actions';

export const assetModule = new Module({
  namespaced: false,
  state: State,
  getters: AssetGetters,
  mutations: AssetMutations,
  actions: AssetActions,
});
