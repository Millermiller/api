import { AxiosResponse } from 'axios';
import request from '@/utils/request'
import { ITest } from '@/models/Test';

export default {
  saveResult(test: ITest, percent: number): Promise<AxiosResponse> {
    return request.post(`/result/${test.id}`, { result: percent })
  },
  nextLevel(test: ITest): Promise<AxiosResponse> {
    return request.post(`/complete/${test.id}`)
  },
}
