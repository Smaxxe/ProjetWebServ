<template>
    <div>
        <h1>Liste des séries</h1>
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
    data: function(){
        return {
            series : [],
        }
    },
    mounted(){
        this.loadSerie();
    },
    methods:{
        loadSerie: function(){
            //Récupére la série dont l'id est récupérable dans la route
            axios.get('api/series/all')
            .then((response) => {
                this.series = response.data.series;
            })
            //attrape erreurs
            .catch(function(error){
                console.log(error);
            });
        }
    }
}
</script>
