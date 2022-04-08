<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Serie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminSeriesAPI extends Controller
{
    /**
     * Renvoie les auteurs pour les afficher dans le menu déroulant de la création de série
     *
     */
    public function create()
    {
        $auteurs = User::all();
        return $auteurs;
    }

    /**
     * Crée une nouvelle entrée dans la bdd pour la nouvelle série
     *
     */
    public function store(Request $request)
    {
        //Validations : pas besoin de vérifier l'auteur puisque le choix se fait déjà parmi les users existants
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required', //On vérifie quand même que le champ ait un contenu pour éviter les fausses manips
            'content' => 'required',
            'acteurs' => 'required', //Si aucun acteur dans le film (animation par ex) il faut le préciser
            'tags' => 'required',

        ]);

        //Création de la nouvelle série avec les éléments
        $serie = new Serie();
        $serie->title = request('title');
        $serie->author_id = User::where('name', request('author'))->first()->id;
        $serie->content = request('content');
        $serie->acteurs = request('acteurs');
        $serie->tags = request('tags');
        $serie->url = str_replace(' ', '_', request('title'));
        $serie->status = 'published';
        $serie->save();

        $id = $serie->id;
        return response()->json($id); //On renvoie l'id de la série pour ensuite charger la vue d'édition
    }

    /**
     * Affiche la page concernant la série en question, pour permettre édition/suppression
     *
     */
    public function edit($series)
    {
        $serie = Serie::where('id', $series)->first();
        $serie->author;
        $auteurs = User::all();
        return response()->json(array("serie" => $serie, "auteurs" => $auteurs));
    }

    /**
     * Met à jour les informations de la série dans la bdd
     *
     */
    public function update(Request $request, $series)
    {
        //Validations : pas besoin de vérifier l'auteur puisque le choix se fait déjà parmi les users existants
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required', //On vérifie quand même que le champ ait un contenu pour éviter les fausses manips
            'content' => 'required',
            'acteurs' => 'required', //Si aucun acteur dans le film (animation par ex) il faut le préciser
            'tags' => 'required',

        ]);

        $serie = Serie::where('id', $series)->first();
        $serie->update([ //On met à jour le contenu de la série
            'title' => request('title'),
            'author_id' => User::where('name', request('author.name'))->first()->id,
            'content' => request('content'),
            'acteurs' => request('acteurs'),
            'tags' => request('tags')
        ]);

        return $series;
    }

    /**
     * Supprime la série concernée dans la BDD
     *
     */
    public function destroy($series)
    {
        $serie = Serie::where('id', $series)->first();
        $medias = $serie->medias;

        //Quand on supprime une série, le comportement cascade supprime les objets médias qui lui sont associés
        //Et via ce bout de code on va également supprimer les fichiers eux-mêmes
        foreach ($medias as $media) {
            File::delete(public_path("/storage/medias/$media->filename"));
        }

        $title = $serie->title;
        $id = $serie->id;
        $serie->delete();

        return $id;
    }
}
