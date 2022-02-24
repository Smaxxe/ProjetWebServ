@extends('/layouts/main')

@section('content')
    <h1>Modification / Suppression de la série <strong>{{$serie->title}}</strong> (ID : {{$serie->id}})</h1>

    @if ($errors->any()) {{--Si la validation renvoie une erreur, on affiche ici--}}
    <div class="alert alert-danger" style="padding-top: 20px">
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Modification de la série--}}
    <form method="POST" action="/admin/series/{{$serie->id}}">
        @method('PUT')
        @csrf
        <div>
            <label for="title" style="font-size: 15pt">Titre :</label>
            <textarea name="title" id="title" style="resize: none">{{$serie->title}}</textarea>
        </div>
        <div>
            <label for="author" style="font-size: 15pt">Auteur : </label>
            <select name="author" id="author">
                <option>{{$serie->author->name}}</option>
                @foreach ($authors as $author)
                    <option>{{$author->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="content" style="font-size: 15pt">Contenu :</label>
            <textarea name="content" id="content" style="height:300px;resize:none">{{$serie->content}}</textarea>
        </div>
        <div>
            <label for="acteurs" style="font-size: 15pt">Acteurs :</label>
            <textarea name="acteurs" id="acteurs" style="resize: none;height:100px">{{$serie->acteurs}}</textarea>
        </div>
        <div>
            <label for="tags" style="font-size: 15pt">Tags :</label>
            <textarea name="tags" id="tags" style="resize: none;height:100px">{{$serie->tags}}</textarea>
        </div>

        <button type="submit" style="border: 1px solid black; border-color: black; padding:10px; font-size: 17px; top:5px">Mettre à jour</button>
    </form>

    {{-- Suppression de la série, c'est un formulaire sinon on ne peut pas utiliser la méthode delete--}}
    <form method="POST" action="/admin/series/{{$serie->id}}" style="margin-top: 20px;">
        @method("DELETE")
        @csrf
        <button type="submit" style="color:red ; border: 3px;border-style:solid; padding:6px; font-weight:bold">Supprimer la série</button>
    </form>

    <div style="margin-bottom: 5%;margin-top : 20px">
        <a href="/admin/series">Revenir à l'index des séries</a>
    </div>
@endsection
