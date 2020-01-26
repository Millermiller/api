import { AxiosResponse } from 'axios';
import request from '@/utils/request'
import { IPuzzle } from '@/models/Puzzle';

export default {
  getPuzzles(): Promise<AxiosResponse<IPuzzle[]>> {
    return request.get('/puzzle')
  },

  processPuzzle(puzzle: IPuzzle): Promise<AxiosResponse> {
    return request.put(`/puzzle/${puzzle.id}`)
  },

  /*
  axios.get('fetch-data')
    .then((response) => {
      let res: Players[] = response.data;
      for(let i = 0; i < res.length; i++){
        self.players.push(res[i]);
      }
    })
    .catch((error: string) => {
      console.log(error);
    });

   */
}
