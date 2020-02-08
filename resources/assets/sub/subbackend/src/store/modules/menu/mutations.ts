import { Mutations } from 'vuex-smart-module';
import MenuState from '@/store/modules/menu/state';
import * as types from '@/store/mutation-types'

export default class MenuMutations extends Mutations<MenuState> {
  [types.EXPAND_MENU](state: any, menuItem: any) {
    if (menuItem.index > -1) {
      if (this.state.items[menuItem.index] && state.items[menuItem.index].meta) {
        this.state.items[menuItem.index].meta.expanded = menuItem.expanded
      }
    } else if (menuItem.item && 'expanded' in menuItem.item.meta) {
      menuItem.item.meta.expanded = menuItem.expanded
    }
  }
}
