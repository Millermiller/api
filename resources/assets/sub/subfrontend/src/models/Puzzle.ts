export interface IPuzzle{
  id: number,
  success: boolean,
  active: boolean,
  text: string,
  translate: any
}

export class Puzzle implements IPuzzle {
  active!: boolean;

  id!: number;

  success!: boolean;

  text!: string;

  translate: any;
}
