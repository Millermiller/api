import { Module } from 'vuex-smart-module';
import State from '@/store/modules/user/state';
import UserGetters from '@/store/modules/user/getters';
import UserMutations from '@/store/modules/user/mutations';
import UserActions from '@/store/modules/user/actions';

export const user = new Module({
  namespaced: false,
  state: State,
  getters: UserGetters,
  mutations: UserMutations,
  actions: UserActions,
});
