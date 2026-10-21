<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(ReportService $reports): View
    {
        return view('doctor.dashboard', [
            'metrics' => $reports->doctorMetrics(auth()->user()),
        ]);
    }
}
