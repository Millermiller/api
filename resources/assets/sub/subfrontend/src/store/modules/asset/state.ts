export default class State {
  assets: any = {
    words: [],
    sentences: [],
    favourites: {},
    personal: [],
  }

  asset = {}

  activePersonalAsset = 0

  activePersonalAssetIndex = 0

  activePersonalAssetName = ''

  activePersonalAssetEdit = false

  activeAssetType = ''
}
