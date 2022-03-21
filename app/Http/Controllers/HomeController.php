<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Fonction d'accès au site
     */
    public function index(){
        $series = \App\Models\Serie::orderBy('id', 'desc')->take(3)->get();
        return view('welcome', array('series' => $series));
        }


    /**
     * Fonction d'accès au SPA
     */
    public function homevue(){
        return view('homevue');
    }
}
