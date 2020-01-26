import { Module } from 'vuex-smart-module';
import TextMutations from '@/store/modules/text/mutations';
import TextGetters from '@/store/modules/text/getters';
import State from '@/store/modules/text/state';

export const text = new Module({
  namespaced: false,
  state: State,
  getters: TextGetters,
  mutations: TextMutations,
});
