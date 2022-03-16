@extends('/layouts/main')

@section('content')
    <h1>Création d'une nouvelle série</h1>

    @if ($errors->any())
        {{-- Si la validation renvoie une/des erreur(s), on affiche ici --}}
        <div class="" style="padding-top: 20px">
            <ul style="color:red">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire de création d'une série --}}
    <form method="POST" action="/admin/series">
        @csrf
        <div>
            <label for="title" style="font-size: 15pt">Titre :</label>
            <textarea name="title" id="title" style="resize: none"></textarea>
        </div>
        <div> {{-- Ici le choix de l'auteur se fait via un menu de sélection déjà rempli par les auteurs existants --}}
            <label for="author" style="font-size: 15pt">Auteur : </label>
            <select name="author" id="author">
                <option value="">--Sélectionner un auteur--</option>
                @foreach ($authors as $author)
                    <option>{{ $author->name }}</option>
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

        <button type="submit"
            class="bouton-simple">Créer et passer à la gestion des médias</button>
    </form>

    <div style="margin-bottom: 5%;margin-top : 20px"> {{-- Pour retourner à l'index de adminséries facilement --}}
        <a href="/admin/series">Revenir à l'index des séries</a>
    </div>
@endsection
