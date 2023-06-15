<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\InvitationEntrepreneurship;
use App\Models\ConvocationForm;
use App\Models\User;
use App\Models\Provincia;
use App\Models\EntrepreneurialProfile;
use App\Models\IdeaNeed;
use App\Models\CurriculumIdea;

class InvitationEntrepreneurshipController extends Controller
{
    /**
     * Display info from invitation
     *
     * @return \Illuminate\Http\Response
     */
    public function invitation($url)
    {
        $invitation= InvitationEntrepreneurship::where('url',$url)->firstOrFail();

        return response()->json([
            'invitation'=>$invitation
        ],200);
    }

    /**
     * Display info from invitation
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, $url)
    {

        $request->validate([
                'title' => 'required',
                'executive_summary' => 'required|max:300',
                'problem_detected' => 'required|max:1500',
                'proposed_solution' => 'required|max:1500',
                'products_services_you_offer' => 'required|max:1500',
                'market' => 'required|max:2000',
                'entrepreneurial_team' => 'required|max:1500',
                'action_plan' => 'required|max:1500',

                'vertical_works_id' => 'required',
                'entrepreneurship_stadia_id' => 'required',
                'development_degrees_id' => 'required',
                'video' => 'max:250',
                'provincia_id' => 'required',
                'localidad_id' => 'required',

                'name' => 'required|min:3|max:50',
                'lastname' => 'required|min:3|max:50',
                'email' => 'required|email',
                'password' => 'required'
        ]);

        $invitation= InvitationEntrepreneurship::where('url',$url)->firstOrFail();

        $user = User::where('email', $request->email)->first();

        if(!$user){
            $user = User::create([
                'name'=> $request->name,
                'lastname'=>$request->lastname,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
        }
        
        $user->assignRole('entrepreneur');

        $roles = $user->getRoleNames();
        
        $token = $user->createToken('auth_token')->plainTextToken;

        //-------------------------------------------------------//

        $convocation = new ConvocationForm();

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
        $convocation->edition_id                    = $invitation->edition_id;
        $convocation->condition                     = 'pending';
        $convocation->user_id                       = $user->id;
        $convocation->is_sent                       = false;
        $convocation->state                         = 1;

        if(!$convocation->save()){
            return response()->json(['error'],400);
        }

        foreach ($entrepreneurship_needs as $need) {
            $idea_need = new IdeaNeed();
            $idea_need->convocation_form_id         = $convocation->id;
            $idea_need->entrepreneurship_need_id    = $need;
            $idea_need->state                       = true;

            if(!$idea_need->save()){
                return response()->json(['error'],400);
            }
        }

        foreach ($curriculum_idea as $curriculum) {
            $cv                         = new CurriculumIdea();
            $cv->convocation_form_id    = $convocation->id;
            $cv->type                   = $curriculum['type'];
            $cv->description            = $curriculum['description'];

            if(!$cv->save()){
                return response()->json(['error'],400);
            }
        }

        //------------------------------------------------------------------

        $profile                                = new EntrepreneurialProfile();
        $profile->name                          = $request->name;
        $profile->lastname                      = $request->lastname;
        $profile->phone_number                  = '';
        
        $profile->email                         = $request->email;
        $profile->user_id                       = $user->id;
        $profile->convocation_form_id           = $convocation->id;

        $profile->gender_id                     = '1';

        $profile->country                       = 'argentina';
        $profile->other_country                 = null;
        $profile->provincia_id                  = 1;
        $profile->localidad_id                  = 1;

        $profile->completed_studie_id           = 1;
        $profile->secundary_tertiary_institute  = null;
        $profile->secundary_tertiary_career     = null;

        $profile->university                    = 'unl';
        $profile->academic_unit_id              = 1;
        $profile->career_id                     = 1;

        $profile->other_university              = null;
        $profile->other_career                  = null;

        $profile->posgrade                      = false;
        $profile->posgrade_institute            = null;
        $profile->posgrade_career               = null;

        $profile->occupation                    = 'Empleado'; 
        $profile->researcher_workplace          = ''; 
        $profile->conicet                       = 'No'; 
        $profile->conicet_membership            = 'Becario'; 
        $profile->is_protectable                = false; 
        $profile->is_susceptible_protected      = false; 
        $profile->have_statement_results        = false; 

        $profile->previous_experience           = null;

        $profile->linkedin                      = null;

        $profile->status                        = false;
        $profile->state                         = 1;

        //Guardo el perfil
        if(!$profile->save()){
            return response()->json(['error'],400);
        }

        $invitation->delete();

        return response()->json([
            'user'=>$user
        ],200);
    }
}
