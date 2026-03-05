@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <x-breadcrumb title="Detalle Actividad" icono="<i class='mdi mdi-eye'></i>" />

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('actividades.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Volver a la lista
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p><strong>Código:</strong> {{ $actividad->codigo }}</p>
            <p><strong>Descripción:</strong> {{ $actividad->descripcion }}</p>
        </div>
    </div>

</div>
@endsection