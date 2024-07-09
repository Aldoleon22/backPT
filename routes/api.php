<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
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

Route::get('users', [SuperAdminController::class , 'index'] );
Route::get('users/{id}', [SuperAdminController::class , 'show'] );
Route::post('addNew', [SuperAdminController::class , 'store'] );
// routes/api.php
Route::get('/userss', [UserController::class, 'index']);


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::put('users/{id}', [AuthController::class, 'updateUser']); // Route pour la mise à jour de l'utilisateur
Route::delete('users/{id}', [AuthController::class, 'deleteUser']); // Route pour la suppression de l'utilisateur

//vehicule
Route::get('listeVehicule' , [SuperAdminController::class, 'viewVehicule']);
Route::delete('cardelete/{id}',[SuperAdminController::class, 'delete']);
Route::post('addCar',[SuperAdminController::class, 'StoreUpload']);
Route::post('updatCar/{id}',[SuperAdminController::class, 'updateCar']);
//ajout des galerie des vehicules
Route::post('addGalerie/{id}',[SuperAdminController::class, 'InsertGalerie']);
Route::get('viewGalerie/{id}' , [SuperAdminController::class, 'ViewGalerie']);
Route::delete('PhotoDelete/{id}',[SuperAdminController::class, 'deleteGalerie']);


