import router from '@/router'
import { store } from '@/store'
import userAPI from '@/api/userAPI';
import ILoginForm from '@/api/ILoginForm';

const { SCHEME, HOSTNAME } = process.env.NODE_ENV === 'production'
  ? { SCHEME: 'https', HOSTNAME: window.location.hostname }
  : { SCHEME: 'http', HOSTNAME: window.location.hostname }

const API_URL = `${SCHEME}://${HOSTNAME}/api`
const SESSION_URL = `${API_URL}/sessions/`
const CURRENT_USER_URL = `${API_URL}/current_user/`

export default {

  user: {
    authenticated: !!window.localStorage.getItem('id_token'),
    info: {},
  },

  login(form: ILoginForm) {
    userAPI.login(form).then((response) => {
      if (response.status === 200) {
        window.localStorage.setItem('id_token', response.data.token)
        store.commit('setAuth', true);
        store.commit('setStore', response.data.state);
        store.commit('setSelection', 0)
      } else {
        //
      }
    }, (response) => {
      // reject(response.data.message)
    })
  },

  logout() {
    userAPI.logout().then((data) => {
      window.localStorage.removeItem('id_token')
      this.user.authenticated = false
      store.commit('setAuth', false);
      router.push({ path: '/login' })
    }, (error) => {
      console.log(error.message)
    })
  },

  checkAuth() {
    const id_token = window.localStorage.getItem('id_token')
    this.user.authenticated = !!id_token
  },

  getAuthHeader() {
    return {
      Authorization: window.localStorage.getItem('id_token'),
    }
  },
}
