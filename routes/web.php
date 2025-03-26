<?php
use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Route;
/**
 * Controladores Admin
 * 
 */
use App\Http\Controllers\admin;
use App\Http\Controllers\institucionesController;
use App\Http\Controllers\pacienteController;
use App\Http\Controllers\AuthController;

//PDF
use App\Http\Controllers\adminReporteController;
use App\Http\Controllers\doctoresController;
use App\Http\Controllers\registroController;

/**
 * Controladores Doctor
 */
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

//Auth

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

//Doctores-view
Route::get('/admin/doctor', [doctoresController::class, 'index'])->name('doctor-admin');
//Instituciones-views
Route::resource('instituciones', institucionesController::class);
Route::get('/admin/instituciones', [institucionesController::class, 'index'])->name('instituciones-admin');
Route::get('/admin/instituciones/crear', [institucionesController::class, 'create'])->name('instituciones-admin-crear');
Route::post('/admin/instituciones/crear', [InstitucionesController::class, 'store']);
Route::delete('/admin/instituciones/{id}', [InstitucionesController::class, 'destroy'])->name('instituciones-admin-delete');
Route::get('/admin/instituciones/editar/{id}', [institucionesController::class, 'edit'])->name('instituciones-admin-edit');
Route::patch('/admin/instituciones/editar/{id}', [institucionesController::class, 'update'])->name('instituciones-admin-update');
Route::get('/admin/instituciones/visualizar/{id}', [institucionesController::class, 'show'])->name('instituciones-admin-visualizar');
//PDF
Route::get('/admin/instituciones/pdf', [institucionesController::class, 'PDF'])->name('instituciones-admin-pdf');

//Paciente
Route::resource('paciente', pacienteController::class);
Route::get('/admin/paciente', [pacienteController::class, 'index'])->name('paciente-admin');

//Reportes
Route::get('/admin/reportes', [adminReporteController::class,'index']);
Route::get('/admin/solicitudes', [adminReporteController::class,'solicitudes'])->name('solicitudes');
Route::put('/admin/solicitudes/{id}', [DoctoresController::class, 'update'])->name('aprobar.update');

});

//Auth para doctor
/* 
#Meter dentro de esta función las rutas junto con el dashboard de doctor
#Aquí irán todas las rutas que hagan mención a la carpeta doctor-views

#Solamente des comenten el Route ubicado justo abajo de este comentario
*/

//Route::middleware(['auth', 'doctor'])->group(function () {
//    Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor.dashboard');
//});

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


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

