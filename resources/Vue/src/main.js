import Vue from "vue";
import VueRouter from "vue-router";
import VueResource from "vue-resource";
import Vuex from "vuex";
import vClickOutside from "v-click-outside";
import store from "./store/store";
import interceptor from "./components/Authentication/interceptors";
// Plugins
import GlobalComponents from "./globalComponents";
import Notifications from "./components/UIComponents/NotificationPlugin";
import SideBar from "./components/UIComponents/SidebarPlugin";
import App from "./App";
// router setup
import routes from "./routes/routes";
// library imports
import Chartist from "chartist";
import "bootstrap/dist/css/bootstrap.css";
import "es6-promise/auto";
import "./assets/sass/paper-dashboard.scss";
import _ from "lodash";
import {
  VueMaskDirective
} from "v-mask";
import VueProgressBar from 'vue-progressbar'


window._ = _;
// plugin setup
Vue.use(VueRouter);
Vue.use(GlobalComponents);
Vue.use(vClickOutside);
Vue.use(Notifications);
Vue.use(SideBar);
Vue.use(VueResource);
Vue.use(Vuex);
Vue.directive('mask', VueMaskDirective)
Vue.use(VueProgressBar)
// configure router
const router = new VueRouter({
  routes, // short for routes: routes
  mode: "history",
  linkActiveClass: "active"
});

// global library setup
Object.defineProperty(Vue.prototype, "$Chartist", {
  get() {
    return this.$root.Chartist;
  }
});
Vue.http.interceptors.push(function(request, next) {
  let token = localStorage["token"];
  if (!token) {
    token = "{}";
  } else {
    token = JSON.parse(token);
  }
  // modify request
  request.headers.set("Authorization", "Bearer " + token.access_token);
  // console.log(request.headers.get("Authorization"));
  request.headers.set("Accept", "application/vnd.mob.v1+json");
  request.emulateJSON = true;

  // continue to next interceptor
  next(function(response) {
    
    if (response.status == 500) {
      if (response.data.message == "Token has expired, but is still valid.") {
        console.log("RETRY", response);
      } else {
        console.log("Whoops, an unknown error occured.");
      }
    }
  });
});

router.beforeEach((to, from, next) => {

  Vue.http
    .get("http://localhost:8000/api/user")
    .then(response => {
    })
    .catch(error => {
      console.warn(error);
      next("/login");
    });
  next();
});

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
  el: "#app",
  render: h => h(App),
  router,
  data: {
    Chartist: Chartist
  },
  store,
  watch: {
    $route(to, from) {
      if (to.path === "/login") {
        console.log("loginnnnnnnnn");
      }
    }
  }
});
