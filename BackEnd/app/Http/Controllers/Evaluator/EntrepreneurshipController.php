<?php

namespace App\Http\Controllers\Evaluator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entrepreneurship;
use App\Models\EntrepreneurialProfile;

use PDF;

class EntrepreneurshipController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $entrepreneurship = Entrepreneurship::where('slug',$slug)->firstOrFail();

        if(!$entrepreneurship){
            return response()->json(['error'],400);
        }

        $entrepreneurship->user;
        $entrepreneurship->provincia;
        $entrepreneurship->localidad;
        $entrepreneurship->entrepreneurship_stadia;
        $entrepreneurship->development_degrees;
        $entrepreneurship->vertical_works;
        $entrepreneurship->need_startup;
        $entrepreneurship->curriculum;

        foreach ($entrepreneurship->need_startup as $idea) {
            $idea->entrepreneurship_need;
        }

        return response(compact('entrepreneurship'), 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($slug)
    {
        $entrepreneurship = Entrepreneurship::where('slug',$slug)->first();
        $entrepreneurship->user;
        $entrepreneurship->provincia;
        $entrepreneurship->localidad;
        $entrepreneurship->entrepreneurship_stadia;
        $entrepreneurship->development_degrees;
        $entrepreneurship->vertical_works;
        $entrepreneurship->need_startup;
        $entrepreneurship->curriculum;

        foreach ($entrepreneurship->need_startup as $idea) {
            $idea->entrepreneurship_need;
        }

        $team = EntrepreneurialProfile::where('convocation_form_id',$entrepreneurship->convocation_form_id)
                                    ->get();

        if(!$team){
            return response()->json(['error'],400);
        }

        foreach ($team as $t) {
            $t->provincia;
            $t->localidad;
            $t->completed_studie;
            $t->academic_unit;
            $t->career;
            $t->gender;
        }

        $data = [
            'entrepreneurship' => $entrepreneurship,
            'team' => $team
        ];

        $pdf = PDF::loadView('pdf.startUp', $data);

        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );

        $title = $entrepreneurship->title;

        return $pdf->download($title.'.pdf');
    }
}
