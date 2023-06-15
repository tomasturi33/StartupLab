<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ConvocationForm;
use App\Models\Entrepreneurship;
use App\Models\EntrepreneurshipWindow;
use Carbon\Carbon;

use App\Models\IdeaNeed;
use App\Models\NeedStartup;

use App\Models\CurriculumIdea;
use App\Models\CurriculumStartup;
use App\Models\EntrepreneurialProfile;

use PDF;

class ConvocationFormController extends Controller
{
    /**
     * Display a listing of the Convocation Form
     * where the condition is "in_progress"
     * @return \Illuminate\Http\Response
     */
    public function inProgress($edition_id)
    {
        $entrepreneurships = ConvocationForm::where('state',1)
                                ->where('edition_id',$edition_id)
                                ->where('condition','empty')

                                ->orWhere('edition_id',$edition_id)
                                ->where('condition','in_progress')

                                ->orderBy('id','DESC')
                                ->get();

        return response()->json([
            'entrepreneurships'=>$entrepreneurships
        ],200);
    }

    /**
     * Display a listing of the Convocation Form
     * where the condition is "pending"
     * @return \Illuminate\Http\Response
     */
    public function Pending($edition_id){
        $entrepreneurships = ConvocationForm::where('state',1)
                                ->where('edition_id',$edition_id)
                                ->where('condition','pending')
                                ->orderBy('id','DESC')
                                ->get();

        return response()->json([
            'entrepreneurships'=>$entrepreneurships
        ],200);
    }

    /**
     * Display a listing of the Convocation Form
     * where the condition is "pending"
     * @return \Illuminate\Http\Response
     */
    public function Rejected($edition_id){
        $entrepreneurships = ConvocationForm::where('state',1)
                                ->where('edition_id',$edition_id)
                                ->where('condition','rejected')
                                ->orderBy('id','DESC')
                                ->get();

        return response()->json([
            'entrepreneurships'=>$entrepreneurships
        ],200);
    }

    /**
     * Display a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $id_entrepreneurship)
    {
        $entrepreneurship = ConvocationForm::find($id_entrepreneurship);
        $entrepreneurship->user;
        $entrepreneurship->provincia;
        $entrepreneurship->localidad;
        $entrepreneurship->entrepreneurship_stadia;
        $entrepreneurship->development_degrees;
        $entrepreneurship->vertical_works;
        $entrepreneurship->idea_need;
        $entrepreneurship->curriculum_idea;

        foreach ($entrepreneurship->idea_need as $idea) {
            $idea->entrepreneurship_need;
        }
        
        return response()->json([
            'entrepreneurship'=>$entrepreneurship
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id, $id_entrepreneurship)
    {
        $convocation = ConvocationForm::find($id_entrepreneurship);

        $convocation->condition = $request->condition;

        if(!$convocation->save()){
            return response()->json(['error'],400);
        }

        if($convocation->condition=='accepted')
        {
            $this->createEntrepreneurship($convocation);
            $this->createWindow($convocation);
        }

        return response()->json([
            'convocation'=>$convocation
        ],200);
    }

     /**
     * Create entrepreneurship after accepted
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createEntrepreneurship($convocation)
    {
        $entrepreneurship = new Entrepreneurship();

        $entrepreneurship->title                            = $convocation->title;
        $entrepreneurship->executive_summary                = $convocation->executive_summary;
        $entrepreneurship->problem_detected                 = $convocation->problem_detected;
        $entrepreneurship->proposed_solution                = $convocation->proposed_solution;
        $entrepreneurship->products_services_you_offer      = $convocation->products_services_you_offer;
        $entrepreneurship->market                           = $convocation->market;
        $entrepreneurship->entrepreneurial_team             = $convocation->entrepreneurial_team;
        $entrepreneurship->action_plan                      = $convocation->action_plan;
        $entrepreneurship->entrepreneurship_stadia_id       = $convocation->entrepreneurship_stadia_id;
        $entrepreneurship->development_degrees_id           = $convocation->development_degrees_id;
        $entrepreneurship->vertical_works_id                = $convocation->vertical_works_id;

        $entrepreneurship_needs                             = $convocation->idea_need;
        $entrepreneurship->video                            = $convocation->video;
        $curriculum_idea                                    = $convocation->curriculum_idea;

        $entrepreneurship->provincia_id                     = $convocation->provincia_id;
        $entrepreneurship->localidad_id                     = $convocation->localidad_id;
        $entrepreneurship->user_id                          = $convocation->user_id;
        $entrepreneurship->edition_id                       = $convocation->edition_id;
        $entrepreneurship->convocation_form_id              = $convocation->id;
        $entrepreneurship->slug                             = Str::slug($convocation->title).'-'.time();
        $entrepreneurship->image                            = 5;
        $entrepreneurship->state                            = 1;

        if(!$entrepreneurship->save()){
            return response()->json(['error'],400);
        }

        foreach ($entrepreneurship_needs as $need) {
            $need_startup = new NeedStartup();
            $need_startup->entrepreneurship_id         = $entrepreneurship->id;
            $need_startup->entrepreneurship_need_id    = $need->entrepreneurship_need_id; 
            $need_startup->state                       = true;

            if(!$need_startup->save()){
                return response()->json(['error'],400);
            }
        }

        foreach ($curriculum_idea as $curriculum) {
            $cv = new CurriculumStartup();
            $cv->entrepreneurship_id    = $entrepreneurship->id;
            $cv->type                   = $curriculum->type;
            $cv->description            = $curriculum->description;

            if(!$cv->save()){
                return response()->json(['error'],400);
            }
        }

        return true;
    }

    /**
     * Create window after accepted
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createWindow($convocation)
    {
        $window                         = new EntrepreneurshipWindow();

        $window->title                  = $convocation->title;
        $window->executive_summary      = $convocation->executive_summary;
        $window->problem_detected       = $convocation->problem_detected;
        $window->proposed_solution      = $convocation->proposed_solution;
        $window->market                 = $convocation->market;
        $window->entrepreneurial_team   = $convocation->entrepreneurial_team;
        
        $window->degree_development     = 'MDN reformulado';

        $window->user_id                = $convocation->user_id;
        $window->edition_id             = $convocation->edition_id;
        $window->convocation_form_id    = $convocation->id;

        $window->slug                 = Str::slug($convocation->title);

        $window->published              = false;
        $window->state                  = 1;

        if(!$window->save()){
            return response()->json(['error'],400);
        }

        return true;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id, $id_entrepreneurship)
    {
        $entrepreneurship = ConvocationForm::find($id_entrepreneurship);
        $entrepreneurship->user;
        $entrepreneurship->provincia;
        $entrepreneurship->localidad;
        $entrepreneurship->entrepreneurship_stadia;
        $entrepreneurship->development_degrees;
        $entrepreneurship->vertical_works;
        $entrepreneurship->idea_need;
        $entrepreneurship->curriculum_idea;

        foreach ($entrepreneurship->idea_need as $idea) {
            $idea->entrepreneurship_need;
        }

        $team = EntrepreneurialProfile::where('convocation_form_id',$entrepreneurship->id)
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

        $pdf = PDF::loadView('pdf.myPDF', $data);

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF2($id, $id_entrepreneurship)
    {
        $entrepreneurship = ConvocationForm::find($id_entrepreneurship);
        $entrepreneurship->user;
        $entrepreneurship->provincia;
        $entrepreneurship->localidad;
        $entrepreneurship->entrepreneurship_stadia;
        $entrepreneurship->development_degrees;
        $entrepreneurship->vertical_works;
        $entrepreneurship->idea_need;
        $entrepreneurship->curriculum_idea;

        foreach ($entrepreneurship->idea_need as $idea) {
            $idea->entrepreneurship_need;
        }

        $team = EntrepreneurialProfile::where('convocation_form_id',$entrepreneurship->id)
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

        $pdf = PDF::loadView('pdf.myPDF', $data);

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
