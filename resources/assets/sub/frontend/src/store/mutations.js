import Vue from 'vue'
export default {

    setUser(state, user){
        state.user.avatar = user.avatar
        state.user.email = user.email
        state.user.id = user.id
        state.user.login = user.login
    },

    setInfo(state, info){
        state.info = info
    },

    setStore(state, data){
        state.user.avatar = data.user.avatar
        state.user.email = data.user.email
        state.user.id = data.user.id
        state.user.login = data.user.login
        state.user.active = data.user.active
        state.user.active_to = new Date(data.user.active_to.date).toLocaleDateString()
        state.user.plan = data.user.plan
        state.info.site = data.site

        state.assets.words = data.words
        state.assets.sentences = data.sentences
        state.assets.favourites = data.favourites
        state.assets.personal = data.personal

        state.texts = data.texts
        state.intro = data.intro
    },

    setTexts(state, data){
        state.texts = data
    },

    setAuth(state, auth){
        state.user.authenticated = auth
    },

    setWords(state, data){
        state.assets.words = data
    },

    setSentences(state, data){
        state.assets.sentences = data
    },

    setPercent(state, data){
        state.percent = data
    },

    setQuantity(state, data){
        state.quantity = data
    },

    setError(state, data){
        state.errors.splice(0, 0, data)
    },

    removeError(state, id){
        state.errors.splice(id, 1)
    },

    removePersonal(state, id){
        state.assets.personal.splice(id, 1)
    },

    addPersonal(state, asset){
        state.assets.personal.splice(1, 0, asset)
    },

    resetError(state){
        state.errors = []
    },

    resetPercent(state){
        state.percent = 0
    },

    setAsset(state, data){
        state.asset = data
    },

    addCard(state, data){
        state.assets.personal[state.activePersonalAssetIndex].cards.splice(0, 0, data)
    },

    addCardToFavorite(state, data){
        state.assets.personal[0].cards.splice(0, 0, data)
    },

    removeCardFromFavorite(state, id){
        state.assets.personal[0].cards.splice(id, 1)
    },

    setSelection(state, data){
        state.assets.personal.forEach(function(element, index, array){
            Vue.set(element, 'selected', element.id === data)
        })
        state.assets.sentences.forEach(function(element, index, array){
            Vue.set(element, 'selected', element.id === data)
        })
        state.assets.words.forEach(function(element, index, array){
            Vue.set(element, 'selected', element.id === data)
        })

        if(data.index >= 0){
            if(data.asset.type === 1){
               // Vue.set(state.assets.words[data.index], 'selected', true)
            }
            if(data.asset.type === 2){
              //  Vue.set(state.assets.sentences[data.index], 'selected', true)
            }
            else{
                Vue.set(state.assets.personal[data.index], 'selected', true)
                state.activePersonalAsset = state.assets.personal[data.index].id
                state.activePersonalAssetName = state.assets.personal[data.index].title
                state.activePersonalAssetIndex = data.index
            }
        }
    },

    removeCard(state, id){
        state.assets.personal[state.activePersonalAssetIndex].cards.splice(id, 1)
    },

    showDictionary(state){
        state.showDictionary = true
    },

    hideDictionary(state){
        state.showDictionary = false
    },

    setIntroVisibility(state, data){
        state.introNeed[data.page] = data.visible
    },

    setActiveAssetType(state, data){
        state.activeAssetType = data
    },

    setActiveAssetEdit(state, data){
        state.setActiveAssetEdit = data
    },

    setBackdrop(state, data){
        state.backdrop = data
    },

    setMenuOpen(state, data){
        state.rightMenuOpen = data
    }
}
