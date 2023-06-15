<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edition;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convocations= Edition::where('published',1)
                        ->where('start_date','<=',date('Y-m-d'))
                        ->where('finish_date','>=',date('Y-m-d'))
                        ->get();

        return response()->json([
            'convocations'=>$convocations
        ],200);
    }

    /**
     * Display info from convocation/edition
     *
     * @return \Illuminate\Http\Response
     */
    public function convocationInfo($slug)
    {
        $convocation= Edition::where('slug',$slug)->firstOrFail();

        return response()->json([
            'convocation'=>$convocation
        ],200);
    }
}
