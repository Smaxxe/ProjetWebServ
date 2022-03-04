git clone -b nomdelabranch lienversvotrerepo.com/nomDuProjet
cd nomduprojet
composer install
definir .env (donner lien vers base de données)
php artisan key:generate
php artisan migrate:fresh --seed

Pour avoir les droits admin, il faut se connecter (lien dans le menu du site ou localhost:8000/login) avec le mail admin@mail.com et le mdp adminadmin
