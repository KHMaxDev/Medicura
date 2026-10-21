<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(ReportService $reports): View
    {
        return view('admin.dashboard', [
            'metrics' => $reports->adminMetrics(),
        ]);
    }
}
