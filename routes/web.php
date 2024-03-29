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
    Route::resource('leads','ContactsController')->names('lead');
    Route::post('leads/import','ContactsController@import')->name('lead.import');
    Route::get('leads/export/model','ContactsController@exportModel' )->name('lead.export.model');
    Route::any('leads-search','ContactsController@search')->name('lead.search');
    Route::resource('roles','RoleController')->names('role');
    Route::resource('customers','CustomerController')->names('customer');
    Route::any('customers-search','CustomerController@search')->name('customer.search');
    Route::get('receitaws','ReceitawsController@index')->name('receitaws.index');
    Route::resource('campaign','CampaignController')->names('campaign');
    Route::any('campaign-search','CampaignController@search')->name('campaign.search');
    Route::any('campaign-search-create','CampaignController@searchCreate')->name('campaign.search.create');
});

Route::get('envio-email', function (){
    //return new \App\Mail\newMailCRMller();
    \Illuminate\Support\Facades\Mail::send(new \App\Mail\newMailCRMller());
});
