<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppareilController;
use App\Http\Controllers\AssistantController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\TraitementController;
use App\Http\Controllers\UserDfController;
use App\Http\Controllers\AdminController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//appareils
Route::get('appareils',[AppareilController::class, 'index']);
Route::post('appareils',[AppareilController::class, 'store']);
Route::get('appareils/{id}',[AppareilController::class, 'show']);
Route::get('appareils/{id}/edit',[AppareilController::class, 'edit']);
Route::put('appareils/{id}/edit',[AppareilController::class, 'update']);
Route::delete('appareils/{id}/delete',[AppareilController::class, 'destory']);

//assistants
Route::get('/assistants',[AssistantController::class, 'index']);
Route::post('assistants',[AssistantController::class, 'store']);
Route::get('assistants/{id}',[AssistantController::class, 'show']);
Route::get('assistants/{id}/edit',[AssistantController::class, 'edit']);
Route::put('assistants/{id}/edit',[AssistantController::class, 'update']);
Route::delete('assistants/{id}/delete',[AssistantController::class, 'destory']);

//devis
Route::get('devis',[DevisController::class, 'index']);
Route::post('devis',[DevisController::class, 'store']);
Route::get('devis/{id}',[DevisController::class, 'show']);
Route::get('devis/{id}/edit',[DevisController::class, 'edit']);
Route::put('devis/{id}/edit',[DevisController::class, 'update']);
Route::delete('devis/{id}/delete',[DevisController::class, 'destory']);

//factures
Route::get('factures',[FactureController::class, 'index']);
Route::post('factures',[FactureController::class, 'store']);
Route::get('factures/{id}',[FactureController::class, 'show']);
Route::get('factures/{id}/edit',[FactureController::class, 'edit']);
Route::put('factures/{id}/edit',[FactureController::class, 'update']);
Route::delete('factures/{id}/delete',[FactureController::class, 'destory']);

//rendez_vouses
Route::get('rendez_vouses',[RendezVousController::class, 'index']);
Route::post('rendez_vouses',[RendezVousController::class, 'store']);
Route::get('rendez_vouses/{id}',[RendezVousController::class, 'show']);
Route::get('rendez_vouses/{id}/edit',[RendezVousController::class, 'edit']);
Route::put('rendez_vouses/{id}/edit',[RendezVousController::class, 'update']);
Route::delete('rendez_vouses/{id}/delete',[RendezVousController::class, 'destory']);

//salles
Route::get('salles',[SalleController::class, 'index']);
Route::post('salles',[SalleController::class, 'store']);
Route::get('salles/{id}',[SalleController::class, 'show']);
Route::get('salles/{id}/edit',[SalleController::class, 'edit']);
Route::put('salles/{id}/edit',[SalleController::class, 'update']);
Route::delete('salles/{id}/delete',[SalleController::class, 'destory']);

//traitements
Route::get('traitements',[TraitementController::class, 'index']);
Route::post('traitements',[TraitementController::class, 'store']);
Route::get('traitements/{id}',[TraitementController::class, 'show']);
Route::get('traitements/{id}/edit',[TraitementController::class, 'edit']);
Route::put('traitements/{id}/edit',[TraitementController::class, 'update']);
Route::delete('traitements/{id}/delete',[TraitementController::class, 'destory']);

//user_dfs
Route::get('user_dfs',[UserDfController::class, 'index']);

//admins
Route::get('admins',[AdminController::class, 'index']);
