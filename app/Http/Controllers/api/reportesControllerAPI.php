<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reportes;
use Illuminate\Http\Request;

class ReportesControllerAPI extends Controller
{
    public function index()
    {
        return response()->json(Reportes::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre_del_Paciente' => 'required',
            'Nombre_del_Doctor' => 'required',
            'Fecha_del_Reporte' => 'required',
            'Descripción' => 'required',
        ]);

        $reporte = Reportes::create($request->all());
        return response()->json($reporte, 201);
    }

    public function show(Reportes $reporte)
    {
        return response()->json($reporte);
    }

    public function update(Request $request, Reportes $reporte)
    {
        $request->validate([
            'Nombre_del_Paciente' => 'required',
            'Nombre_del_Doctor' => 'required',
            'Fecha_del_Reporte' => 'required',
            'Descripción' => 'required',
        ]);

        $reporte->update($request->all());
        return response()->json($reporte);
    }

    public function destroy(Reportes $reporte)
    {
        $reporte->delete();
        return response()->json(null, 204);
    }
}