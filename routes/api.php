<?php

use App\Http\Controllers\Api\Admin\CategoriaController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\EmpresaController;
use App\Http\Controllers\Api\Client\EmpresaController as ClientEmpresaController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\FrontController;
use App\Http\Controllers\Api\HookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('v1')->group(function () {
    // PUBLIC
   Route::get('/public/empresas/{quantity}',[FrontController::class,'empresas']);
   Route::get('/public/empresa/{id}',[FrontController::class,'empresa']);
   Route::get('/public/categorias',[FrontController::class,'categorias']);
   Route::get('/public/categorias/{id}',[FrontController::class,'categoria']);
 /*   Route::get('/public/{slug}',[FrontController::class,'categoria']); */

   //::auth
   Route::post('/auth/register',[AuthController::class,'register']);
   Route::post('/auth/login',[AuthController::class,'login']);

    // PRIVATE
    Route::group(['middleware' => 'auth:sanctum'], function () {
       //::auth
       Route::post('/auth/logout',[AuthController::class,'logout']);

       //::rol client
       Route::apiResource('/client/empresa',ClientEmpresaController::class);

       //::rol  admin
       Route::apiResource('/admin/user',UserController::class);
       Route::apiResource('/admin/categoria',CategoriaController::class);
       Route::post('/admin/categoria/image',[CategoriaController::class,'uploadImage']);
       Route::apiResource('/admin/empresa',EmpresaController::class);

       // Hook
       Route::patch('/hook/order',[HookController::class,'order']);
       Route::post('/hook/image',[HookController::class,'image']);
       Route::patch('/hook/deleteimage',[HookController::class,'deleteImage']);

    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   return $request->user();
});
