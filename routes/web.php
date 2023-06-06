<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ApOPController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AssistantController;
use App\Http\Controllers\DentistController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserchategoryController;
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
/*
Route::get('/ap', 'App\Http\Controllers\PatientController@show');

Route::get('/', function () {
    return view('welcome');
});

*/
Route::get('/', function () {
    return view('login');
});

Route::get('/home', 'App\Http\Controllers\MainController@index');
Route::get('/searchap', 'App\Http\Controllers\MainController@appointments');
Route::get('/searchp', 'App\Http\Controllers\MainController@patients');
Route::view('/addap', 'newap');
Route::post('/addap', 'App\Http\Controllers\MainController@newap');
Route::view('/addp', 'newp');
Route::post('/addp', 'App\Http\Controllers\MainController@newp');
Route::get('/op', 'App\Http\Controllers\MainController@operation');


Route::post('login', 'App\Http\Controllers\MainController@login');
