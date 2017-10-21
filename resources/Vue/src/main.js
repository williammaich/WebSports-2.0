import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import Vuex from 'vuex'
import vClickOutside from 'v-click-outside'
import store from './store/store'
import interceptor from './components/Authentication/interceptors'
// Plugins
import GlobalComponents from './globalComponents'
import Notifications from './components/UIComponents/NotificationPlugin'
import SideBar from './components/UIComponents/SidebarPlugin'
import App from './App'
// router setup
import routes from './routes/routes'
// library imports
import Chartist from 'chartist'
import 'bootstrap/dist/css/bootstrap.css'
import 'es6-promise/auto'
import './assets/sass/paper-dashboard.scss'
import _ from 'lodash'



window._ = _
// plugin setup
Vue.use(VueRouter)
Vue.use(GlobalComponents)
Vue.use(vClickOutside)
Vue.use(Notifications)
Vue.use(SideBar)
Vue.use(VueResource)
Vue.use(Vuex)
// configure router
const router = new VueRouter({
  routes, // short for routes: routes
  mode: 'history',
  linkActiveClass: 'active',

})




// global library setup
Object.defineProperty(Vue.prototype, '$Chartist', {
  get () {
    return this.$root.Chartist
  }
})

router.beforeEach((to,  from, next) => {
    Vue.http.get('http://localhost:8000/api/user')
      .then(response => {
        console.warn(response.data)
      })
    interceptor.check_empty_token()
    interceptor.check_auth()
    next()
})

// router.beforeEach((to, from, next) => {
//   if (to.matched.some(record => record.meta.requiresAuth)) {
//     // this route requires auth, check if logged in
//     // if not, redirect to login page.
//     if (!auth.loggedIn()) {
//       next({
//         path: '/login',
//         query: { redirect: to.fullPath }
//       })
//     } else {
//       next()
//     }
//   } else {
//     next() // make sure to always call next()!
//   }
// })
/* eslint-disable no-new */
new Vue({
  el: '#app',
  render: h => h(App),
  router,
  data: {
    Chartist: Chartist
  },
  store,
  interceptor,
  watch: {
    '$route'(to,from){
      if(to.path === '/login') {
        console.log('loginnnnnnnnn')
      }
    }
  }
})
