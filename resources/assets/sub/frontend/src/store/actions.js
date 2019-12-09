import Vue from 'vue'

export default{
    increment (context) {
        context.commit('increment')
    },

    auth (context, isAuth){

        context.commit('setAuth', isAuth);

        if(isAuth){

        }
    },

    reloadStore(context) {
        Vue.http.get('/check').then(
            (response) => {
                context.commit('setStore', response.body.state)
            },
            (response) => {
                console.log(response.body)
            }
        )
    },

    reloadPersonal(context) {
        Vue.http.get('/personal').then(
            (response) => {
                context.commit('setPersonal', response.body)
            },
            (response) => {
                console.log(response.body)
            }
        )
    },

    addPersonalAsset(context, title){

        Vue.http.post('/asset', {title: title}).then(
            (response) => {
                if(response.status === 201){
                    context.commit('addPersonal',
                        {
                            basic:0,
                            favorite:0,
                            id: response.body.id,
                            level: 0,
                            result: 0,
                            count: 0,
                            title: response.body.title,
                            cards: [],
                            selected: true
                        }
                    )
                    context.commit('setSelection', 1)
                }
            },
            (responce) => {
                console.log(response.body)
            }
        )
    },

    loadAsset(context, data){
        context.commit('setSelection', data)
    },

    onCardsPageOpen(context){
        let asset = {type: 3}

        if(!context.state.activePersonalAssetEdit)
            context.commit('setSelection', {asset, index: 0})
    },

    onCardsPageClose(context){
        context.commit('setSelection', {})
        context.commit('setActiveAssetEdit', false)
    },
    /**
     * @param context
     * @param data {key: key, value: value}
     */
    findAndRemoveFavorite(context, data){
        context.state.assets.personal[0].cards.forEach(function(element, index, array){
            if(element[data.key] == data.value)
                context.commit('removeCardFromFavorite', index)
        })
    },

    setActiveAssetType(context, data){
      let type = ''

      if(data === 1)
          type = 'words'
      else if(data === 2)
          type = 'sentences'
      else
          type = 'personal'

      context.commit('setActiveAssetType', type)
    },

    toggleBackdrop(context){
        if(context.state.backdrop === 0 && context.state.rightMenuOpen)
            context.commit('setBackdrop', 1)
        else
            context.commit('setBackdrop', 0)
    },

    toggleMenuOpen(context){
        if(context.state.rightMenuOpen)
            context.commit('setMenuOpen', false)
        else
            context.commit('setMenuOpen', true)
    }
}