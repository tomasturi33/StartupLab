<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Localidad;

class LocalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localidades = Localidad::select('id','name')
                        ->where('state',1)
                        ->orderBy('id', 'DESC')
                        ->get();

        return response()->json([
            'localidades'=>$localidades
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
        $localidad = new Localidad();
        $localidad->name = $request->name;
        $localidad->provincia_id = $request->provincia_id;
        $localidad->state = 1;

        if(!$localidad->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'localidad'=>$localidad
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
        $localidad = Localidad::find($id);
        $localidad->provincia;

        return response()->json([
            'localidad'=>$localidad
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
        $localidad = Localidad::find($id);
        $localidad->name = $request->name;
        $localidad->provincia_id = $request->provincia_id;

        if(!$localidad->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'localidad'=>$localidad
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $localidad = Localidad::find($id);
        $localidad->state = 0;

        if(!$localidad->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'localidad'=>$localidad
        ],200);
    }
}
