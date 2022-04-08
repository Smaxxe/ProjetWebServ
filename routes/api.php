<?php

use App\Http\Controllers\API\AdminSeriesAPI;
use App\Http\Controllers\API\ContactAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SeriesAPI;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//DEBUT VUEJS///

//Routes pour le controller API des Séries
Route::get('series/home', [SeriesAPI::class, 'home']);
Route::get('series/all', [SeriesAPI::class, 'index']);
Route::get('series/{serie_id}', [SeriesAPI::class, 'show']);

//Route pour les contacts
Route::post('contact', [ContactAPI::class, 'store']);

//Routes pour adminSeries
Route::resource('admin/series', AdminSeriesAPI::class);
