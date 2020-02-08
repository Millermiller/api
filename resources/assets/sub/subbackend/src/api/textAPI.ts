import { AxiosResponse } from 'axios'
import request from '@/utils/request'


export default {
  saveDescription(id: number, form: any): Promise<AxiosResponse> {
    return request.put(`/admin/text/description/${id}`, form)
  },
  saveImage(id: number, form: any): Promise<AxiosResponse> {
    return request.put(`/admin/text/image/${id}`, form)
  },
  getSynonyms(id: number): Promise<AxiosResponse> {
    return request.get(`/admin/text/synonyms/${id}`)
  },
  addSynonym(data: any): Promise<AxiosResponse> {
    return request.post('/admin/text/synonym', data)
  },
  deleteSynonym(id: number): Promise<AxiosResponse> {
    return request.delete(`/admin/text/synonym/${id}`)
  },
  getText(id: number): Promise<AxiosResponse> {
    return request.get(`/admin/text/${id}`)
  },
  getTexts(): Promise<AxiosResponse> {
    return request.get('/admin/texts')
  },
  saveExtra(data: any): Promise<AxiosResponse> {
    return request.post('/admin/text/extra', data)
  },
  saveSentences(data: any): Promise<AxiosResponse> {
    return request.post('/admin/text/sentences', data)
  },
  deleteText(id: number): Promise<AxiosResponse> {
    return request.delete(`/admin/text/${id}`)
  },
  saveText(data: any): Promise<AxiosResponse> {
    return request.post('/admin/text', data)
  },
  publishText(data: any): Promise<AxiosResponse> {
    return request.post('/admin/text/publish', data)
  },
  all(): Promise<AxiosResponse> {
    return request.get(`/admin/text`)
  },
  load(id: number): Promise<AxiosResponse> {
    return request.get(`/admin/text/${id}`)
  },
  save(id: number, form: any): Promise<AxiosResponse> {
    return request.put(`/admin/text/${id}`, form)
  },
  destroy(id: number): Promise<AxiosResponse> {
    return request.delete(`/admin/text/${id}`)
  },
  create(form: any): Promise<AxiosResponse> {
    return request.post('/admin/text', form)
  },
}
