<template>
    <div>
        <!-- Reprise de l'ancien blade mais sans les parties blade de gestion d'erreur et d'authentification -->
        <h1>Nous contacter !</h1>

        <!-- Formulaire : meme formulaire que l'ancien blade, mais avec des champs v-model dans chaque input -->
        <form @submit.prevent="submit"> <!-- Appele la fonction submit de la partie script -->
            <!-- Le csrf est géré dans le header du layout de l'appli ('homevue.blade.php' à ce jour)  -->
            <div class="alert alert-success" v-show="succes">Votre demande de contact a bien été reçue !</div> <!-- Feedback positif qui n'est affiché qu'en cas de succès -->
            <div>
                <input type="text" name="name" placeholder="Nom et Prénom" v-model="fields.name">
                <div class="alert alert-danger" v-if="errors && errors.name"> <!-- Si il y a une erreur et que'elle concerne l'input name : -->
                    {{errors.name[0]}} <!-- on affiche l'erreur -->
                </div>
            </div>
            <div>
                <input type="text" name="email" placeholder="Email" v-model="fields.email">
                <div class="alert alert-danger" v-if="errors && errors.email">
                    {{errors.email[0]}}
                </div>
            </div>
            <div>
                <textarea name="message" placeholder="Message" minlength="20" maxlength="1000" style="height:200px;resize:none" v-model="fields.message"></textarea>
                <div class="alert alert-danger" v-if="errors && errors.message">
                    {{errors.message[0]}}
                </div>
            </div>
            <div>
                <button type="submit" class="bouton-simple">Envoyer</button>
            </div>
        </form>

    </div>
</template>

<script>
    export default {
        data(){
            return {
                fields:{}, /* Le contenu des champs du formulaire */
                succes :false, //booléen à vrai en cas de formulaire valide et envoyé. Permet d'afficher un feedback s'il vaut vrai
                errors :{},
            }
        },

        methods: {
            submit() {
                //Store un contact avec this.fields comme données
                axios.post('api/contact', this.fields)

                .then(response =>{
                    //si le store est effectué sans problème :
                    this.fields = {};  //on vide this.fields
                    this.errors = {}; //on vide this.errors
                    this.succes = true; //Le formulaire est bien envoyé. Le fait que succès passe à true va faire afficher le div contenant le feedback
                })

                //attrape erreurs
                .catch(error => {
                    if (error.response.status == 422){ //Le code erreur pour les problèmes de validations en laravel est 422
                        this.errors = error.response.data.errors; //On récupère alors l'erreur dans l'objet errors
                        this.succes = false; //Dans le cas où une personne envoie un premier message sans problème, puis un autre avec problème,
                                             //le feedback positif doit disparaitre
                    }
                    console.log(error);
                });
            }
        }
    }
</script>
