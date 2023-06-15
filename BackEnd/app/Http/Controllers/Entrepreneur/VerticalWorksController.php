<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VerticalWorks;

class VerticalWorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vertical_works = VerticalWorks::select('id','name')
                                        ->where('state',1)
                                        ->get();

        return response()->json([
            'vertical_works'=>$vertical_works
        ],200);
    }
}
