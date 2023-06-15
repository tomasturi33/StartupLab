<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\EntrepreneurshipNotes;

class EntrepreneurshipNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($entrepreneurship_id)
    {
        $notes = EntrepreneurshipNotes::where('entrepreneurship_id',$entrepreneurship_id)
                        ->orderBy('id','DESC')
                        ->get();

        foreach ($notes as $n) {
            $n->user;
            $n->date =  $n->created_at->day.'/'.$n->created_at->month.'/'.$n->created_at->year;
            $n->hour =  $n->created_at->hour.':'. (($n->created_at->minute<10)?('0'.$n->created_at->minute):$n->created_at->minute );
               
        }

        return response()->json([
            'data'=>compact('notes')
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
        $note = new EntrepreneurshipNotes();
        $note->note                 = $request->note;
        $note->entrepreneurship_id  = $request->entrepreneurship_id;
        $note->user_id              = Auth::id();

        if(!$note->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'note'=>$note
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
        $note = EntrepreneurshipNotes::find($id);
        
        if(!$note->delete()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'note'=>$note
        ],200);
        
    }
}
