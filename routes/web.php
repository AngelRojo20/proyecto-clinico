<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
}) ->name('home');

Route::resource('pacientes', App\Http\Controllers\PacienteController::class);
Route::resource('tecnicos', App\Http\Controllers\TecnicoController::class);
Route::resource('muestras', App\Http\Controllers\MuestraController::class);
