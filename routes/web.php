<?php

use Illuminate\Support\Facades\Route;

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
    return view('client.welcome');
});

Auth::routes();
Route::get('/home',function (){
    return redirect(route('home'));
});

Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => 'auth'],function (){

    Route::get('/home', function() {
        return view('admin.home');
    })->name('home');

});

Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => 'auth'], function(){
    Route::resource('usuarios','UserController')->names('user')->parameters(['usuarios' => 'user']);
    Route::resource('leads','LeadsController')->names('lead')->parameters(['usuarios' => 'lead']);
    Route::post('leads/import','LeadsController@import')->name('lead.import');
    Route::get('leads/export/model','LeadsController@exportModel' )->name('lead.export.model');
    Route::resource('roles','RoleController')->names('role');

});

Route::get('envio-email', function (){
    //return new \App\Mail\newMailCRMller();
    \Illuminate\Support\Facades\Mail::send(new \App\Mail\newMailCRMller());
});
