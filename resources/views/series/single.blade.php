@extends('/layouts/main')

<!-- View d'affichage d'une série en particulier-->

@section('content')
    <h1>{{$serie->title}}</h1>
    <h2 class = 'subheader'>Auteur de l'article : {{$serie->author->name}}</h2>

    <p>{{$serie->content}}</p>

    <p style="color: grey; font-size: 12px">TAGS : {{$serie->tags}}</p>

{{-- Liste des commentaires --}}
<h4> Commentaires :</h4>
@foreach ($comments as $comment)
    {{$comment->content}} <br>
    <i>-{{$comment->author->name}}</i>
    <br><br>
@endforeach

{{-- Formulaire pour commentaire --}}

@if ($errors->any()) {{--Si la validation renvoie une/des erreur(s), on affiche ici--}}
    <div class="" style="padding-top: 20px">
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@auth
    <form method="POST" action="/comment?serie_id={{$serie->id}}">{{-- On met l'id de la série dans l'url pour pouvoir le récupérer dans la fonction store() --}}
        @csrf
        <div>
            <label for="content" style="font-size: 15pt">Ajouter commentaire :</label>
            <textarea name="content" id="content" style="resize: none" placeholder="Le commentaire doit faire entre 20 et 1000 caractères"></textarea>
        </div>
        <button type="submit" style="border: 1px solid black; border-color: black; padding:10px; font-size: 20px; top:5px">Valider</button>
    </form>
@else
    <a href="http://localhost:8000/login">Se connecter pour poster un commentaire</a>
@endauth

@endsection
