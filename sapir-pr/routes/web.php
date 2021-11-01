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

// Route::get('/', function () {
//     return view('welcome', ['vaderus' => ['Health', 'Strength']]);
// });

Route::get('/', 'App\Http\Controllers\BattleController@load')->name('home');
Route::post('/start', 'App\Http\Controllers\BattleController@start')->name('start');  
Route::post('/continue', 'App\Http\Controllers\BattleController@continue')->name('continue');
