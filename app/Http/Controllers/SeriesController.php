<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use \App\Models\Media;

class SeriesController extends Controller
{
    public function index(){
        $series = Serie::all();
        return view('series.index', array('series' => $series));
    }

    public function show($serie_title){
        $serie = \App\Models\Serie::where('title', $serie_title)->first();
        $comments = $serie->comments;
        $medias = $serie->medias;
        return view('series.single', array('serie' => $serie, 'comments' => $comments,'medias' => $medias));
    }
    //
}
