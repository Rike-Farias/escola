<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlunoController;
use App\Http\Controllers\Api\MotoristaController;
use App\Http\Controllers\Api\MonitoraController;
use App\Http\Controllers\Api\OnibusController;
use App\Http\Controllers\Api\ManutencaoController;
use App\Http\Controllers\Api\LavagemVeiculoController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// 1 - CRUD DOS ALUNOS

Route::get('alunos', [AlunoController::class, 'index']);
Route::get('/alunos/count', [AlunoController::class, 'count']);
Route::get('/alunos/amount-by-route', [AlunoController::class, 'amountStudentsByRoute']);
Route::post('/alunos/students-by-route', [AlunoController::class, 'studentsByRoute']);
Route::post('/alunos/students-by-class', [AlunoController::class, 'studentsByClass']); 
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

// 3 - ONIBUS ESCOLARES
Route::get('onibus', [OnibusController::class, 'index']);
Route::get('onibus/{id}', [OnibusController::class,'show']);
Route::post('onibus', [OnibusController::class,'store']);
Route::put('onibus/{id}', [OnibusController::class, 'update']);
Route::delete('onibus/{id}', [OnibusController::class, 'destroy']);

// 4 - MANUTENÇÕES

Route::get('manutencoes', [ManutencaoController::class, 'index']);
Route::get('manutencoes/{id}', [ManutencaoController::class,'show']);
Route::post('manutencoes', [ManutencaoController::class,'store']);
Route::put('manutencoes/{id}', [ManutencaoController::class, 'update']);
Route::delete('manutencoes/{id}', [ManutencaoController::class, 'destroy']);

// 5 - Lavagens

Route::get('lavagens', [LavagemVeiculoController::class, 'index']);
Route::get('lavagens/{id}', [LavagemVeiculoController::class,'show']);
Route::post('lavagens', [LavagemVeiculoController::class,'store']);
Route::put('lavagens/{id}', [LavagemVeiculoController::class, 'update']);
Route::delete('lavagens/{id}', [LavagemVeiculoController::class, 'destroy']);

// 6 - Filtros de busca
Route::post('/alunos/buscar', [AlunoController::class, 'searchStudents']);


// 7 OUTRAS ROTAS
// Route::get('alunos/importar', [AlunoController::class, 'importar']);

