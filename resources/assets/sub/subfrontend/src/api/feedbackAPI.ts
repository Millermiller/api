import { AxiosResponse } from 'axios';
import request from '@/utils/request'
import IFeedbackForm from '@/api/IFeedbackForm';

export default {
  create(form: IFeedbackForm): Promise<AxiosResponse<any[]>> {
    return request.post('feedback', { message: form.message })
  },
}
