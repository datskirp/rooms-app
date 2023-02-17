<?php

use App\Http\Controllers\Api\v1\RoomController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
Route::get('/', function () {
    return view('welcome');
});

*/

Route::prefix('login/google')->name('google.')->group(function () {
    Route::get('', [LoginController::class, 'loginWithGoogle'])->name('login');
    Route::get('callback', [LoginController::class, 'callbackFromGoogle'])->name('callback');
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

//Route::post('/rooms', [RoomController::class, 'create']);

/* vue */
Route::any('{all}', function () {
    $user = Auth::user();
    return view('vue')->with(compact('user'));
})->where(['all' => '.*']);
