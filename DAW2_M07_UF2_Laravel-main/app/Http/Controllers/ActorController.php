<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
    /* READ ACTORS FROM DDBB WITH QB */
    public static function readActors() {
        $actors = DB::table('actors')->get();
        return $actors;
    }

    /* LISTA DE TODOS LOS ACTORES */
    public function listOfActors(){
        $title = "Listado de Actores";
        $actors = ActorController::readActors();
        // dd($actors);

        // $actor = [
        //     "name"=>$_GET["id"],
        //     "surname"=>$_GET["surname"],
        //     "birthday"=>$_GET["birthday"],
        //     "country"=>$_GET["country"],
        //     "img_url"=>$_GET["img_url"],
        //     "duration"=>$_GET["duration"]
        // ];

        $arrayActors = $actors->toArray();

        return view('actors.list', ["actors" => $arrayActors, "title" => $title]);
    }

    /* LISTA DE ACTORES POR DECADA */
    public function listActorsByDecade(Request $request){
        $decade = $request ->query('decade');
        $title = "Listado actores filtrado por decada ( $decade )";        
        $actorsByDecade =  DB::table('actors')->whereBetween('birthday', [$decade . '-01-01', ($decade + 9) . '-12-31'])->get();

        
        return view('actors.list', ["actors" => $actorsByDecade, "title" => $title]);
    }

    /* LISTA COUNT ACTORES */
    public function listCountActors(){
        $actors = ActorController::readActors();
        $title = "Total de Actores";
        $totalActorCount = count($actors);
        
        return view('actors.count', ["actors" => $totalActorCount, "title" => $title]);
    }

    public function deleteActor($id){
        $actor = DB::table('actors');
        if(!$actor){
        return response()->json(['action' => 'delete', 'status' => false]);
        }
        $deleted = $actor->delete($id);
        return response()->json(['action' => 'delete', 'status' => $deleted]);
    }
}