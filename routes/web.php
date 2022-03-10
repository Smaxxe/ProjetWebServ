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
use App\Http\Controllers\CommentsController;

//Routes concernant le HomeController
Route::get('/', [HomeController::class, 'index']);

//Routes concernant le SeriesController
Route::get('/series', [SeriesController::class, 'index']);
Route::get('/series/{url}',[SeriesController::class, 'show']);

//Routes concernant le ContactController
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);

//Routes du AdminSeriesController
Route::resource('admin/series', AdminSeriesController::class)
    ->middleware(['auth', 'adminAuth']);

//Routes du CommentsController
Route::resource('/comment', CommentsController::class);

//Généré automatiquement par breeze, mais n'est plus utilisé à part si on tape l'url directement
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
