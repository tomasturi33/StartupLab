<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entrepreneurship;

class EntrepreneurshipController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $entrepreneurship = Entrepreneurship::where('slug',$slug)->firstOrFail();

        if(!$entrepreneurship){
            return response()->json(['error'],400);
        }

        $entrepreneurship->user;
        $entrepreneurship->provincia;
        $entrepreneurship->localidad;
        $entrepreneurship->entrepreneurship_stadia;
        $entrepreneurship->development_degrees;
        $entrepreneurship->vertical_works;
        $entrepreneurship->need_startup;
        $entrepreneurship->curriculum;

        foreach ($entrepreneurship->need_startup as $idea) {
            $idea->entrepreneurship_need;
        }

        return response(compact('entrepreneurship'), 200);
    }
}
