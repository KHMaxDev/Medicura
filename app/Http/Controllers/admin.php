<?php

namespace App\Http\Controllers;
use App\Models\Institucion;
use App\Models\Doctores;
use Illuminate\Http\Request;

class admin extends Controller
{
    public function index(){
        $institucionCount = Institucion::count();
        $doctores = Doctores::where('tipo', 'doctor')->where('estatus', 'pendiente')->get();
        $doctoresCount = $doctores->count();
        return view('admin-views.admin', compact('institucionCount','doctoresCount'));
    }
}
