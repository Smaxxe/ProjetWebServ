<template>
    <div>
        <h1>{{serie.title}}</h1>
        Auteur : <!-- {{serie->author->name}} -->  <!-- Ne fonctionne plus comme avant, serie n'a plus la métode author(plus du php). Il va
        peut être falloir utiliser un resource comme je faisais avant pour mettre le nom de l'auteur dans les données renvoyées par l'api -->
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            serie : [],
        }
    },
    mounted(){
        this.loadSerie();
    },
    methods:{
        loadSerie: function(){
            //Récupére la série dont l'id est récupérable dans la route
            axios.get('api/series/'+this.$route.params.serie_id)
            .then((response) => {
                this.serie = response.data;
            })
            //attrape erreurs
            .catch(function(error){
                console.log(error);
            });
        }
    }
}
</script>
