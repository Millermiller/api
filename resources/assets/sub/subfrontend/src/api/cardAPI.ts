import { AxiosResponse } from 'axios';
import request from '@/utils/request'
import { ICard } from '@/models/Card';
import IDictionaryForm from '@/api/IDictionaryForm';
import IWord from '@/models/Word';
import { ITranslate } from '@/models/Translate';
import { IAsset } from '@/models/Asset';


export default {
  createCard(word: IWord, translate: ITranslate, asset: IAsset): Promise<AxiosResponse> {
    return request.post(`/card/${word.id}/${translate.id}/${asset.id}`)
  },
  destroyCard(card: ICard): Promise<AxiosResponse> {
    return request.delete(`/card/${card.id}`)
  },
  translate(word: string, sentence: boolean): Promise<AxiosResponse> {
    return request.get('/translate', { params: { word, sentence: +sentence } })
  },
  addWord(form: IDictionaryForm): Promise<AxiosResponse> {
    return request.post('/word', form)
  },
  addFavourite(item: any): Promise<AxiosResponse> {
    return request.post(`/favourite/${item.word.id}/${item.translate_id}`)
  },
  destroyFavourite(item: any): Promise<AxiosResponse> {
    return request.delete(`/favourite/${item.word.id}`)
  },
}
