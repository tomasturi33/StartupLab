<?php

namespace App\Http\Controllers\Evaluator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entrepreneurship;
use App\Models\EntrepreneurialProfile;

class EntrepreneurialProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team($slug)
    {
        $entrepreneurship = Entrepreneurship::select('convocation_form_id')
                                ->where('slug',$slug)
                                ->first();

        $entrepreneurs = EntrepreneurialProfile::select('id', 'name', 'lastname', 'email', 'status')
                            ->where('convocation_form_id', $entrepreneurship->convocation_form_id)
                            ->orderBy('id','DESC')
                            ->get();

        if(!$entrepreneurship ||!$entrepreneurs){
            return response()->json(['error'],400);
        }

        return response()->json([
            'team'=>compact('entrepreneurs')
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id)
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
            'team'=>compact('entrepreneur',200)
        ],200);
    }
}
