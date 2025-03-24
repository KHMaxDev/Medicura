<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminReporteController extends Controller
{
    public function index(){
        return view ('admin-views.reports.reportes-admin');
    }
}
