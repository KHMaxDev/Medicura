<?php

namespace App\Http\Controllers;

use App\Models\Doctores;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctor = Doctores::where('tipo', 'doctor')
            ->where('estatus', 'activo')
            ->where('_id', auth()->id())  // Get logged-in doctor's data
            ->first();

        return view('doctor-views.doctor', compact('doctor'));
    }
}
