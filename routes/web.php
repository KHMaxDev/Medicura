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
use App\Models\Usuario;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\Api\CitaController as ApiCitaController;
use App\Http\Controllers\reportesController;
use App\Http\Controllers\MedicamentosController;
use App\Http\Controllers\Api\ApiMedicamentosController;

Route::get('/', function () {
    return view('welcome'); // O cualquier otra vista que consideres como la principal
})->name('principal');

//Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/registro', [doctoresController::class, 'registro'])->name('registro');
Route::post('/registro', [doctoresController::class, 'store'])->name('doctor-crear');
Route::get('/registro=confirmado',[doctoresController::class,'exitoso'])->name('registro-exitoso');

//Auth para admin
Route::middleware(['auth', 'admin'])->group(function () {
//admin index
Route::get('/admin', [admin::class, 'index'])->name('admin');
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

//Usuario-paciente
Route::resource('usuario', usuarioController::class);
Route::get('/admin/usuarios', [usuarioController::class, 'index'])->name('usuarios.index');
Route::get('/admin/usuarios/crear', [usuarioController::class, 'create'])->name('usuarios.crear');
Route::post('/admin/usuarios/crear', [usuarioController::class, 'store'])->name('usuarios.store');
Route::delete('/admin/usuarios/{id}', [usuarioController::class, 'destroy'])->name('usuarios.delete');
Route::get('/admin/usuarios/editar/{id}', [usuarioController::class, 'edit'])->name('usuarios.edit');
Route::patch('/admin/usuarios/editar/{id}', [usuarioController::class, 'update'])->name('usuarios.update');
Route::get('/admin/usuarios/visualizar/{id}', [usuarioController::class, 'show'])->name('usuarios.show');

//API Usuario-paciente 
Route::apiResource('usuario', ApiController::class);
Route::get('/api/usuarios', [ApiController::class, 'index']);
Route::get('/api/usuarios/{id}', [ApiController::class, 'show']);
Route::patch('/api/usuarios/{id}', [ApiController::class, 'update']);
Route::post('/api/usuarios', [ApiController::class, 'store']);
Route::delete('/api/usuarios/{id}', [ApiController::class, 'destroy']);

// usuarios-paciente
Route::put('admin/usuarios/editar/{id}', [UsuarioController::class, 'update']);
Route::get('/admin/usuarios/crear', [usuarioController::class, 'create'])->name('usuarios.create');
Route::get('/admin/usuarios/{id}', [usuarioController::class, 'show'])->name('usuarios.show');
Route::get('/admin/usuarios/destroy/{id}', action: [usuarioController::class, 'destroy'])->name('usuarios.destroy');
Route::delete('admin/usuarios/destroy/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
Route::get('/admin/usuarios/editar/{id}', [usuarioController::class, 'edit'])->name('usuarios.edit');

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

// Medicamentos web routes
Route::resource('medicamentos', MedicamentosController::class);
Route::get('/admin/medicamentos', [MedicamentosController::class, 'index'])->name('medicamentos-admin');
Route::get('/admin/medicamentos/crear', [MedicamentosController::class, 'create'])->name('medicamentos-admin-crear');
Route::post('/admin/medicamentos/crear', [MedicamentosController::class, 'store'])->name('medicamentos.store');
Route::delete('/admin/medicamentos/{id}', [MedicamentosController::class, 'destroy'])->name('medicamentos-admin-delete');
Route::get('/admin/medicamentos/editar/{id}', [MedicamentosController::class, 'edit'])->name('medicamentos-admin-edit');
Route::patch('/admin/medicamentos/editar/{id}', [MedicamentosController::class, 'update'])->name('medicamentos-admin-update');
Route::get('/admin/medicamentos/view/{id}', [MedicamentosController::class, 'show'])->name('medicamentos-admin-view');

// Medicamentos API routes
Route::apiResource('medicamentos', ApiMedicamentosController::class);
Route::get('/api/medicamentos', [ApiMedicamentosController::class, 'index']);
Route::get('/api/medicamentos/{id}', [ApiMedicamentosController::class, 'show']);
Route::patch('/api/medicamentos/{id}', [ApiMedicamentosController::class, 'update']);
Route::post('/api/medicamentos', [ApiMedicamentosController::class, 'store']);
Route::delete('/api/medicamentos/{id}', [ApiMedicamentosController::class, 'destroy']);

