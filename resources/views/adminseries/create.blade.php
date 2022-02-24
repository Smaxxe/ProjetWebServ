@extends('/layouts/main')

@section('content')
    <h1>Création d'une nouvelle série</h1>

    @if ($errors->any()) {{--Si la validation renvoie une erreur, on affiche ici--}}
    <div class="alert alert-danger" style="padding-top: 20px">
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="/admin/series">

        @csrf
        <div>
            <label for="title" style="font-size: 15pt">Titre :</label>
            <textarea name="title" id="title" style="resize: none"></textarea>
        </div>
        <div>
            <label for="author" style="font-size: 15pt">Auteur : </label>
            <select name="author" id="author">
                <option value="">--Sélectionner un auteur--</option>
                @foreach ($authors as $author)
                    <option>{{$author->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="content" style="font-size: 15pt">Contenu :</label>
            <textarea name="content" id="content" style="height:300px;resize:none"></textarea>
        </div>
        <div>
            <label for="acteurs" style="font-size: 15pt">Acteurs :</label>
            <textarea name="acteurs" id="acteurs" style="resize: none;height:100px"></textarea>
        </div>
        <div>
            <label for="tags" style="font-size: 15pt">Tags :</label>
            <textarea name="tags" id="tags" style="resize: none;height:100px"></textarea>
        </div>

        <button type="submit" style="border: 1px solid black; border-color: black; padding:10px; font-size: 20px; top:5px">Créer</button>
    </form>

    <div style="margin-bottom: 5%;margin-top : 20px">
        <a href="/admin/series">Revenir à l'index des séries</a>
    </div>
@endsection
