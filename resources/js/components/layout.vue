<template>
  <div>
    <!-- Start Top Bar -->
    <div class="top-bar">
      <div class="top-bar-left">
        <ul class="menu">
          <li class="menu-text">FreshTomatoes (VueJS)</li>
          <li>
            <router-link to="/">Home</router-link>
          </li>
          <li><router-link to="/series">Series</router-link></li>
          <li><router-link to="/contact">Contact</router-link></li>
          <li><router-link to="/register">Créer un compte</router-link></li>
        </ul>
      </div>
    </div>
    <!-- End Top Bar -->

    <div class="callout large primary">
      <div class="text-center">
        <h1>FreshTomatoes</h1>
        <h2 class="subheader">
          Bienvenue sur le site préféré des critiques cinéma !
        </h2>
      </div>
    </div>

    <!-- Chargement du composant qu'on va changer -->
    <router-view></router-view>
  </div>
</template>

<script>
export default {
    data() {
       return {
           auth
       }
    },

    beforeMount(){
        this.auth = isLoggedIn();
    }
}
</script>
