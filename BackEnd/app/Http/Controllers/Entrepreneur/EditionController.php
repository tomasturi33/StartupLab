<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Edition;

class EditionController extends Controller
{
    /**
     * Display info about edition
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edition = Edition::find($id);

        return response()->json([
            'edition'=>$edition
        ],200);
    }
}
