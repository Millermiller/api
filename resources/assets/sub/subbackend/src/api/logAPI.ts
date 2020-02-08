import { AxiosResponse } from 'axios'
import request from '@/utils/request'


export default {
  read(id: number): Promise<AxiosResponse> {
    return request.get(`/admin/log/${id}`)
  },
  delete(id: number): Promise<AxiosResponse> {
    return request.delete(`/admin/log/${id}`)
  },
}
