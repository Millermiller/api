import { Actions } from 'vuex-smart-module'
import AppState from '@/store/modules/app/state'
import AppGetters from '@/store/modules/app/getters'
import AppMutations from '@/store/modules/app/mutations'
import * as types from '@/store/mutation-types'
import assetAPI from '@/api/assetAPI'

export default class AppActions extends Actions<AppState, AppGetters, AppMutations, AppActions> {
  toggleSidebar(opened: any) {
    this.commit(types.TOGGLE_SIDEBAR, opened)
  }

  toggleDevice(device: any) {
    this.commit(types.TOGGLE_DEVICE, device)
  }

  expandMenu(menuItem: any) {
    if (menuItem) {
      menuItem.expanded = menuItem.expanded || false
      this.commit(types.EXPAND_MENU, menuItem)
    }
  }

  switchEffect(effectItem: any) {
    if (effectItem) {
      this.commit(types.SWITCH_EFFECT, effectItem)
    }
  }

  removeCard(data: any) {
    assetAPI.destroyCard(data.card).then(
      (response) => {
        if (response.data.success) {
          this.commit('removeCard', data.index)
        }
      },
      (responce) => {
        //
      },
    )
  }

  reloadActiveAssets(id: any) {
    assetAPI.reloadActiveAssets(id).then((response) => {
      if (response.data.success) {
        this.commit('setActiveAsset', response.data.data)
      }
    }, (response) => {
      console.log(response)
    })
  }
}
