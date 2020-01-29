import { Getters } from 'vuex-smart-module';
import { Card } from 'element-ui';
import State from '@/store/modules/asset/state';
import { Word } from '@/models/Word';

export default class AssetGetters extends Getters<State> {
  get activeAssetType() {
    return this.state.activeAssetType !== '' ? this.state.activeAssetType : 'words'
  }

  get activeAssetName() {
    return this.state.activePersonalAssetName !== '' ? this.state.activePersonalAssetName : ''
  }

  get activePersonalAssetEdit() {
    return this.state.activePersonalAssetEdit
  }

  get activeWords() {
    let count = 0;

    this.state.assets.words.forEach((element: Word, index: number, array: []) => {
      if (element.active) count++;
    })

    return count;
  }

  get activeSentences() {
    let count = 0;

    this.state.assets.sentences.forEach((element: Word, index: number, array: []) => {
      if (element.active) count++;
    });

    return count;
  }

  get words() {
    return this.state.assets.words;
  }

  get sentences() {
    return this.state.assets.sentences;
  }

  get personal() {
    return this.state.assets.personal;
  }

  get cards(): Card[] | null {
    if (typeof this.state.assets.personal[this.state.activePersonalAssetIndex] !== 'undefined') return this.state.assets.personal[this.state.activePersonalAssetIndex].cards;
    return null;
  }

  get activeAsset() {
    return this.state.activePersonalAsset;
  }
}
