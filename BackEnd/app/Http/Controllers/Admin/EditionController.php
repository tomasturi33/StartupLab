<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Edition;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Edition::where('state',1)->orderBy('id','DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $edition = new Edition();

        $edition->name = $request->name;
        $edition->pre_incubation = $request->pre_incubation;
        $edition->incubation = $request->incubation;
        $edition->pre_aceleration = $request->pre_aceleration;
        $edition->published = 0;
        $edition->slug = Str::slug($request->name).'-'.time();
        $edition->state = 1;

        if(!$edition->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'edition'=>$edition
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
        $edition = Edition::where('id', $id)->first();
        $modules = $edition->module_pre_incubations;
        
        return response()->json(compact('edition'),200);
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

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'published' => 'required',
            'terms_and_conditions' =>'required_if:published,==,true'
        ]);

        $edition = Edition::find($id);

        $edition->name = $request->name;
        $edition->description = $request->description;
        $edition->pre_incubation = $request->pre_incubation;
        $edition->incubation = $request->incubation;
        $edition->pre_aceleration = $request->pre_aceleration;
        $edition->published = $request->published;
        $edition->start_date = $request->start_date;
        $edition->start_time = $request->start_time;
        $edition->finish_date = $request->finish_date;
        $edition->finish_time = $request->finish_time;
        $edition->terms_and_conditions = $request->terms_and_conditions;

        $edition->slug = Str::slug($request->name).'-'.time();

        if(!$edition->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'edition'=>$edition
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
        $edition = Edition::find($id);

        if(!$edition->delete()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'edition'=>$edition
        ],200);
    }
}