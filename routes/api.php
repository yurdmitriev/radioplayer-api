<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RadioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/login/{provider}', [AuthController::class,'redirectToProvider']);
Route::get('/login/{provider}/callback', [AuthController::class,'handleProviderCallback']);

Route::get('/radio', [RadioController::class, 'index']);
Route::post('/radio', [RadioController::class, 'store']);
Route::patch('/radio/{id}', [RadioController::class, 'update']);
Route::get('/radio/{id}', [RadioController::class, 'show']);
Route::delete('/radio/{id}', [RadioController::class, 'destroy']);
