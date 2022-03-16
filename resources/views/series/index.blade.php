@extends('/layouts/main')

<!--Ici c'est la view de base affichée par le controller séries, donc l'index des séries-->


@section('content')
    <h1>Toutes les séries</h1>
    <ul>
        @foreach ($series->reverse() as $serie) {{-- Ici on va afficher toutes les séries mais dans l'ordre inverse de leur création pour afficher les toutes dernières sorties en premier --}}
            <li><a href='http://localhost:8000/series/{{$serie->url}}'>{{ $serie->title }} ;;;; Vérification id : {{$serie->id}}</a></li>
        @endforeach
    </ul>
@endsection
