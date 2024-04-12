<?php

namespace App\Http\Controllers;

use App\Models\Recept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class ReceptController extends Controller
{
    function osszesRecept(){
        $recept = DB::table('recepts as r')
        ->select('r.*', "k.nev as kat_nev")
        ->join('kategorias as k', 'r.kat_id', '=', 'k.id')
        ->get();
        return $recept;
    }

    function ujRecept(Request $request){
        $recept = new Recept();
        $recept->nev = $request->nev;
        $recept->kat_id = $request->kat_id;
        $recept->kep_eleresi_ut = $request->nekep_eleresi_ut;
        $recept->leiras = $request->leiras;
        $recept->save();
    }

    function torolRecept($id) {
        Recept::find($id)->delete();
    }
}
