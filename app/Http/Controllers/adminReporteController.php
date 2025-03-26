<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctores;

class adminReporteController extends Controller
{
    public function index(){
        return view ('admin-views.reports.reportes-admin');
    }

    public function solicitudes(){
        $doctores = Doctores::where('tipo', 'doctor')
                    ->where('estatus', 'pendiente')
                    ->get();

        return view ('admin-views.solicitudes-doctor.solicitudes',compact('doctores'));
    }
}
