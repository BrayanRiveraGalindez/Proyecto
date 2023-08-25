<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthUserAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthUserAPIController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);

Route::group(['middleware' => ['auth:sanctum']], function () { //Si esta logeado permite hacer el crud de lo contrario no

	//ruta protegidas
	Route::post('/logout', [AuthUserAPIController::class, 'logout']);
	Route::get('/profile', [AuthUserAPIController::class, 'profile']);

	Route::group(['prefix'=> 'users','controller'=>UserController::class],function(){
		Route::get('/','index');
		Route::post('/','store');
		Route::get('/{user}','show');
		Route::put('/{user}','update');
		Route::delete('/{user}','destroy');
	});

	Route::group(['prefix'=> 'categories','controller'=>CategoryController::class],function(){
		Route::get('/','index');
		Route::post('/','store');
		Route::put('/{categories}','update');
		Route::delete('/{categories}','destroy');
		Route::get('/{categories}','show');
	});

	Route::group(['prefix'=> 'products','controller'=>ProductController::class],function(){
		Route::get('/','index');
		Route::post('/','store');
		Route::put('/{product}','update'); //Falta que actualice
		Route::delete('/{product}','destroy');
		Route::get('/{product}','show');
	});
});
