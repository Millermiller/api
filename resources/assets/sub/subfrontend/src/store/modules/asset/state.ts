export default class State {
  assets: any = {
    words: [],
    sentences: [],
    favourites: {},
    personal: [],
  }

  activePersonalAsset = 0

  activePersonalAssetIndex = 0

  activePersonalAssetName = ''

  activePersonalAssetEdit = false

  activeAssetType = ''
}
