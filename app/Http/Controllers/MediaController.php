<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Affiche la view pour uploader un ou plusieurs medias
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('adminseries.mediaUpload');
    }
    /**
     * Stocke les médias envoyés
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([ //Vérification qu'on uploade bien le bon type de fichier
            //'medias'=>'required', //On ne le met pas pour avoir le choix ou non d'uploader un média
            'medias.*' =>'mimes:image/png,image/jpg,video/mp4,video/mpeg,image/gif'

        ]);
    }

}
