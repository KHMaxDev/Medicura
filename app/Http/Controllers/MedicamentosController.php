<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamentos;

class MedicamentosController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamentos::all();
        return view('admin-views.medicamentos.medicamentos-admin', compact('medicamentos'));
    }

    public function show($id)
    {
        $medicamento = Medicamentos::find($id);
        if (!$medicamento) {
            return redirect()->route('medicamentos.index')->with('error', 'Medicamento no encontrado');
        }
        return view('admin-views.medicamentos.medicamentos-admin-view', compact('medicamento'));
    }

    public function create()
    {
        return view('admin-views.medicamentos.medicamentos-admin-create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'nombre' => 'required|string',
        'descripcion' => 'nullable|string',
        'efectos_secundarios' => 'nullable|array',
        'interacciones' => 'nullable|array',
        'tipo' => 'required|string',
    ]);

    // Filter empty values from arrays
    $data['efectos_secundarios'] = array_filter($request->input('efectos_secundarios', []));
    $data['interacciones'] = array_filter($request->input('interacciones', []));

    Medicamentos::create($data);

    return redirect()->route('medicamentos-admin')->with('success', 'Medicamento creado con éxito.');
}


    public function edit($id)
    {
        $medicamento = Medicamentos::find($id);
        if (!$medicamento) {
            return redirect()->route('medicamentos.index')->with('error', 'Medicamento no encontrado');
        }
        return view('admin-views.medicamentos.medicamentos-admin-edit', compact('medicamento'));
    }

    public function update(Request $request, $id)
{
    $data = $request->validate([
        'nombre' => 'required|string',
        'descripcion' => 'nullable|string',
        'efectos_secundarios' => 'nullable|array',
        'interacciones' => 'nullable|array',
        'tipo' => 'required|string',
    ]);

    // Filter empty values from arrays
    $data['efectos_secundarios'] = array_filter($request->input('efectos_secundarios', []));
    $data['interacciones'] = array_filter($request->input('interacciones', []));

    $medicamento = Medicamentos::findOrFail($id);
    $medicamento->update($data);

    return redirect()->route('medicamentos-admin')->with('success', 'Medicamento actualizado con éxito.');
}

    public function destroy($id)
    {
        $medicamento = Medicamentos::find($id);
        if (!$medicamento) {
            return redirect()->route('medicamentos.index')->with('error', 'Medicamento no encontrado');
        }

        $medicamento->delete();
        return redirect()->route('medicamentos.index')->with('success', 'Medicamento eliminado correctamente');
    }
}