<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ConvocationForm;
use App\Models\User;
use App\Models\Provincia;
use App\Models\EntrepreneurialProfile;
use App\Models\IdeaNeed;
use App\Models\CurriculumIdea;

class ConvocationFormController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrepreneurial_profiles = EntrepreneurialProfile::where('user_id',Auth::id())
                                    ->where('state',1)
                                    ->get();

        $convocation_forms = [];
        foreach ($entrepreneurial_profiles as $profile) {
            $cf = ConvocationForm::where('id', $profile->convocation_form_id)->first();
            if($cf){
                $convocation_forms[] = $cf;
            }
        }
        
        return response()->json([
            'convocation_forms'=>$convocation_forms
        ],200);
    }

    /**
     * Displays the status of the user convocation
     * 
     * 
     * @return \Illuminate\Http\Response convocation's status
     */
    public function checkStatus($id)
    {
        $state_convocation_form = ConvocationForm::select('condition')
                                    ->where('id', $id)
                                    ->first();

        return response()->json([
            'status'=> (!is_null($state_convocation_form)?$state_convocation_form['condition']:'empty')
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $convocation = new ConvocationForm();

        $convocation->title                         = $request->title;
        $convocation->executive_summary             = $request->executive_summary;
        $convocation->problem_detected              = $request->problem_detected;
        $convocation->proposed_solution             = $request->proposed_solution;
        $convocation->products_services_you_offer   = $request->products_services_you_offer;
        $convocation->market                        = $request->market;
        $convocation->action_plan                   = $request->action_plan;
        $convocation->vertical_works_id             = $request->vertical_works_id;

        $entrepreneurship_needs                     = $request->entrepreneurship_needs;
        $convocation->video                         = $request->video;
        $curriculum_idea                            = $request->curriculum_idea;

        $convocation->entrepreneurship_stadium_id   = $request->entrepreneurship_stadium_id;
        $convocation->development_degrees_id        = $request->development_degrees_id;
        $convocation->provincia_id                  = $request->provincia_id;
        $convocation->localidad_id                  = $request->localidad_id;
        $convocation->condition                     = 'in_progress';
        $convocation->user_id                       = Auth::id();
        $convocation->is_sent                       = false;
        $convocation->state                         = 1;

        if(!$convocation->save()){
            return response()->json(['error'],400);
        }

        $need_delete = IdeaNeed::where('convocation_form_id',$id)->delete();
        
        foreach ($entrepreneurship_needs as $need) {
            $idea_need = new IdeaNeed();
            $idea_need->convocation_form_id         = $convocation->id;
            $idea_need->entrepreneurship_need_id    = $need;
            $idea_need->state                       = true;

            if(!$idea_need->save()){
                return response()->json(['error'],400);
            }
        }

        $curriculum_delete = CurriculumIdea::where('convocation_form_id', $id)->delete();

        foreach ($curriculum_idea as $curriculum) {
            $cv = new CurriculumIdea();
            $cv->convocation_form_id    = $id;
            $cv->type                   = $curriculum['type'];
            $cv->description            = $curriculum['description'];

            if(!$cv->save()){
                return response()->json(['error'],400);
            }
        }

        return response()->json([
            'convocation'=>$convocation
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $convocation = ConvocationForm::find($id);

        $convocation->title                         = $request->title;
        $convocation->executive_summary             = $request->executive_summary;
        $convocation->problem_detected              = $request->problem_detected;
        $convocation->proposed_solution             = $request->proposed_solution;
        $convocation->products_services_you_offer   = $request->products_services_you_offer;
        $convocation->market                        = $request->market;
        $convocation->entrepreneurial_team          = $request->entrepreneurial_team;
        $convocation->action_plan                   = $request->action_plan;

        $convocation->vertical_works_id             = $request->vertical_works_id; 

        $entrepreneurship_needs                     = $request->entrepreneurship_needs;
        $convocation->video                         = $request->video;
        $curriculum_idea                            = $request->curriculum_idea;

        $convocation->entrepreneurship_stadia_id    = $request->entrepreneurship_stadia_id;
        $convocation->development_degrees_id        = $request->development_degrees_id;
        $convocation->provincia_id                  = $request->provincia_id;
        $convocation->localidad_id                  = $request->localidad_id;
        $convocation->condition                     = 'in_progress';

        if(!$convocation->save()){
            return response()->json(['error'],400);
        }

        $need_delete = IdeaNeed::where('convocation_form_id',$id)->delete();

        foreach ($entrepreneurship_needs as $need) {
            $idea_need = new IdeaNeed();
            $idea_need->convocation_form_id         = $convocation->id;
            $idea_need->entrepreneurship_need_id    = $need;
            $idea_need->state                       = true;

            if(!$idea_need->save()){
                return response()->json(['error'],400);
            }
        }

        $curriculum_delete = CurriculumIdea::where('convocation_form_id', $id)->delete();

        foreach ($curriculum_idea as $curriculum) {
            $cv = new CurriculumIdea();
            $cv->convocation_form_id    = $id;
            $cv->type                   = $curriculum['type'];
            $cv->description            = $curriculum['description'];

            if(!$cv->save()){
                return response()->json(['error'],400);
            }
        }

        return response()->json([
            'convocation'=>$convocation
        ],200);
    }

    public function changeStatusToPending($id)
    {
        $convocation = ConvocationForm::find($id);

        $convocation->condition = 'pending';

        if(!$convocation->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'convocation'=>$convocation
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
        $convocation =  ConvocationForm::find($id);

        $convocation->user;
        $convocation->provincia;
        $convocation->localidad;
        $convocation->vertical_works;
        $convocation->entrepreneurship_stadia;
        $convocation->development_degrees;
        $convocation->idea_need;
        $convocation->curriculum_idea;

        foreach ($convocation->idea_need as $idea) {
            $idea->entrepreneurship_need;
        }

        return response()->json([
            'convocation'=>$convocation
        ],200);
    }
}
