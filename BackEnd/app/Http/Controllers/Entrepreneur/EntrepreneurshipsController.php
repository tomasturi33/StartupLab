<?php

/*
Este controlador se encarga de mostrar los emprendimientos
y las vidrieras de cada emprendimiento. Obtiene datos de la
table entrepreneurships pero no realiza ningun tipo de cambio
*/

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entrepreneurship;

class EntrepreneurshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Entrepreneurship::select('id','title', 'image', 'slug')
                    ->where('state',1)->orderBy('id','DESC')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return Entrepreneurship::where('slug', $slug)->first();
    }
}
