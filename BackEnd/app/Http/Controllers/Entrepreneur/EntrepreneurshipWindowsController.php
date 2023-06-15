<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EntrepreneurshipWindow;
use App\Models\EntrepreneurialProfile;
use Storage;
use PDF;
class EntrepreneurshipWindowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $windows = EntrepreneurshipWindow::where('state',1)
                    ->where('published',1)
                    ->get();

        foreach($windows as $window){
            if($window->logo){
                $window->logo = Storage::url($window->logo);
            }
        }

        if(!$windows){
            return response()->json(['error'],400);
        }

        return response()->json([
            'windows'=>$windows
        ],200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $window = EntrepreneurshipWindow::where('slug', $slug)->first();

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
        $entrepreneurship = EntrepreneurshipWindow::where('slug', $slug)->first();

        // $entrepreneurship->user;
        // $entrepreneurship->provincia;
        // $entrepreneurship->localidad;
        // $entrepreneurship->entrepreneurship_stadia;
        // $entrepreneurship->development_degrees;
        // $entrepreneurship->vertical_works;
        // $entrepreneurship->need_startup;
        // $entrepreneurship->curriculum;

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

        $title = $entrepreneurship->title;

        return $pdf->download($title.'.pdf');
    }
}
