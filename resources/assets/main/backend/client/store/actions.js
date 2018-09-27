import * as types from './mutation-types'
import Vue from 'vue'

export const toggleSidebar = ({ commit }, opened) => commit(types.TOGGLE_SIDEBAR, opened)

export const toggleDevice = ({ commit }, device) => commit(types.TOGGLE_DEVICE, device)

export const expandMenu = ({ commit }, menuItem) => {
  if (menuItem) {
    menuItem.expanded = menuItem.expanded || false
    commit(types.EXPAND_MENU, menuItem)
  }
}

export const switchEffect = ({ commit }, effectItem) => {
  if (effectItem) {
    commit(types.SWITCH_EFFECT, effectItem)
  }
}

export const removeCard = ({ commit }, data) => {
  Vue.http.delete('/card/' + data.card.id + '/' + data.card.asset_id).then(
    (response) => {
      if (response.body.success) {
        commit('removeCard', data.index)
      }
    },
    (responce) => {
      //
    }
  )
}

export const reloadActiveAssets = ({ commit }, id) => {
  Vue.http.get('/admin/asset/' + id).then((response) => {
    if (response.body.success) {
      commit('setActiveAsset', response.body.data)
    }
  }, (response) => {
    console.log(response)
  })
}
