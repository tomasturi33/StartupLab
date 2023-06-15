<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Entrepreneurship;
use App\Models\ModulePreIncubation;
use App\Models\Edition;
use App\Models\ModulePreIncubationTask;

class EntrepreneurshipTrelloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($edition_id)
    {
        $modules_pre_incubation = ModulePreIncubation::select('id','name', 'edition_id')
                                            ->where('edition_id',$edition_id)
                                            ->where('state',1)
                                            ->orderBy('order', 'ASC')
                                            ->get();

        $edition = Edition::where('id', $edition_id)->first();
        
        $entrepreneurships = $edition->entrepreneurship;
        $entrepreneurships_by_module = [];
        $emps = [];
        $trello = [];

        foreach ($modules_pre_incubation as $m) {
            $emps = [];
            foreach ($entrepreneurships as $e) {
                $task = ModulePreIncubationTask::select('id','module_pre_incubation_id', 'entrepreneurship_id', 'condition', 'task', 'updated_at')
                                    ->where('entrepreneurship_id',$e->id)
                                    ->where('task','!=','--')
                                    ->latest()
                                    ->first();
                if($task && $task->count() > 0){
                    
                    $task->entrepreneurship;

                    if($m->id == $task->module_pre_incubation_id){
                        array_push($emps, $task);
                    }
                }
                
            }
            
            array_push($entrepreneurships_by_module, ['module_name'=> $m->name , 'entrepreneurships'=>$emps ] );
        }
        

        if(!$entrepreneurships){
            return response()->json(['error'],400);
        }

        return response()->json([
            'data'=> compact('entrepreneurships', 'modules_pre_incubation', 'entrepreneurships_by_module')
        ],200);
    }

}
