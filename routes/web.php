<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::namespace('\App\Http\Controllers')->group(function() {
    Route::get('/', 'IndexController@index')->name('index')->name('index');
    Route::post('user/register', 'UserController@register')->name('user.register');
    Route::middleware(['token'])->group(function() {
        Route::get('user/{user:token}', 'UserController@show')->name('user.show');
        Route::post('user/{user:id}/generateNewToken', 'UserController@generateNewToken')->name('user.new-token');
        Route::post('user/{user:id}/deactivateToken', 'UserController@deactivateToken')->name('user.deactivate-token');
        Route::post('user/{user:id}/imFeelingLucky', 'UserController@imFeelingLucky')->name('user.im-feeling-lucky');
        Route::get('user/{user:id}/imFeelingLucky/history', 'UserController@imFeelingLuckyHistory')->name('user.im-feeling-lucky->history');
    });
});
