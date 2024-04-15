<?php

use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
});
Route::get('/symlink', function () {
    Artisan::call('storage:link');
});

Route::get('{any}', function(){
       return File::get(public_path() . '/index.html');
})->where('any', '.*'); */

Route::get('{any}', function(){
    return view('welcome');
})->where('any', '.*');
