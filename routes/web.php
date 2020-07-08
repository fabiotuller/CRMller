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

    Route::post('leads/import','LeadsController@import')->name('leadsImport');
    Route::get('leads/index', 'LeadsController@index')->name('leads');
    Route::get('lead/edit/{lead}','LeadsController@show')->name('formEditLead');
    Route::put('lead/editar/{lead}','LeadsController@edit')->name('editLead');
    Route::delete('lead/destroy/{lead}','LeadsController@destroy')->name('destroyLead');

});




