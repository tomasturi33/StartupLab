<?php

namespace App\Http\Controllers\Evaluator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\EntrepreneurshipAssignedToEvaluators;
use App\Models\Entrepreneurship;

use App\Models\ModuleAssignedToEvaluator;
use App\Models\ModulePreIncubation;
use App\Models\ModulePreIncubationTask;
use App\Models\Edition;
use App\Models\EntrepreneurialProfile;

use App\Notifications\NewTaskCorrection;

use App\Traits\EntrepreneurshipTrait;

class EvaluatorsController extends Controller
{
    use EntrepreneurshipTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrepreneurships = EntrepreneurshipAssignedToEvaluators::where('user_id',Auth::id())->get();

        foreach ($entrepreneurships as $m) {
            $m->edition;
            $m->entrepreneurship = Entrepreneurship::select('id', 'title','edition_id', 'slug')->where('id',$m->entrep_id)->first();
            $m->progress = $this->calculateProgress($m->entrepreneurship);
        }
        
        if(!$entrepreneurships){
            return response()->json(['error'],400);
        }

        return response()->json([
            'evaluator'=>compact('entrepreneurships')
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
    public function tasks($slug)
    {
        $entrepreneurship = Entrepreneurship::select('id','title','edition_id','slug')
                                ->where('slug',$slug)
                                ->first();


        $tasks = ModulePreIncubationTask::where('state',1)
                            ->where('entrepreneurship_id',$entrepreneurship->id)
                            ->where('task','!=','--')
                            ->with(['entrepreneurship' => function ($query) {
                                        $query->select('id', 'title');
                                    }])
                            ->with(['module_pre_incubation' => function ($query) {
                                        $query->select('id', 'name');
                                    }])
                            ->get();

        if(!$tasks){
            return response()->json(['error'],400);
        }

        //---------------------------------------------------------------------------//


        $module_pre_incubation = ModulePreIncubation::select('id', 'edition_id', 'order', 'name', 'slug', 'require_activity')
                                    ->where('edition_id', $entrepreneurship->edition_id)
                                    ->where('state', 1)
                                    ->get();

        foreach ($module_pre_incubation as $m) {

            if($m->require_activity){
                $task = ModulePreIncubationTask::select('condition')
                                    ->where('entrepreneurship_id', $entrepreneurship->id)
                                    ->where('module_pre_incubation_id',$m->id)
                                    ->orderBy('id','DESC')
                                    ->first();
                if($task){
                    $m->task_state = ($task->condition=='approved')?'Aprobado':(($task->condition=='pending')?'Pendiente':'No Aprobado');
                }else{
                    $m->task_state = '--';
                }
            }else{
                $m->task_state = 'No requerida';
            }
        }

        $progress = $this->calculateProgress($entrepreneurship);

        return response()->json([
            'data'=>compact('entrepreneurship', 'tasks', 'module_pre_incubation', 'progress')
        ],200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTasks($slug, $module_pre_incubation_id)
    {
        $entrepreneurship = Entrepreneurship::select('id','title','edition_id','slug')
                                ->where('slug',$slug)
                                ->first();

        $module_pre_incubation = ModulePreIncubation::find($module_pre_incubation_id);

        $module_pre_incubation_tasks = ModulePreIncubationTask::where('module_pre_incubation_id',$module_pre_incubation_id)
                                            ->where('entrepreneurship_id', $entrepreneurship->id)
                                            ->get();

        foreach ($module_pre_incubation_tasks as $task) {
            $task->created_date = $task->created_at->day.'/'.$task->created_at->month.'/'.$task->created_at->year;
            $task->updated_date = $task->updated_at->day.'/'.$task->updated_at->month.'/'.$task->updated_at->year;
            $task->user;
            $task->evaluator;
            $task->url  = Storage::url($task->task);
        }

        return response()->json([
            'data'=>compact('module_pre_incubation','module_pre_incubation_tasks')
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
        $task = ModulePreIncubationTask::find($id);
        $task->url  = Storage::url($task->task);
        $task->user;
        $task->entrepreneurship;
        $task->module_pre_incubation;

        if($task->evaluator_id){
           $task->evaluator = User::find($task->evaluator_id); 
        }

        if(!$task){
            return response()->json(['error'],400);
        }

        return response()->json([
            'data'=>compact('task')
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
        $task = ModulePreIncubationTask::find($id);
        $task->condition = $request->condition;
        $task->evaluator_id = Auth::id();
        $task->devolution = $request->devolution;

        if(!$task->save()){
            return response()->json(['error'],400);        
        }

        $module = $task->module_pre_incubation;

        $this->sendNotification($task->user_id, $module);

        return response()->json([
            'task'=>compact('task')
        ],200);  
    }

    /**
     * Send notification when evaluator updated the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendNotification($user_id, ModulePreIncubation $module)
    {
        $convocation_form = EntrepreneurialProfile::select('convocation_form_id')
                                        ->where('user_id',$user_id)
                                        ->first();

        
        $entrepreneurial_profiles = EntrepreneurialProfile::select('id','user_id')
                                        ->where('user_id','!=',null)
                                        ->where('convocation_form_id', $convocation_form->convocation_form_id)
                                        ->get();

        foreach ($entrepreneurial_profiles as $profile) {
            $user = $profile->user;
            $user->notify(new NewTaskCorrection($user, $module->name ));
        }   
    }
}
