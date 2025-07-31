
@php
    $esEdicion = isset($familia);
@endphp

@can($esEdicion ? 'editar coordinaciones' : 'crear coordinaciones')
    <form action="{{ $esEdicion ? route('familias.update', $familia) : route('familias.store') }}" method="POST">
        @csrf
        @if($esEdicion) @method('PUT') @endif

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Coordinacion</label>
            <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $familia->nombre ?? '') }}" required>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="ver_entre_hermanos" id="ver" value="1"
                {{ old('ver_entre_hermanos', $familia->ver_entre_hermanos ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="ver">Permitir ver entre hermanos</label>
        </div>

        <button class="btn btn-success">{{ $esEdicion ? 'Actualizar' : 'Crear' }}</button>
    </form>
@else
    <div class="alert alert-danger">
        No tienes permiso para {{ $esEdicion ? 'editar' : 'crear' }} coordinacion.
    </div>
@endcan
