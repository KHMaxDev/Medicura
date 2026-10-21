<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(ReportService $reports): View
    {
        return view('admin.reports.index', [
            'metrics' => $reports->adminMetrics(),
        ]);
    }

    public function pdf(ReportService $reports)
    {
        $metrics = $reports->adminMetrics();

        return Pdf::loadView('pdf.report', $metrics)
            ->setPaper('letter', 'landscape')
            ->download('reporte-medicura.pdf');
    }
}
