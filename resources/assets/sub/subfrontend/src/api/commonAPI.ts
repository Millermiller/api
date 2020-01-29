import { AxiosResponse } from 'axios';
import request from '@/utils/request'

export default {
  check(): Promise<AxiosResponse<any>> {
    return request.get('/check')
  },
}
