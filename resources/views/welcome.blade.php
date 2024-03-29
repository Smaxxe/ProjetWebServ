@extends('layouts/main')

<!--Ici on est dans la view qui s'affiche directement en arrivant sur le site, sur la page HOME ('/') -->

@section('content')
    <h1>Les dernières séries à la mode</h1>
    <ul>
        @foreach ($series as $serie)
            @if ($loop->iteration > 3)
                {{-- On affiche seulement 3 séries, et quand on passe à la 4e boucle on break --}}
            @break
        @endif
        <li>
            <a href='http://localhost:8000/series/{{ $serie->url }}'>{{ $serie->title }}</a>
        </li> {{-- Ici on affiche chaque série par son titre et un lien vers la série --}}
    @endforeach

    </ul>

    {{-- Si l'utilisateur a essayé d'accéder une page pour laquelle il n'avait pas les droits, affichage d'un message d'erreur --}}
    @if(session('droits'))
        <script>
            window.alert('{{session('droits')}}')
        </script>
    @endif

@endsection
