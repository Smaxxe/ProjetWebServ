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
    {path:"/login", component: require('./components/auth/login.vue').default},
    {path:"/register", component: require('./components/auth/register.vue').default},

]

const router = new VueRouter({
    routes: routes,
});

function isLoggedIn() {
    return localStorage.getItem("auth");
  }

  router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.authOnly)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      if (!isLoggedIn()) {
        next({
          path: "/login",
          query: { redirect: to.fullPath }
        });
      } else {
        next();
      }
    } else if (to.matched.some(record => record.meta.guestOnly)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      if (isLoggedIn()) {
        next({
          path: "/dashboard",
          query: { redirect: to.fullPath }
        });
      } else {
        next();
      }
    } else {
      next(); // make sure to always call next()!
    }
  });

  //Instanciation d'une vue qui représente le layout global
new Vue({
    router,
    render: h => h(layout)
}).$mount('#layout');

<<<<<<< HEAD
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
=======
>>>>>>> 75e1b5da1eb0ff323b45f6a974db3862d3ed8cf3
