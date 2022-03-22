{{-- C'est la vue d'acceuil de la version VueJS de l'aplication --}}


<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>FreshTomatoes | Welcome</title>
    <link rel="stylesheet" href="{{ URL::to('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.2.3/motion-ui.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation-prototype.min.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css' rel='stylesheet'
        type='text/css'>
</head>

<body>
<<<<<<< HEAD
    <div id="app">
        <!-- Start Top Bar -->
        <div class="top-bar">
            <div class="top-bar-left">
                <ul class="menu nav nav-pills">
                    <li class="menu-text">FreshTomatoes (VueJS)</li>
                    <li role="presentation" class=" active"><router-link to="/">Home</router-link> </li>
                    <li role="presentation"><router-link to="/series">Series</router-link></li>
                    <li role="presentation"><router-link to="/contact">Contact</router-link></li>

                    {{-- Si on est connecté, seul le lien pour se déconnecter apparait dans la top bar --}}
                    @auth
                        <li>
                            {{-- Récupération du rôle et du nom de l'utilisateur --}}
                            <?php $userName = Illuminate\Support\Facades\Auth::user()->name;
                            $userRole = Illuminate\Support\Facades\Auth::user()->role; ?>

                            {{-- On ne peut pas simpleemnt utiliser une balise <a> pour le lien de déconnexion, car il faut une methode post pour accéder à l'url de logout.
                La balise <a> soumet donc un formulaire (d'id "logout-form") de méthode post grâce à du JavaScript --}}
                            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Se
                                déconnecter({{ $userName }})</a>

                            {{-- Le formulaire de méthode post qui renvoie au lien de logout : --}}
                            <form id="logout-form" action="http://localhost:8000/logout" method="POST"
                                value="Se déconnecter">
                                @csrf
                            </form>

                            {{-- Si l'utilisateur a les droits admin, on affiche un lien vers admin/series --}}
                            @if (strcmp($userRole, 'admin') == 0)
                        <li><a href="/admin/series">Gérer les séries</a></li>
                        @endif
                        </li>

                        {{-- Sinon, la top bar a les liens pour se connecter et s'inscrire --}}
                    @else
                        <li><a href="http://localhost:8000/login">Se connecter</a></li>
                        <li><a href="http://localhost:8000/register">S'inscrire</a></li>
                    @endauth

                </ul>

            </div>
        </div>
        <!-- End Top Bar -->

        <div class="callout large primary">
            <div class="text-center">
                <h1>FreshTomatoes</h1>
                <h2 class="subheader">Bienvenue sur le site préféré des critiques cinéma !</h2>
            </div>
        </div>

        {{-- Chargement du composant qu'on va changer --}}
        <router-view></router-view>
=======
    <div id="layout">
>>>>>>> 75e1b5da1eb0ff323b45f6a974db3862d3ed8cf3
    </div>

    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.2.3/motion-ui.min.js"></script>
    {{-- <script src="{{ URL::to('/js/manifest.js') }}"></script>
    <script src="{{ URL::to('/js/vendor.js') }}"></script> --}}
    <script src="{{ URL::to('/js/app.js') }}"></script>
    <script>
        $(document).foundation();
    </script>


</body>

</html>
