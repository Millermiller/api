import { Mutations } from 'vuex-smart-module';
import AssetState from '@/store/modules/asset/state';

export default class UserMutations extends Mutations<AssetState> {
  setActiveAsset(data: any) {
    this.state.activeAsset = data.cards
    this.state.activeAssetId = data.id
  }

  removeCard(id: any) {
    this.state.activeAsset.splice(id, 1)
  }

  changeAssetTranslate(data: any) {
    this.state.activeAsset[data.index].translate.value = data.translate.value
    this.state.activeAsset[data.index].translate.id = data.translate.id
    this.state.activeAsset[data.index].translate_id = data.translate.id
    this.state.activeAsset[data.index].translate.active = data.translate.active
  }

  changeAssetWord(data: any) {
    this.state.activeAsset[data.index].translate.value = data.text
  }

  changeAssetAudio(data: any) {
    this.state.activeAsset[data.index].word.audio = data.url
  }

  addCard(data: any) {
    this.state.activeAsset.push(data)
  }
}
