export default {

    user: {
        authenticated: false,
        active: false
    },

    info: {},

    assets: {
        words: [],
        sentences: [],
        favourites: {},
        personal: [],
    },

    percent: 0,
    quantity: 0,
    errors: [],
    asset: {},

    activePersonalAsset: 0,
    activePersonalAssetIndex: 0,
    activePersonalAssetName: '',
    activePersonalAssetEdit: false,
    activeAssetType: '',
    showDictionary: true,

    texts: [],

    intro: {},

    introNeed: {
        'login':      false,
        'main':       false,
        'learnHome':  false,
        'learn':      false,
        'testHome':   false,
        'test':       false,
        'cards':      false,
        'texts':      false,
        'text':       false
    }
}
