<?php

namespace App\Http\Controllers\Evaluator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModulePreIncubation;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Pill;

class ModulesPreIncubationController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = ModulePreIncubation::select('order', 'edition_id','name', 'slug')
                        ->where('edition_id', 1)
                        ->get();
        if(!$modules){
            return response()->json(['error'],400);
        }

        return response()->json([
            'data' => compact('modules')],200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $module = ModulePreIncubation::where('slug',$slug)->first();
        $module->pills;

        if(!$module){
            return response()->json(['error'],400);
        }

        return response()->json([
            'data' => compact('module')],200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pill($slug, $pill_slug)
    {
        $pill = Pill::where('slug',$pill_slug)->first();
        $pill->url  = Storage::url($pill->content);
        $pill->pill_teacher;

        if(!$pill){
            return response()->json(['error'],400);
        }

        return response()->json([
            'data' => compact('pill')
        ],200);
    }
}
