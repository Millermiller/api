import { AxiosResponse } from 'axios';
import userAPI, { ILoginData } from '@/api/userAPI'

export class LoginService {
  public static execute(payload: any): Promise<AxiosResponse<ILoginData>> {
    return new Promise((resolve, reject) => {
      userAPI.login(payload).then((response) => {
        if (response.status === 200) {
          resolve(response)
        } else {
          reject(response.data.message)
        }
      }, (response) => {
        reject(response.response.data.message)
      })
    })
  }

  public static logout() {
    return userAPI.logout()
  }
}
