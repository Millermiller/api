export default {

    user: {
        authenticated: false,
        active: false,
        plan: {
            name: '',
            id: ''
        }
    },

    sites: [],
    currentsite: {},
    domain: '',

    info: {},

    assets: {
        words: [],
        sentences: [],
        favourites: {},
        personal: [],
    },
    backdrop: 0,
    rightMenuOpen: false,
    percent: 0,
    quantity: 0,
    result: 0,
    level: 0,
    title: '',
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
