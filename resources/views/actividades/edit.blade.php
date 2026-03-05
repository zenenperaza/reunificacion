@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <x-breadcrumb title="Editar Actividad" icono="<i class='mdi mdi-pencil-box'></i>" />

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('actividades.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Volver a la lista
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('actividades.update', $actividad) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Código <span class="text-danger">*</span></label>
                        <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror"
                               value="{{ old('codigo', $actividad->codigo) }}" required>
                        @error('codigo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Descripción <span class="text-danger">*</span></label>
                        <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                               value="{{ old('descripcion', $actividad->descripcion) }}" required>
                        @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-success">
                        <i class="mdi mdi-content-save"></i> Actualizar
                    </button>
                    <a href="{{ route('actividades.index') }}" class="btn btn-light">Cancelar</a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection