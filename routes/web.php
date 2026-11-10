<?php
use App\Http\Controllers\DemoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/login', 'login')->name('login');
// Old authentication links now lead to the public interface selector.
Route::redirect('/registro', '/login');
Route::redirect('/recuperar-contrasena', '/login');
Route::get('/admin/{path?}', [DemoController::class, 'index'])->where('path', '.*')->name('admin.dashboard');
Route::get('/doctor/{path?}', [DemoController::class, 'index'])->where('path', '.*')->name('doctor.dashboard');
