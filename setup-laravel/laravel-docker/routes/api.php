<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\CandidaturaController;

Route::apiResource('empresas', EmpresaController::class);
Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('vagas', VagaController::class);
Route::apiResource('candidaturas', CandidaturaController::class);

// Rota de busca de usuários com filtro
Route::get('usuarios/busca', [UsuarioController::class, 'search']);
