<?php

use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\InstitutionController as AdminInstitutionController;
use App\Http\Controllers\Admin\MedicineController as AdminMedicineController;
use App\Http\Controllers\Admin\PatientController as AdminPatientController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Doctor\AppointmentController as DoctorAppointmentController;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Doctor\MedicineController as DoctorMedicineController;
use App\Http\Controllers\Doctor\PatientController as DoctorPatientController;
use App\Http\Controllers\Doctor\TreatmentController as DoctorTreatmentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contacto', [ContactoController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('contact.store');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.attempt');

Route::get('/registro', [RegisterController::class, 'show'])->name('register');
Route::post('/registro', [RegisterController::class, 'register'])
    ->middleware('throttle:5,1')
    ->name('register.store');
Route::get('/registro/confirmado', [RegisterController::class, 'success'])->name('register.success');

Route::get('/recuperar-contrasena', [PasswordResetController::class, 'requestForm'])->name('password.request');
Route::post('/recuperar-contrasena', [PasswordResetController::class, 'sendLink'])
    ->middleware('throttle:5,1')
    ->name('password.email');
Route::get('/restablecer-contrasena/{user}', [PasswordResetController::class, 'resetForm'])
    ->middleware('signed')
    ->name('password.reset');
Route::post('/restablecer-contrasena/{user}', [PasswordResetController::class, 'reset'])
    ->middleware(['signed', 'throttle:5,1'])
    ->name('password.update');

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('doctors/pdf', [AdminDoctorController::class, 'pdf'])->name('doctors.pdf');
        Route::get('doctors/pending', [AdminDoctorController::class, 'pending'])->name('doctors.pending');
        Route::get('doctors', [AdminDoctorController::class, 'index'])->name('doctors.index');
        Route::get('doctors/{doctor}', [AdminDoctorController::class, 'show'])->name('doctors.show');
        Route::patch('doctors/{doctor}/approve', [AdminDoctorController::class, 'approve'])->name('doctors.approve');
        Route::patch('doctors/{doctor}/deny', [AdminDoctorController::class, 'deny'])->name('doctors.deny');

        Route::resource('patients', AdminPatientController::class);
        Route::get('institutions/pdf', [AdminInstitutionController::class, 'pdf'])->name('institutions.pdf');
        Route::resource('institutions', AdminInstitutionController::class);
        Route::resource('medicines', AdminMedicineController::class);
        Route::resource('appointments', AdminAppointmentController::class);

        Route::get('reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('reports/pdf', [AdminReportController::class, 'pdf'])->name('reports.pdf');
    });

Route::prefix('doctor')
    ->name('doctor.')
    ->middleware(['auth', 'doctor'])
    ->group(function () {
        Route::get('/', [DoctorDashboardController::class, 'index'])->name('dashboard');

        Route::get('patients', [DoctorPatientController::class, 'index'])->name('patients.index');
        Route::get('patients/search', [DoctorPatientController::class, 'search'])->name('patients.search');
        Route::post('patients/{patient}/attach', [DoctorPatientController::class, 'attach'])->name('patients.attach');
        Route::delete('patients/{patient}', [DoctorPatientController::class, 'detach'])->name('patients.detach');

        Route::resource('appointments', DoctorAppointmentController::class);
        Route::resource('medicines', DoctorMedicineController::class);
        Route::resource('treatments', DoctorTreatmentController::class);
    });
