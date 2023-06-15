<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicUnit;

class AcademicUnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academic_units = AcademicUnit::select('id','name', 'initials')
                                        ->where('state',1)
                                        ->orderBy('id', 'DESC')
                                        ->get();

        return response()->json([
            'academic_units'=>$academic_units
        ],200);
    }

    /**
     * Display an specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $academic_unit = AcademicUnit::find($id);
        $academic_unit->careers;

        return response()->json([
            'academic_unit'=>$academic_unit
        ],200);
    }

    /**
     * Create an specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $academic_unit = new AcademicUnit();
        $academic_unit->name = $request->name;
        $academic_unit->initials = $request->initials;
        $academic_unit->state=1;

        if(!$academic_unit->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'academic_unit'=>$academic_unit
        ],200);
    }

    /**
     * Update an specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $academic_unit = AcademicUnit::find($id);
        $academic_unit->name = $request->name;
        $academic_unit->initials = $request->initials;

        if(!$academic_unit->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'academic_unit'=>$academic_unit
        ],200);
    }

    /**
     * Delete an specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $academic_unit = AcademicUnit::find($id);
        $academic_unit->state = 0;

        if(!$academic_unit->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'academic_unit'=>$academic_unit
        ],200);
    }
}
