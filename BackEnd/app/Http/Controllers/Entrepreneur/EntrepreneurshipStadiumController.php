<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EntrepreneurshipStadium;

class EntrepreneurshipStadiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrepreneurship_stadium = EntrepreneurshipStadium::select('id','name')
                                        ->where('state',1)
                                        ->get();

        return response()->json([
            'entrepreneurship_stadium'=>$entrepreneurship_stadium
        ],200);
    }
}
