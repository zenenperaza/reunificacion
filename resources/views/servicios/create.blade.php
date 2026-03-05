@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <x-breadcrumb title="Nuevo Servicio" icono="<i class='mdi mdi-briefcase-plus-outline'></i>" />

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('servicios.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Volver a la lista
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('servicios.store') }}">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nombre"
                               class="form-control @error('nombre') is-invalid @enderror"
                               value="{{ old('nombre') }}" required>
                        @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" rows="3"
                                  class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>
                        @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-success">
                        <i class="mdi mdi-content-save"></i> Guardar
                    </button>
                    <a href="{{ route('servicios.index') }}" class="btn btn-light">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection