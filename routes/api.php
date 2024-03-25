<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DegreeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Candidate routes
Route::get('/candidates', [CandidateController::class, 'index']);
Route::post('/candidates', [CandidateController::class, 'store']);
Route::get('/candidates/{id}', [CandidateController::class, 'show']);
Route::put('/candidates/{id}', [CandidateController::class, 'update']);
Route::delete('/candidates/{id}', [CandidateController::class, 'destroy']);

// Degree routes
Route::get('/degrees', [DegreeController::class, 'index']);
Route::post('/degrees', [DegreeController::class, 'store']);
Route::get('/degrees/{id}', [DegreeController::class, 'show']);
Route::put('/degrees/{id}', [DegreeController::class, 'update']);
Route::delete('/degrees/{id}', [DegreeController::class, 'destroy']);

