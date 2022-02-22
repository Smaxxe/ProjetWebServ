<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(){
        $series = \App\Models\Serie::all();
        return view('series.index', array('series' => $series));
    }

    public function show($serie_title){
        $serie = \App\Models\Serie::where('title', $serie_title)->first();
        return view('series.single', array('serie' => $serie));
    }
    //
}
