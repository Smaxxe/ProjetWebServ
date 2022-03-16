git clone -b nomdelabranch lienversvotrerepo.com/nomDuProjet
cd nomduprojet
composer install
definir .env (donner lien vers base de données)
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
php artisan storage:link

Pour avoir les droits admin, il faut se connecter avec le mail admin@mail.com et le mot de passe adminadmin (on peut se login via la top bar, ou alors directement via le lien localhost:8000/login). Pour se connecter avec simplement le rôle d'user, il faut se connecter avec (user@mail.com, useruser).


-IDENTIFICATION / AUTHENTIFICATION AVEC ROLES USER ET ADMIN

