<template>
  <div class="grid-container">
    <div>{{ this.$route.query.create }}</div>

    <div class="card-header">
      Modification / Suppression de la série
      <strong>{{ serie.title }}</strong>
    </div>

    <div class="card-body">
      <form @submit.prevent="submit">

        <!-- On affiche ça quand on arrive ici après la création d'une nouvelle série -->
        <div
          class="alert alert-success"
          v-show="this.$route.query.create == 'true'">
          La série a bien été créée!
        </div>
        <div>
          <label class="form-label">Titre de la série </label>
          <input
            type="text"
            name="name"
            v-model="serie.title"
            class="form-control"
          />
          <div class="alert alert-danger" v-if="errors && errors.name">
            <!-- Si il y a une erreur et que'elle concerne l'input name : -->
            {{ errors.name[0] }}
            <!-- on affiche l'erreur -->
          </div>
        </div>
        <div>
          <label class="form-label">Auteur</label>
          <select name="author" id="author" v-model="serie['author'].name">
            <option>{{ serie["author"].name }}</option>
            <!--En première option on place l'auteur de la série, pour éviter d'avoir un vide  -->
            <option v-for="auteur in allAuteurs" :key="auteur.id">
              {{ auteur.name }}
            </option>
          </select>
          <div class="alert alert-danger" v-if="errors && errors.author">
            {{ errors.author[0] }}
          </div>
        </div>

        <div>
          <label class="form-label">Contenu </label>
          <textarea
            name="content"
            v-model="serie.content"
            style="height: 300px; resize: none"
          ></textarea>

          <div class="alert alert-danger" v-if="errors && errors.content">
            {{ errors.content[0] }}
          </div>
        </div>

        <div>
          <label class="form-label">Acteurs</label>
          <textarea
            name="acteurs"
            v-model="serie.acteurs"
            style="height: 100px; resize: none"
          ></textarea>

          <div class="alert alert-danger" v-if="errors && errors.acteurs">
            {{ errors.acteurs[0] }}
          </div>
        </div>

        <div>
          <label class="form-label">Tags</label>
          <textarea
            name="tags"
            v-model="serie.tags"
            style="height: 100px; resize: none"
          ></textarea>

          <div class="alert alert-danger" v-if="errors && errors.tags">
            {{ errors.tags[0] }}
          </div>
        </div>

        <!-- Appelle la fonction submit de la partie script -->
        <div class="alert alert-success" v-show="succes">
          La série a bien été mise à jour !
        </div>
        <!-- Feedback positif qui n'est affiché qu'en cas de succès -->

        <div>
          <button type="submit" class="bouton-simple">
            Mettre à jour la série
          </button>
        </div>
      </form>

      <div v-on:click="suppr">
        <button class="bouton-alerte">Supprimer la série</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      serie: [], //Infos sur la série qu'on modifie
      allAuteurs: [], //On récupère tous les auteurs pour le menu déroulant
      succes: false, //booléen à vrai en cas de formulaire valide et envoyé. Permet d'afficher un feedback s'il vaut vrai
      errors: {},
    };
  },

  mounted() {
    this.loadSerie();
  },

  methods: {
    loadSerie() {
      //Récupére la série dont l'id est récupérable dans la route
      axios
        .get("api/admin/series/" + this.$route.params.serie_id + "/edit")
        .then((response) => {
          this.serie = response.data["serie"];
          this.allAuteurs = response.data["auteurs"];
        })
        //attrape erreurs
        .catch(function (error) {
          console.log(error);
        });
    },

    submit() {
      axios
        .put("api/admin/series/" + this.$route.params.serie_id, this.serie)

        .then((response) => {
          //si le update est effectué sans problème :
          this.errors = {}; //on vide this.errors
          this.succes = true; //Le formulaire est bien envoyé. Le fait que succès passe à true va faire afficher le div contenant le feedback
          this.$route.query.create = null;
        })

        .catch((error) => {
          if (error.response.status == 422) {
            //Le code erreur pour les problèmes de validations en laravel est 422
            this.errors = error.response.data.errors; //On récupère alors l'erreur dans l'objet errors
            this.succes = false;
          }
          console.log(error);
        });
    },

    suppr: function () {
      axios
        .delete("api/admin/series/" + this.$route.params.serie_id)
        .then((response) => {
          this.$router.push("/admin/series");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
