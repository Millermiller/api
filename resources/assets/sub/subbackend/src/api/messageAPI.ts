import { AxiosResponse } from 'axios'
import request from '@/utils/request'


export default {
  read(id: number): Promise<AxiosResponse> {
    return request.get(`/admin/message/${id}`)
  },
  delete(id: number): Promise<AxiosResponse> {
    return request.delete(`/admin/message/${id}`)
  },
}
