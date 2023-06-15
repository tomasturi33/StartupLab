<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EntrepreneurshipAssignedToTutor;
use App\Models\Edition;
use App\Models\Entrepreneurship;

class TutorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tutors = User::select('id','name', 'lastname', 'email')
                    ->whereHas("roles", function($q){ $q->where("name", 'tutor'); })
                    ->orderBy('id','DESC')
                    ->get();

        foreach ($tutors as $tutor) {
            $tutor->getRoleNames();
        }

        return response()->json([
            'data'=>$tutors
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
        $tutor = User::find($id);

        $entrepreneurships_assigned = $tutor->entrepreneurship_assigned_to_tutor;

        foreach ($entrepreneurships_assigned as $entrepreneurship) {

            $entrepreneurship->entrepreneurship['title'];
        }

        $editions = Edition::select('id', 'name')->get();

        if(!$tutor || !$editions){
            return response()->json(['error'],400);
        }

        return response()->json([
            'data'=>compact('tutor', 'editions')
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
        $entrepreneurship_assigned = new EntrepreneurshipAssignedToTutor();

        $entrepreneurship_assigned->entrep_id       = $request->entrepreneurship_id;
        $entrepreneurship_assigned->edition_id      = $request->edition_id;
        $entrepreneurship_assigned->user_id         = $request->user_id;

        if(!$entrepreneurship_assigned->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'entrepreneurship_assigned'=>$entrepreneurship_assigned
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $user_id)
    {
        $entrepreneurship_assigned = EntrepreneurshipAssignedToTutor::where('user_id', $user_id)
                                    ->where('entrep_id', $id)
                                    ->first();

        if(!$entrepreneurship_assigned->delete()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'entrepreneurship_assigned'=>$entrepreneurship_assigned
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modulesAssingned($user_id, $edition_id)
    {
        $entrepreneurships = Entrepreneurship::where('edition_id',$edition_id)->get();

        $entrepreneurships_assigned = [];

        foreach ($entrepreneurships as $m) {
            $entrepreneurships_assigned[] = [
                    'id'            => $m->id,
                    'user_id'       => $user_id,
                    'name'          => $m->title,
                    'is_assigned'   => $this->findModule($user_id, $m->id)
                ];
        }

        if(!$entrepreneurships){
            return response()->json(['error'],400);
        }

        return response()->json([
            'data'=>compact('entrepreneurships_assigned')
        ],200);
    }

    /**
     * Find if a specific user has an associated module
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findModule($user_id ,$entrep_id){
        $found =  EntrepreneurshipAssignedToTutor::where('user_id',$user_id)
                        ->where('entrep_id', $entrep_id)
                        ->first();

        if($found)
            return true;
        return false;
    }
}
