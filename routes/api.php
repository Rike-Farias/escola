<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlunoController;
use App\Http\Controllers\Api\MotoristaController;
use App\Http\Controllers\Api\MonitoraController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// 1 - CRUD DOS ALUNOS

Route::get('alunos', [AlunoController::class, 'index']);
Route::get('alunos/{id}', [AlunoController::class, 'show']);
Route::post('alunos', [AlunoController::class, 'store']);
Route::put('alunos/{id}', [AlunoController::class, 'update']);
Route::delete('alunos/{id}', [AlunoController::class, 'destroy']);

// 2 - CRUD DOS MOTORISTAS

Route::get('motoristas', [MotoristaController::class, 'index']);
Route::get('motoristas/{id}', [MotoristaController::class,'show']);
Route::post('motoristas', [MotoristaController::class,'store']);
Route::put('motoristas/{id}', [MotoristaController::class, 'update']);
Route::delete('motoristas/{id}', [MotoristaController::class, 'destroy']);

// 2 - CRUD DAS MONITORAS

Route::get('monitoras', [MonitoraController::class, 'index']);
Route::get('monitoras/{id}', [MonitoraController::class,'show']);
Route::post('monitoras', [MonitoraController::class,'store']);
Route::put('monitoras/{id}', [MonitoraController::class, 'update']);
Route::delete('monitoras/{id}', [MonitoraController::class, 'destroy']);

// 2 OUTRAS ROTAS

Route::get('alunos/importar', [AlunoController::class, 'importar']);

