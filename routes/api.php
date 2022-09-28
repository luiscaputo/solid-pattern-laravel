<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Cidades
Route::get('/cidade', [CityController::class, 'index']);
Route::post('/cidade/create', [CityController::class, 'store']);
Route::put('/cidade/update/{id}', [CityController::class, 'update']);
Route::get('/cidade/{id}', [CityController::class, 'show']);
Route::delete('/cidade/delete/{id}', [CityController::class, 'destroy']);

// Postos
Route::get('/posto', [PostController::class, 'index']);
Route::post('/posto/create', [PostController::class, 'store']);
Route::put('/posto/update/{id}', [PostController::class, 'update']);
Route::get('/posto/{id}', [PostController::class, 'show']);
Route::delete('/posto/delete/{id}', [PostController::class, 'destroy']);


