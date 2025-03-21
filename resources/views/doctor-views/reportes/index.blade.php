@extends('doctor-views.reportes.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white">CRUD de Reportes</h2>
        </div>
        <div>
            <a href="{{route('reportes.create')}} " class="btn btn-primary">Crear Reporte</a>
        </div>
    </div>
    @if (Session::get ('success'))
    <div class="alert alert-success mt-2 ">
        <strong>{{ Session::get('success')}}<br>
    </div>
    @endif


    <div class="col-12 mt-4">
        <table class="table table-bordered text-white">
            <tr class="text-secondary">
                <th>Nombre del Paciente</th>
                <th>Nombre del Doctor</th>
                <th>Fecha del Reporte</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>

           @foreach ($reportes as $reporte)
            <tr>
                <td>{{$reporte->Nombre_del_Paciente}}</td>
                <td>{{$reporte->Nombre_del_Doctor}}</td>
                <td>{{$reporte->Fecha_del_Reporte}}</td>
                <td>{{$reporte->Descripción}}</td>
                <td>
                <a href="{{ route('reportes.edit', $reporte->id) }}" class="btn btn-warning">Editar</a>
               
                <form action="{{ route('reportes.destroy', $reporte->id) }}" method="POST" style="display:inline;">
                     @csrf 
                     @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este reporte?');"> Eliminar </button>
                
                </form>


                    
                </td>
            </tr>
            @endforeach


        </table>
       {{$reportes->links()}}  
    </div>
</div>
@endsection