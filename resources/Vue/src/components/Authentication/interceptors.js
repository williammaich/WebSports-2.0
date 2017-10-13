import Vue from 'vue'
import Vuex from 'vuex'
import VueResource from 'vue-resource'

Vue.use(VueResource)
Vue.use(Vuex)

let getToken = function () {
  let token = localStorage['token']
  if (!token) {
    token = '{}'
  }
  return JSON.parse(token)
}


export default {
  login() {
    Vue.router.push('/login')
  },
  check_empty_token() {
    let token = getToken()
    if(!token.access_token) {
      this.login()
    }
  },
  check_auth() {
    let token = getToken()
    Vue.http.interceptors.push((request, next) => {
      request.headers.set('Authorization', 'Bearer ' + token.access_token)
      next()
    })
  }
}