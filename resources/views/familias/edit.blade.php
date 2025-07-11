@extends('layouts.app')

@section('title', 'Editar Familia')

@section('content')
<div class="container">
    <x-breadcrumb title="Editar Familia" />

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('familias.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Volver a la lista
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Actualizar Familia</h4>

            {{-- Aquí insertamos el formulario --}}
            @include('familias._form', ['familia' => $familia])
        </div>
    </div>
</div>
@endsection
