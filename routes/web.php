<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware'=> "web"], function(){
    /*
    Route::view('reg', 'reg');
    Route::post('reg', 'App\Http\Controllers\MainController@reg');
    */

    //Login/kezdőlap
    Route::view('login', 'login');
    Route::post('login', 'App\Http\Controllers\MainController@login');
    Route::get('logout', 'App\Http\Controllers\MainController@logout');
    Route::view('/', 'login');
    Route::post('/', 'App\Http\Controllers\MainController@login');
    Route::get('/home', 'App\Http\Controllers\MainController@index');
    //______________________________________________________________________________
    //Időpontok
    Route::get('/searchap', 'App\Http\Controllers\MainController@appointments');
    Route::post('searchap', 'App\Http\Controllers\MainController@searchap');
    Route::get('/searchp', 'App\Http\Controllers\MainController@patients');
    Route::post('/searchp', 'App\Http\Controllers\MainController@searchp');
    Route::get('/addap', 'App\Http\Controllers\MainController@app');
    Route::post('/addap', 'App\Http\Controllers\MainController@newap');
    Route::get('/infap/{id}', 'App\Http\Controllers\MainController@infap')->name('infap');
    //Route::view('/infap/{id}', 'appointment');
    Route::post('/infap/{id}/pay', 'App\Http\Controllers\MainController@pay')->name('pay');
    Route::post('/infap/{id}/otoa', 'App\Http\Controllers\MainController@otoa')->name('otoa');
    //______________________________________________________________________________
    //Beavatkozások
    Route::get('/op', 'App\Http\Controllers\MainController@op');
    Route::get('/delop/{id}', 'App\Http\Controllers\MainController@delop');
    Route::get('/edop/{id}', 'App\Http\Controllers\MainController@edop');
    Route::post('edop', 'App\Http\Controllers\MainController@upop');
    Route::view('/addo', 'newo');
    Route::post('/addo', 'App\Http\Controllers\MainController@newo');
    //______________________________________________________________________________
    //Páciensek
    Route::view('/addp', 'newp');
    Route::post('/addp', 'App\Http\Controllers\MainController@newp');
    Route::get('/edp/{id}', 'App\Http\Controllers\MainController@edp');
    Route::post('edp', 'App\Http\Controllers\MainController@upp');
    Route::get('/infp/{id}', 'App\Http\Controllers\MainController@infp');
});
