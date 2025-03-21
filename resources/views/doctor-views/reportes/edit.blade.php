@extends('doctor-views.reportes.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>

            <h2>Editar Reporte</h2>
        </div>
        <div>
            <a href="{{route('reportes.index')}}" class="btn btn-primary">Volver</a>
        </div>
    </div>
  
    @if ($errors->any())
    <div class="alert alert-danger mt-2 ">
        <strong>Opps!    </strong> Algo fue mal..<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('reportes.update', $reporte->id) }}" method="POST">

       @csrf
       @method('PUT')
      
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Nombre del Paciente:</strong>
                    <input type="text" name="Nombre_del_Paciente" class="form-control" placeholder="Nombre del Paciente" value="{{$reporte->Nombre_del_Paciente}}">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Nombre del Doctor:</strong>
                    <input type="text" name="Nombre_del_Doctor" class="form-control" placeholder="Nombre del Doctor" value="{{$reporte->Nombre_del_Doctor}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Fecha del Reporte:</strong>
                    <input type="date" name="Fecha_del_Reporte" class="form-control" placeholder="Fecha del Reporte" value={{$reporte->Fecha_del_Reporte}}>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Descripción:</strong>
                    <textarea class="form-control" style="height:150px" name="Descripción" placeholder="Descripción...">{{$reporte->Descripción}}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </form>
</div>

@endsection