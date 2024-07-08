<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserConttroller;
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

Route::get('users', [UserConttroller::class , 'index'] );
Route::get('users/{id}', [UserConttroller::class , 'show'] );
Route::post('addNew', [UserConttroller::class , 'store'] );
// routes/api.php



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::put('users/{id}', [AuthController::class, 'updateUser']); // Route pour la mise à jour de l'utilisateur
Route::delete('users/{id}', [AuthController::class, 'deleteUser']); // Route pour la suppression de l'utilisateur

//vehicule
Route::get('listeVehicule' , [UserConttroller::class, 'viewVehicule']);
route::delete('cardelete/{id}',[UserConttroller::class, 'delete']);
Route::post('addCar',[UserConttroller::class, 'StoreUpload']);
