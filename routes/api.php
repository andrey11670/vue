<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\Passwords\CreateController;
use App\Http\Controllers\Passwords\DestroyController;
use App\Http\Controllers\Passwords\IndexController;
use App\Http\Controllers\Passwords\ShowController;
use App\Http\Controllers\Passwords\StoreController;
use App\Http\Controllers\Passwords\UpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:sanctum'], function(){

Route::group(['prefix' => 'passwords'], function () {
    Route::match(['get' , 'post'],'/', IndexController::class);
    Route::middleware('admin')->get('/create', CreateController::class);
    Route::middleware('admin')->post('/', StoreController::class);
    // user может редактировать пароли кот он сам создал
    Route::get('/{id}',ShowController::class);
    Route::put('/{id}',UpdateController::class);
    Route::delete('/{id}',DestroyController::class);
    // только user может редактировать доступ к парлям кот он сам создал
    Route::get('/{id}/access',\App\Http\Controllers\AccessUser\ShowController::class);
    Route::put('/{id}/access',\App\Http\Controllers\AccessUser\UpdateController::class);
});

Route::group(['prefix' => 'folders'], function (){
    Route::get('/create', App\Http\Controllers\Folders\CreateController::class);
    Route::post('/', App\Http\Controllers\Folders\StoreController::class);
});

    Route::group(['prefix' => 'users'], function (){
        Route::get('/', App\Http\Controllers\Users\IndexController::class);
        Route::group(['middleware' => 'admin'], function () {
            Route::middleware('admin')->get('/create', App\Http\Controllers\Users\CreateController::class);
            Route::middleware('admin')->post('/', App\Http\Controllers\Users\StoreController::class);
            Route::middleware('admin')->get('/{id}', App\Http\Controllers\Users\ShowController::class);
            Route::middleware('admin')->put('/{id}', App\Http\Controllers\Users\UpdateController::class);
            Route::middleware('admin')->delete('/{id}',\App\Http\Controllers\Users\DestroyController::class);
            // Admin может брать любого пользователя и менять ему доступы к контенту
            Route::middleware('admin')->get('/{id}/access',\App\Http\Controllers\Access\ShowController::class);
            Route::middleware('admin')->put('/{id}/access',\App\Http\Controllers\Access\UpdateController::class);
        });
    });
});



