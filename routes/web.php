<?php
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('index'); });

Route::get('/Login-Medico', function () { return view('LoginRegistar.loginMedico'); });
Route::get('/Login-Paciente', function () { return view('LoginRegistar.loginPaciente'); });

Route::get('/Registar-Medico-User', function () { return view('LoginRegistar.registarMedicoUser'); });
Route::get('/Registar-Medico', function () { return view('LoginRegistar.registarMedico'); });
Route::get('/Registar-Medico-UnidadesMedicas', function () { return view('LoginRegistar.registarMedicoUnidadesMedicas'); });

Route::get('/Registar-Paciente-User', function () { return view('LoginRegistar.registarPacienteUser'); });
Route::get('/Registar-Paciente', function () { return view('LoginRegistar.registarPaciente'); });

Route::prefix('Medico')->group(function () {
    Route::get('/Dashboard', function () { return view('Medico.dashboardMedico'); })->name('MedicoDashboard');
    
    Route::get('/Inserir-Baixas-temporarias', [MedicoController::class, 'showUnidadesMedicasForm'])->name('inserirBaixas');
    Route::get('/Baixas-temporarias', [MedicoController::class, 'verBaixasTemporarias'])->name('baixas');
    Route::get('/api/paciente/{cartao_cidadao}', [MedicoController::class, 'getPaciente']);
    Route::get('/Editar-Baixa/{id}', [MedicoController::class, 'verEditarBaixa'])->name('verEditarBaixa');
    
    Route::post('/dashboard', [MedicoController::class, 'dashboardMedico'])->name('dashboardMedico');
    Route::post('/Baixas-temporarias', [MedicoController::class, 'insertBaixasMedicas'])->name('insertBaixasMedicas');
    Route::post('/Editar-Baixa/{id}', [MedicoController::class, 'editarBaixa'])->name('EditarBaixa');
    Route::post('/Eliminar-Baixa/{id}', [MedicoController::class, 'eliminarBaixa'])->name('eliminarBaixa');
});


Route::post('/Login-Medico', [MedicoController::class, 'login'])->name('loginMedico');
Route::post('/Login-Paciente', [PacienteController::class, 'login'])->name('loginPaciente');

Route::post('/Registar-Medico-User', [MedicoController::class, 'storeUser'])->name('registarMedicoUser');
Route::post('/Registar-Medico', [MedicoController::class, 'storeMedico'])->name('registarMedico');
Route::post('/Registar-Medico-UnidadesMedicas', [MedicoController::class, 'registar'])->name('registarMedicoUnidadesMedicas');

Route::post('/Registar-Paciente-User', [PacienteController::class, 'storeUser'])->name('registarPacienteUser');
Route::post('/Registar-Paciente', [PacienteController::class, 'registar'])->name('registarPaciente');