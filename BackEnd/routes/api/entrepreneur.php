<?php

use Illuminate\Support\Facades\Route;

//-----------------------------------------------------------
//----------------RUTAS DEL EMPRENDEDOR----------------------
//-----------------------------------------------------------
Route::group(['middleware' => ['IsEntrepreneur', 'auth:sanctum']], function (){
        
    Route::get('entrepreneurial-profiles/{id}','Entrepreneur\EntrepreneurialProfileController@EntrepreneurialProfiles');
    Route::post('entrepreneurial-profiles/add','Entrepreneur\EntrepreneurialProfileController@store');
    Route::put('entrepreneurial-profiles/update/{id}','Entrepreneur\EntrepreneurialProfileController@update');
    Route::get('entrepreneurial-profiles/{convocation_form_id}/show/{id}','Entrepreneur\EntrepreneurialProfileController@show');
    Route::delete('entrepreneurial-profiles/{convocation_form_id}/delete/{id}','Entrepreneur\EntrepreneurialProfileController@destroy');

    //----------------Generos-----------------
    Route::get('genders', 'Entrepreneur\GenderController@index');

    Route::get('entrepreneurship','Entrepreneur\EntrepreneurshipController@index');
    Route::get('entrepreneurship/{id}','Entrepreneur\EntrepreneurshipController@show');
    Route::put('entrepreneurship/{id}','Entrepreneur\EntrepreneurshipController@update');

    // Viriera del emprendedor
    Route::get('entrepreneurship-window/{convocation_form_id}', 'Entrepreneur\EntrepreneurshipWindowController@show');
    Route::post('entrepreneurship-window/{convocation_form_id}', 'Entrepreneur\EntrepreneurshipWindowController@update');

    // Virieras de todos los emprendedores, visibles desde OTROS EMPRENDIMIENTOS
    Route::get('entrepreneurship-windows', 'Entrepreneur\EntrepreneurshipWindowsController@index');
    Route::get('entrepreneurship-windows/{slug}', 'Entrepreneur\EntrepreneurshipWindowsController@show');
    Route::get('entrepreneurship-windows/{slug}/generate-pdf', 'Entrepreneur\EntrepreneurshipWindowsController@generatePDF');

    Route::get('modules-pre-incubation/{id}','Entrepreneur\ModulesPreIncubationController@index');
    Route::get('modules-pre-incubation/module/{slug}/{convocation_form_id}','Entrepreneur\ModulesPreIncubationController@show');
    Route::get('modules-pre-incubation/pill/{slug}','Entrepreneur\ModulesPreIncubationController@showPill');

    // Tareas de los modulos
    Route::get('entrepreneurship-tasks/{module_pre_incubation_id}/{convocation_form_id}', 'Entrepreneur\ModulesPreIncubationTaskController@tasks');
    Route::post('entrepreneurship-tasks', 'Entrepreneur\ModulesPreIncubationTaskController@store');
    Route::post('entrepreneurship-tasks/view_module', 'Entrepreneur\ModulesPreIncubationTaskController@viewModule');

    Route::get('entrepreneurships','Entrepreneur\EntrepreneurshipsController@index');
    Route::get('entrepreneurships/{slug}','Entrepreneur\EntrepreneurshipsController@show');
});