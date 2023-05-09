<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

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

Route::get('/gioca', [GameController::class, 'gioca']);
Route::get('/itera', [GameController::class, 'itera']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
