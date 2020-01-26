import { Actions } from 'vuex-smart-module';
import State from '@/store/modules/user/state';
import UserGetters from '@/store/modules/user/getters';
import UserMutations from '@/store/modules/user/mutations';

export default class UserActions extends Actions<State, UserGetters, UserMutations, UserActions> {
  auth(isAuth: boolean) {
    this.commit('setAuth', isAuth);
  }
}
