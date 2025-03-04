<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\Passwords\CreateController;
use App\Http\Controllers\Passwords\DestroyController;
use App\Http\Controllers\Passwords\IndexController;
use App\Http\Controllers\Passwords\StoreController;
use App\Http\Controllers\Passwords\ShowController;
use App\Http\Controllers\Passwords\UpdateController;
use Illuminate\Support\Facades\Auth;
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
Route::get('{page}',MainController::class)->where('page', '.*');

/*Route::get('/{any?}', function () {
    //return view('layouts.app')->where('any', '.*');
    return view('layouts.app');
});
Route::get('/passwords/{any?}', function () {
    //return view('layouts.app')->where('any', '.*');
    return view('layouts.app');
});
Route::get('/folders/{any?}', function () {
    //return view('layouts.app')->where('any', '.*');
    return view('layouts.app');
});
Route::get('/users/{any?}', function () {
    //return view('layouts.app')->where('any', '.*');
    return view('layouts.app');
});
 Route::get('/users/{any?}/access', function () {
    //return view('layouts.app')->where('any', '.*');
    return view('layouts.app');
});
 Route::get('/passwords/{any?}/access', function () {
    //return view('layouts.app')->where('any', '.*');
    return view('layouts.app');
});*/

 Route::group(['prefix' => 'passwords', 'middleware' => 'sanctum'], function (){
       Route::get('/', IndexController::class)->name('passwords');
       Route::get('/create', CreateController::class);
       Route::post('/', StoreController::class);
        Route::get('/{id}',ShowController::class);
        Route::patch('/{id}',UpdateController::class);
        Route::delete('/{id}',DestroyController::class);
        Route::get('/{id}/access',\App\Http\Controllers\AccessUser\ShowController::class);
        Route::put('/{id}/access',\App\Http\Controllers\AccessUser\ShowController::class);
 });
Route::group(['prefix' => 'folders'], function (){
    Route::get('/create', App\Http\Controllers\Folders\CreateController::class);
    Route::post('/store', App\Http\Controllers\Folders\StoreController::class);
});
Route::group(['prefix' => 'users'], function (){
    Route::get('/', App\Http\Controllers\Users\IndexController::class)->name('users');
    Route::get('/create', App\Http\Controllers\Users\CreateController::class);
    Route::post('/', App\Http\Controllers\Users\StoreController::class);
    Route::get('/{id}', App\Http\Controllers\Users\ShowController::class);
    Route::patch('/{id}', App\Http\Controllers\Users\UpdateController::class);
    Route::delete('/{id}',App\Http\Controllers\Users\DestroyController::class);
    Route::get('/{id}/access',\App\Http\Controllers\Access\ShowController::class);
});



Auth::routes();




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
