import { Actions } from 'vuex-smart-module'
import request from '@/utils/request'
import State from '@/store/modules/asset/state'
import AssetGetters from '@/store/modules/asset/getters'
import AssetMutations from '@/store/modules/asset/mutations'

export default class AssetActions extends Actions<State, AssetGetters, AssetMutations, AssetActions> {
  addPersonalAsset(title: string) {
    return new Promise((resolve, reject) => {
      request.post('/asset', { title }).then(
        (response: any) => {
          if (response.status === 201) {
            this.dispatch('reloadPersonal')
            this.commit('setSelection', 1)
            resolve(response)
          }
        },
        (response: any) => {
          console.log(response.data)
          reject()
        },
      )
    })
  }

  reloadPersonal() {
    return new Promise((resolve, reject) => {
      request.get('/personal').then(
        (response: any) => {
          this.commit('setPersonal', response.data)
          resolve(response)
        },
        (response: any) => {
          console.log(response.data)
          reject()
        },
      )
    })
  }

  loadAsset(data: any) {
    this.commit('setSelection', data)
  }

  setActiveAssetType(data: number) {
    let type = ''

    if (data === 1) type = 'words'
    else if (data === 2) type = 'sentences'
    else type = 'personal'

    this.commit('setActiveAssetType', type)
  }

  onCardsPageClose() {
    this.commit('setSelection', 1)
    this.commit('setActiveAssetEdit', false)
  }

  onCardsPageOpen() {
    const asset = { type: 3 }
    if (!this.state.activePersonalAssetEdit) this.commit('setSelection', 1)
  }
}
