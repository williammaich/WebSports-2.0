import VueRouter from 'vue-router';

let routes = [
    {
        path: '/login',
        component: require('./views/Login')
    },
];

export default new VueRouter({
    routes,
});