<?php

namespace App\Http\Controllers;
use App\Models\Institucion;
use App\Models\Doctores;
use App\Models\User;
use Illuminate\Http\Request;

class admin extends Controller
{
    public function index(){
        $adminInfo = User::where('tipo', 'admin')->first();
        $institucionCount = Institucion::count();
        $doctores = Doctores::where('tipo', 'doctor')->where('estatus', 'pendiente')->get();
        $doctoresActive = Doctores::where('tipo', 'doctor')->where('estatus', 'activo')->get();
        $doctoresAct = $doctoresActive->count();
        $doctoresCount = $doctores->count();
        return view('admin-views.admin', compact('institucionCount','doctoresCount','doctoresAct','adminInfo'));
    }
}
