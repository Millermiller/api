import { Mutations } from 'vuex-smart-module';
import AppState from '@/store/modules/app/state';
import * as types from '@/store/mutation-types'

export default class UserMutations extends Mutations<AppState> {
  [types.TOGGLE_DEVICE](device: any) {
    this.state.device.isMobile = device === 'mobile'
    this.state.device.isTablet = device === 'tablet'
  }

  [types.TOGGLE_SIDEBAR](opened: any) {
    if (this.state.device.isMobile) {
      this.state.sidebar.opened = opened
    } else {
      this.state.sidebar.opened = true
    }
  }

  [types.SWITCH_EFFECT](effectItem: any) {
    // eslint-disable-next-line guard-for-in,no-restricted-syntax
    for (const name in effectItem) {
      this.state.effect[name] = effectItem[name]
    }
  }
}
