<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reportes;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class reportesController extends Controller
{
     public function index(): View
    {
        $reportes = reportes::latest()->paginate(10);                 
        return view('doctor-views.reportes.index',['reportes' => $reportes]);
    }

    public function create(): View
    {
        return view('doctor-views.reportes.create');
    }

    public function store(Request $request): RedirectResponse
    {
       $request->validate([
           'Nombre_del_Paciente' => 'required',
           'Nombre_del_Doctor' => 'required',
           'Fecha_del_Reporte' => 'required',           
           'Descripción' => 'required',
           
       ]);

        reportes ::create($request->all());
        return redirect()->route('reportes.index')->with('success', 'Reporte creado con exito');
    }

    public function show(reportes $reportes)
    {
        
    }

    public function edit(reportes $reporte): View
    {
        return view('doctor-views.reportes.edit', compact('reporte'));
    }

    public function update(Request $request, reportes $reporte): RedirectResponse
    {
        $request->validate([
            'Nombre_del_Paciente' => 'required',
            'Nombre_del_Doctor' => 'required',
            'Fecha_del_Reporte' => 'required',
            'Descripción' => 'required',
        ]);
    
        $reporte->update($request->all());
        return redirect()->route('reportes.index')->with('success', 'Reporte actualizado con éxito');
    }
    
    public function destroy(reportes $reporte): RedirectResponse
    {
        $reporte->delete();
        return redirect()->route('reportes.index')->with('success', 'Reporte eliminado con éxito');
    } 
}