<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provincias = Provincia::all();

        return response()->json([
            'provincias'=>$provincias
        ],200);
    }

    /**
     * Display a resource whit her relationships
     * elements.
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provincia = Provincia::find($id);

        $provincia->localidads;

        return response()->json( compact('provincia'),200);
    }
}
