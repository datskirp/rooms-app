<?php

use App\Http\Controllers\Api\v1\UserAnswerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\RoomController;

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
// TODO: is this controller RESTful? room/open/{link}
Route::controller(RoomController::class)->group(function () {
    Route::get('/room/{id}', 'show');
    Route::post('/rooms', 'create');
    //Route::patch('/resume/{resume_id}', 'updateResume');
    //Route::delete('/resume/{resume_id}', 'deleteResume');
    Route::get('/room/open/{link}/user/{email}', 'showByLink');
});

Route::controller(UserAnswerController::class)->group(function () {
    Route::post('/answers', 'create');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
