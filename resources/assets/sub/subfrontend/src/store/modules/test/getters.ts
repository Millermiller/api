import { Getters } from 'vuex-smart-module';
import State from '@/store/modules/test/state';

export default class TestGetters extends Getters<State> {
  get percent() {
    return this.state.percent;
  }

  get quantity() {
    return this.state.quantity;
  }

  get level() {
    return this.state.level;
  }

  get title() {
    return this.state.title;
  }

  get result() {
    return this.state.result;
  }

  get errors() {
    return this.state.errors;
  }
}
