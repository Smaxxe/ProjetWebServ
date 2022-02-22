<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $series = \App\Models\Serie::orderBy('id', 'desc')->take(3)->get();
        return view('welcome', array('series' => $series));
        }
    //
}
