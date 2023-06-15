<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ModulePreIncubation;

class ModulePreIncubationController extends Controller
{
    /**
     * Change the order of the modules
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function moveUp(Request $request, $id)
    {
        $module_up = ModulePreIncubation::find($id);

        if($module_up->order>1){
            $module_down = ModulePreIncubation::where('edition_id',$module_up->edition_id)
                            ->where('order',$module_up->order-1)->first();

            $module_up->order -= 1;
            $module_up->save();

            $module_down->order += 1;
            $module_down->save();
        }
        
        return response()->json([
            'module'=>$module_up
        ],200);
    }

    /**
     * Change the order of the modules
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function moveDown(Request $request, $id)
    {
        $module_down = ModulePreIncubation::find($id);

        //busco la edicion que tenga el orden maximo, para guardar una contigua
        $maxOrder = ModulePreIncubation::where('edition_id', $module_down->edition_id )->max('order');

        if($module_down->order < $maxOrder){

            $module_up = ModulePreIncubation::where('edition_id',$module_down->edition_id)
                            ->where('order',$module_down->order+1)
                            ->first();

            $module_down->order += 1;
            $module_down->save();

            $module_up->order -= 1;
            $module_up->save();
        }
        
        return response()->json([
            'module'=>$module_down
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
        $request->validate([
            'name' => 'required|string|max:256',
            'description' => 'required|string',
            'require_activity' => 'required',
        ]);

        //busco la edicion que tenga el orden maximo, para guardar una contigua
        $maxOrder = ModulePreIncubation::where('edition_id', $request->edition_id )->max('order');

        $module = new ModulePreIncubation();

        $module->order = $maxOrder+1;
        $module->edition_id = $request->edition_id;
        $module->name = $request->name;
        $module->description = $request->description;
        $module->require_activity = $request->require_activity;
        $module->activity_statement = $request->activity_statement;
        $module->slug = Str::slug($request->name).'-'.time();
        $module->state = 1;

        if(!$module->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'module'=>$module
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
        $module = ModulePreIncubation::find($id);
        
        return response()->json(compact('module'),200);
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
            'name' => 'required|string|max:256',
            'description' => 'required|string',
            'require_activity' => 'required'
        ]);

        $module = ModulePreIncubation::find($id);
        $module->name = $request->name;
        $module->description = $request->description;
        $module->require_activity = $request->require_activity;
        $module->activity_statement = $request->activity_statement;
        $module->slug = Str::slug($request->name).'-'.time();
        
        if(!$module->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'module'=>$module
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
        $module = ModulePreIncubation::find($id);

        $modules = ModulePreIncubation::where('edition_id',$module->edition_id)
                        ->where('order','>',$module->order)
                        ->get();

        foreach ($modules as $m) {
            $m->order = $m->order-1;
            $m->save();
        }


        if(!$module->delete()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'module'=>$module
        ],200);
    }
}
