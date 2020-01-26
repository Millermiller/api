import { Mutations } from 'vuex-smart-module'
import State from '@/store/modules/test/state'

export default class TestMutations extends Mutations<State> {
  setPercent(data: number): void {
    this.state.percent = data
  }

  setQuantity(data: number): void {
    this.state.quantity = data
  }

  setTitle(data: string): void {
    this.state.title = data
  }

  setLevel(data: number): void {
    this.state.level = data
  }

  setResult(data: number): void {
    this.state.result = data
  }

  setError(data: any) {
    this.state.errors.unshift(data)
  }

  removeError(id: number) {
    this.state.errors.splice(id, 1)
  }

  resetError(): void {
    this.state.errors = []
  }

  resetPercent(): void {
    this.state.percent = 0
  }
}
