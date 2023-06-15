<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gender;

class GenderController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genders = Gender::select('id','name')
                                    ->where('state',1)
                                    ->get();

        if(!$genders){
            return response()->json(['error'],400);
        }
        
        return response()->json([
            'genders'=>$genders
        ],200);
    }
}
