import { Getters } from 'vuex-smart-module';
import MenuState from '@/store/modules/menu/state';

export default class UserGetters extends Getters<MenuState> {
  get menuitems() {
    return this.state.items
  }

  get componententry() {
    return this.state.items.filter((c: any) => c.meta && c.meta.label === 'Components')[0]
  }
}
