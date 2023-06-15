<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\ConvocationForm;
use App\Models\Entrepreneurship;
use App\Models\ModulePreIncubation;
use App\Models\ModulePreIncubationTask;
use App\Models\Pill;

class ModulesPreIncubationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($convocation_form_id)
    {   
        //Busco la convocatoria del emprendimiento
        $convocation_form = ConvocationForm::find($convocation_form_id);

        // Obtengo todos los modulos de esta edicion
        $modules = ModulePreIncubation::select('id', 'order', 'name', 'slug')
                        ->where('edition_id', $convocation_form->edition_id)
                        ->where('state',1)
                        ->orderBy('order', 'ASC')
                        ->get();

        //Busco el emprendimiento
        $entrepreneurship = Entrepreneurship::select('id')->where('convocation_form_id', $convocation_form->id)->firstOrFail();

        //Con el emprendimiento, me traigo todas las tareas aprovadas de dicho emprendimiento
        $tasks = ModulePreIncubationTask::where('state',1)
                            ->where('entrepreneurship_id',$entrepreneurship->id)
                            // ->where('condition','approved')
                            // ->orWhere('condition','not_approved')
                            // ->orWhere('condition','pending')
                            ->get();

        //Comparto todos los modulos de estaedicion,con las tareas delemprendimiento, y agrego una variable al array
        //modules llamada is_eneable para habilitar o deshabilitar los modulos segun el progreso

        foreach ($modules as $m) {
            if($m->order==1){
                $m->is_enabled = true;
            }else{
                $m->is_enabled = false;

                if(count($tasks)!=0){
                   foreach ($tasks as $task) {
                        if($m->id==$task->module_pre_incubation_id){
                            $m->is_enabled = true;
                        }
                    } 
                }
            }
        }

        //Busco el objeto habilitado con indice mas alto
        //y pregunto si el siguien existe, si existe lo
        //habilito para q pueda ser accesido por el emprendedor

        $index_max_order_eneable=0;
        $index = 0;

        foreach ($modules as $m) {
            if($m->is_enabled){
                $index = $index_max_order_eneable;
            }
            $index_max_order_eneable++;
        }

        if(isset($modules[$index+1]) && count($tasks)!=0){
            $modules[$index+1]->is_enabled = true;
        }
        
        $tasks_approved = ModulePreIncubationTask::where('state',1)
                            ->where('entrepreneurship_id',$entrepreneurship->id)
                            ->where('condition','approved')
                            ->count();

        $progress = 0;
        if(count($modules)>0){
            $progress =$tasks_approved/ count($modules) * 100;
        }
        $progress = $this->truncNumber($progress,0);

        $count_task = count($tasks);

        return response()->json([
            'data'=>compact('modules', 'progress', 'count_task', 'tasks')
        ],200);
    }

    function truncNumber( $number, $prec = 2 )
    {
        return bccomp( $number, 0, 10) == 0 ? $number : round( $number - pow( 0.1, bcadd( $prec, 1)) * 5, $prec);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $convocation_form_id)
    {
        //Busco el emprendimiento
        $entrepreneurship = Entrepreneurship::select('id')->where('convocation_form_id', $convocation_form_id)->firstOrFail();

        $module = ModulePreIncubation::where('slug',$slug)->first();
        $module->pills;

        if(!$module){
            return response()->json(['error'],400);
        }

        $module_before = [];
        $task_before = [];

        $task_count = 0;
        $is_enabled = true;

        if($module->order>1){
            $module_before = ModulePreIncubation::select('id')
                                ->where('edition_id', $module->edition_id)
                                ->where('order',$module->order-1)
                                ->first();
            $task_before = ModulePreIncubationTask::where('module_pre_incubation_id', $module_before->id)
                                ->where('entrepreneurship_id', $entrepreneurship->id)
                                ->where('condition', 'approved')
                                ->get();

            $task_count = count($task_before);

            if($task_count==0){
                $is_enabled = false;
            }
            
        }

        return response()->json([
            'data'=>compact('module', 'is_enabled')
        ],200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPill($slug)
    {
        $pill = Pill::where('slug',$slug)->first();
        $pill->url  = Storage::url($pill->content);
        $pill->pill_teacher;

        if(!$pill){
            return response()->json(['error'],400);
        }

        return response()->json([
            'pill'=>$pill
        ],200);
    }
}
