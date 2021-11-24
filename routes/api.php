<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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
Route::get("/test",function(){
    //return "Hay";
    $users = array("name"=>"Mg Mg", "email"=>"mgmg@gmail.com");
    return $users;
});

Route::post("/user", [UserController::class,'create']);
Route::get("users",[UserController::class,'index'])->middleware('auth:api');

Route::post('login',[UserController::class,'login']);

Route::get("/redirect",[UserController::class,'redirect'])->name('login');



Route::group(['middleware'=>"auth:api"], function(){

    Route::get('posts',[PostController::class, 'index']);
    Route::post('post',[PostController::class, 'create']);
    Route::post('posts/{id}',[PostController::class, 'update']);
    Route::get('posts/{id}',[PostController::class, 'destroy']);

});
