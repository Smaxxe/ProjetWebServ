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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminSeriesController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CommentsController;


//Routes concernant le HomeController
Route::get('/', [HomeController::class, 'index']);

//Routes concernant le SeriesController
Route::get('/series', [SeriesController::class, 'index']);
Route::get('/series/{url}', [SeriesController::class, 'show']);

//Routes concernant le ContactController
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);

//Routes du MediaController
Route::resource('admin/media', MediaController::class)
    ->middleware(['auth', 'adminAuth']); //Vérification par middleware que l'utilisateur est connecté et a les droits admin
Route::get('admin/media/create/{serie}', [MediaController::class, 'create']) //Route pour passer de la création d'une série à l'ajout de medias en passant l'id de la série
    ->middleware(['auth', 'adminAuth']);
Route::get('/admin/media/edit/{serie}', [MediaController::class, 'edit']) //Route pour passer de l'édition d'une série à la gestion de ses médias associés
    ->middleware(['auth', 'adminAuth']);

//Routes du AdminSeriesController
Route::resource('admin/series', AdminSeriesController::class)
    ->middleware(['auth', 'adminAuth']);

//Routes du CommentsController
Route::resource('/comment', CommentsController::class);

require __DIR__.'/auth.php';

