<?php

namespace App\Http\Controllers;
use App\Models\Doctores;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $doctores = Doctores::where('tipo', 'doctor')->where('estatus','activo')->first();
    return view('dashboard',compact('doctores'));
}

}


