import { Getters } from 'vuex-smart-module';
import State from '@/store/modules/user/state';

export default class UserGetters extends Getters<State> {
  get user() {
    return this.state.user;
  }

  get avatar() {
    return this.state.user.avatar;
  }

  get login() {
    return this.state.user.login;
  }

  get email() {
    return this.state.user.email;
  }

  get plan() {
    return this.state.user.plan;
  }

  get active_to() {
    return this.state.user.active_to;
  }


  get auth() {
    return this.state.user.authenticated;
  }

  get isActive() {
    return this.state.user.active;
  }
}
