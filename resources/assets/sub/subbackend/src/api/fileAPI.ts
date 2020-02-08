import { AxiosResponse } from 'axios'
import request from '@/utils/request'

export default {
  uploadWordfile(data: any): Promise<AxiosResponse> {
    return request.post('/admin/wordfile', data)
  },
  addCard(word: any, translate: any, issentence: any): Promise<AxiosResponse> {
    return request.post('/admin/card', { word, translate, issentence })
  },
}
