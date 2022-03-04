<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\Media;

class MediaController extends Controller
{
    /**
     * Affiche la view pour uploader un ou plusieurs medias
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serie_id = session()->get('s_id');
        return view('adminseries.media', array('serie_id' => $serie_id));
    }
    /**
     * Stocke les médias envoyés en les associant avec une série dont l'id est passé en paramètre
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([ //Vérification qu'on uploade bien le bon type de fichier
            //'medias'=>'required', //On ne le met pas pour avoir le choix ou non d'uploader un média lorsqu'on créé une série

            //On limite les formats acceptés à certains types d'images/vidéos
            'medias.*' => 'mimes:image/png,image/jpg,video/mp4,video/mpeg,image/gif'
        ]);

        if($request->TotalFiles > 0)
        {
            for($x = 0 ; $x < $request->TotalFiles; $x ++) //On boucle pour récupérer les fichiers 1 par 1
            {
                if($request->hasFile('files'.$x))
                {
                    $media = $request->file('files'.$x); //On récupère le fichier courant

                    $url = $media->store('storage/app/public/Medias'); //On le stocke en récupérant au passage son path
                    //lien du tuto : https://www.tutsmake.com/multiple-file-upload-using-ajax-in-laravel-8/

                    $insert[$x]['url'] = $url;
                    $insert[$x]['serie_id'] = $request->serie_id;
                }
            }

            Media::insert($insert);
        }

        $serie = Serie::where('id', request('serie_id'))->first()->id;
        return redirect('/admin/series')->with('status',"La série $serie->title (ID : $serie->id) a bien été créée !");
    }
}
