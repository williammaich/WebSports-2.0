import VueRouter from 'vue-router';


let routes = [
    {
        path: '/login',
        component: require('./views/Login')
    },
    // {
    //     path: '/register',
    //     component: require('./views/Register')
    // },
    // {
    //   path: '/forgotPassword',
    //   component: required('./views/Forgot')
    // }
];

export default new VueRouter({
    routes,
    linkActiveClass : 'is-active'
});