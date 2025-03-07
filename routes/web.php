<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin;
use App\Http\Controllers\institucionesController;

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
