<?php

namespace App\Http\Controllers;
use App\Models\Institucion;
use Illuminate\Http\Request;

class institucionesController extends Controller
{

    public function index()
    {
        //Devuelve todas las instituciones, solicito para mostrar en una tabla
        $instituciones = Institucion::all();
        //Retorna la vista
        return view ('admin-views.instituciones.instituciones-admin', compact('instituciones'));
    }
    public function create(){
        //Retorna una vista asignada para realizar las creaciones
        return view('admin-views.instituciones.instituciones-admin-create');
    }

    // Guardar una nueva institución
    public function store(Request $request)
    {
        //Hace la petición y envío de los parámetros que asigné en el modelo o como lo estructuré
        //Defino su tipo y si es requerido ese campo
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

        //Hace el envió de la petición con los datos, y finalmente me redirecciona a la vista principal
        $institucion = new Institucion($request->all());
        $institucion->save();   
        return redirect()->route('instituciones-admin')->with('success', 'Institución creada exitosamente.');
    }

    //Vista para mostrar un solo registro de acuerdo a la id
    public function show(string $id)
    {
        $institucion = Institucion::find($id);
        return view('admin-views.instituciones.instituciones-admin-view', compact('institucion'));
    }

    //De acuerdo al ID manda una vista
    public function edit($id){
        $institucion = Institucion::find($id);
        return view('admin-views.instituciones.instituciones-admin-edit', compact('institucion'));
    }


    //Actualizar una institución
    public function update(Request $request, string $id)
    {
        // Buscar la institución
        $institucion = Institucion::find($id);
        
        // Verifica si existe
        if (!$institucion) {
            return redirect()->back()->with('error', 'Institución no encontrada.');
        }
    
        // Valida los datos del formulario
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
    
        // Actualiza datos
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
    
        // Guarda los cambios y verifica si se guardaron correctamente
        if ($institucion->save()) {
            return redirect()->route('instituciones-admin')->with('success', 'Institución actualizada con éxito.');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar la institución.');
        }
    }

    //Elimina un registro de acuerdo al ID
    public function destroy(string $id)
    {
        $institucion = Institucion::find($id);
        

        if (!$institucion) {
            return redirect()->back()->with('error', 'Institución no encontrada');
        }
        
        //Al realizar la eliminación, devuelve nuevamente la página principal (hace un refresh)
        $institucion->delete();
        return redirect()->route('instituciones-admin')->with('success', 'Institución eliminada con éxito');
    }
}
