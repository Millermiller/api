import IPlan from '@/models/Plan'

export interface IUser {
  avatar: string
  email: string
  id: number
  login: string
  active_to: any
  active: boolean
  plan: IPlan
}

export class User implements IUser {
  avatar!: string
  email!: string
  id!: number
  login!: string
  active_to: any
  active!: boolean
  plan!: IPlan

  constructor(id: number, email: string, login: string, avatar: string) {
    this.id = id
    this.email = email
    this.login = login
    this.avatar = avatar
  }
}
