<?php

namespace App\Http\Controllers;
use App\Models\Institucion;
use Illuminate\Http\Request;

class institucionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instituciones = Institucion::all();
        return view ('admin-views.instituciones.instituciones-admin', compact('instituciones'));
    }
    public function create(){
        return view('admin-views.instituciones.instituciones-admin-create');
    }
    /**
     * Store a newly created resource in storage.
     */
    // Guardar una nueva institución
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion.estado' => 'required|string',
            'direccion.municipio' => 'required|string',
            'direccion.ciudad' => 'required|string',
            'direccion.colonia' => 'required|string',
            'direccion.codigo_postal' => 'required|integer',
            'direccion.calle' => 'required|string',
            'direccion.numero' => 'required|string',
        ]);

        $institucion = new Institucion($request->all());
        $institucion->save();   
        return redirect()->route('instituciones-admin')->with('success', 'Institución creada exitosamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $institucion = Institucion::find($id);
        return view('admin-views.instituciones.instituciones-admin-view', compact('institucion'));
    }

    public function edit($id){
        $institucion = Institucion::find($id);
        return view('admin-views.instituciones.instituciones-admin-edit', compact('institucion'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Buscar la institución
        $institucion = Institucion::find($id);
        
        // Verificar si existe
        if (!$institucion) {
            return redirect()->back()->with('error', 'Institución no encontrada.');
        }
    
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion.estado' => 'required|string|max:255',
            'direccion.municipio' => 'required|string|max:255',
            'direccion.ciudad' => 'required|string|max:255',
            'direccion.colonia' => 'required|string|max:255',
            'direccion.codigo_postal' => 'required|numeric',
            'direccion.calle' => 'required|string|max:255',
            'direccion.numero' => 'required|string|max:20',
        ]);
    
        // Actualizar datos
        $institucion->nombre = $request->nombre;
        $institucion->direccion = [
            'estado' => $request->direccion['estado'],
            'municipio' => $request->direccion['municipio'],
            'ciudad' => $request->direccion['ciudad'],
            'colonia' => $request->direccion['colonia'],
            'codigo_postal' => $request->direccion['codigo_postal'],
            'calle' => $request->direccion['calle'],
            'numero' => $request->direccion['numero'],
        ];
        $institucion->updated_at = now();
    
        // Guardar cambios y verificar si se guardaron correctamente
        if ($institucion->save()) {
            return redirect()->route('instituciones-admin')->with('success', 'Institución actualizada con éxito.');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar la institución.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $institucion = Institucion::find($id);
        
        if (!$institucion) {
            return redirect()->back()->with('error', 'Institución no encontrada');
        }
    
        $institucion->delete();
        return redirect()->route('instituciones-admin')->with('success', 'Institución eliminada con éxito');
    }
}
