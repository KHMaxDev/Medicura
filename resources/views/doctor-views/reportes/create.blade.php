@extends('doctor-views.reportes.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>

            <h2>Crear Reporte</h2>
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

    <form action="{{route('reportes.store')}}" method="POST">
       @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Nombre del Paciente:</strong>
                    <input type="text" name="Nombre_del_Paciente" class="form-control" placeholder="Nombre del Paciente" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Nombre del Doctor:</strong>
                    <input type="text" name="Nombre_del_Doctor" class="form-control" placeholder="Nombre del Doctor" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Fecha del Reporte:</strong>
                    <input type="date" name="Fecha_del_Reporte" class="form-control" placeholder="Fecha del Reporte" >
                    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Descripción:</strong>
                    <textarea class="form-control" style="height:150px" name="Descripción" placeholder="Descripción..."></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </div>
    </form>
</div>

@endsection