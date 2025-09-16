<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\CandidaturaController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('empresas', EmpresaController::class);
Route::apiResource('vagas', VagaController::class);
Route::apiResource('candidaturas', CandidaturaController::class);

Route::get('usuarios/search', [UsuarioController::class, 'search']);