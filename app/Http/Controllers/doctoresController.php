<?php

namespace App\Http\Controllers;
use App\Models\Doctores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade as PDF;


class doctoresController extends Controller
{
    public function registro()
    {
        return view('register.register');;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctores = Doctores::where('tipo', 'doctor')->get();

        //Retorna la vista
        return view ('admin-views.medicos.doctores-admin', compact('doctores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Hace la petición y envío de los parámetros que asigné en el modelo o como lo estructuré
        //Defino su tipo y si es requerido ese campo
        $request->validate([
            'nombre'           => 'required|string|max:255',
            'apellido_paterno' => 'required|string',
            'apellido_materno' => 'required|string',
            'email'            => 'required|email',
            'contrasena'       => 'required|string',
            'celular'          => 'required|integer',
            'fecha_nacimiento' => 'required|date',
            'genero'           => 'required|string',
            'curp'             => 'required|string|max:18|min:18',
            'cedula'           => 'required|string|max:30',
            'especialidad'     => 'required|string',
            'institucion'      => 'required|string',
            'foto_perfil'      => 'required|image'
        ]);

        $data = $request->all();

        // Agregar los valores por defecto
        $data['tipo'] = 'doctor';
        $data['estatus'] = 'pendiente';

        // Procesar la subida de la foto de perfil
        if ($request->hasFile('foto_perfil')) {
            $file = $request->file('foto_perfil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/doctor'), $filename);
            $data['foto_perfil'] = $filename;
        }

        // Hashear la contraseña antes de guardar
        $data['contrasena'] = Hash::make($data['contrasena']);

        // Crear y guardar el nuevo registro
        $doctor = new Doctores($data);
        $doctor->save();   

        return redirect()->route('admin-views.medicos.doctores-admin')
            ->with('success', 'Doctor creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
