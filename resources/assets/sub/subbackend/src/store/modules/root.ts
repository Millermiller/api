import {
  Getters, Mutations, Actions, Module, Context,
} from 'vuex-smart-module'

import { Store } from 'vuex'
import menu from '@/store/modules/menu'
import app from '@/store/modules/app'
import asset from '@/store/modules/asset'

class State {

}
class CommonGetters extends Getters<State> {

}
class CommonMutations extends Mutations<State> {

}

class CommonActions extends Actions<State, CommonGetters, CommonMutations, CommonActions> {
  menustore!: Context<typeof menu>
  appstore!: Context<typeof app>
  assetstore!: Context<typeof asset>

  $init(store: Store<any>): void {
    this.menustore = menu.context(store)
    this.appstore = app.context(store)
    this.assetstore = asset.context(store)
  }
}

// Create a module with module asset classes
export const root = new Module({
  namespaced: false,
  actions: CommonActions,
  modules: {
    menu,
    app,
    asset,
  },
})
