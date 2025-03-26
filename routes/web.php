<?php
use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin;
use App\Http\Controllers\institucionesController;
use App\Http\Controllers\pacienteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\adminReporteController;
use App\Http\Controllers\doctoresController;
use App\Http\Controllers\registroController;
use App\Http\Controllers\usuarioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\Api\CitaController as ApiCitaController;
use App\Http\Controllers\reportesController;
use App\Http\Controllers\MedicamentosController;
use App\Http\Controllers\Api\ApiMedicamentosController;
use App\Http\Controllers\DashboardController;

// Pagina principal
Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/registro', [doctoresController::class, 'registro'])->name('registro');
Route::post('/registro', [doctoresController::class, 'store'])->name('doctor-crear');

// Auth para admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [admin::class, 'index'])->name('admin');
    
    // Instituciones
    Route::resource('instituciones', institucionesController::class);
    Route::get('/admin/instituciones/pdf', [institucionesController::class, 'PDF'])->name('instituciones-admin-pdf');
    
    // Pacientes
    Route::resource('paciente', pacienteController::class);
    Route::get('/admin/paciente', [pacienteController::class, 'index'])->name('paciente-admin');
    
    // Reportes
    Route::resource('/admin/reportes', adminReporteController::class);
    
    // Doctores
    Route::get('/admin/doctor', [doctoresController::class, 'index'])->name('doctor-admin');
});

// Usuario-paciente
Route::resource('usuario', usuarioController::class);

// API Usuario-paciente
Route::apiResource('usuario', ApiController::class);

// Citas
Route::resource('citas', CitaController::class);
Route::apiResource('citas', ApiCitaController::class);

// Reportes
Route::resource('/reportes', reportesController::class);

// Medicamentos
Route::resource('medicamentos', MedicamentosController::class);
Route::apiResource('medicamentos', ApiMedicamentosController::class);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

