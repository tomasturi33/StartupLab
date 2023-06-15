<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\EntrepreneurshipAssignedToTutor;
use App\Models\Entrepreneurship;
use App\Models\ModulePreIncubationTask;
use App\Models\ModulePreIncubation;

use App\Traits\EntrepreneurshipTrait;

class TutorsController extends Controller
{
    use EntrepreneurshipTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrepreneurships = EntrepreneurshipAssignedToTutor::where('user_id',Auth::id())->get();

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
}
