<?php

use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/Login-Medico', function () {
    return view('LoginRegistar.loginMedico');
});

Route::get('/Login-Paciente', function () {
    return view('LoginRegistar.loginPaciente');
});

Route::get('/Registar-Medico', function () {
    return view('LoginRegistar.registarMedico');
});


Route::get('/Registar-Paciente', function () {
    return view('LoginRegistar.registarPaciente');
});

Route::post('/Login-Medico', [MedicoController::class, 'login'])->name('loginMedico');
Route::post('/Login-Paciente', [PacienteController::class, 'login'])->name('loginPaciente');
Route::post('/Registar-Medico', [MedicoController::class, 'registar'])->name('registarMedico');
Route::post('/Registar-Paciente', [PacienteController::class, 'registar'])->name('registarPaciente');
