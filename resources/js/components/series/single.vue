<template>
    <div class="home col-5 mx-auto py-5 mt-5">
        <h1>{{serie.title}}</h1>
        <h3> Auteur : {{ auteur.name }}</h3>
            <!-- {{serie->author->name}} -->  <!-- Ne fonctionne plus comme avant, serie n'a plus la métode author(plus du php?). Il va
        peut être falloir utiliser un resource pour mettre le nom de l'auteur dans les données renvoyées par l'api -->
        <p>{{ serie.content }}</p>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            serie : {},
            auteur : {}
        }
    },
    mounted(){
        this.loadSerie();
    },
    methods:{
        loadSerie: function(){
            //Récupére la série dont l'id est récupérable dans la route
            axios.get('api/series/' + this.$route.params.serie_id)
            .then((response) => {
                this.serie = response.data;
                this.auteur = this.serie['author'];
            })
            //attrape erreurs
            .catch(function(error){
                console.log(error);
            });
        }
    }
}
</script>
