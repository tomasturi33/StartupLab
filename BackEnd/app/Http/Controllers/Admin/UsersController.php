<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select('id','name', 'lastname', 'email')
                    ->orWhereHas("roles", function($q){ $q->where('name','!=','entrepreneur'); })
                    ->orderBy('id','DESC')
                    ->get();

        foreach ($users as $user) {
            $user->getRoleNames();
        }

        return response()->json([
            'users'=>$users
        ],200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AdminUsers()
    {
        $users = User::select('id','name', 'lastname', 'email')
                    ->whereHas("roles", function($q){ $q->where("name", 'admin'); })
                    ->orderBy('id','DESC')
                    ->get();

        foreach ($users as $user) {
            $user->getRoleNames();
        }

        return response()->json([
            'users'=>$users
        ],200);
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function EvaluatorUsers()
    {
        $users = User::select('id','name', 'lastname', 'email')
                    ->whereHas("roles", function($q){ $q->where("name", 'evaluator'); })
                    ->orderBy('id','DESC')
                    ->get();

        foreach ($users as $user) {
            $user->getRoleNames();
        }

        return response()->json([
            'users'=>$users
        ],200);
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function TutorUsers()
    {
        $users = User::select('id','name', 'lastname', 'email')
                    ->whereHas("roles", function($q){ $q->where("name", 'tutor'); })
                    ->orderBy('id','DESC')
                    ->get();

        foreach ($users as $user) {
            $user->getRoleNames();
        }

        return response()->json([
            'users'=>$users
        ],200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function EntrepreneurUsers()
    {
        $users = User::select('id','name', 'lastname', 'email')
                    ->whereHas("roles", function($q){ $q->where("name", 'admin'); })
                    ->orderBy('id','DESC')
                    ->get();

        foreach ($users as $user) {
            $user->getRoleNames();
        }

        return response()->json([
            'users'=>$users
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
        $validatedData = $request->validate([
            'name'=> 'required|string|max:255',
            'lastname'=>'required|string|max:255',
            'email'=>'required|string|email|max:255'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            $user = User::create([
                'name'=> $validatedData['name'],
                'lastname'=>$validatedData['lastname'],
                'email'=>$request->email,
                'password'=>Hash::make('UNLPotencia')
            ]);
        }

        if($request->evaluator_role){
            $user->assignRole('evaluator');
        }

        if($request->admin_role){
            $user->assignRole('admin');
        }
        
        if($request->tutor_role){
            $user->assignRole('tutor');
        }

        return response()->json([
            'user'=>$user
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
        $user = User::find($id);

        $user->admin_role = false;
        if($user->hasRole('admin')){
            $user->admin_role = true;
        }

        $user->evaluator_role = false;
        if($user->hasRole('evaluator')){
            $user->evaluator_role = true;
        }

        $user->tutor_role = false;
        if($user->hasRole('tutor')){
            $user->tutor_role = true;
        }

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
        $validatedData = $request->validate([
            'name'=> 'required|string|max:255',
            'lastname'=>'required|string|max:255',
            'email'=>'required|string|email|max:255'
        ]);

        $user = User::find($id);

        $user->name         = $validatedData['name'];
        $user->lastname     = $validatedData['lastname'];
        $user->email        = $validatedData['email'];


        if($request->evaluator_role){
            $user->assignRole('evaluator');
        }else{
            $user->removeRole('evaluator');
        }

        if($request->admin_role){
            $user->assignRole('admin');
        }else{
            $user->removeRole('admin');
        }

        if($request->tutor_role){
            $user->assignRole('tutor');
        }else{
            $user->removeRole('tutor');
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
        $user = User::find($id);
        $user->removeRole('admin');
        $user->removeRole('evaluator');
        $user->removeRole('tutor');

        if(!$user->hasRole('entrepreneur')){
            if(!$user->delete()){
                return response()->json(['error'],400);
            }
        }

        return response()->json([
            'user'=>$user
        ],200);
    }
}
