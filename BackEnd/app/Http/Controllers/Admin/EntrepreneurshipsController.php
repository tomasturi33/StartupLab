<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\Entrepreneurship;
use App\Models\Edition;
use App\Models\ConvocationForm;
use App\Models\EntrepreneurialProfile;
use App\Models\EntrepreneurshipWindow;
use App\Models\InvitationEntrepreneurship;
use App\Models\ModulePreIncubation;
use App\Models\ModulePreIncubationTask;

use App\Models\IdeaNeed;
use App\Models\NeedStartup;
use App\Models\CurriculumIdea;

use Illuminate\Support\Str;
use App\Mail\InvitationEntrepreneurshipEdition;
use Illuminate\Support\Facades\Mail;

//use Illuminate\Support\Facades\Storage;

use PDF;
use Storage;

class EntrepreneurshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrepreneurships = Entrepreneurship::select('id', 'title', 'edition_id', 'slug')
                                ->where('state',1)
                                ->orderBy('id','DESC')
                                ->get();

        foreach ($entrepreneurships as $e) {
            $e->edition;
        }

        return response()->json([
            'entrepreneurships'=>$entrepreneurships
        ],200);
    }

    /**
     * Display a listing of the Convocation Form
     *
     * @return \Illuminate\Http\Response
     */
    public function Rejected()
    {
        $entrepreneurships = ConvocationForm::where('state',1)
                                ->where('condition','rejected')
                                ->orderBy('id','DESC')
                                ->get();

        foreach ($entrepreneurships as $e) {
            $e->edition;
        }

        return response()->json([
            'entrepreneurships'=>$entrepreneurships
        ],200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function EntrepreneurshipEdition($id_edition)
    {
        $edition = Edition::where('id', $id_edition)->first();
        $entrepreneurships = $edition->entrepreneurship;
        
        foreach ($entrepreneurships as $e) {
            $task = ModulePreIncubationTask::select('id','module_pre_incubation_id','condition','updated_at')
                                    ->where('entrepreneurship_id',$e->id)
                                    ->where('task','!=','--')
                                    ->latest()
                                    ->first();

            $e->last_task_date = '--';
            $e->last_task_state = '--';
            $e->last_task_module = '--';

            $e->progress = $this->progress($id_edition, $e->id);
            
            if($task!=null){
                $e->last_task_module = $task->module_pre_incubation->name;

                $e->last_task_date = $task->updated_at;

                $e->last_task_date = $task->updated_at->day.'/'.$task->updated_at->month.'/'.$task->updated_at->year;

                switch ($task->condition) {
                    case 'approved':
                        $e->last_task_state = 'Aprobado';
                        break;
                    
                    case 'not_approved':
                        $e->last_task_state = 'No aprobado';
                        break;

                    case 'pending':
                        $e->last_task_state = 'Pendiente';
                        break;

                    default:
                        $e->last_task_state = '--';
                        break;
                }
            }
            
        }

        if(!$entrepreneurships){
            return response()->json(['error'],400);
        }

        return response()->json([
            'data'=>compact('entrepreneurships')
        ],200);
    }

    public function ConvocationFormEdition($id_edition)
    {
        $edition = Edition::where('id', $id_edition)->first();
        $convocation = $edition->convocationForm;

        return compact('convocation', 200);
    }

    /**
     * Display a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $id_entrepreneurship)
    {
        $entrepreneurship = Entrepreneurship::find($id_entrepreneurship);

        $entrepreneurship->user;
        $entrepreneurship->provincia;
        $entrepreneurship->localidad;
        $entrepreneurship->entrepreneurship_stadia;
        $entrepreneurship->development_degrees;
        $entrepreneurship->vertical_works;
        $entrepreneurship->need_startup;
        $entrepreneurship->curriculum;

        foreach ($entrepreneurship->need_startup as $idea) {
            $idea->entrepreneurship_need;
        }

        return response(compact('entrepreneurship'), 200);
    }

    /**
     * Display a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show2($id)
    {
        $entrepreneurship = Entrepreneurship::find($id);

        $entrepreneurship->user;
        $entrepreneurship->provincia;
        $entrepreneurship->localidad;
        $entrepreneurship->entrepreneurship_stadia;
        $entrepreneurship->development_degrees;
        $entrepreneurship->vertical_works;
        $entrepreneurship->need_startup;
        $entrepreneurship->curriculum;

        foreach ($entrepreneurship->need_startup as $idea) {
            $idea->entrepreneurship_need;
        }

        return response(compact('entrepreneurship'), 200);
    }

    /**
     * Display a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showConvocationForm($id)
    {
        $entrepreneurship = Entrepreneurship::find($id);

        $convocation_form = $entrepreneurship->convocation_form;
        $convocation_form->user;
        $convocation_form->provincia;
        $convocation_form->localidad;
        $convocation_form->entrepreneurship_stadia;
        $convocation_form->development_degrees;
        $convocation_form->vertical_works;
        $convocation_form->idea_need;
        $convocation_form->curriculum_idea;

        foreach ($convocation_form->idea_need as $idea) {
            $idea->entrepreneurship_need;
        }

        return response(compact('entrepreneurship'), 200);
    }

    /**
     * Display a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showStartUp($id)
    {
        $entrepreneurship = Entrepreneurship::find($id);
        $entrepreneurship->user;
        $entrepreneurship->provincia;
        $entrepreneurship->localidad;
        $entrepreneurship->entrepreneurship_stadia;
        $entrepreneurship->development_degrees;
        $entrepreneurship->vertical_works;
        $entrepreneurship->need_startup;
        $entrepreneurship->curriculum;

        foreach ($entrepreneurship->need_startup as $idea) {
            $idea->entrepreneurship_need;
        }

        return response(compact('entrepreneurship'), 200);
    }

    /**
     * Display a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTeam($id)
    {
        $entrepreneurship = Entrepreneurship::find($id);
        
        $team = EntrepreneurialProfile::where('convocation_form_id',$entrepreneurship->convocation_form_id)
                                    ->get();

        if(!$team){
            return response()->json(['error'],400);
        }

        foreach ($team as $t) {
            $t->provincia;
            $t->localidad;
            $t->completed_studie;
            $t->academic_unit;
            $t->career;
            $t->gender;
        }

        return response()->json([
            'team'=>$team
        ],200);
    }

    /**
     * Display a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team($id, $convocation_form_id)
    {
        $team = EntrepreneurialProfile::where('convocation_form_id',$convocation_form_id)
                                    ->get();

        if(!$team){
            return response()->json(['error'],400);
        }

        foreach ($team as $t) {
            $t->provincia;
            $t->localidad;
            $t->completed_studie;
            $t->academic_unit;
            $t->career;
            $t->gender;
        }

        return response()->json([
            'team'=>$team
        ],200);
    }

    /**
     * Display a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showWindow($id,$convocation_form_id)
    {
        $window = EntrepreneurshipWindow::where('edition_id',$id)
                                        ->where('convocation_form_id', $convocation_form_id)
                                        ->first();

        if($window->logo!=null){
            $window->logo = Storage::url($window->logo);
        }

        if($window->image_1!=null){
            $window->image_1 = Storage::url($window->image_1);
        }

        if($window->image_2!=null){
            $window->image_2 = Storage::url($window->image_2);
        }

        if($window->image_3!=null){
            $window->image_3 = Storage::url($window->image_3);
        }

        if($window->image_4!=null){
            $window->image_4 = Storage::url($window->image_4);
        }
        
        if(!$window){
            return response()->json(['error'],400);
        }

        return response()->json([
            'window'=>$window
        ],200);
    }

    /**
     * Display a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showModulesPreIncubation($id,$entrepreneurship_id)
    {

        //$module_pre_incubation_tasks = ModulePreIncubationTask::where('entrepreneurship_id', $entrepreneurship_id)->get();

        $module_pre_incubation_tasks_approved_count = ModulePreIncubationTask::where('entrepreneurship_id', $entrepreneurship_id)
                                                                ->where('condition','approved')
                                                                ->count();

        $module_pre_incubation = ModulePreIncubation::select('id', 'edition_id', 'order', 'name', 'slug', 'require_activity')
                                    ->where('edition_id', $id)
                                    ->where('state', 1)
                                    ->get();

        $module_pre_incubation_count = ModulePreIncubation::where('edition_id', $id)
                                    ->where('state', 1)
                                    ->count();

        foreach ($module_pre_incubation as $m) {

            if($m->require_activity){
                $task = ModulePreIncubationTask::select('condition')
                                    ->where('entrepreneurship_id', $entrepreneurship_id)
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

        $progress = 0;
        if($module_pre_incubation_count!=0){
            $progress = round($module_pre_incubation_tasks_approved_count/$module_pre_incubation_count*100, 2);
        }
        

        return response()->json([
            'data'=>compact('module_pre_incubation', 'progress')
        ],200);
    }

    /**
     * Display a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showModulePreIncubationTask($id,$entrepreneurship_id, $module_pre_incubation_id)
    {
        $module_pre_incubation = ModulePreIncubation::find($module_pre_incubation_id);

        $module_pre_incubation_tasks = ModulePreIncubationTask::where('module_pre_incubation_id',$module_pre_incubation_id)
                                            ->where('entrepreneurship_id', $entrepreneurship_id)
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
     * Display a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addEntrepreneurshipEdition($id, Request $request)
    {
        $request->validate([
            'edition_id' => 'required',
            'title' => 'required',
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email'
        ]);

        $profile = EntrepreneurialProfile::where('email',$request->email)->first();
        
        if($profile)
        {
            if($profile->convocation_form['edition_id']==$request->edition_id)
            {
                throw ValidationException::withMessages([
                    'error' => 'El correo ya está en uso en esta convocatoria. Revise las bases y condiciones.'
                ]);
            }
        }

        $invitation             = new InvitationEntrepreneurship();
        $invitation->edition_id = $request->edition_id;
        $invitation->name       = $request->name;
        $invitation->lastname   = $request->lastname;
        $invitation->email      = $request->email;
        $invitation->title      = $request->title;
        $invitation->url        = Str::random(128);
        
        if(!$invitation->save()){
            return response()->json(['error'],400);
        }

        $this->sendInvitation(  $invitation,
                                $invitation->name,
                                $invitation->email);

        return response()->json([
            'invitation'=>$invitation
        ],200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id, $id_entrepreneurship)
    {
        $entrepreneurship = Entrepreneurship::find($id_entrepreneurship);
        $entrepreneurship->user;
        $entrepreneurship->provincia;
        $entrepreneurship->localidad;
        $entrepreneurship->entrepreneurship_stadia;
        $entrepreneurship->development_degrees;
        $entrepreneurship->vertical_works;
        $entrepreneurship->need_startup;
        $entrepreneurship->curriculum;

        foreach ($entrepreneurship->need_startup as $idea) {
            $idea->entrepreneurship_need;
        }

        $team = EntrepreneurialProfile::where('convocation_form_id',$entrepreneurship->convocation_form_id)
                                    ->get();

        if(!$team){
            return response()->json(['error'],400);
        }

        foreach ($team as $t) {
            $t->provincia;
            $t->localidad;
            $t->completed_studie;
            $t->academic_unit;
            $t->career;
            $t->gender;
        }

        $data = [
            'entrepreneurship' => $entrepreneurship,
            'team' => $team
        ];

        $pdf = PDF::loadView('pdf.startUp', $data);

        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );

        $title = $entrepreneurship->title;

        return $pdf->download($title.'.pdf');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF2($id)
    {
        $entrepreneurship = Entrepreneurship::find($id);
        $entrepreneurship->user;
        $entrepreneurship->provincia;
        $entrepreneurship->localidad;
        $entrepreneurship->entrepreneurship_stadia;
        $entrepreneurship->development_degrees;
        $entrepreneurship->vertical_works;
        $entrepreneurship->need_startup;
        $entrepreneurship->curriculum;

        foreach ($entrepreneurship->need_startup as $idea) {
            $idea->entrepreneurship_need;
        }

        $team = EntrepreneurialProfile::where('convocation_form_id',$entrepreneurship->convocation_form_id)
                                    ->get();

        if(!$team){
            return response()->json(['error'],400);
        }

        foreach ($team as $t) {
            $t->provincia;
            $t->localidad;
            $t->completed_studie;
            $t->academic_unit;
            $t->career;
            $t->gender;
        }

        $data = [
            'entrepreneurship' => $entrepreneurship,
            'team' => $team
        ];

        $pdf = PDF::loadView('pdf.startUp', $data);

        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );

        $title = $entrepreneurship->title;

        return $pdf->download($title.'.pdf');
    }

    /**
     * Send invitation when entrepreneurship invitation 
     * is created.
     * 
     * @return \Illuminate\Http\Response
     */
    public function sendInvitation( $invitation , $name, $to)
    {
        $base_url = env('APP_URL_VUE');
        $url = $base_url.'invitation-vip/'.$invitation->url;

        $correo = new InvitationEntrepreneurshipEdition($name, $url);
        Mail::to($to)->send($correo);
    }

    /**
     * Calculate progress advance to entrepreneurship
     * 
     * @return \Illuminate\Http\Response
     */
    public function progress($edition_id , $entrepreneurship_id)
    {
        $module_pre_incubation_tasks_approved_count = ModulePreIncubationTask::where('entrepreneurship_id', $entrepreneurship_id)
                                                                ->where('condition','approved')
                                                                ->count();

        $module_pre_incubation_count = ModulePreIncubation::where('edition_id', $edition_id)
                                    ->where('state', 1)
                                    ->count();

        $progress = 0;
        if($module_pre_incubation_count!=0){
            $progress = round($module_pre_incubation_tasks_approved_count/$module_pre_incubation_count*100, 2);
        }
        

        return $progress;
    }

    
}
