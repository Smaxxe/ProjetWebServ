<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Affiche la view pour uploader un ou plusieurs medias
     *
     * @return \Illuminate\Http\Response
     * 
     * @Gouipe Salut mek
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

    }
}
