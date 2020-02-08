import { Getters } from 'vuex-smart-module'
import AssetState from '@/store/modules/asset/state'

export default class UserGetters extends Getters<AssetState> {
  get cards() {
    return this.state.activeAsset
  }

  get activeAssetId() {
    return this.state.activeAssetId
  }
}
