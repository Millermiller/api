import { Mutations } from 'vuex-smart-module';
import Vue from 'vue';
import State from '@/store/modules/asset/state';
import { Word } from '@/models/Word';
import ISentence from '@/models/Sentence';
import { IPersonal } from '@/models/Personal';
import { Card } from '@/models/Card';
import { Asset } from '@/models/Asset';

export default class AssetMutations extends Mutations<State> {
  setPersonal(data: IPersonal[]) {
    this.state.assets.personal = data;
  }

  setWords(data: Word[]) {
    this.state.assets.words = data;
  }

  setSentences(data: ISentence[]) {
    this.state.assets.sentences = data;
  }

  setFavourites(data: any) {
    this.state.assets.favourites = data;
  }

  removePersonal(id: number) {
    this.state.assets.personal.splice(id, 1)
  }

  addPersonal(asset: IPersonal) {
    this.state.assets.personal.push(asset)
  }

  /**
   *
   * @param data
   * @param data.index
   * @param data.asset
   */
  patchPersonal(data: any) {
    this.state.assets.personal[data.index] = data.asset;
  }

  /**
   *
   * @param card
   * @param card.id
   * @param card.asset_id
   */
  removeCard(card: Card) {
    const index = this.state.assets.personal.findIndex((item: any) => item.id === card.asset_id);
    this.state.assets.personal[index].count--;
  }

  setAsset(asset: Asset): void {
    this.state.asset = asset;
  }

  addCardToFavorite(): void {
    this.state.assets.personal[0].count++;
  }

  removeCardFromFavorite(): void {
    this.state.assets.personal[0].count--;
  }

  /**
   * @param asset_id
   */
  addCard(asset_id: number) {
    const index = this.state.assets.personal.findIndex((item: any) => item.id === asset_id);
    this.state.assets.personal[index].count++;
  }

  setSelection(data: { asset: any, index: number }) {
    this.state.assets.personal.forEach((element: IPersonal, index: number, array: []) => {
      Vue.set(element, 'selected', element.id === data.index);
    });
    this.state.assets.sentences.forEach((element: ISentence, index: number, array: []) => {
      Vue.set(element, 'selected', element.id === data.index);
    });
    this.state.assets.words.forEach((element: Word, index: number, array: []) => {
      Vue.set(element, 'selected', element.id === data.index);
    });

    if (data.index >= 0) {
      if (data.asset.type === 1) {
        // Vue.set(state.assets.words[data.index], 'selected', true)
      }
      if (data.asset.type === 2) {
        //  Vue.set(state.assets.sentences[data.index], 'selected', true)
      } else {
        Vue.set(this.state.assets.personal[data.index], 'selected', true);
        this.state.activePersonalAsset = this.state.assets.personal[data.index].id;
        this.state.activePersonalAssetName = this.state.assets.personal[data.index].title;
        this.state.activePersonalAssetIndex = data.index;
      }
    }
  }

  setActivePersonalAssetName(data: string): void {
    this.state.activePersonalAssetName = data;
  }

  setActiveAssetType(data: string): void {
    this.state.activeAssetType = data;
  }

  setActiveAssetEdit(data: boolean): void {
    this.state.activePersonalAssetEdit = data;
  }
}
