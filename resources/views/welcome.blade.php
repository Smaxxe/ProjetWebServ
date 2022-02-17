@extends('layouts/main')

<!--Ici on est dans la view qui s'affiche directement en arrivant sur le site, sur la page HOME ('/') -->

@section('content')
  <h1>Lise des séries</h1>
  <ul>
      @foreach ($series as $serie )
        <li><a href='http://localhost:8000/séries/{{$serie->id}}' >{{ $serie->title }}</a></li>
      @endforeach
  </ul>
@endsection
