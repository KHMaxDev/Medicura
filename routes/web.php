<?php
use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin;
use App\Http\Controllers\institucionesController;
use App\Http\Controllers\pacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\Api\CitaController as ApiCitaController;
use App\Http\Controllers\reportesController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',function(){
    return view('login.login');
});

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

//API Instituciones
//Route::apiResource('instituciones', ApiController::class);
//Route::get('/api/instituciones', [ApiController::class, 'index']);
//Route::get('/api/instituciones/{id}', [ApiController::class, 'show']);
//Route::patch('/api/instituciones/{id}', [ApiController::class, 'update']);
//Route::post('/api/instituciones', [ApiController::class, 'store']);
//Route::delete('/api/instituciones/{id}', [ApiController::class, 'destroy']);
//Paciente
Route::resource('paciente', pacienteController::class);
Route::get('/admin/paciente', [pacienteController::class, 'index'])->name('paciente-admin');

// Citas routes
Route::resource('citas', CitaController::class);
Route::get('/admin/citas', [CitaController::class, 'index'])->name('citas-admin');
Route::get('/admin/citas/crear', [CitaController::class, 'create'])->name('citas-admin-crear');
Route::post('/admin/citas/crear', [CitaController::class, 'store']);
Route::delete('/admin/citas/{id}', [CitaController::class, 'destroy'])->name('citas-admin-delete');
Route::get('/admin/citas/editar/{id}', [CitaController::class, 'edit'])->name('citas-admin-edit');
Route::patch('/admin/citas/editar/{id}', [CitaController::class, 'update'])->name('citas-admin-update');
Route::get('/admin/citas/view/{id}', [CitaController::class, 'show'])->name('citas-admin-view');

//API Citas
Route::apiResource('citas', ApiCitaController::class);
Route::get('/api/citas', [ApiCitaController::class, 'index']);
Route::get('/api/citas/{id}', [ApiCitaController::class, 'show']);
Route::patch('/api/citas/{id}', [ApiCitaController::class, 'update']);
Route::post('/api/citas', [ApiCitaController::class, 'store']);
Route::delete('/api/citas/{id}', [ApiCitaController::class, 'destroy']);

Route::resource('/reportes', reportesController::class);
