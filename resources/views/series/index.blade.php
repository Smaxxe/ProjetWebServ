@extends('/layouts/main')

<!--Ici c'est la view de base affichée par le controller séries, donc l'index des séries-->


@section('content')
    <h1>Toutes les séries</h1>
    <ul>
        @foreach ($series as $serie)
            <li><a href='http://localhost:8000/séries/{{$serie->id}}'>{{ $serie->title }}</a></li>
        @endforeach
    </ul>
@endsection
