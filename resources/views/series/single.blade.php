@extends('/layouts/main')

<!-- View d'affichage d'une série en particulier-->

@section('content')
    <h1>{{$serie->title}}</h1>
    <h2 class = 'subheader'>Auteur de l'article : {{$serie->author->name}}</h2>

    <p>{{$serie->content}}</p>

    <p style="color: grey; font-size: 12px">TAGS : {{$serie->tags}}</p>
@endsection
