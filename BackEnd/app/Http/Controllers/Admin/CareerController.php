<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $careers = Career::select('id','name')
                        ->where('state',1)
                        ->orderBy('id', 'DESC')
                        ->get();

        return response()->json([
            'careers'=>$careers
        ],200);
    }

    /**
     * Display an specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $career = Career::find($id);
        $career->academic_unit;

        return response()->json([
            'career'=>$career
        ],200);
    }

    /**
     * Create an specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $career = new Career();
        $career->name = $request->name;
        $career->academic_unit_id = $request->academic_unit_id;
        $career->state=1;

        if(!$career->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'career'=>$career
        ],200);
    }

    /**
     * Update an specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $career = Career::find($id);
        $career->name = $request->name;
        $career->academic_unit_id = $request->academic_unit_id;

        if(!$career->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'career'=>$career
        ],200);
    }

    /**
     * Delete an specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $career = Career::find($id);
        $career->state = 0;

        if(!$career->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'career'=>$career
        ],200);
    }
}
