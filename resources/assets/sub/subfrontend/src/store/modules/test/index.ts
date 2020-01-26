import { Module } from 'vuex-smart-module';
import State from '@/store/modules/test/state';
import TestGetters from '@/store/modules/test/getters';
import TestMutations from '@/store/modules/test/actions';

export const test = new Module({
  namespaced: false,
  state: State,
  getters: TestGetters,
  mutations: TestMutations,
});
