<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $series = \App\Models\Serie::all();
        return view('welcome', array('series' => $series));
        }
    //
}
