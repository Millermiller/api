import axios from 'axios'


const service = axios.create({
  baseURL: process.env.VUE_APP_BASE_API, // url = base url + request url
  timeout: 5000,
  // withCredentials: true // send cookies when cross-domain requests
})

// Request interceptors
service.interceptors.request.use(
  (config) => {
    // @ts-ignore
    axios.defaults.headers.common.Authorization = document.querySelector('meta[name="csrf-token"]').content
    return config
  },
  (error) => {
    Promise.reject(error)
  },
)

export default service
