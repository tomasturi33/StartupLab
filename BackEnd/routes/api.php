<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/index','IndexController@index');
Route::get('/index/convocation/{slug}','IndexController@convocationInfo');
Route::get('/login', function () {
        echo 'Login';
    });

Route::post('/login','AuthController@login');
Route::post('/password-recovery','AuthController@passwordRecovery');
Route::put('/password-reset/{url}','AuthController@passwordReset');
Route::post('/register','AuthController@register');
Route::get('/invitation/{url}','InvitationController@invitation');
Route::put('/invitation/{url}','InvitationController@register');

Route::get('/invitation-entrepreneurship/{url}','InvitationEntrepreneurshipController@invitation');
Route::put('/invitation-entrepreneurship/{url}','InvitationEntrepreneurshipController@register');

Route::get('provincias', 'ProvinciaController@index');
Route::get('provincias-localidades/{id}', 'ProvinciaController@show');
Route::get('completed-studies', 'Entrepreneur\CompletedStudiesController@index');

Route::get('academic-units', 'Entrepreneur\AcademicUnitsController@index');
Route::get('academic-units/{id}', 'Entrepreneur\AcademicUnitsController@show');

Route::get('entrepreneurship-stadium', 'Entrepreneur\EntrepreneurshipStadiumController@index');
Route::get('development-degree', 'Entrepreneur\DevelopmentDegreeController@index'); 

Route::get('vertical-works', 'Entrepreneur\VerticalWorksController@index');
Route::get('entrepreneurship-needs', 'Admin\EntrepreneurshipNeedController@index');

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout','AuthController@logout');

    //---------------------------------------------
    // El usuario logueado
    //---------------------------------------------
    Route::get('user','UserController@index');
    Route::get('user/{id}','UserController@show');
    Route::put('user/{id}','UserController@update');

    Route::get('check-my-convocations','Entrepreneur\ConvocationFormController@index');
    Route::get('edition/{id}','Entrepreneur\EditionController@show');

    Route::get('convocation','Entrepreneur\ConvocationFormController@index');
    Route::get('convocation/{id}','Entrepreneur\ConvocationFormController@show');
    Route::post('convocation','Entrepreneur\ConvocationFormController@store');
    Route::put('convocation/{id}','Entrepreneur\ConvocationFormController@update');
    Route::get('convocation/status/{id}','Entrepreneur\ConvocationFormController@checkStatus');
    Route::put('convocation/send-idea/{id}','Entrepreneur\ConvocationFormController@changeStatusToPending');

    //-----------------------------------------------------------
    //----RUTAS DE RECU8RSOS TRANSVERSALES ATODOS LOS ROLESS-----
    //-----------------------------------------------------------

    Route::group(['prefix' => 'other'], function () {

        //---------------------------------------------
        // Notas de los emprendimientos
        //---------------------------------------------
        Route::get('notes/{id}','EntrepreneurshipNotesController@index');
        Route::post('notes/{id}','EntrepreneurshipNotesController@store');
        Route::delete('notes/{id}','EntrepreneurshipNotesController@destroy');

    });

});