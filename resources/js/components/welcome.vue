<template>
  <div class="grid-container">
    <h1>Les dernières séries à la mode</h1>
    <ul>
      <li v-for="serie in series" :key="serie.id">
        <router-link :to="`/series/${serie.id}`">{{
          serie.title
        }}</router-link>
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
    this.loadSeries();
  },

  methods: {
    loadSeries: function () {
      axios
        .get("api/series/home")

        .then((response) => {
          this.series = response.data.series;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
