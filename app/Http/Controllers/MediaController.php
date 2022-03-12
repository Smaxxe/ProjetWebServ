<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Models\Media;
use App\Models\Serie;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Cette fonction sert à afficher le formulaire d'upload de nouveaux médias de la bouvelle série,
     * qui s'affiche directement après avoir envoyé le formulaire de création d'une nouvelle série
     *
     * @param App\Models\Serie $serie
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Serie $serie)
    {
        $medias = $serie->medias;
        return view('medias', array('serie' => $serie, 'medias' => $medias));

        //return view('medias.create', array('serie' => $serie));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMediaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMediaRequest $request)
    {
        $validated = $request->validate([ //Vérification qu'on uploade bien le bon type de fichier
            //'medias'=>'required', //On ne le met pas pour avoir le choix ou non d'uploader un média lorsqu'on créé une série

            //On limite les formats acceptés à certains types d'images
            'files' => 'required',
            'files.*' => 'mimes:png,jpg,gif',
        ]);

        if ($request->TotalFiles > 0) {
            for ($x = 0; $x < $request->TotalFiles; $x++) //On boucle pour récupérer les fichiers 1 par 1
            {
                if ($request->hasFile('files' . $x)) {
                    $media = $request->file('files' . $x); //On récupère le fichier courant

                    $url = $media->store('public/medias'); //On le stocke en récupérant au passage son path
                    //lien du tuto : https://www.tutsmake.com/multiple-file-upload-using-ajax-in-laravel-8/

                    $insert[$x]['url'] = $url;
                    $insert[$x]['filename'] = basename($url);
                    $insert[$x]['serie_id'] = request('serie_id');
                }
            }

            Media::insert($insert);

            return response()->json(['success' => 'Les fichiers ont été chargés']);
        } else {
            return response()->json(['error' => 'Erreur, réessayez']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Dans cette fonction on ne va pas vraiment éditer des objets du modèle média,
     * mais on va plutôt ajouter/supprimer des médias associés à la série qu'on vient de mettre à jour
     *
     * @param App\Models\Serie $serie
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $serie)
    {
        $medias = $serie->medias;
        return view('medias', array('serie' => $serie, 'medias' => $medias));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMediaRequest  $request
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMediaRequest $request, Media $media)
    {
        //
    }

    /**
     * Ici on va supprimer l'objet média passé en argument, mais également le fichier qui lui est associé dans l'arborescence
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $medium)
    { //A FAIRE : DETRUIRE LE FICHIER POINTE PAR L'URL DE LA SERIE + DETRUIRE LA SERIE

        //On supprime le fichier lié au modèle média
        // unlink(asset("$medium->url"));
        File::delete(public_path("/storage/medias/$medium->filename"));

        //On supprime l'objet lui-même
        $medium->delete();

        //On renvoie vers la même page en indiquant que le média a été supprimé
        return back()->with('status', 'Le média a bien été supprimé');
    }
}
