<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\EntrepreneurshipInvitation;
use App\Models\EntrepreneurialProfile;

class InvitationController extends Controller
{
    /**
     * Display info from invitation
     *
     * @return \Illuminate\Http\Response
     */
    public function invitation($url)
    {
        $invitation= EntrepreneurshipInvitation::where('url',$url)->firstOrFail();

        $invitation->entrepreneurial_profile;

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
        $invitation= EntrepreneurshipInvitation::where('url',$url)->firstOrFail();

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

        $profile = EntrepreneurialProfile::find($invitation->entrepreneurial_profile_id);
        $profile->name                          = $request->name;
        $profile->lastname                      = $request->lastname;
        $profile->phone_number                  = '';
        
        $profile->email                         = $request->email;
        $profile->user_id                       = $user->id;

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
        $profile->save();

        //Elimino la invitacion
        $invitation->delete();

        return response()->json([
            'user'=>$user
        ],200);
    }
}
