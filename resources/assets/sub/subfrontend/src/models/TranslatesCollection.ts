import { Collection } from '@/models/Collection';

export class TranslatesCollection extends Collection {
  data: string[]

  constructor(data: string[]) {
    super(data)
    this.data = data
  }
}
