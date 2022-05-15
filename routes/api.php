<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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

Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category', [CategoryController::class, 'store']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
Route::patch('/category/{id}', [CategoryController::class, 'update']);
Route::post('/category/{id}', [CategoryController::class, 'attach']);
Route::get('/category/{id}/radios', [CategoryController::class, 'listMembers']);
Route::delete('/category/{id}/radios/{radioId}', [CategoryController::class, 'detach']);
