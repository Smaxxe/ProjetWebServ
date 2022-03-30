<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JSON
     */
    public function index()
    {
        $series = Serie::all();
        return response()->json(array("series" => $series));
    }

    /**
     * Affiche dans la vue d'accueil les 3 dernières séries
     *
     * @return JSON
     */
    public function home(){
        $series = Serie::latest()->take(3)->get();
        return response()->json(array("series" => $series));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serie  $series
     * @return \Illuminate\Http\Response
     */
    public function show($serie_id) //$serie_id correpond à .../{serie_id} dans la route de api.php qui appelle show
    {
        $serie = Serie::where('id', $serie_id)->first();
        return $serie;
        return response()->json($serie);
    }
}
