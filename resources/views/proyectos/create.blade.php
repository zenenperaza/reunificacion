@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <x-breadcrumb title="Nuevo Proyecto" icono="<i class='mdi mdi-folder-edit'></i>" />

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Volver a la lista
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('proyectos.store') }}">
                @csrf

                <div class="row g-3">

                    {{-- Donante --}}
                    <div class="col-md-6">
                        <label class="form-label">Donante <span class="text-danger">*</span></label>
                        <select name="donante_id" class="form-select @error('donante_id') is-invalid @enderror" required>
                            <option value="">Seleccione...</option>
                            @foreach($donantes as $donante)
                                <option value="{{ $donante->id }}" {{ old('donante_id') == $donante->id ? 'selected' : '' }}>
                                    {{ $donante->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('donante_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Código --}}
                    <div class="col-md-3">
                        <label class="form-label">Código</label>
                        <input type="number" name="codigo"
                               class="form-control @error('codigo') is-invalid @enderror"
                               value="{{ old('codigo') }}">
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
                                   {{ old('estatus', 1) ? 'checked' : '' }}>
                            <label class="form-check-label" for="estatus" id="estatus-label">
                                {{ old('estatus', 1) ? 'Activo' : 'Inactivo' }}
                            </label>
                        </div>
                        @error('estatus') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="col-md-12">
                        <label class="form-label">Descripción <span class="text-danger">*</span></label>
                        <textarea name="descripcion" rows="3"
                                  class="form-control @error('descripcion') is-invalid @enderror"
                                  required>{{ old('descripcion') }}</textarea>
                        @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Inicio --}}
                    <div class="col-md-3">
                        <label class="form-label">Inicio</label>
                        <input type="date" name="inicio"
                               class="form-control @error('inicio') is-invalid @enderror"
                               value="{{ old('inicio') }}">
                        @error('inicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Fin --}}
                    <div class="col-md-3">
                        <label class="form-label">Fin</label>
                        <input type="date" name="fin"
                               class="form-control @error('fin') is-invalid @enderror"
                               value="{{ old('fin') }}">
                        @error('fin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Estados --}}
                    <div class="col-md-6">
                        <label class="form-label">Estados (múltiples)</label>

                        @php
                            $estadoIds = old('estados', []);
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
                            $municipioIds = old('municipios', []);
                        @endphp

                        <select name="municipios[]"
                                id="municipios"
                                class="form-select @error('municipios') is-invalid @enderror"
                                multiple>
                            {{-- Se llena por AJAX --}}
                        </select>

                        @error('municipios') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        <div class="text-muted small mt-1">
                            Selecciona primero los estados y luego elige municipios.
                        </div>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-success">
                        <i class="mdi mdi-content-save"></i> Guardar
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
        $('#estatus-label').text($(this).is(':checked') ? 'Activo' : 'Inactivo');
    });

    function cargarMunicipiosPorEstados(estadoIds, selectedMunicipios = []) {

        if (!estadoIds || estadoIds.length === 0) {
            $('#municipios').html('');
            return;
        }

        $.ajax({
            url: "{{ route('municipios.por-estados') }}",
            method: "GET",
            data: { estados: estadoIds },
            success: function(res) {
                let html = '';
                res.forEach(m => {
                    const sel = selectedMunicipios.includes(m.id) ? 'selected' : '';
                    html += `<option value="${m.id}" ${sel}>${m.nombre}</option>`;
                });
                $('#municipios').html(html);
            }
        });
    }

    // al cambiar estados => recargar municipios
    $('#estados').on('change', function() {
        const estadoIds = $(this).val() || [];
        cargarMunicipiosPorEstados(estadoIds, []);
    });

    // si vienes con old('estados') (por error de validación), precarga municipios y selecciona old('municipios')
    $(function () {
        const estadosOld = @json(old('estados', []));
        const municipiosOld = @json(old('municipios', []));

        if (estadosOld.length > 0) {
            cargarMunicipiosPorEstados(estadosOld, municipiosOld);
        }
    });
</script>
@endsection