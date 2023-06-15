<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::select('id','name', 'lastname', 'email')
                ->where('id',Auth::id())
                ->first();
                
        $user->getRoleNames();

        return response()->json([
            'user'=>$user
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::select('id','name', 'lastname', 'email')
                ->where('id',Auth::id())
                ->first();
                
        $user->getRoleNames();

        return response()->json([
            'user'=>$user
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
        $request->validate([
                'name' => 'required|min:3|max:50',
                'lastname' => 'required|min:3|max:50',
                'email' => 'required|email',
                'change_password' => 'required',
        ]);

        if($request->change_password){
            $request->validate([
                    'password' => 'min:6|max:50|required_with:confirm_password|same:confirm_password'
            ]);
        }

        $cheak_mail = User::where('email',$request->email)->first();

        if($cheak_mail){
            if($cheak_mail->id != Auth::id()){
                throw ValidationException::withMessages([
                    'email' => 'El correo electrónico que intenta cambiar ya se encuentra en uso.'
                ]);
            }
        }


        $user = User::find(Auth::id());

        $user->name     = $request->name;
        $user->lastname = $request->lastname;
        $user->email    = $request->email;
        
        if($request->change_password){
            $user->password = Hash::make($request->password);
        }

        if(!$user->save()){
            return response()->json(['error'],400);
        }
        
        return response()->json([
            'user'=>$user
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
