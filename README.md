INSTALLATION DU PROJET :

- git clone
- composer install
- npm install
- definir .env (donner lien vers base de données)
- php artisan key:generate
- php artisan migrate:fresh --seed
- php artisan storage:link
- npm run prod
- php artisan serve


ELEMENTS AJOUTES EN PLUS DU TP2 :

////////////////////////////////////////////////////////////////////////
/////////////////////////// VERSION BLADE //////////////////////////////
////////////////////////////////////////////////////////////////////////

- GESTION DES COMMENTAIRES : 
    - Possibilité de poster un commentaire, seulement en étant connecté, dans la page d'affichage d'une série
    - Possibilité de modifier le commentaire une fois posté, et de le supprimer (un utlisateur ne peut donner
     qu'un commentaire par série)

- NOTES : 
    - Possibilité de noter une série quand on est connecté, directement dans la page d'affichage d'une série 
    (un utlisateur ne peut donner qu'une note par série)
    - Affichage de la moyenne des notes des séries dans la page

- IDENTIFICATION / AUTHENTIFICATION AVEC ROLES USER ET ADMIN : via la top bar ou directement localhost:8000/login
    - Compte admin : admin@mail.fr, mdp : adminadmin
    - Compte user : user@mail.fr, mdp : useruser
    - Le compte admin seulement permet d'afficher le lien de gestion des séries dans la top bar, avec donc possibilité de créer une nouvelle série, d'en modifier des existantes, de gérer les médias d'une série ou de supprimer une série

- GESTION DES MEDIAS :
    - Possibilité d'ajouter des médias aux séries (png, jpg et gif). Soit directement après la création d'une série, soit en passant par la page d'update         d'une série et en utilisant le bouton en bas pour accéder à la gestion des médias
    - Les médias ajoutés sont ensuite affichés dans la page de la série avec un slider s'il y en a plusieurs
    

////////////////////////////////////////////////////////////////////////
/////////////////////////// VERSION VUEJS //////////////////////////////
////////////////////////////////////////////////////////////////////////
- Lien pour accéder à la version VueJS : localhost:8000/vue (ou par le bouton de la top bar dans la version blade). Possibilité de revenir à la version blade via un bouton une fois dans la version VueJS
- Une fois sur la page d'accueil, les liens sous forme de pills dans la top bar permettent d'accéder aux différents éléments

    - Affichage des séries, d'une série, navigation entre les composants
    - Formulaire de contact
    - CRUD des séries : depuis le lien "Gestion des Séries" dans la top bar, accès à création, modification et suppression des séries
