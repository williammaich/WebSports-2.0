import VueRouter from 'vue-router';
import * as Vue from "vue";
Vue.use(VueRouter);
let routes = [
    {
        path: '/login',
        component: require('./views/Login')
    },    {
        path: '/forgot',
        component: require('./views/Forgot')
    },  {
        path: '/dashboard',
        component: require('./views/Dashboard')
    },
];

export default new VueRouter({
    routes,
});