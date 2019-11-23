import { router } from '../router'
import store from '../store'

const { SCHEME, HOSTNAME } =
    process.env.NODE_ENV == 'production'
        ? {SCHEME: 'https', HOSTNAME: window.location.hostname}
        : {SCHEME: 'http' , HOSTNAME: window.location.hostname}

const API_URL          = `${SCHEME}://${HOSTNAME}/api`
const SESSION_URL      = `${API_URL}/sessions/`
const CURRENT_USER_URL = `${API_URL}/current_user/`

export default {

    user: {
        authenticated: !!window.localStorage.getItem('id_token'),
        info: {}
    },

    login(context, creds, redirect) {
        return new Promise(function (resolve, reject) {
            context.$http.post('/login', creds).then((response) => {
                if (response.status === 200) {
                    window.localStorage.setItem('id_token', response.body.token)
                    store.commit('setAuth', true);
                    store.commit('setStore', response.body.state);
                    store.commit('setSelection', 0)
                    if (redirect) {
                        router.push({path: redirect})
                    }
                    resolve(response.body)
                } else {
                    reject(response.body)
                }
            }, (response) => {
                reject(response.body.message)
            })
        });
    },

    currentUser (context) {
        context.$http.get(CURRENT_USER_URL, {headers: this.getAuthHeader()})
            .then((response) => {
                context.user = response.body.user
            }, error => {
                console.log(error)
            })
    },

    logout (context, options) {
        context.$http.post('/logout', options)
            .then((data) => {
                window.localStorage.removeItem('id_token')
                this.user.authenticated = false
                store.commit('setAuth', false);
                router.push({path: '/login'})
            }, error => {
                console.log(error.message)
            })
    },

    checkAuth () {
        const id_token = window.localStorage.getItem('id_token')
        this.user.authenticated = !!id_token
    },

    getAuthHeader () {
        return {
            'Authorization': window.localStorage.getItem('id_token')
        }
    }
}
