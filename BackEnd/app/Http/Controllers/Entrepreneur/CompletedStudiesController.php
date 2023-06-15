<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompletedStudies;

class CompletedStudiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $completed_studies = CompletedStudies::select('id','name')
                                        ->where('state',1)
                                        ->get();

        return response()->json([
            'completed_studies'=>$completed_studies
        ],200);
    }
}
