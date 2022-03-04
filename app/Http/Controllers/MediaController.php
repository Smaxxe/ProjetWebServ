<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Models\Media;
use App\Models\Serie;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Serie $serie)
    {
        return view('adminseries.media', array('serie'=>$serie));
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

            //On limite les formats acceptés à certains types d'images/vidéos
            'medias.*' => 'mimes:image/png,image/jpg,video/mp4,video/mpeg,image/gif'
        ]);

        if ($request->TotalFiles > 0) {
            for ($x = 0; $x < $request->TotalFiles; $x++) //On boucle pour récupérer les fichiers 1 par 1
            {
                if ($request->hasFile('files' . $x)) {
                    $media = $request->file('files' . $x); //On récupère le fichier courant

                    $url = $media->store('storage/app/public/Medias'); //On le stocke en récupérant au passage son path
                    //lien du tuto : https://www.tutsmake.com/multiple-file-upload-using-ajax-in-laravel-8/

                    $insert[$x]['url'] = $url;
                    $insert[$x]['serie_id'] = request('serie_id');
                }
            }

            Media::insert($insert);

            return response()->json(['success'=>'Les fichiers ont été chargés']);

        } else
        {
           return response()->json(["message" => "Erreur, réessayez"]);
        }

        $serie = Serie::where('id', request('serie_id'))->first();
        return redirect('/admin/series')->with('status', "La série $serie->title (ID : $serie->id) a bien été créée !");
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }
}
