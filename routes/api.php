<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserConttroller;
use Illuminate\Support\Facades\Route;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::put('/users/{id}/status', [AuthController::class, 'updateStatus']);
Route::get('users', [SuperAdminController::class , 'index'] );
Route::get('users/{id}', [SuperAdminController::class , 'show'] );
Route::post('addNew', [SuperAdminController::class , 'store'] );
// routes/api.php



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::put('users/{id}', [AuthController::class, 'updateUser']); // Route pour la mise à jour de l'utilisateur
Route::delete('usersDelete/{id}', [AuthController::class, 'deleteUser']); // Route pour la suppression de l'utilisateur

//vehicule
Route::get('listeVehicul', [SuperAdminController::class, 'viewVehicule']);
Route::delete('cardelete/{id}', [SuperAdminController::class, 'delete']);
Route::post('addCar', [SuperAdminController::class, 'StoreUpload']);
Route::post('updatCar/{id}', [SuperAdminController::class, 'updateCar']);
Route::get('listeVehicule/{id}', [SuperAdminController::class, 'showVehicule']);

//ajout des galerie des vehicules
Route::post('addGalerie/{id}', [SuperAdminController::class, 'InsertGalerie']);
Route::get('viewGalerie/{id}', [SuperAdminController::class, 'ViewGalerie']);
Route::delete('PhotoDelete/{id}', [SuperAdminController::class, 'deleteGalerie']);

//reservation

Route::post('reservation/{id}', [SuperAdminController::class, 'reserver']);
Route::post('/modifier_mot_de_passe', [SuperAdminController::class, 'ModMdp']);
//reservation bolo
Route::post('Reserver/{id}',[UserConttroller::class, 'reservation']);

Route::get('reservations/{id}', [SuperAdminController::class, 'afficheReservation']);
