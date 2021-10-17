<?php

use App\Http\Controllers\AbsencesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\IncidencesController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\UsersController;
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

Route::get('/notifications', [NotificationsController::class, 'getNotifications']);

Route::get('/residences', [IncidencesController::class, 'getResidences']);
Route::get('/incidenceAreas', [IncidencesController::class, 'getIncidenceAreas']);

Route::middleware('auth:sanctum')->get('/users/{id}', [UsersController::class, 'getUser']);
Route::middleware('auth:sanctum')->post('/users/{id}/room', [UsersController::class, 'setRoomInitialState']);
Route::middleware('auth:sanctum')->get('/roomState-date/{id}', [UsersController::class, 'getRoomInitialStateFinishDate']);
Route::middleware('auth:sanctum')->get('/users/{id}/inventory', [UsersController::class, 'userInventory']);

Route::middleware('auth:sanctum')->get('/incidences', [IncidencesController::class, 'getIncidences']);
Route::middleware('auth:sanctum')->get('/incidences/{id}', [IncidencesController::class, 'getIncidence']);
Route::middleware('auth:sanctum')->patch('/incidences/{id}', [IncidencesController::class, 'updateReadStatus']);
Route::middleware('auth:sanctum')->post('/incidences', [IncidencesController::class, 'createIncidence']);
Route::middleware('auth:sanctum')->post('/incidences/{id}/messages', [IncidencesController::class, 'createMessage']);

Route::middleware('auth:sanctum')->get('/absences', [AbsencesController::class, 'getAbsences']);
Route::middleware('auth:sanctum')->post('/absences', [AbsencesController::class, 'createAbsence']);

Route::middleware('auth:sanctum')->get('/reservationRoomTypes', [ReservationsController::class, 'roomTypes']);
Route::middleware('auth:sanctum')->get('/reservations', [ReservationsController::class, 'reservations']);
Route::middleware('auth:sanctum')->post('/reservations', [ReservationsController::class, 'newReservation']);
Route::middleware('auth:sanctum')->delete('/reservations/{id}', [ReservationsController::class, 'cancelReservation']);

Route::middleware('auth:sanctum')->get('/chats/{id}', [ChatsController::class, 'getChat']);
Route::middleware('auth:sanctum')->post('/chats/{id}', [ChatsController::class, 'createMessage']);
Route::middleware('auth:sanctum')->patch('/chats/{id}', [ChatsController::class, 'updateReadStatus']);
