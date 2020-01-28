import { AxiosResponse } from 'axios'
import request from '@/utils/request'
import ILoginForm from '@/api/ILoginForm'
import IState from '@/models/State'

export interface ILoginData {
  state: IState
  message: string
}

export default {
  login(data: ILoginForm): Promise<AxiosResponse<ILoginData>> {
    return request.post('/login', data)
  },
  logout(): Promise<AxiosResponse> {
    return request.post('/logout')
  },
}
