export interface IText {
  id: number,
  active: boolean
}

export class Text implements IText {
  active!: boolean;

  id!: number;
}
