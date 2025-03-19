<?php

namespace App\Http\Controllers;
use App\Models\Institucion;
use Illuminate\Http\Request;

class admin extends Controller
{
    public function index(){
        $institucionCount = Institucion::count();
        return view('admin-views.admin', compact('institucionCount'));
    }
}
