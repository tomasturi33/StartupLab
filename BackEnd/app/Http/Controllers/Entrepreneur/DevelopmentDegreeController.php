<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DevelopmentDegree;

class DevelopmentDegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $development_degree = DevelopmentDegree::select('id','name')
                                        ->where('state',1)
                                        ->get();

        return response()->json([
            'development_degree'=>$development_degree
        ],200);
    }
}
