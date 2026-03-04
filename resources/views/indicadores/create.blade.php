@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <x-breadcrumb title="Nuevo Indicador" icono="<i class='mdi mdi-chart-line'></i>" />

        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('indicadores.index') }}" class="btn btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Volver a la lista
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ route('indicadores.store') }}">
                    @csrf

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Código <span class="text-danger">*</span></label>
                            <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror"
                                value="{{ old('codigo', $indicador->codigo ?? '') }}">

                            @error('codigo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-8">
                            <label class="form-label">Descripción <span class="text-danger">*</span></label>
                            <input type="text" name="descripcion"
                                class="form-control @error('descripcion') is-invalid @enderror"
                                value="{{ old('descripcion') }}" required>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button class="btn btn-success">
                            <i class="mdi mdi-content-save"></i> Guardar
                        </button>
                        <a href="{{ route('indicadores.index') }}" class="btn btn-light">Cancelar</a>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('change', '#estatus', function() {
            $(this).closest('.form-check').find('label').text($(this).is(':checked') ? 'Activo' : 'Inactivo');
        });
    </script>
@endsection
