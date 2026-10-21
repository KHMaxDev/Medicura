@php
    $efectos = old('efectos_secundarios', $medicine->efectos_secundarios ?? []);
    $interacciones = old('interacciones', $medicine->interacciones ?? []);
    $efectos = array_pad(is_array($efectos) ? $efectos : [], 3, '');
    $interacciones = array_pad(is_array($interacciones) ? $interacciones : [], 3, '');
@endphp

<form method="POST" action="{{ $action }}">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="nombre">Nombre del medicamento</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $medicine->nombre ?? '') }}" required>
        </div>
        <div class="form-group col-md-4">
            <label for="tipo">Tipo</label>
            <input type="text" name="tipo" id="tipo" class="form-control" value="{{ old('tipo', $medicine->tipo ?? '') }}" placeholder="Analgésico, antibiótico..." required>
        </div>
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ old('descripcion', $medicine->descripcion ?? '') }}</textarea>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Efectos secundarios</label>
            @foreach($efectos as $efecto)
                <input type="text" name="efectos_secundarios[]" class="form-control mb-2" value="{{ $efecto }}" placeholder="Efecto secundario">
            @endforeach
        </div>
        <div class="form-group col-md-6">
            <label>Interacciones</label>
            @foreach($interacciones as $interaccion)
                <input type="text" name="interacciones[]" class="form-control mb-2" value="{{ $interaccion }}" placeholder="Interacción medicamentosa">
            @endforeach
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
</form>
