require('./bootstrap');
import "bootstrap";

import Vue from 'vue'
import VueRouter from "vue-router"
import layout from './components/layout.vue'
Vue.use(VueRouter)

const routes = [
    { path: "/", component: require('./components/welcome.vue').default },
    { path: "/series", component: require('./components/series/index.vue').default },
    { path: "/series/:serie_id", component: require('./components/series/single.vue').default },
    { path: "/contact", component: require('./components/contact.vue').default },
    { path: "/admin/series", component: require('./components/adminseries/index.vue').default },
    { path: "/admin/series/edit/:serie_id", component: require('./components/adminseries/edit.vue').default },
    { path: "/admin/series/create", component: require('./components/adminseries/create.vue').default }
]

const router = new VueRouter({
    routes: routes,
});

//Instanciation d'une vue qui représente le layout global
new Vue({
    router,
    render: h => h(layout)
}).$mount('#layout');
