import { AxiosResponse } from 'axios';
import request from '@/utils/request'
import { IUser } from '@/models/User';
import ILoginForm from '@/api/ILoginForm';

export default {
  login(data: ILoginForm): Promise<AxiosResponse<any>> {
    return request.post('/login', data)
  },
  logout(): Promise<AxiosResponse<any>> {
    return request.post('/logout')
  },
}
