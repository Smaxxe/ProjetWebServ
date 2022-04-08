<template>
  <div class="grid-container">
    <div class="card-header">Création d'une nouvelle série</div>

    <div class="card-body">
      <form @submit.prevent="submit">
        <div>
          <label class="form-label">Titre de la série </label>
          <input
            type="text"
            name="title"
            v-model="newSerie.title"
            class="form-control"
          />
          <div class="alert alert-danger" v-if="errors && errors.title">
            <!-- Si il y a une erreur et que'elle concerne l'input name : -->
            {{ errors.title[0] }}
            <!-- on affiche l'erreur -->
          </div>
        </div>
        <div>
          <label class="form-label">Auteur</label>
          <select name="author" id="author" v-model="newSerie.author">
            <option></option>
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
            v-model="newSerie.content"
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
            v-model="newSerie.acteurs"
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
            v-model="newSerie.tags"
            style="height: 100px; resize: none"
          ></textarea>

          <div class="alert alert-danger" v-if="errors && errors.tags">
            {{ errors.tags[0] }}
          </div>
        </div>

        <div>
          <button type="submit" class="bouton-simple">
            Confirmer la création de la série
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newSerie: {},
      allAuteurs: {},
      errors: {},
    };
  },

  mounted() {
    this.loadAuteurs();
  },

  methods: {
    //Charge tous les auteurs pour les afficher dans le menu déroulant
    loadAuteurs() {
      axios
        .get("api/admin/series/create")
        .then((response) => {
          this.allAuteurs = response.data;
        })
        //attrape erreurs
        .catch(function (error) {
          console.log(error);
        });
    },

    //Envoie les infos de création de la série
    submit() {
      axios
        .post("api/admin/series/", this.newSerie)

        .then((response) => {
          //si le update est effectué sans problème :
          this.errors = {}; //on vide this.errors
          //On redirige vers la page d'édition de cette série, en indiquant la création pour afficher un statut dans edit.vue
          this.$router.push({path : "/admin/series/edit/" + response.data, query : {create : true}});
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
  },
};
</script>
