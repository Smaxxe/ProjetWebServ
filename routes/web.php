<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\ContactController;

//Routes concernant le HomeController
Route::get('/', [HomeController::class, 'index']);

//Routes concernant le SeriesController
Route::get('/series', [SeriesController::class, 'index']);
Route::get('/series/{url}',[SeriesController::class, 'show']);

//Routes concernant le ContactController
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);
