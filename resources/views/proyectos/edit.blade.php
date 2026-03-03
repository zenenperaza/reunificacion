@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <x-breadcrumb title="Editar Proyecto" icono="<i class='mdi mdi-folder-edit'></i>" />

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Volver a la lista
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('proyectos.update', $proyecto) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- Donante --}}
                    <div class="col-md-6">
                        <label class="form-label">Donante <span class="text-danger">*</span></label>
                        <select name="donante_id" class="form-select @error('donante_id') is-invalid @enderror" required>
                            <option value="">Seleccione...</option>
                            @foreach($donantes as $d)
                                <option value="{{ $d->id }}"
                                    {{ (old('donante_id', $proyecto->donante_id) == $d->id) ? 'selected' : '' }}>
                                    {{ $d->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('donante_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Código --}}
                    <div class="col-md-3">
                        <label class="form-label">Código</label>
                        <input type="number"
                               name="codigo"
                               class="form-control @error('codigo') is-invalid @enderror"
                               value="{{ old('codigo', $proyecto->codigo) }}">
                        @error('codigo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Estatus --}}
                    <div class="col-md-3">
                        <label class="form-label d-block">Estatus</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="estatus"
                                   name="estatus"
                                   value="1"
                                   {{ old('estatus', $proyecto->estatus) ? 'checked' : '' }}>
                            <label class="form-check-label" for="estatus">
                                {{ old('estatus', $proyecto->estatus) ? 'Activo' : 'Inactivo' }}
                            </label>
                        </div>
                        @error('estatus') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="col-md-12">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion"
                                  rows="3"
                                  class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $proyecto->descripcion) }}</textarea>
                        @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Inicio --}}
                    <div class="col-md-3">
                        <label class="form-label">Inicio</label>
                        <input type="date"
                               name="inicio"
                               class="form-control @error('inicio') is-invalid @enderror"
                               value="{{ old('inicio', optional($proyecto->inicio)->format('Y-m-d')) }}">
                        @error('inicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Fin --}}
                    <div class="col-md-3">
                        <label class="form-label">Fin</label>
                        <input type="date"
                               name="fin"
                               class="form-control @error('fin') is-invalid @enderror"
                               value="{{ old('fin', optional($proyecto->fin)->format('Y-m-d')) }}">
                        @error('fin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Estados --}}
                    <div class="col-md-6">
                        <label class="form-label">Estados (múltiples)</label>
                        @php
                            $estadoIds = old('estados', $proyecto->estados->pluck('id')->toArray());
                        @endphp

                        <select name="estados[]"
                                id="estados"
                                class="form-select @error('estados') is-invalid @enderror"
                                multiple>
                            @foreach($estados as $e)
                                <option value="{{ $e->id }}" {{ in_array($e->id, $estadoIds) ? 'selected' : '' }}>
                                    {{ $e->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('estados') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Municipios --}}
                    <div class="col-md-12">
                        <label class="form-label">Municipios (según estados)</label>

                        @php
                            $municipioIds = old('municipios', $proyecto->municipios->pluck('id')->toArray());
                        @endphp

                        <select name="municipios[]"
                                id="municipios"
                                class="form-select @error('municipios') is-invalid @enderror"
                                multiple>
                            {{-- Precargados desde el controlador (para que se vean al abrir edit) --}}
                            @foreach($municipios as $m)
                                <option value="{{ $m->id }}" {{ in_array($m->id, $municipioIds) ? 'selected' : '' }}>
                                    {{ $m->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('municipios') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        <div class="text-muted small mt-1">
                            Selecciona primero los estados y luego elige municipios.
                        </div>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-success">
                        <i class="mdi mdi-content-save"></i> Actualizar
                    </button>
                    <a href="{{ route('proyectos.index') }}" class="btn btn-light">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    // Cambiar texto del estatus
    $(document).on('change', '#estatus', function() {
        const label = $(this).closest('.form-check').find('label');
        label.text($(this).is(':checked') ? 'Activo' : 'Inactivo');
    });

    // Cargar municipios según estados seleccionados
    function cargarMunicipiosPorEstados(estadoIds, selectedMunicipios = []) {

        // Si no hay estados: limpiar municipios
        if (!estadoIds || estadoIds.length === 0) {
            $('#municipios').html('');
            return;
        }

        $.ajax({
            url: "{{ route('municipios.por-estados') }}", // <-- crea esta ruta
            method: "GET",
            data: { estados: estadoIds },
            success: function(res) {
                // res = [{id, nombre}, ...]
                let html = '';
                res.forEach(m => {
                    const sel = selectedMunicipios.includes(m.id) ? 'selected' : '';
                    html += `<option value="${m.id}" ${sel}>${m.nombre}</option>`;
                });
                $('#municipios').html(html);
            }
        });
    }

    // Al cambiar estados, recargar municipios
    $('#estados').on('change', function() {
        const estadoIds = $(this).val() || [];
        cargarMunicipiosPorEstados(estadoIds, []);
    });
</script>
@endsection