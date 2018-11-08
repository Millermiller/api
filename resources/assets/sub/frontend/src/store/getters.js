export default{

    avatar: state => {
        return state.user.avatar;
    },

    login: state => {
        return state.user.login;
    },

    email: state => {
        return state.user.email;
    },

    plan: state => {
        return state.user.plan;
    },

    backdrop: state => {
        return state.backdrop;
    },

    rightMenuOpen: state => {
        return state.rightMenuOpen;
    },

    active_to: state => {
        return state.user.active_to;
    },

    words: state => {
        return state.assets.words;
    },

    sentences: state => {
        return state.assets.sentences;
    },

    personal: state => {
        return state.assets.personal;
    },

    auth: state => {
        return state.user.authenticated;
    },

    isActive: state => {
        return state.user.active
    },

    percent: state => {
        return state.percent
    },

    quantity: state => {
        return state.quantity
    },

    errors: state => {
        return state.errors
    },

    asset: state => {
        return state.asset
    },

    cards: state => {
        if( typeof state.assets.personal[state.activePersonalAssetIndex] !== 'undefined')
            return state.assets.personal[state.activePersonalAssetIndex].cards
    },

    activeAsset: state => {
        return state.activePersonalAsset
    },

    showDictionary: state => {
        return state.showDictionary
    },

    texts: state => {
        return state.texts
    },

    intro: (state, getters) => (id) =>{
        return state.intro[id]
    },

    isShowIntro: (state, getters) => (id) =>{
        return state.introNeed[id]
    },

    activeAssetType: state => {
      return (state.activeAssetType !== '') ? state.activeAssetType : 'words'
    },

    activeAssetName: state => {
      return (state.activePersonalAssetName !== '') ? state.activePersonalAssetName : ''
    },

    activePersonalAssetEdit: state => {
        return state.activePersonalAssetEdit
    },

    activeWords: state => {
        let count = 0

        state.assets.words.forEach(function(element, index, array){
            if(element.active)
                count++
        })

        return count
    },

    activeSentences: state => {
        let count = 0

        state.assets.sentences.forEach(function(element, index, array){
            if(element.active)
                count++
        })

        return count
    },

    activeTexts: state => {
        let count = 0

        state.texts.forEach(function(element, index, array){
            if(element.active)
                count++
        })

        return count
    }
}