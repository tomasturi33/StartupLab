<?php

use Illuminate\Support\Facades\Route;


//-----------------------------------------------------------
//------------------RUTAS DEL EVALUADOR----------------------
//-----------------------------------------------------------

Route::group(['prefix' => 'evaluator','middleware' => ['IsEvaluator', 'auth:sanctum']], function () {

    //---------------------------------------------
    // Ediciones creadas por los administradores
    //---------------------------------------------
    Route::get('evaluators/','Evaluator\EvaluatorsController@index');
    Route::get('evaluators/{slug}','Evaluator\EvaluatorsController@tasks');
    Route::get('evaluators/{slug}/module-pre-incubation/{module_pre_incubation_id}','Evaluator\EvaluatorsController@showTasks');
    
    Route::get('evaluators/{slug}/startup','Evaluator\EntrepreneurshipController@show');
    Route::get('evaluators/{slug}/startup/generate-pdf','Evaluator\EntrepreneurshipController@generatePDF');
    Route::get('evaluators/{slug}/team','Evaluator\EntrepreneurialProfileController@team');
    Route::get('evaluators/{slug}/team/{id}/profile','Evaluator\EntrepreneurialProfileController@show');
    Route::get('evaluators/{slug}/window','Evaluator\EntrepreneurshipWindowController@show');
    Route::get('evaluators/{slug}/window/generate-pdf','Evaluator\EntrepreneurshipWindowController@generatePDF');

    Route::get('modules','Evaluator\ModulesPreIncubationController@index');
    Route::get('modules/{slug}','Evaluator\ModulesPreIncubationController@show');
    Route::get('modules/{slug}/pill/{slug_pill}','Evaluator\ModulesPreIncubationController@pill');

    Route::get('task/{id}','Evaluator\EvaluatorsController@show');

    Route::put('evaluators/task/{id}/status', 'Evaluator\EvaluatorsController@update');
});