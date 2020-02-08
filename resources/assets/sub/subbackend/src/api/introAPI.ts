import { AxiosResponse } from 'axios'
import request from '@/utils/request'


export default {
  all(): Promise<AxiosResponse> {
    return request.get(`/admin/intro`)
  },
  load(id: number): Promise<AxiosResponse> {
    return request.get(`/admin/intro/${id}`)
  },
  save(id: number, form: any): Promise<AxiosResponse> {
    return request.put(`/admin/intro/${id}`, form)
  },
  destroy(id: number): Promise<AxiosResponse> {
    return request.delete(`/admin/intro/${id}`)
  },
}
