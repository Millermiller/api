import { AxiosResponse } from 'axios';
import request from '@/utils/request'
import { IAsset } from '@/models/Asset';

export default {
  getAsset(id: number): Promise<AxiosResponse> {
    return request.get(`/asset/${id}`)
  },
  updateAsset(asset: IAsset, title: string): Promise<AxiosResponse> {
    return request.put(`/asset/${asset.id}`, { title })
  },
  destroyAsset(asset: IAsset): Promise<AxiosResponse> {
    return request.delete(`/asset/${asset.id}`)
  },
}
