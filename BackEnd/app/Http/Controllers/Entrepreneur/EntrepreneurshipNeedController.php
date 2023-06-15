<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EntrepreneurshipNeed;

class EntrepreneurshipNeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrepreneurship_needs = EntrepreneurshipNeed::select('name')
                        ->where('state',1)
                        ->orderBy('id', 'DESC')
                        ->get();

        return response()->json([
            'entrepreneurship_needs'=>$entrepreneurship_needs
        ],200);
    }
}
