require('./bootstrap');
import "bootstrap";

import Vue from 'vue'
import VueRouter from "vue-router"
Vue.use(VueRouter)

const routes = [
    { path: "/", component: require('./components/welcome.vue').default },
    { path: "/series", component: require('./components/series/index.vue').default },
    { path: "/series/:serie_id", component: require('./components/series/single.vue').default },
    { path: "/contact", component: require('./components/contact.vue').default },
    { path: "/admin/series", component: require('./components/adminseries/index.vue').default },

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


//JS pour topbar de homevue
var pills = document.getElementsByClassName("menu nav nav-pills")[0].children;
for (var i = 1; i < pills.length; i++) {
  pills[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
