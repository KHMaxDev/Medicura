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
use App\Http\Controllers\DoctorController;

//contacto
use App\Http\Controllers\ContactoController;

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
Route::get('/registro=confirmado',[doctoresController::class,'exitoso'])->name('registro-exitoso');

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
Route::get('/admin/doctor/pdf', [doctoresController::class, 'doctoresPDF'])->name('doctores-admin-pdf');

//Paciente
Route::resource('paciente', pacienteController::class);
Route::get('/admin/paciente', [pacienteController::class, 'index'])->name('paciente-admin');

//Reportes
Route::get('/admin/reportes', [adminReporteController::class,'index']);
Route::get('/admin/solicitudes', [adminReporteController::class,'solicitudes'])->name('solicitudes');
Route::put('/admin/solicitudes/{id}', [DoctoresController::class, 'update'])->name('aprobar.update');
Route::delete('/admin/solicitudes/{id}', [DoctoresController::class, 'destroy'])->name('eliminar.destroy');


//Doctores

//Auth para doctor
/* 
#Meter dentro de esta función las rutas junto con el dashboard de doctor
#Aquí irán todas las rutas que hagan mención a la carpeta doctor-views

#Solamente des comenten el Route ubicado justo abajo de este comentario
*/


// Usuario-paciente
Route::resource('usuario', usuarioController::class);

// API Usuario-paciente
/*Route::apiResource('usuario', ApiController::class);
Route::get('/api/usuarios', [ApiController::class, 'index']);
Route::get('/api/usuarios/{id}', [ApiController::class, 'show']);
Route::patch('/api/usuarios/{id}', [ApiController::class, 'update']);
Route::post('/api/usuarios', [ApiController::class, 'store']);
Route::delete('/api/usuarios/{id}', [ApiController::class, 'destroy']);
*/
// usuarios-paciente
Route::put('admin/usuarios/editar/{id}', [UsuarioController::class, 'update']);

Route::get('/admin/usuarios/crear', [usuarioController::class, 'create'])->name('usuarios.create');

Route::get('/admin/usuarios/{id}', [usuarioController::class, 'show'])->name('usuarios.show');

Route::get('/admin/usuarios/destroy/{id}', action: [usuarioController::class, 'destroy'])->name('usuarios.destroy');

Route::delete('admin/usuarios/destroy/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

Route::get('/admin/usuarios/editar/{id}', [usuarioController::class, 'edit'])->name('usuarios.edit');

// Citas routes
Route::resource('citas', CitaController::class);
Route::apiResource('citas', ApiCitaController::class);

// Reportes
Route::resource('/reportes', reportesController::class);

// Medicamentos
Route::resource('medicamentos', MedicamentosController::class);
Route::apiResource('medicamentos', ApiMedicamentosController::class);


//Doctor Website :)
/*
Route::middleware(['auth', 'doctor'])->group(function () {
    Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor');
});
*/

// Citas views for Doctor
Route::middleware(['auth', 'doctor'])->group(function () {
    // Remove: Route::resource('citas', CitaController::class); // Conflicts with custom routes

    // Dashboard
    Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor');

    // Citas Routes
    Route::get('/doctor/citas', [CitaController::class, 'index'])->name('citas-doctor');
    Route::get('/doctor/citas/crear', [CitaController::class, 'create'])->name('citas-doctor-create');
    Route::post('/doctor/citas/crear', [CitaController::class, 'store'])->name('citas-doctor-store');
    Route::get('/doctor/citas/visualizar/{id}', [CitaController::class, 'show'])->name('citas-doctor-view');
    Route::get('/doctor/citas/editar/{id}', [CitaController::class, 'edit'])->name('citas-doctor-edit');
    Route::patch('/doctor/citas/editar/{id}', [CitaController::class, 'update'])->name('citas-doctor-update');
    Route::delete('/doctor/citas/{id}', [CitaController::class, 'destroy'])->name('citas-doctor-delete');
});

//contacto
Route::post('/contacto', [ContactoController::class, 'store']);
