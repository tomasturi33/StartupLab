<?php
/*
namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\User;
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\ConvocationForm;
use App\Models\EntrepreneurialProfile;
use App\Mail\PasswordRecoveyMailable;
use App\Models\PasswordRecovery;

class AuthController extends Controller
{
    public function index()
    {
        return response()->json([
            'hello'=>'hola mundo'
        ],500);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'credentials' => 'Invalid username or password'
            ]);
        }

        //$convocation_form = $user->convocation_forms;

        // get the names of the user's roles
        $roles = $user->getRoleNames(); // Returns a collection
    
        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'access_token'=>$token,
            'type_token'=>'Bearer',
            'user_id'=>$user['id'],
            'name'=>$user['name'],
            'lastname'=>$user['lastname'],
            'roles'=>$roles
        ],200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'lastname'=> 'required|string|max:255',
            'email'=> 'required|string|email|max:255',
            'password'=> 'required|string|min:5|max:255',
            'edition_id'=>'required'
        ]);

        $user = User::where('email', strtolower($request->email) )->first();

        if(!$user){
            $user = new User();
            $user->name         = $request->name;
            $user->lastname     = $request->lastname;
            $user->email        = strtolower($request->email);
            $user->password     = Hash::make($request->password);   
        }

        if(!$user->save()){
            return response()->json(['error'],400);
        }

        $user->assignRole('entrepreneur');
        
        $roles = $user->getRoleNames(); // Returns a collection
        
        $token = $user->createToken('auth_token')->plainTextToken;

        /* Creo una combocatoria asociandola al usuario y a la edicion */
        $convocation = new ConvocationForm();
        
        $convocation->edition_id                    = $request->edition_id;
        $convocation->entrepreneurship_stadia_id    = 1;
        $convocation->development_degrees_id        = 1;
        $convocation->provincia_id                  = 22;
        $convocation->localidad_id                  = 1885;
        $convocation->condition                     = 'empty';
        $convocation->user_id                       = $user->id;
        $convocation->vertical_works_id             = 1;
        $convocation->state                         = 1;
        $convocation->is_sent                       = 0;

        if(!$convocation->save()){
            $user->delete();
            return response()->json(['error'],400);
        }

        $profile                                = new EntrepreneurialProfile();
        $profile->name                          = $request->name;
        $profile->lastname                      = $request->lastname;
        $profile->email                         = $request->email;
        $profile->dni                           = '';
        $profile->gender_id                     = '1';
        $profile->user_id                       = $user->id;
        $profile->convocation_form_id           = $convocation->id;
        
        $profile->country                       = 'argentina';
        $profile->provincia_id                  = 1;
        $profile->localidad_id                  = 1;

        $profile->completed_studie_id           = 1;
        $profile->secundary_tertiary_institute  = '';
        $profile->secundary_tertiary_career     = '';

        $profile->university                    = 'unl';
        $profile->academic_unit_id              = 1;
        $profile->career_id                     = 1;

        $profile->posgrade                      = false;
        $profile->posgrade_institute            = '';
        $profile->posgrade_career               = '';

        $profile->occupation                    = 'Empleado'; 
        $profile->researcher_workplace          = ''; 
        $profile->conicet                       = 'No'; 
        $profile->conicet_membership            = 'Becario'; 
        $profile->is_protectable                = false; 
        $profile->is_susceptible_protected      = false; 
        $profile->have_statement_results        = false; 

        $profile->status                        = false;
        $profile->state                         = 1;

        if(!$profile->save()){
            $user->delete();
            $convocation->delete();
            return response()->json(['error'],400);
        }

        return response()->json([
            'access_token'=>$token,
            'type_token'=>'Bearer',
            'user_id'=>$user['id'],
            'name'=>$user['name'],
            'lastname'=>$user['lastname'],
            'state_convocation_form'=>'empty',
            'roles'=>$roles
        ],200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'msg'=>'Token deleted'
        ],200);
    }

    public function passwordRecovery(Request $request)
    {
        $validatedData = $request->validate([
            'email'=>'required|string|email|max:255',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return response()->json(['error'=>'El correo electrónico no se encuentra registrado'],400);
        }

        $res = PasswordRecovery::where('user_id',$user->id)->delete();

        $password_recovery          = new PasswordRecovery();
        $password_recovery->url     = Str::random(128);
        $password_recovery->user_id = $user->id;

        if(!$password_recovery->save()){
            return response()->json(['error'=>'No se logro registrar la solicitud de reseteo de password,  por favor intente mas tarde.'],400);
        }

        $this->sendInvitation(  $password_recovery->url,
                                $user->name,
                                $user->email);

        return response()->json([
            'message'=>'Se ha enviado un correo electrónico para continuar con el proceso de recuperación de contraseña.'
        ],200);
    }

    public function passwordReset(Request $request, $url)
    {
        $recovery = PasswordRecovery::where('url', $request->url)->first();

        if(!$recovery)
        {
            return response()->json([
                'error'=>'La solicitud no se encuentra disponible'
            ],400);
        }

        $validatedData = $request->validate([
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        if($validatedData['password'] != $validatedData['confirm_password'])
        {
            return response()->json([
                'error'=>'La contraseña no es valida'
            ],400);
        }

        $user = User::find($recovery->user_id);

        $user->password = Hash::make($validatedData['password']);

        if(!$user->save())
        {
            return response()->json([
                'error'=>'No se pudo actualizar la contraseña, intente mas tarde.'
            ],400);
        }

        $res = PasswordRecovery::where('user_id',$user->id)->delete();

        return response()->json([
            'message'=>'Se ha actualizado la contraseña con exíto.'
        ],200);
    }

    /**
     * Send email to recovery password user
     * 
     * @return \Illuminate\Http\Response
     */
    public function sendInvitation( $url , $name, $to)
    {
        $base_url = env('APP_URL_VUE');
        $url = $base_url.'password-recovery/'.$url;

        $correo = new PasswordRecoveyMailable($name, $url);
        Mail::to($to)->send($correo);
    }
}