import { AxiosResponse } from 'axios'
import request from '@/utils/request'

export default {
  getAudio(id: number): Promise<AxiosResponse> {
    return request.post(`/admin/forvo/${id}`)
  },
}
