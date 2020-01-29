// Import base classes
// https://github.com/ktsn/vuex-smart-module
import {
  Getters, Mutations, Actions, Module, Context,
} from 'vuex-smart-module'
import Vue from 'vue'
import { Store } from 'vuex'
import request from '@/utils/request'

import { assetModule } from '@/store/modules/asset'
import { text } from '@/store/modules/text'
import { user } from '@/store/modules/user'
import { test } from '@/store/modules/test'
import { User } from '@/models/User'
import IState from '@/models/State';


interface SetStoreParams {
  data: any
}

// State
class State {
  sites = []
  currentsite = {}
  domain = ''
  info = {}
  backdrop = 0
  rightMenuOpen = false
  showDictionary = true
  intro = []

  introNeed = {
    login: false,
    main: false,
    learnHome: false,
    learn: false,
    testHome: false,
    test: false,
    cards: false,
    texts: false,
    text: false,
  }
}

// Getters
// Extend 'Getters' class with 'FooState' type
class CommonGetters extends Getters<State> {
  get sites() {
    return this.state.sites
  }

  get currentsite() {
    return this.state.currentsite
  }

  get backdrop() {
    return this.state.backdrop
  }

  get rightMenuOpen() {
    return this.state.rightMenuOpen
  }

  get showDictionary() {
    return this.state.showDictionary
  }

  intro(id: number) {
    return this.state.intro[id]
  }

  isShowIntro = (id: string) => {
    // return this.state.introNeed[id]
  }
}

// Mutations
// Extend 'Mutations' class with 'FooState' type
class CommonMutations extends Mutations<State> {
  setInfo(info: any): void {
    this.state.info = info
  }

  showDictionary(): void {
    this.state.showDictionary = true
  }

  hideDictionary(): void {
    this.state.showDictionary = false
  }

  // setIntroVisibility = ({data}: { data: any }) => this.state.introNeed[data.page] = data.visible

  setBackdrop(data: number): void {
    this.state.backdrop = data
  }

  setMenuOpen(data: boolean): void {
    this.state.rightMenuOpen = data
  }

  setSites(sites: any) {
    this.state.sites = sites
  }

  setCurrentSite(site: any) {
    this.state.currentsite = site
  }

  setDomain(domain: string) {
    this.state.domain = domain
  }
}

class CommonActions extends Actions<State, CommonGetters, CommonMutations, CommonActions> {
  userstore!: Context<typeof user>

  assetstore!: Context<typeof assetModule>

  textstore!: Context<typeof text>

  $init(store: Store<any>): void {
    this.userstore = user.context(store)
    this.assetstore = assetModule.context(store)
    this.textstore = text.context(store)
  }

  setStore(data: IState) {
    this.userstore.commit('setUser', new User(data.user.id, data.user.email, data.user.login, data.user.avatar))
    this.userstore.commit('setActiveTo', new Date(data.user.active_to.date).toLocaleDateString())
    this.userstore.commit('setActive', data.user.active)
    this.userstore.commit('setPlan', data.user.plan)
    // this.state.info.site = data.site

    this.assetstore.commit('setWords', data.words)
    this.assetstore.commit('setSentences', data.sentences)
    this.assetstore.commit('setFavourites', data.favourites)
    this.assetstore.commit('setPersonal', data.personal)

    this.textstore.commit('setTexts', data.texts)

    // this.commit('setIntro', data.intro)
    this.commit('setSites', data.sites)
    this.commit('setCurrentSite', data.currentsite)
    this.commit('setDomain', data.domain)
  }

  reloadStore = () => {
    (<any>Vue).Vue.http.get('/check').then(
      (response: any) => {
        this.setStore(response.data.state)
      },
      (response: any) => {
        console.log(response.data)
      },
    )
  }

  toggleBackdrop = () => {
    if (this.state.backdrop === 0 && this.state.rightMenuOpen) this.commit('setBackdrop', 1)
    else this.commit('setBackdrop', 0)
  }

  toggleMenuOpen = () => this.commit('setMenuOpen', !this.state.rightMenuOpen)
}

// Create a module with module asset classes
export const root = new Module({
  namespaced: false,
  state: State,
  getters: CommonGetters,
  mutations: CommonMutations,
  actions: CommonActions,
  modules: {
    user,
    assetModule,
    text,
    test,
  },
})
