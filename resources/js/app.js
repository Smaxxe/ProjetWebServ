require('./bootstrap');

import Vue from 'vue'
import VueRouter from "vue-router"
Vue.use(VueRouter)

const routes = [
    { path: "/", component: require('./components/welcome.vue').default },
    { path: "/serie/:url", component: require('./components/serie.vue') },
]

const router = new VueRouter({
    routes: routes,
});

const app = new Vue({
    router
}).$mount('#app');

// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();
