<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\EntrepreneurshipInvitation;
use App\Models\EntrepreneurialProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Mail\InvitationMailable;
use Illuminate\Support\Facades\Mail;

class EntrepreneurialProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function EntrepreneurialProfiles($id)
    {
        $entrepreneurial_profile = [];

        $entrepreneurial_profiles = EntrepreneurialProfile::where('convocation_form_id',$id)
                                    ->get();
        
        return response()->json([
            'entrepreneurial_profiles'=>$entrepreneurial_profiles
        ],200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validated = $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'email|required|max:255',
        ]);

        $profile = EntrepreneurialProfile::where('email',$request->email)
                        //->where('convocation_form_id',$request->convocation_form_id)
                        ->get();

        // return response()->json(
        //         ['profile' => $profile,
        //         'is_empty' => $profile->isEmpty()]
        //         ,200);


        if(!$profile->isEmpty()){
            return response()->json(
                ['message' => 'El correo ya esta en uso en esta convocatoria. Revise las bases y condiciones.']
                ,400);
        }
        
        $entrepreneurial_profile = new EntrepreneurialProfile();

        $entrepreneurial_profile->name                  = $request->name;
        $entrepreneurial_profile->lastname              = $request->lastname;
        $entrepreneurial_profile->email                 = $request->email;
        $entrepreneurial_profile->convocation_form_id   = $request->convocation_form_id;

        $entrepreneurial_profile->gender_id             = '1';

        $entrepreneurial_profile->country               = 'argentina';
        $entrepreneurial_profile->provincia_id          = 1;
        $entrepreneurial_profile->localidad_id          = 1;
        $entrepreneurial_profile->legal_address         = '';

        $entrepreneurial_profile->completed_studie_id   = 1;
        $entrepreneurial_profile->university            = 'unl';
        $entrepreneurial_profile->academic_unit_id      = 1;
        $entrepreneurial_profile->career_id             = 1;
        $entrepreneurial_profile->posgrade              = 0; 

        $entrepreneurial_profile->occupation                = 'Empleado'; 
        $entrepreneurial_profile->researcher_workplace      = ''; 
        $entrepreneurial_profile->conicet                   = 'No'; 
        $entrepreneurial_profile->conicet_membership        = 'Becario'; 
        $entrepreneurial_profile->is_protectable            = false; 
        $entrepreneurial_profile->is_susceptible_protected  = false; 
        $entrepreneurial_profile->have_statement_results    = false; 

        $entrepreneurial_profile->status                = 0;
        $entrepreneurial_profile->state                 = 1;

        if(!$entrepreneurial_profile->save()){
            return response()->json(['error'],400);
        }

        $entrepreneurship_invitation                                = new EntrepreneurshipInvitation();
        $entrepreneurship_invitation->url                           = Str::random(128);
        $entrepreneurship_invitation->entrepreneurial_profile_id    = $entrepreneurial_profile->id;
        $entrepreneurship_invitation->state                         = 1;

        if(!$entrepreneurship_invitation->save()){
            return response()->json(['error'],400);
        }

        $this->sendInvitation(  $entrepreneurship_invitation,
                                $entrepreneurial_profile->name,
                                $entrepreneurial_profile->email);
        
        return response()->json([
            'entrepreneurial_profile'=>$entrepreneurial_profile
        ],200);
    }

    /**
     * Update the user auth profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user           = User::find($request->user_id);
        $user->name     = $request->name;
        $user->lastname = $request->lastname;
        $user->email    = $request->email;

        if(!$user->save()){
            return response()->json(['error'],400);
        }

        $entrepreneurial_profile = EntrepreneurialProfile::find($id);

        $entrepreneurial_profile->name                          = $request->name;
        $entrepreneurial_profile->lastname                      = $request->lastname;
        $entrepreneurial_profile->dni                           = $request->dni;
        $entrepreneurial_profile->gender_id                     = $request->gender_id;
        $entrepreneurial_profile->email                         = $request->email;
        $entrepreneurial_profile->phone_number                  = $request->phone_number;
        
        $entrepreneurial_profile->country                       = $request->country;
        $entrepreneurial_profile->other_country                 = $request->other_country;

        $entrepreneurial_profile->provincia_id                  = $request->provincia_id;
        $entrepreneurial_profile->localidad_id                  = $request->localidad_id;
        $entrepreneurial_profile->legal_address                 = $request->legal_address;

        $entrepreneurial_profile->completed_studie_id           = $request->completed_studie_id;
        $entrepreneurial_profile->secundary_tertiary_institute  = $request->secundary_tertiary_institute;
        $entrepreneurial_profile->secundary_tertiary_career     = $request->secundary_tertiary_career;
        
        $entrepreneurial_profile->university                    = $request->university;

        $entrepreneurial_profile->other_university              = $request->other_university;
        $entrepreneurial_profile->other_career                  = $request->other_career;

        $entrepreneurial_profile->academic_unit_id              = $request->academic_unit_id;
        $entrepreneurial_profile->career_id                     = $request->career_id;

        $entrepreneurial_profile->posgrade                      = $request->posgrade;
        $entrepreneurial_profile->posgrade_institute            = $request->posgrade_institute;
        $entrepreneurial_profile->posgrade_career               = $request->posgrade_career;

        $entrepreneurial_profile->occupation                    = $request->occupation;
        $entrepreneurial_profile->researcher_workplace          = $request->researcher_workplace;
        $entrepreneurial_profile->conicet                       = $request->conicet;
        $entrepreneurial_profile->conicet_membership            = $request->conicet_membership;
        $entrepreneurial_profile->is_protectable                = $request->is_protectable;
        $entrepreneurial_profile->is_susceptible_protected      = $request->is_susceptible_protected;
        $entrepreneurial_profile->have_statement_results        = $request->have_statement_results;

        $entrepreneurial_profile->previous_experience           = $request->previous_experience;

        $entrepreneurial_profile->linkedin                      = $request->linkedin;
        $entrepreneurial_profile->cv                            = $request->cv;
        
        $entrepreneurial_profile->status                        = 1;

        if(!$entrepreneurial_profile->save()){
            return response()->json(['error'],400);
        }
        
        return response()->json([
            'entrepreneurial_profile'=>$entrepreneurial_profile
        ],200); 

    }

    /**
     * Display a specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($convocation_form_id, $id = NULL)
    {
        $entrepreneurial_profile = [];
        if($id==-1){
            $entrepreneurial_profile = EntrepreneurialProfile::where('user_id',Auth::id())
                                        ->where('convocation_form_id',$convocation_form_id)
                                        ->first();
        }else{
            $entrepreneurial_profile = EntrepreneurialProfile::where('id',$id)
                                        ->where('convocation_form_id',$convocation_form_id)
                                        ->first();
        }

        if(!$entrepreneurial_profile){
            return response()->json(['error'],400);
        }

        $entrepreneurial_profile->provincia;
        $entrepreneurial_profile->localidad;
        $entrepreneurial_profile->completed_studie;
        $entrepreneurial_profile->academic_unit;
        $entrepreneurial_profile->career;
        $entrepreneurial_profile->gender;
        
        return response()->json([
            'entrepreneurial_profile'=>$entrepreneurial_profile
        ],200);
    }

    /**
     * Display a specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($convocation_form_id, $id)
    {
        $entrepreneurial_profile = EntrepreneurialProfile::where('id',$id)
                                    ->where('convocation_form_id',$convocation_form_id)
                                    ->first();

        if(!$entrepreneurial_profile->delete()){
            return response()->json(['error'],400);
        }

        // $entrepreneurial_profile = EntrepreneurialProfile::where('id',$id)
        //                             ->where('convocation_form_id',$convocation_form_id)
        //                             ->get();
        
        // if(count($entrepreneurial_profile)==1){
        //     if(!$entrepreneurial_profile->delete()){
        //         return response()->json(['error'],400);
        //     }
        // }

        return response()->json([
            'entrepreneurial_profile'=>$entrepreneurial_profile
        ],200);
    }

    /**
     * Send invitation when entrepreneurship invitation 
     * is created.
     * 
     * @return \Illuminate\Http\Response
     */
    public function sendInvitation( $invitation , $name, $to){
        $base_url = env('APP_URL_VUE');
        $url = $base_url.'invitation/'.$invitation->url;
        // $url = 'http://192.168.80.13/invitation/'.$invitation->url;

        $correo = new InvitationMailable($name, $url);
        Mail::to($to)->send($correo);
    }
    
    public function sendInvitationMail($to, $url){
        $correo = new InvitationMailable();
        Mail::to($to)->send($correo);
    }
}
