<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VerticalWorks;

class VerticalWorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vertical_works = VerticalWorks::select('id','name')
                        ->where('state',1)
                        ->orderBy('id', 'DESC')
                        ->get();

        return response()->json([
            'vertical_works'=>$vertical_works
        ],200);
    }

    /**
     * Display an specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vertical_work = VerticalWorks::find($id);

        return response()->json([
            'vertical_work'=>$vertical_work
        ],200);
    }

    /**
     * Create an specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vertical_work = new VerticalWorks();
        $vertical_work->name = $request->name;
        $vertical_work->state=1;

        if(!$vertical_work->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'vertical_work'=>$vertical_work
        ],200);
    }

    /**
     * Update an specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vertical_work = VerticalWorks::find($id);
        $vertical_work->name = $request->name;

        if(!$vertical_work->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'vertical_work'=>$vertical_work
        ],200);
    }

    /**
     * Delete an specific resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vertical_work = VerticalWorks::find($id);
        $vertical_work->state = 0;

        if(!$vertical_work->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'vertical_work'=>$vertical_work
        ],200);
    }
}
