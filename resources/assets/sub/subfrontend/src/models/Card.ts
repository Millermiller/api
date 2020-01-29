import IWord from '@/models/Word'
import { ITranslate } from '@/models/Translate'

export interface ICard {
  translate: ITranslate
  id: number
  asset_id: number
  word?: IWord
  exist?: boolean
  favourite?: boolean
  nocontrols?: boolean
}

export class Card implements ICard {
  asset_id!: number
  id!: number
  word?: IWord
  translate!: ITranslate
  nocontrols?: boolean

  constructor(word?: IWord, nocontrols?: boolean) {
    this.word = word
    this.nocontrols = nocontrols
  }
}
