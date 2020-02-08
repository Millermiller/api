export default interface IWord {
  id: number,
  active: boolean,
  word: string
}

export class Word implements IWord {
  active!: boolean;

  id!: number;

  word!: string;

  constructor(word: string) {
    this.word = word
  }
}
