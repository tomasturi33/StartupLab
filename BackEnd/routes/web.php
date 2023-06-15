<?php

use Illuminate\Support\Facades\Route;
use App\Mail\InvitationMailable;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Notifications\NewTaskUploaded;
use App\Notifications\NewTaskCorrection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/notification', function () {
    $user = User::find(11);
    $user->notify(new NewTaskUploaded($user, 'Idea Tomas', 'Modulo 3'));

    return  config('app.name');
});

Route::get('/corrected-task', function () {
    $user = User::find(11);
    $user->notify(new NewTaskCorrection($user, 'Modulo 3'));

    return  config('app.name');
});



Route::get('/send-mail', function () {

    $correo = new InvitationMailable('tomas turi', 'url_del_video');
    Mail::to('tomasturi@gmail.com')->send($correo);

    return 'mensaje enviado';
    
});

Route::get('generate-pdf/{id}','Admin\ConvocationFormController@generatePDF');