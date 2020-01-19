import * as types from '../mutation-types'

const state = {
  device: {
    isMobile: false,
    isTablet: false
  },
  sidebar: {
    opened: false,
    hidden: false
  },
  effect: {
    translate3d: true
  },
  activeAsset: {},
  activeAssetId: 0
}

const mutations = {
  [types.TOGGLE_DEVICE] (state, device) {
    state.device.isMobile = device === 'mobile'
    state.device.isTablet = device === 'tablet'
  },

  [types.TOGGLE_SIDEBAR] (state, opened) {
    if (state.device.isMobile) {
      state.sidebar.opened = opened
    } else {
      state.sidebar.opened = true
    }
  },

  [types.SWITCH_EFFECT] (state, effectItem) {
    for (let name in effectItem) {
      state.effect[name] = effectItem[name]
    }
  },
  setActiveAsset (state, data) {
    state.activeAsset = data.cards
    state.activeAssetId = data.id
  },
  removeCard (state, id) {
    state.activeAsset.splice(id, 1)
  },
  changeAssetTranslate (state, data) {
    state.activeAsset[data.index].translate.value = data.translate.value
    state.activeAsset[data.index].translate.id = data.translate.id
    state.activeAsset[data.index].translate_id = data.translate.id
    state.activeAsset[data.index].translate.active = data.translate.active
  },
  changeAssetWord (state, data) {
    state.activeAsset[data.index].translate.value = data.text
  },
  changeAssetAudio (state, data) {
    state.activeAsset[data.index].word.audio = data.url
  },
  addCard (state, data) {
    state.activeAsset.push(data)
  }
}

const getters = {
  cards: state => {
    return state.activeAsset
  },
  activeAssetId: state => {
    return state.activeAssetId
  }
}

export default {
  state,
  mutations,
  getters
}
