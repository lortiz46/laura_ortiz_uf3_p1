<?php

use App\Http\Controllers\NewController;
use App\Http\Controllers\FilmController;
use App\Http\Middleware\ValidateYear;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;


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

Route::get('/', function () {
    return view('welcome');
});

//Peliculas:
Route::middleware('year')->group(function() {
    Route::group(['prefix'=>'filmout'], function(){
        // Routes included with prefix "filmout"
        Route::get('oldFilms/{year?}',[FilmController::class, "listOldFilms"])->name('oldFilms');
        Route::get('newFilms/{year?}',[FilmController::class, "listNewFilms"])->name('newFilms');
        Route::get('films/{year?}/{genre?}',[FilmController::class, "listFilms"])->name('listFilms');
        Route::get('filmsByYear/{year?}',[FilmController::class, "listFilmsByYear"])->name('filmsByYear');
        Route::get('filmsByGenre/{genre?}',[FilmController::class, "listFilmsByGenre"])->name('filmsByGenre');
        Route::get('sortFilms',[FilmController::class, "listSortFilms"])->name('sortFilms');
        Route::get('countFilms',[FilmController::class, "listCountFilms"])->name('countFilms');
        
    });
});


Route::middleware('img_url')->group(function() {
    Route::group(['prefix'=>'filmin'], function(){
        // Routes included with prefix "filmin"
        Route::post('createFilm',[FilmController::class, "list"])->name('createFilm');
               
    });
});

//Actores:
Route::group(['prefix'=>'actorout'], function(){
    Route::get('listActors', [ActorController::class, "listOfActors"])->name('listOfActors');
    Route::get('actor/{decade?}', [ActorController::class, "listActorsByDecade"])->name('listActorsByDecade');
    Route::get('countActors', [ActorController::class, "listCountActors"])->name('countActors');
    

});

