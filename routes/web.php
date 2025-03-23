<?php
use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin;
use App\Http\Controllers\institucionesController;
use App\Http\Controllers\pacienteController;
use App\Http\Controllers\usuarioController;
use App\Models\Usuario;



/* 
Route::get('/', function () {
  return view('admin-views.usuarios.index');
}); */


//Route::get('/', function () {
  //$usuarios = Usuario::all(['nombre', 'email', 'curp', '_id']);
  //return view('admin-views.usuarios.index', compact('usuarios'));
//});



use App\Http\Controllers\CitaController;
use App\Http\Controllers\Api\CitaController as ApiCitaController;




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
Route::apiResource('instituciones', ApiController::class);
Route::get('/api/instituciones', [ApiController::class, 'index']);
Route::get('/api/instituciones/{id}', [ApiController::class, 'show']);
Route::patch('/api/instituciones/{id}', [ApiController::class, 'update']);
Route::post('/api/instituciones', [ApiController::class, 'store']);
Route::delete('/api/instituciones/{id}', [ApiController::class, 'destroy']);

//Paciente
Route::resource('paciente', pacienteController::class);
Route::get('/admin/paciente', [pacienteController::class, 'index'])->name('paciente-admin');



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