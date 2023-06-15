<?php

use Illuminate\Support\Facades\Route;

//-----------------------------------------------------------
//--------------RUTAS DEL ADMINISTRADOR----------------------
//-----------------------------------------------------------

Route::group(['prefix' => 'admin','middleware' => ['IsAdmin', 'auth:sanctum'] ], function () {
    //---------------------------------------------
    // Ediciones creadas por los administradores
    //---------------------------------------------
    Route::get('editions','Admin\EditionController@index');
    Route::get('editions/{slug}','Admin\EditionController@show');
    Route::post('editions','Admin\EditionController@store');
    Route::put('editions/{id}','Admin\EditionController@update');
    Route::delete('editions/{id}','Admin\EditionController@destroy');

    //---------------------------------------------
    // Emprendimientos de cada edicion
    //---------------------------------------------
    Route::get('edition/{id}/entrepreneurships','Admin\EntrepreneurshipsController@EntrepreneurshipEdition');
    Route::get('edition/{id}/entrepreneurships/{id_entrepreneurship}','Admin\EntrepreneurshipsController@show');
    Route::get('edition/{id}/entrepreneurships/{convocation_form_id}/show-window','Admin\EntrepreneurshipsController@showWindow');
    Route::get('edition/{id}/team/{convocation_form_id}','Admin\EntrepreneurshipsController@team');
    Route::get('edition/{id}/entrepreneurships/{entrepreneurship_id}/modules-pre-incubation','Admin\EntrepreneurshipsController@showModulesPreIncubation');
    Route::get('edition/{id}/entrepreneurships/{entrepreneurship_id}/modules-pre-incubation/{module_pre_incubation_id}','Admin\EntrepreneurshipsController@showModulePreIncubationTask');

    Route::get('edition/{id}/entrepreneurships/{id_entrepreneurship}/generate-pdf','Admin\EntrepreneurshipsController@generatePDF');

    Route::post('edition/{id}/entrepreneurships/add-entrepreneurship-edition','Admin\EntrepreneurshipsController@addEntrepreneurshipEdition');

    //---------------------------------------------
    // Formularios de convocatoria de cada edicion
    //---------------------------------------------
    Route::get('edition/{id}/convocation-form','Admin\EntrepreneurshipsController@ConvocationFormEdition');
    Route::get('edition/{id}/convocation-form/pending','Admin\ConvocationFormController@Pending');
    Route::get('edition/{id}/convocation-form/in-progress','Admin\ConvocationFormController@inProgress');
    Route::get('edition/{id}/convocation-form/rejected','Admin\ConvocationFormController@Rejected');
    Route::get('edition/{id}/convocation-form/{id_entrepreneurship}','Admin\ConvocationFormController@show');
    Route::put('edition/{id}/convocation-form/{id_entrepreneurship}','Admin\ConvocationFormController@update');
    Route::get('edition/{id}/convocation-form/{id_entrepreneurship}/generate-pdf','Admin\ConvocationFormController@generatePDF');
    
    //---------------------------------------------
    // Modulos de cada edicion
    //---------------------------------------------
    Route::get('modules','Admin\ModulePreIncubationController@index');
    Route::get('modules/{id}','Admin\ModulePreIncubationController@show');
    Route::post('modules','Admin\ModulePreIncubationController@store');
    Route::put('modules/{id}','Admin\ModulePreIncubationController@update');
    Route::delete('modules/{id}','Admin\ModulePreIncubationController@destroy');

    Route::put('modules-pre-incubation/move-up/{id}','Admin\ModulePreIncubationController@moveUp');
    Route::put('modules-pre-incubation/move-down/{id}','Admin\ModulePreIncubationController@moveDown');

    //---------------------------------------------
    // Pildoras de cada modulo
    //---------------------------------------------
    Route::get('pills/{module_pre_incubation_id}/module','Admin\PillController@pills');
    Route::get('pills/{id}','Admin\PillController@show');
    Route::post('pills','Admin\PillController@store');
    Route::post('pills/{id}','Admin\PillController@update');
    Route::delete('pills/{id}','Admin\PillController@destroy');

    Route::put('pills/move-up/{id}','Admin\PillController@moveUp');
    Route::put('pills/move-down/{id}','Admin\PillController@moveDown');

    //---------------------------------------------
    // Todos los emprendimientos
    //---------------------------------------------
    
    // Route::get('entrepreneurships','Admin\EntrepreneurshipsController@index');
    Route::get('entrepreneurships/{id}','Admin\EntrepreneurshipsController@show2');
    // Route::get('entrepreneurships-rejected','Admin\EntrepreneurshipsController@Rejected');

    Route::get('entrepreneurships/{id}/convocation-form','Admin\EntrepreneurshipsController@showConvocationForm');
    Route::get('entrepreneurships/{id}/convocation-form/generate-pdf','Admin\ConvocationFormController@generatePDF2');

    Route::get('entrepreneurships/{id}/startup','Admin\EntrepreneurshipsController@showStartUp');
    Route::get('entrepreneurships/{id}/startup/generate-pdf','Admin\EntrepreneurshipsController@generatePDF2');

    Route::get('entrepreneurships/{id}/team','Admin\EntrepreneurshipsController@showTeam');

    Route::get('entrepreneurships/{edition_id}/entrepreneurship-windows', 'Admin\EntrepreneurshipWindowsController@index');
    Route::get('entrepreneurships/{edition_id}/entrepreneurship-windows/{entrepreneurship_id}', 'Admin\EntrepreneurshipWindowsController@show');

    Route::get('entrepreneurships/{edition_id}/entrepreneurship-trello', 'Admin\EntrepreneurshipTrelloController@index');
    //---------------------------------------------
    // Notas de los emprendimientos
    //---------------------------------------------
    Route::get('notes/{id}','Admin\EntrepreneurshipNotesController@index');
    Route::post('notes/{id}','Admin\EntrepreneurshipNotesController@store');
    Route::delete('notes/{id}','Admin\EntrepreneurshipNotesController@destroy');

    //---------------------------------------------
    // Todos los Emprendedores
    //---------------------------------------------
    Route::get('entrepreneurs','Admin\EntrepreneurialProfileController@index');
    Route::get('entrepreneurs/{id}','Admin\EntrepreneurialProfileController@show');

    //---------------------------------------------
    // Todos los Evaluadores
    //---------------------------------------------
    Route::get('evaluators','Admin\EvaluatorsController@index');
    Route::get('evaluators/{id}','Admin\EvaluatorsController@show');
    Route::get('evaluators/{user_id}/edition/{edition_id}/entrepreneurships','Admin\EvaluatorsController@modulesAssingned');
    Route::post('evaluators','Admin\EvaluatorsController@store');
    Route::delete('evaluators/{id}/{user_id}','Admin\EvaluatorsController@destroy');

    //---------------------------------------------
    // Todos los Tutores
    //---------------------------------------------
    Route::get('tutors','Admin\TutorsController@index');
    Route::get('tutors/{id}','Admin\TutorsController@show');
    Route::get('tutors/{user_id}/edition/{edition_id}/entrepreneurships','Admin\TutorsController@modulesAssingned');
    Route::post('tutors','Admin\TutorsController@store');
    Route::delete('tutors/{id}/{user_id}','Admin\TutorsController@destroy');


    //---------------------------------------------
    // Roles de usuarios
    //---------------------------------------------
    Route::get('roles','Admin\RolesController@index');

    //---------------------------------------------
    // Todos los usuarios
    //---------------------------------------------
    Route::get('users','Admin\UsersController@index');
    Route::post('users','Admin\UsersController@store');
    Route::get('users/{id}','Admin\UsersController@show');
    Route::put('users/{id}','Admin\UsersController@update');
    Route::delete('users/{id}','Admin\UsersController@destroy');
    Route::get('admin-users','Admin\UsersController@AdminUsers');
    Route::get('evaluator-users','Admin\UsersController@EvaluatorUsers');
    Route::get('tutor-users','Admin\UsersController@TutorUsers');
    
    //---------------------------------------------
    // Rutas a las configuraciones
    //---------------------------------------------
    Route::get('academic-units', 'Admin\AcademicUnitsController@index');
    Route::get('academic-units/{id}', 'Admin\AcademicUnitsController@show');
    Route::put('academic-units/{id}', 'Admin\AcademicUnitsController@update');
    Route::post('academic-units', 'Admin\AcademicUnitsController@store');
    Route::delete('academic-units/{id}', 'Admin\AcademicUnitsController@destroy');

    Route::get('careers', 'Admin\CareerController@index');
    Route::get('careers/{id}', 'Admin\CareerController@show');
    Route::put('careers/{id}', 'Admin\CareerController@update');
    Route::post('careers', 'Admin\CareerController@store');
    Route::delete('careers/{id}', 'Admin\CareerController@destroy');

    Route::get('vertical-works', 'Admin\VerticalWorksController@index');
    Route::get('vertical-works/{id}', 'Admin\VerticalWorksController@show');
    Route::put('vertical-works/{id}', 'Admin\VerticalWorksController@update');
    Route::post('vertical-works', 'Admin\VerticalWorksController@store');
    Route::delete('vertical-works/{id}', 'Admin\VerticalWorksController@destroy');

    Route::get('entrepreneurship-needs', 'Admin\EntrepreneurshipNeedController@index');
    Route::get('entrepreneurship-needs/{id}', 'Admin\EntrepreneurshipNeedController@show');
    Route::put('entrepreneurship-needs/{id}', 'Admin\EntrepreneurshipNeedController@update');
    Route::post('entrepreneurship-needs', 'Admin\EntrepreneurshipNeedController@store');
    Route::delete('entrepreneurship-needs/{id}', 'Admin\EntrepreneurshipNeedController@destroy');

    Route::get('provincias', 'Admin\ProvinciaController@index');
    Route::get('provincias/{id}', 'Admin\ProvinciaController@show');
    Route::put('provincias/{id}', 'Admin\ProvinciaController@update');
    Route::post('provincias', 'Admin\ProvinciaController@store');

    Route::get('localidades', 'Admin\LocalidadController@index');
    Route::get('localidades/{id}', 'Admin\LocalidadController@show');
    Route::put('localidades/{id}', 'Admin\LocalidadController@update');
    Route::post('localidades', 'Admin\LocalidadController@store');
    Route::delete('localidades/{id}', 'Admin\LocalidadController@destroy');
});