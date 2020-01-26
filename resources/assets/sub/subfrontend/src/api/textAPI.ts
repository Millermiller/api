import { AxiosResponse } from 'axios';
import request from '@/utils/request'
import { IText } from '@/models/Text';

export default {
  getText(id: number): Promise<AxiosResponse> {
    return request.get(`/text/${id}`)
  },
  nextLevel(text: IText): Promise<AxiosResponse> {
    return request.post('/nextTLevel', { id: text.id })
  },
}
