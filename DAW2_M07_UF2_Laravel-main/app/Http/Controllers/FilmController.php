<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;


class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array {
        $films = Storage::json('/public/films.json');
        return $films;
    }
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {        
        $old_films = [];
        if (is_null($year))
        $year = 2000;
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
        //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            }else if((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)){
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            }else if(!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    //Modified Act.:
    public function listFilmsByYear($year = null){
        $filmsByYear = [];   
        $films = FilmController::readFilms();

        //if year is null
        if (is_null($year))
        $year = 1985;

        //list based on year
        foreach ($films as $film) {
            if (!is_null($year) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado por año ( $year )";
                $filmsByYear[] = $film;
            }
        }
        return view('films.list', ["films" => $filmsByYear, "title" => $title]);
    }

    public function listFilmsByGenre($genre = null){
        $filmsByGenre = [];
        $films = FilmController::readFilms();

        //if genre is null
        if (is_null($genre))
        $genre = "Comedia";

        //list based on genre
        foreach ($films as $film) {
            if (!is_null($genre) && strtolower($film['genre']) == strtolower($genre)){
                $title = "Listado de todas las pelis filtrado por género ( $genre )";
                $filmsByGenre[] = $film;
            }
        }
        return view('films.list', ["films" => $filmsByGenre, "title" => $title]);
    }

    public function listSortFilms($year = null){
    
        $sortFilms = [];   
        $films = FilmController::readFilms();

        if (!is_null($year)) {
            $title = "Listado de todas las pelis filtrado año de nueva a antigua";
            foreach ($films as $film) {
                if ($film['year'] == $year) {
                    $sortFilms[] = $film;
                }
            }
        } else {
            $title = "Listado de todas las pelis filtrado año de nueva a antigua";
            usort($films, function($a, $b) {
                return $b['year'] - $a['year'];
            });
            $sortFilms = $films;
        }
        return view('films.list', ["films" => $sortFilms, "title" => $title]);
    }
    
    // total number of films
    public function listCountFilms($year = null, $genre = null) {
        $films = FilmController::readFilms();        
        $title = "Numero total de pelis";
        $filteredFilms = array_filter($films, function ($film) use ($year, $genre) {
            return (is_null($year) || $film['year'] == $year) && (is_null($genre) || strtolower($film['genre']) == strtolower($genre));
        });
    
        $totalFilmCount = count($filteredFilms);
        return view('films.count', ["films" => $totalFilmCount, "title" => $title]);
    }

    //(new functions practica)
    public function createFilm(){
        $filmExist = FilmController::isFilm($_POST["name"]);
        if($filmExist){
            return view('welcome', ['ERROR' => 'This film exists.']);
        }else{
            $films = FilmController::readFilms();
            $film = ["name" => $_POST["name"],
                    "year"=> $_POST["year"],
                    "genre"=> $_POST["genre"],
                    "country"=> $_POST["country"],
                    "duration"=> $_POST["duration"],
                    "img_url"=> $_POST["img_url"]];

            $films[] = $film;
            
            $json = json_encode($films, JSON_PRETTY_PRINT);
            Storage::put('public/films.json', $json);
            
            $title = "Listado de pelis.";
            return view('films.list', ["films" => $films, "title" => $title]);
        }
    }

    public function isFilm($name = null):bool {
        $films = FilmController::readFilms();
        $filmExist = false;

        foreach($films as $film){
            if($film["name"]==$name){
                $filmExist = true;
            }
        }
        return $filmExist;
    }
}
