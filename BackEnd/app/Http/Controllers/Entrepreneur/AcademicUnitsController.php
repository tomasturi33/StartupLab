<?php

namespace App\Http\Controllers\Entrepreneur;

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
        $academic_units = AcademicUnit::select('id','name')
                                        ->where('state',1)
                                        ->get();

        return response()->json([
            'academic_units'=>$academic_units
        ],200);
    }

    public function show($id)
    {
        $academic_unit = AcademicUnit::find($id);
        $academic_unit->careers;

        return response()->json([
            'academic_unit'=>$academic_unit
        ],200);
    }
}
