<?php

use Illuminate\Support\Facades\Route;


//-----------------------------------------------------------
//------------------RUTAS DEL TUTOR----------------------
//-----------------------------------------------------------

Route::group(['prefix' => 'tutor','middleware' => ['IsTutor', 'auth:sanctum']], function () {

    //---------------------------------------------
    // Ediciones creadas por los administradores
    //---------------------------------------------
    Route::get('tutors/','Tutor\TutorsController@index');
    Route::get('tutors/{slug}','Tutor\TutorsController@tasks');
    Route::get('tutors/{slug}/module-pre-incubation/{module_pre_incubation_id}','Tutor\TutorsController@showTasks');
    
    Route::get('tutors/{slug}/startup','Tutor\EntrepreneurshipController@show');
    Route::get('tutors/{slug}/team','Tutor\EntrepreneurialProfileController@team');
    Route::get('tutors/{slug}/team/{id}/profile','Tutor\EntrepreneurialProfileController@show');
    Route::get('tutors/{slug}/window','Tutor\EntrepreneurshipWindowController@show');

    // Route::get('modules','Evaluator\ModulesPreIncubationController@index');
    // Route::get('modules/{slug}','Evaluator\ModulesPreIncubationController@show');
    // Route::get('modules/{slug}/pill/{slug_pill}','Evaluator\ModulesPreIncubationController@pill');

    // Route::get('task/{id}','Tutor\TutorsController@show');

    // Route::put('tutors/task/{id}/status', 'Tutor\TutorsController@update');
});