<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EntrepreneurshipNeed;

class EntrepreneurshipNeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrepreneurship_needs = EntrepreneurshipNeed::select('id','name')
                        ->where('state',1)
                        ->orderBy('id', 'DESC')
                        ->get();

        return response()->json([
            'entrepreneurship_needs'=>$entrepreneurship_needs
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
        $entrepreneurship_need = new EntrepreneurshipNeed();
        $entrepreneurship_need->name = $request->name;
        $entrepreneurship_need->state=1;

        if(!$entrepreneurship_need->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'entrepreneurship_need'=>$entrepreneurship_need
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
        $entrepreneurship_need = EntrepreneurshipNeed::find($id);

        return response()->json([
            'entrepreneurship_need'=>$entrepreneurship_need
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
        $entrepreneurship_need = EntrepreneurshipNeed::find($id);
        $entrepreneurship_need->name = $request->name;

        if(!$entrepreneurship_need->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'entrepreneurship_need'=>$entrepreneurship_need
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
        $entrepreneurship_need = EntrepreneurshipNeed::find($id);
        $entrepreneurship_need->state = 0;

        if(!$entrepreneurship_need->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'entrepreneurship_need'=>$entrepreneurship_need
        ],200);
    }
}
