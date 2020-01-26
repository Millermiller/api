export interface IUser {
  avatar: string
  email: string
  id: number
  login: string
}
export class User implements IUser {
  avatar!: string
  email!: string
  id!: number
  login!: string

  constructor(id: number, email: string, login: string, avatar: string) {
    this.id = id
    this.email = email
    this.login = login
    this.avatar = avatar
  }
}
