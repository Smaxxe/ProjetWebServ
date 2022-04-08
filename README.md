INSTALLATION DU PROJET :

composer install
definir .env (donner lien vers base de données)
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
npm run prod
php artisan serve


ELEMENTS AJOUTES EN PLUS DU TP2 :

////////////////////////////////////////////////////////////////////////
/////////////////////////// VERSION SERVEUR //////////////////////////////
////////////////////////////////////////////////////////////////////////

- GESTION DES COMMENTAIRES :
    Possibilité de poster un commentaire, seulement quand en étant connecté
    Possibilité de modifier le commentaire une fois posté, et de le supprimer

- NOTES : 
    Possibilité de noter une série quand on est connecté
    Affichage de la note des séries

- IDENTIFICATION / AUTHENTIFICATION AVEC ROLES USER ET ADMIN : via la top bar ou directement localhost:8000/login
    Compte admin : admin@mail.fr, mdp : adminadmin
    Compte user : user@mail.fr, mdp : useruser

- GESTION DES MEDIAS :
    Possibilité d'ajouter des médias aux séries (png, jpg et gif). Soit directement après la création d'une série, soit en passant par la page d'update         d'une série et en utilisant le bouton en bas pour accéder à la gestion des médias
    Les médias ajoutés sont ensuite affichés dans la page de la série avec un slider s'il y en a plusieurs
    

////////////////////////////////////////////////////////////////////////
/////////////////////////// VERSION VUEJS //////////////////////////////
////////////////////////////////////////////////////////////////////////

- Affichage des séries, d'une série, navigation entre les composants
- Formulaire de contact
- CRUD des séries
- Pills pour affichage
