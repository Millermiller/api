import { Mutations } from 'vuex-smart-module';
import State from '@/store/modules/user/state';
import { IUser } from '@/models/User';

export default class UserMutations extends Mutations<State> {
  setUser(user: IUser) {
    this.state.user.avatar = user.avatar;
    this.state.user.email = user.email;
    this.state.user.id = user.id;
    this.state.user.login = user.login;
  }

  setAuth(auth: boolean) {
    this.state.user.authenticated = auth;
  }

  setActiveTo(date: string) {
    this.state.user.active_to = date
  }

  setActive(active: boolean) {
    this.state.user.active = active
  }

  setPlan(plan: any) {
    this.state.user.plan = plan
  }
}
