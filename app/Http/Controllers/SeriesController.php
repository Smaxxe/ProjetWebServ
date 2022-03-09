<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Serie;
use \App\Models\Media;

class SeriesController extends Controller
{
    public function index(){
        $series = Serie::all();
        return view('series.index', array('series' => $series));
    }

    public function show($serie_title){
        $serie = Serie::where('title', $serie_title)->first();
        $medias = $serie->medias;
        return view('series.single', array('serie' => $serie, 'medias' => $medias));
    }
    //
}
