<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use File;

use App\Models\PillTeacher;
use App\Models\Pill;

class PillController extends Controller
{
    /**
     * Change the order of the modules
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function moveUp(Request $request, $id)
    {
        $pill_up = Pill::find($id);

        if($pill_up->order>1){
            $pill_down = Pill::where('module_pre_incubation_id',$pill_up->module_pre_incubation_id)
                            ->where('order',$pill_up->order-1)->first();

            $pill_up->order -= 1;
            $pill_up->save();

            $pill_down->order += 1;
            $pill_down->save();
        }
        
        return response()->json([
            'module'=>$pill_up
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
        $pill_down = Pill::find($id);

        //busco la edicion que tenga el orden maximo, para guardar una contigua
        $maxOrder = Pill::where('module_pre_incubation_id', $pill_down->module_pre_incubation_id )->max('order');

        if($pill_down->order < $maxOrder){

            $pill_up = Pill::where('module_pre_incubation_id',$pill_down->module_pre_incubation_id)
                            ->where('order',$pill_down->order+1)
                            ->first();

            $pill_down->order += 1;
            $pill_down->save();

            $pill_up->order -= 1;
            $pill_up->save();
        }
        
        return response()->json([
            'module'=>$pill_down
        ],200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pills($module_pre_incubation_id)
    {
        $pills = Pill::select('id','order', 'name')
                    ->where('module_pre_incubation_id',$module_pre_incubation_id)
                    ->where('state',1)
                    ->orderBy('order', 'ASC')
                    ->get();

        return response()->json([
            'pills'=>$pills
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
        if($request->type_content == 'video'){
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'content' => 'required|max:40000',
                'name_teacher' => 'required|string|max:125',
                'lastname_teacher' => 'required|string|max:125'
            ]);
        }else{
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'content' => 'required',
                'name_teacher' => 'required|string|max:125',
                'lastname_teacher' => 'required|string|max:125'
            ]);
        }
        
        //busco la edicion que tenga el orden maximo, para guardar una contigua
        $maxOrder = Pill::where('module_pre_incubation_id', $request->module_pre_incubation_id )->max('order');

        $pill = new Pill();
        $pill->module_pre_incubation_id     = $request->module_pre_incubation_id;
        $pill->order                        = $maxOrder+1;
        $pill->name                         = $request->name;
        $pill->description                  = $request->description;
        $pill->type_content                 = $request->type_content;

        $pill->slug                         = Str::slug($request->name).'-'.time();
        $pill->state                        = 1;
            
        if($request->type_content=='video'){
            $request->validate([
                'content' => 'file|max:10240',
            ]);
            $pill->content                      = $request->file('content')->store('public/videos');
        }

        if($request->type_content=='pdf'){
            $pill->content                      = $request->file('content')->store('public/pdf');
        }

        if(     $request->type_content=='youtube_video' ||
                $request->type_content=='vimeo_video' ||
                $request->type_content=='nube_unl_video' ||
                $request->type_content=='link'){
            $pill->content                      = $request->content;
        }

        if(!$pill->save()){
            return response()->json(['error'],400);
        }

        $teacher = new PillTeacher();

        $teacher->pill_id                       = $pill->id;
        $teacher->academic_title                = $request->academic_title;
        $teacher->abbreviated_academic_title    = $request->abbreviated_academic_title;
        $teacher->name_teacher                  = $request->name_teacher;
        $teacher->lastname_teacher              = $request->lastname_teacher;
        $teacher->email                         = $request->email;
        $teacher->linkedin                      = $request->linkedin;
        $teacher->state                         = 1;

        if(!$teacher->save()){
            $pill->delete();
            return response()->json(['error'],400);
        }

        return response()->json([
            'pill'=>$pill
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
        $pill = Pill::find($id);

        if($pill->type_content=='video'||$pill->type_content=='pdf'){
            $pill->url = Storage::url($pill->content);
        }

        $pill->pill_teacher;
        
        return response()->json([
            'pill'=>$pill
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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required',
            'name_teacher' => 'required|string|max:125',
            'lastname_teacher' => 'required|string|max:125'
        ]);

        $pill               = Pill::find($id);
        $pill->name         = $request->name;
        $pill->description  = $request->description;
        $pill->type_content = $request->type_content;

        if($request->replace_content=='true'){
            switch ($request->type_content) {
                case 'video':
                    $pill->content      = $request->file('content')->store('public/videos');
                    break;
                
                case 'pdf':
                    $pill->content      = $request->file('content')->store('public/pdf');
                    break;
                
                case 'youtube_video':
                    $pill->content      = $request->content;
                    break;
                
                case 'vimeo_video':
                    $pill->content      = $request->content;
                    break;
                case 'nube_unl_video':
                    $pill->content      = $request->content;
                    break;
                
                default:
                    // code...
                    break;
            }
        }

        if(!$pill->save()){
            return response()->json(['error'],400);
        }

        $teacher                                = PillTeacher::find($request->pill_teacher_id);

        $teacher->academic_title                = $request->academic_title;

        $teacher->abbreviated_academic_title    = $request->abbreviated_academic_title;
        $teacher->name_teacher                  = $request->name_teacher;
        $teacher->lastname_teacher              = $request->lastname_teacher;
        $teacher->email                         = $request->email;
        $teacher->linkedin                      = $request->linkedin;

        if(!$teacher->save()){
            $pill->delete();
            return response()->json(['error'],400);
        }

        return response()->json([
            'pill'=>$pill
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:125',
    //         'content' => 'required',
    //         'name_teacher' => 'required|string|max:125',
    //         'lastname_teacher' => 'required|string|max:125'
    //     ]);

    //     $pill                               = Pill::find($id);
    //     $pill->name                         = $request->name;
    //     $pill->description                  = $request->description;

    //     if(!$pill->save()){
    //         return response()->json(['error'],400);
    //     }

    //     $teacher                                = PillTeacher::find($request->pill_teacher_id);

    //     $teacher->academic_title                = $request->academic_title;
    //     $teacher->abbreviated_academic_title    = $request->abbreviated_academic_title;
    //     $teacher->name_teacher                  = $request->name_teacher;
    //     $teacher->lastname_teacher              = $request->lastname_teacher;
    //     $teacher->email                         = $request->email;
    //     $teacher->linkedin                      = $request->linkedin;

    //     if(!$teacher->save()){
    //         $pill->delete();
    //         return response()->json(['error'],400);
    //     }

    //     return response()->json([
    //         'pill'=>$pill
    //     ],200);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update2(Request $request, $id)
    {
        if($request->replace_content=='true'){
            if($request->type_content=='video'){
                $pill               = Pill::find($id);
                $pill->name         = $request->name;
                $pill->description  = $request->description;
                $pill->content      = $request->file('content')->store('public/videos');
            }else{
                $pill               = Pill::find($id);
                $pill->name         = $request->name;
                $pill->description  = $request->description;
                $pill->content      = $request->file('content')->store('public/pdf');
            }
        }else{
            $pill               = Pill::find($id);
            $pill->name         = $request->name;
            $pill->description  = $request->description;
        }

        if(!$pill->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'pill'=>$pill
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
        $pill = Pill::find($id);

        $pills = Pill::where('module_pre_incubation_id',$pill->module_pre_incubation_id)
                        ->where('order','>',$pill->order)
                        ->get();

        foreach ($pills as $p) {
            $p->order = $p->order-1;
            $p->save();
        }

        if(!$pill->delete()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'pill'=>$pill
        ],200);

    }
}
