<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EntrepreneurialProfile;

class EntrepreneurialProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrepreneurs = EntrepreneurialProfile::select('id', 'name', 'lastname', 'email', 'status')
                            ->orderBy('id','DESC')->get();

        return response()->json([
            'entrepreneurs'=>$entrepreneurs
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entrepreneur = EntrepreneurialProfile::find($id);

        $entrepreneur->provincia;
        $entrepreneur->localidad;
        $entrepreneur->completed_studie;
        $entrepreneur->academic_unit;
        $entrepreneur->career;
        $entrepreneur->convocation_form->edition;

        if(!$entrepreneur){
            return response()->json(['error'],400);
        }

        return response()->json([
            'entrepreneur'=>$entrepreneur
        ],200);
    }
}
