<?php

use App\Http\Controllers\InformationController;
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
    // return view('welcome');
    echo "Hello World";
});
Route::resource('information', InformationController::class);
Route::get('/allinformation',[InformationController::class,'new']);
Route::post('/saveinformation',[InformationController::class,'createInfo']);
