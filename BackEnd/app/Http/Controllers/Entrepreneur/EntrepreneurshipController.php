<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entrepreneurship;
use Illuminate\Support\Facades\Auth;
use App\Models\NeedStartup;
use App\Models\CurriculumStartup;

class EntrepreneurshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrepreneurship = Entrepreneurship::where('user_id', Auth::id())->first();

        if(!$entrepreneurship){
            return response()->json(['error'],400);
        }

        return response()->json([
            'entrepreneurship'=>$entrepreneurship
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
        $entrepreneurship = Entrepreneurship::where('convocation_form_id', $id)->first();

        $entrepreneurship->user;
        $entrepreneurship->provincia;
        $entrepreneurship->localidad;
        $entrepreneurship->vertical_works;
        $entrepreneurship->entrepreneurship_stadia;
        $entrepreneurship->development_degrees;
        $entrepreneurship->need_startup;
        $entrepreneurship->curriculum;

        foreach ($entrepreneurship->need_startup as $idea) {
            $idea->entrepreneurship_need;
        }

        if(!$entrepreneurship){
            return response()->json(['error'],400);
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
    public function update(Request $request, $id)
    {
        $entrepreneurship = Entrepreneurship::find($id);

        $entrepreneurship->title                        = $request->title;
        $entrepreneurship->executive_summary            = $request->executive_summary;
        $entrepreneurship->problem_detected             = $request->problem_detected;
        $entrepreneurship->proposed_solution            = $request->proposed_solution;
        $entrepreneurship->products_services_you_offer  = $request->products_services_you_offer;
        $entrepreneurship->market                       = $request->market;
        $entrepreneurship->entrepreneurial_team         = $request->entrepreneurial_team;
        $entrepreneurship->action_plan                  = $request->action_plan;

        $entrepreneurship->vertical_works_id            = $request->vertical_works_id;

        $entrepreneurship->entrepreneurship_stadia_id   = $request->entrepreneurship_stadia_id;
        $entrepreneurship->development_degrees_id       = $request->development_degrees_id;

        $entrepreneurship_needs                         = $request->entrepreneurship_needs;
        $entrepreneurship->video                        = $request->video;
        $curriculum                             = $request->curriculum;

        $entrepreneurship->provincia_id                 = $request->provincia_id;
        $entrepreneurship->localidad_id                 = $request->localidad_id;

        if(!$entrepreneurship->save()){
            return response()->json(['error'],400);
        }

        $need_delete = NeedStartup::where('entrepreneurship_id',$id)->delete();

        foreach ($entrepreneurship_needs as $need) {
            $idea_need                              = new NeedStartup();
            $idea_need->entrepreneurship_id         = $entrepreneurship->id;
            $idea_need->entrepreneurship_need_id    = $need;
            $idea_need->state                       = true;

            if(!$idea_need->save()){
                return response()->json(['error'],400);
            }
        }

        $curriculum_delete = CurriculumStartup::where('entrepreneurship_id', $id)->delete();

        foreach ($curriculum as $curri) {
            $cv                         = new CurriculumStartup();
            $cv->entrepreneurship_id    = $id;
            $cv->type                   = $curri['type'];
            $cv->description            = $curri['description'];

            if(!$cv->save()){
                return response()->json(['error'],400);
            }
        }

        return response()->json([
            'entrepreneurship'=>$entrepreneurship
        ],200);
    }
}