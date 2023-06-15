<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use File;

use App\Models\ModulePreIncubationTask;
use App\Models\ModulePreIncubation;
use App\Models\Entrepreneurship;
use App\Models\User;

use App\Models\EntrepreneurshipAssignedToEvaluators;
use App\Notifications\NewTaskUploaded;

class ModulesPreIncubationTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tasks($module_pre_incubation_id, $convocation_form_id)
    {
        $entrepreneurship = Entrepreneurship::select('id')
                                ->where('convocation_form_id', $convocation_form_id)
                                ->first();

        if(!$entrepreneurship){
            return response()->json(['error'],400);
        }

        $tasks = ModulePreIncubationTask::where('entrepreneurship_id', $entrepreneurship->id)
                        ->where('module_pre_incubation_id', $module_pre_incubation_id)
                        ->where('state', 1)
                        ->get();

        foreach ($tasks as $task) {
            $task->created_date = $task->created_at->day.'/'.$task->created_at->month.'/'.$task->created_at->year;
            $task->updated_date = $task->updated_at->day.'/'.$task->updated_at->month.'/'.$task->updated_at->year;
            $task->user;
            $task->url  = Storage::url($task->task);
            $task->evaluator = User::find($task->evaluator_id);
        }

        return response()->json([
            'data'=>compact('tasks')
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
            'task' => 'required|mimes:pdf|max:6144'
        ]);

        $entrepreneurship = Entrepreneurship::select('id')
                                ->where('convocation_form_id', $request->convocation_form_id)
                                ->first();
        if(!$entrepreneurship){
            return response()->json(['error'],400);
        }

        $task = new ModulePreIncubationTask();

        $task->module_pre_incubation_id     = $request->module_pre_incubation_id;
        $task->entrepreneurship_id          = $entrepreneurship->id;
        $task->user_id                      = Auth::id();
        $task->message                      = $request->message;
        $task->task                         = $request->file('task')->store('public/tasks');
        $task->condition                    = 'pending';
        $task->state                        = 1;

        if(!$task->save()){
            return response()->json(['error'],400);
        }

        $module = $task->module_pre_incubation->name;
        $this->sendNotification($entrepreneurship->id, $module);

        return response()->json([
            'task'=>$task
        ],200);
    }

    /**
     * 
     * Send notification when entrepreneur upload new task.
     *
     */
    public function sendNotification($entrepreneurship_id, $module_pre_incubation)
    {

        $entrepreneurships_assigned = EntrepreneurshipAssignedToEvaluators::where('entrep_id', $entrepreneurship_id)->get();

        foreach ($entrepreneurships_assigned as $assigned) {
            $user = $assigned->user;
            $entrepreneurship = $assigned->entrepreneurship->title;

            $user->notify(new NewTaskUploaded($user, $entrepreneurship , $module_pre_incubation));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function viewModule(Request $request)
    {   
        $entrepreneurship = Entrepreneurship::select('id')
                                ->where('convocation_form_id', $request->convocation_form_id)
                                ->first();
        if(!$entrepreneurship){
            return response()->json(['error'],400);
        }

        $task = ModulePreIncubationTask::where('module_pre_incubation_id', $request->module_pre_incubation_id)
                                ->where('entrepreneurship_id', $entrepreneurship->id)
                                ->where('condition', 'approved')
                                ->first();

        if(!$task){
            $task = new ModulePreIncubationTask();
            $task->module_pre_incubation_id     = $request->module_pre_incubation_id;
            $task->entrepreneurship_id          = $entrepreneurship->id;
            $task->user_id                      = Auth::id();
            $task->task                         = '--';
            $task->condition                    = 'approved';
            $task->state                        = 1;

            if(!$task->save()){
                return response()->json(['error'],400);
            }
        }

        return response()->json([
            'task'=>$task
        ],200);
    }
}
