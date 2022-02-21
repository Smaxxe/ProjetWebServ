@extends('layouts/main')

<!--Ici on est dans la view qui s'affiche directement en arrivant sur le site, sur la page HOME ('/') -->

@section('content')
    <h1>Les dernières séries à la mode</h1>
    <ul>
        @php //Section php pour déclarer une variable qui va servir à compter le nombre de boucles
        $count = 0
        @endphp
        @foreach ($series as $serie)
            @if(++$count > 3) {{-- On affiche seulement 3 séries, et quand on passe à la 4e boucle on break --}}
                @break
            @endif
            <li><a href='http://localhost:8000/séries/{{$serie->id}}'>{{ $serie->title }}</a></li>
        @endforeach

    </ul>
@endsection

