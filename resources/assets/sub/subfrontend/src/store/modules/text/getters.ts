import { Getters } from 'vuex-smart-module'
import State from '@/store/modules/text/state'
import { IText } from '@/models/Text'

export default class TextGetters extends Getters<State> {
  get texts() {
    return this.state.texts
  }

  get activeTexts() {
    let count = 0

    this.state.texts.forEach((element:IText, index: number, array: IText[]) => {
      if (element.active) count++
    })

    return count
  }
}
