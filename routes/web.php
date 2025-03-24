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

//Pagina principal
Route::get('/', function () {
    return view('welcome');
});

//Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/registro', [doctoresController::class, 'registro'])->name('registro');
Route::post('/registro', [doctoresController::class, 'store'])->name('doctor-crear');

//Auth para admin
Route::middleware(['auth', 'admin'])->group(function () {
//admin index
Route::get('/admin', [admin::class, 'index'])->name('admin');
//Instituciones
Route::resource('instituciones', institucionesController::class);
Route::get('/admin/instituciones', [institucionesController::class, 'index'])->name('instituciones-admin');
Route::get('/admin/instituciones/crear', [institucionesController::class, 'create'])->name('instituciones-admin-crear');
Route::post('/admin/instituciones/crear', [InstitucionesController::class, 'store']);
Route::delete('/admin/instituciones/{id}', [InstitucionesController::class, 'destroy'])->name('instituciones-admin-delete');
Route::get('/admin/instituciones/editar/{id}', [institucionesController::class, 'edit'])->name('instituciones-admin-edit');
Route::patch('/admin/instituciones/editar/{id}', [institucionesController::class, 'update'])->name('instituciones-admin-update');
Route::get('/admin/instituciones/visualizar/{id}', [institucionesController::class, 'show'])->name('instituciones-admin-visualizar');
Route::get('/admin/instituciones/pdf', [institucionesController::class, 'PDF'])->name('instituciones-admin-pdf');
//Paciente
Route::resource('paciente', pacienteController::class);
Route::get('/admin/paciente', [pacienteController::class, 'index'])->name('paciente-admin');

Route::resource('/admin/reportes', adminReporteController::class);

Route::get('/admin/doctor', [doctoresController::class, 'index'])->name('doctor-admin');
});

//Auth para doctor
/* 
Route::middleware(['auth', 'doctor'])->group(function () {
    Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor.dashboard');
});
*/
