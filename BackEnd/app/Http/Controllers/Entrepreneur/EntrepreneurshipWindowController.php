<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EntrepreneurshipWindow;
use Storage;

class EntrepreneurshipWindowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($convocation_form_id)
    {
        $window = EntrepreneurshipWindow::where('convocation_form_id', $convocation_form_id)->first();

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $convocation_form_id)
    {
        $window = EntrepreneurshipWindow::where('convocation_form_id', $convocation_form_id)
                                            ->firstOrFail();

        $window->title                          = $request->title;
        $window->executive_summary              = $request->executive_summary;
        $window->problem_detected               = $request->problem_detected;
        $window->proposed_solution              = $request->proposed_solution;
        $window->market                         = $request->market;
        $window->strategic_alliance             = $request->strategic_alliance;
        $window->entrepreneurial_team           = $request->entrepreneurial_team;
        $window->contact                        = $request->contact;

        if($request->hasFile('logo')){
            if(Storage::exists($window->logo)){
                Storage::delete($window->logo);
            }
            $window->logo      = $request->file('logo')->store('public/window/logos');
        }else{
            if($request->logo=='null'){
                if(Storage::exists($window->logo)){
                    Storage::delete($window->logo);
                    $window->logo      = null;
                }
            }  
        }

        if($request->hasFile('image_1')){
            if(Storage::exists($window->image_1)){
                Storage::delete($window->image_1);
            }
            $window->image_1      = $request->file('image_1')->store('public/window/images');
        }else{
            if($request->image_1=='null'){
                if(Storage::exists($window->image_1)){
                    Storage::delete($window->image_1);
                    $window->image_1      = null;
                }
            }  
        }

        if($request->hasFile('image_2')){
            if(Storage::exists($window->image_2)){
                Storage::delete($window->image_2);
            }
            $window->image_2      = $request->file('image_2')->store('public/window/images');
        }else{
            if($request->image_2=='null'){
                if(Storage::exists($window->image_2)){
                    Storage::delete($window->image_2);
                    $window->image_2      = null;
                }
            }  
        }

        if($request->hasFile('image_3')){
            if(Storage::exists($window->image_3)){
                Storage::delete($window->image_3);
            }
            $window->image_3      = $request->file('image_3')->store('public/window/images');
        }else{
            if($request->image_3=='null'){
                if(Storage::exists($window->image_3)){
                    Storage::delete($window->image_3);
                    $window->image_3      = null;
                }
            }  
        }

        if($request->hasFile('image_4')){
            if(Storage::exists($window->image_4)){
                Storage::delete($window->image_4);
            }
            $window->image_4      = $request->file('image_4')->store('public/window/images');
        }else{
            if($request->image_4=='null'){
                if(Storage::exists($window->image_4)){
                    Storage::delete($window->image_4);
                    $window->image_4      = null;
                }
            }  
        }

        $window->video                          = $request->video;
        $window->degree_development             = $request->degree_development;

        $window->published                      = ($request->published=='true'||$request->published==1)?1:0;

        if(!$window->save()){
            return response()->json(['error'],400);
        }

        return response()->json([
            'window'=>$window
        ],200);
    }
}
