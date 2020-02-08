import { AxiosResponse } from 'axios'
import request from '@/utils/request'
import { IAsset } from '@/models/Asset'

export default {
  getAsset(id: number): Promise<AxiosResponse> {
    return request.get(`/admin/asset/${id}`)
  },
  getAssets(): Promise<AxiosResponse> {
    return request.get('/admin/assets')
  },
  updateAsset(asset: IAsset, title: string): Promise<AxiosResponse> {
    return request.put(`/asset/${asset.id}`, { title })
  },
  destroyAsset(asset: IAsset): Promise<AxiosResponse> {
    return request.delete(`/asset/${asset.id}`)
  },
  addAsset(type: any): Promise<AxiosResponse> {
    return request.post('/admin/level', { asset_id: type })
  },
  updateAudio(formdata: FormData): Promise<AxiosResponse> {
    return request.post('/admin/audio', formdata)
  },
  translate(data: any): Promise<AxiosResponse> {
    return request.post('/admin/translate', data)
  },
  changeUsedTranslate(data: any): Promise<AxiosResponse> {
    return request.post('/admin/translate', data)
  },
  getValues(card: any): Promise<AxiosResponse> {
    return request.get(`/admin/values/${card.word_id}`)
  },
  getExamples(card: any): Promise<AxiosResponse> {
    return request.get(`/admin/examples/${card.id}`)
  },
  addCard(data: any): Promise<AxiosResponse> {
    return request.post('/card', data)
  },
  destroyCard(card: any): Promise<AxiosResponse> {
    return request.delete(`/card/${card.id}/${card.asset_id}`)
  },
  addAdminCard(data: any): Promise<AxiosResponse> { // TODO: ???
    return request.post('/card', data)
  },
  getTranslate(text: string, sentence: number): Promise<AxiosResponse> {
    return request.get('/translate', { params: { word: text, sentence } })
  },
  sentences(): Promise<AxiosResponse> {
    return request.get('/admin/sentences')
  },
  reloadActiveAssets(id: any): Promise<AxiosResponse> {
    return request.get(`/admin/asset/${id}`)
  },
  removeTranslate(id: number): Promise<AxiosResponse> {
    return request.delete(`/admin/translate/${id}`)
  },
  updateTitle(id: number, data: any): Promise<AxiosResponse> {
    return request.post(`/admin/asset/${id}`, data)
  },
}
