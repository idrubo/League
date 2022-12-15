<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\teamsC;
use App\Http\Controllers\playersC;
use App\Http\Controllers\gamesC;

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

Route::get  ('/', [teamsC::class, 'manage']);
Route::post ('/', [teamsC::class, 'manage']);

Route::get  ('/teams/', [teamsC::class, 'manage']);
Route::post ('/teams/', [teamsC::class, 'manage']);

Route::get  ('/players/', [playersC::class, 'manage']);
Route::post ('/players/', [playersC::class, 'manage']);

Route::get  ('/games/', [gamesC::class, 'manage']);
Route::post ('/games/', [gamesC::class, 'manage']);

