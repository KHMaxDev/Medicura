<?php

namespace App\Http\Controllers;
use App\Models\Doctores;
use App\Mail\PostMail;
use App\Mail\PostDenegado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


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
            'email' => 'required|email',
            'celular'          => 'required|integer|digits:10', // asegurando que sea un número de 10 dígitos
            'fecha_nacimiento' => 'required|date|before_or_equal:2004-12-31',
            'genero'           => 'required|string|in:Masculino,Femenino,No especifica', // Validar el género
            'curp'             => 'required|string|max:18|min:18',
            'cedula' => 'required|string', // Validación para cédula (debe ajustarse a la estructura exacta que esperas)
            'especialidad'     => 'required|string',
            'institucion'      => 'required|string'
        ]);
        

        $data = $request->all();

        // Agregar los valores por defecto
        $data['tipo'] = 'doctor';
        $data['estatus'] = 'pendiente';

        // Procesar la subida de la foto de perfil
        /*if ($request->hasFile('foto_perfil')) {
            $file = $request->file('foto_perfil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/doctor'), $filename);
            $data['foto_perfil'] = $filename;
        }*/

        // Hashear la contraseña antes de guardar
        //$data['contrasena'] = Hash::make($data['contrasena']);
        
        // Crear y guardar el nuevo registro
        $doctor = new Doctores($data);
        $doctor->save();   

        return view('register.confirmado');
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
        // Encuentra al doctor con el ID proporcionado
        $doctor = Doctores::find($id);
    
        if (!$doctor) {
            return redirect()->route('solicitudes')->with('error', 'Doctor no encontrado.');
        }
        //Crear contraseña aleatoria
        $length = rand(6, 8); // Longitud aleatoria entre 6 y 8 caracteres
        $randomPassword = Str::random($length);
        $hashedPassword = Hash::make($randomPassword);
    
        $data = $request->all();
        // Agregar los valores por defecto
        $data['contrasena'] = $hashedPassword;

        // Actualiza el estatus
        $doctor->estatus = $request->input('estatus', 'activo'); // Asegura que el estatus sea 'activo' por defecto
        $doctor->updated_at = now();

        $doctor->fill($data);

        $doctorEmail = $doctor->email;
        $doctorName = $doctor->nombre . " ".$doctor->apellido_paterno." ".$doctor->apellido_materno;
        
        // Guarda los cambios y verifica si se guardaron correctamente
        if ($doctor->save()) {

            //Envío de correo
            Mail::to($doctorEmail)->send(new PostMail(
                [
                    'name'=>$doctorName,
                    'email'=>$doctorEmail,
                    'contrasena'=>$randomPassword,
                ]
            ));

            return redirect()->route('solicitudes')->with('success', 'Solicitud aprobada con éxito.');
        } else {

            return redirect()->back()->with('error', 'Error al actualizar el estatus.');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctores::find($id);
        

        if (!$doctor) {
            return redirect()->back()->with('error', 'Solicitud no encontrada');
        }
                    //Envío de correo
         Mail::to('madoxchetumal@gmail.com')->send(new PostDenegado());
        //Al realizar la eliminación, devuelve nuevamente la página principal (hace un refresh)
        $doctor->delete();
        return redirect()->route('solicitudes')->with('success', 'Solicitud eliminada con éxito');
    }

    public function doctoresPDF(Request $request){
        $doctores = Doctores::where('tipo', 'doctor')->where('estatus','activo')->get();
        $pdf = \PDF::loadView('admin-views.medicos.doctores-admin-pdf', compact('doctores'))->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true, 'isHtml5ParserEnabled' => true])->setPaper('letter', 'landscape');
        return $pdf->download('Doctores_reporte.pdf');
    }

    public function exitoso(){
        return view('register.confirmado');
    }
}
