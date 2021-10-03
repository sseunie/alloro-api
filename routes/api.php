<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IncidencesController;
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

Route::post('/login', [AuthController::class, 'login']);

//Route::get('/notifications', [AuthController::class, 'login']);

Route::get('/residences', [IncidencesController::class, 'getResidences']);
Route::get('/incidenceAreas', [IncidencesController::class, 'getIncidenceAreas']);

//Route::middleware('auth:sanctum')->get('/users/{id}', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/incidences', [IncidencesController::class, 'getIncidences']);
Route::middleware('auth:sanctum')->get('/incidences/{id}', [IncidencesController::class, 'getIncidence']);
Route::middleware('auth:sanctum')->post('/incidences', [IncidencesController::class, 'createIncidence']);
//Route::middleware('auth:sanctum')->get('/absences', [AuthController::class, 'login']);
//Route::middleware('auth:sanctum')->post('/absences', [AuthController::class, 'login']);
