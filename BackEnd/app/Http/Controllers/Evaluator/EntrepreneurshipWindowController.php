<?php

namespace App\Http\Controllers\Evaluator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entrepreneurship;
use App\Models\EntrepreneurshipWindow;
use App\Models\EntrepreneurialProfile;

use PDF;
use Storage;

class EntrepreneurshipWindowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $entrepreneurship = Entrepreneurship::select('convocation_form_id')
                                ->where('slug',$slug)
                                ->first();

        $window = EntrepreneurshipWindow::where('convocation_form_id', $entrepreneurship->convocation_form_id)->first();

        if($window->logo!=null){
            $window->logo = Storage::url($window->logo);
        }

        if($window->image_1!=null){
            $window->image_1 = Storage::url($window->image_1);
        }

        if($window->image_2!=null){
            $window->image_2 = Storage::url($window->image_2);
        }

        if($window->image_3!=null){
            $window->image_3 = Storage::url($window->image_3);
        }

        if($window->image_4!=null){
            $window->image_4 = Storage::url($window->image_4);
        }
        
        if(!$window){
            return response()->json(['error'],400);
        }

        return response()->json([
            'window'=>$window
        ],200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($slug)
    {

        $entrepreneurship = Entrepreneurship::select('convocation_form_id')
                                ->where('slug',$slug)
                                ->first();

        $window = EntrepreneurshipWindow::where('convocation_form_id', $entrepreneurship->convocation_form_id)->first();

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
            'entrepreneurship' => $window,
            'team' => $team
        ];

        $pdf = PDF::loadView('pdf.showcaseVenture', $data);

        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );

        return $pdf->download($window->title.'.pdf');
    }
}
