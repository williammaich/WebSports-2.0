import Vue from 'vue'

let getToken = function () {
  let token = localStorage['token']
  if (!token) {
    token = '{}'
  }
  return JSON.parse(token)
}


export default {
  check_empty_token() {
    let token = getToken()
    if(!token.access_token) {
      return false
    }
  },
  check_auth() {
    let token = getToken()
    Vue.http.interceptors.push((request, next) => {
      request.headers.set('Authorization','Bearer ' + token.access_token)
      next((response) => {
        if(response.status === 401) {
          window.location.replace('/#/login')
        }
      })
    })
  }
}