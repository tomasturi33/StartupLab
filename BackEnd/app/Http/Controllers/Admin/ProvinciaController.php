<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $provincia = new Provincia();
        $provincia->name = $request->name;

        if(!$provincia->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'provincia'=>$provincia
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provincia = Provincia::find($id);
        $provincia->localidads;

        return response()->json([
            'provincia'=>$provincia
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $provincia = Provincia::find($id);
        $provincia->name = $request->name;

        if(!$provincia->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'provincia'=>$provincia
        ],200);
    }
}
