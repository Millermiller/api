import { AxiosResponse } from 'axios'
import request from '@/utils/request'


export default {
  all(): Promise<AxiosResponse> {
    return request.get(`/admin/puzzle`)
  },
  load(id: number): Promise<AxiosResponse> {
    return request.get(`/admin/puzzle/${id}`)
  },
  save(id: number, form: any): Promise<AxiosResponse> {
    return request.put(`/admin/puzzle/${id}`, form)
  },
  create(form: any): Promise<AxiosResponse> {
    return request.post('/admin/puzzle', form)
  },
  destroy(id: number): Promise<AxiosResponse> {
    return request.delete(`/admin/puzzle/${id}`)
  },
}
