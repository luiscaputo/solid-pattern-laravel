<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsersControllers\AllUsersController;
use App\Http\Controllers\UsersControllers\CreateUserController;
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

// Users Route
Route::post('/users-create', [CreateUserController::class, 'handle']);
Route::get('/users-all', [AllUsersController::class, 'handle']);
