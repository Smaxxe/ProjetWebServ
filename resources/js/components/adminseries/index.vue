<template>
  <div class="grid-container">
    <div>
      <router-link :to="`/admin/series/create`">
        <button class="bouton-simple">Créer une nouvelle série</button>
      </router-link>
    </div>
    <ul>
      <li v-for="serie in series" :key="serie.id">
        <router-link :to="`/admin/series/edit/${serie.id}`"
          >{{ serie.title }} (ID : {{ serie.id }})</router-link
        >
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      series: [],
    };
  },
  mounted() {
    this.loadSerie();
  },
  methods: {
    loadSerie() {
      //Récupère la série dont l'id est récupérable dans la route
      axios.get("api/series/all")
        .then((response) => {
          this.series = response.data.series;
        })
        //attrape erreurs
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
