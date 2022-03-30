<template>
  <div>
    <!-- Start Top Bar -->
    <div class="top-bar">
      <div class="top-bar-left">
        <ul class="menu nav nav-pills">
          <li class="nav-item menu-text">FreshTomatoes (VueJS)</li>
          <li class="nav-item active"  name="homeLink">
            <router-link to="/">Home</router-link>
          </li>
          <li class="nav-item" name="seriesLink"><router-link to="/series">Series</router-link></li>
          <li class="nav-item" name="contactLink"><router-link to="/contact">Contact</router-link></li>
          <li class="nav-item" name="registerLink"><router-link to="/register">Créer un compte</router-link></li>
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
            //auth,
            pills:{},// tableau des pills (liens de la top bar)
       }
    },

    beforeMount(){
        this.auth = isLoggedIn();
    },

    mounted(){
        //Initialisation de pills pills
        this.pills["home"] = document.getElementsByName("homeLink")[0];
        this.pills["series"] = document.getElementsByName("seriesLink")[0];
        this.pills["contact"] = document.getElementsByName("contactLink")[0];
        this.pills["register"] = document.getElementsByName("registerLink")[0];

        //Event Listener des clicks sur les liens, mais plus nécessaire normalement car il ya un watcher sur le changement de route à la place
        /*
        for (var i = 1; i < pills.length; i++) {
            pills[i].addEventListener("click", function() { //quand on click sur un menu
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", ""); //le menu qui était actif ne l'est plus
                this.className += " active"; //le menu sélectionné devient actif
                });
        }
        */

    },

    //A chaque changement de route :
    watch:{
        $route(to){ // to est la location sur laquelle on se trouve après changement de route
            //L'ancien pill actif ne l'est plus
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", ""); //le menu qui était actif ne l'est plus

            //Le pill correspondant à l'arrivée (to.path) devient actif
            switch(to.path) {
                case "/":
                    this.pills["home"].className += " active";
                    break;

                case "/series":
                    this.pills["series"].className += " active";
                    break;

                case "/contact":
                    this.pills["contact"].className += " active";
                    break;

                case "/register":
                    this.pills["register"].className += " active";
                    break;
            }
        }
    }
}


</script>
