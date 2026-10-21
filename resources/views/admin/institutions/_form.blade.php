@php($direccion = $institution?->direccion ?? [])

<form method="POST" action="{{ $action }}">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="form-group">
        <label for="nombre">Nombre de la institución</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $institution->nombre ?? '') }}" required>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="estado">Estado</label>
            <input type="text" name="direccion[estado]" id="estado" class="form-control" value="{{ old('direccion.estado', $direccion['estado'] ?? '') }}" required>
        </div>
        <div class="form-group col-md-6">
            <label for="municipio">Municipio</label>
            <input type="text" name="direccion[municipio]" id="municipio" class="form-control" value="{{ old('direccion.municipio', $direccion['municipio'] ?? '') }}" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="ciudad">Ciudad</label>
            <input type="text" name="direccion[ciudad]" id="ciudad" class="form-control" value="{{ old('direccion.ciudad', $direccion['ciudad'] ?? '') }}" required>
        </div>
        <div class="form-group col-md-6">
            <label for="colonia">Colonia</label>
            <input type="text" name="direccion[colonia]" id="colonia" class="form-control" value="{{ old('direccion.colonia', $direccion['colonia'] ?? '') }}" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="calle">Calle</label>
            <input type="text" name="direccion[calle]" id="calle" class="form-control" value="{{ old('direccion.calle', $direccion['calle'] ?? '') }}" required>
        </div>
        <div class="form-group col-md-4">
            <label for="numero">Número</label>
            <input type="text" name="direccion[numero]" id="numero" class="form-control" value="{{ old('direccion.numero', $direccion['numero'] ?? '') }}" required>
        </div>
        <div class="form-group col-md-4">
            <label for="codigo_postal">Código postal</label>
            <input type="text" name="direccion[codigo_postal]" id="codigo_postal" class="form-control" value="{{ old('direccion.codigo_postal', $direccion['codigo_postal'] ?? '') }}" maxlength="5" required>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
</form>
