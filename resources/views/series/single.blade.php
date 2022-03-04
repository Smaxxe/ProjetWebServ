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
<form method="POST" action="/comment">
    @csrf
    <div>
        <label for="comment" style="font-size: 15pt">Ajouter commentaire :</label>
        <textarea name="title" id="title" style="resize: none"></textarea>
    </div>
    <button type="submit" style="border: 1px solid black; border-color: black; padding:10px; font-size: 20px; top:5px">Valider</button>

</form>

@endsection
