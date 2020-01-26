import { Mutations } from 'vuex-smart-module';
import State from '@/store/modules/text/state';
import { IText } from '@/models/Text';

export default class TextMutations extends Mutations<State> {
  setTexts(data: IText[]) {
    this.state.texts = data;
  }
}
