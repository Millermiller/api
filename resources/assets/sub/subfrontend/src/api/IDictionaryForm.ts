
export default interface IDictionaryForm{
  orig: string,
  translate: string,
  is_public: boolean | number
}

export class DictionaryForm implements IDictionaryForm {
  is_public: boolean | number = false
  orig: string = ''
  translate: string = ''
}
