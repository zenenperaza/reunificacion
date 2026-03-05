@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <x-breadcrumb title="Detalle Servicio" icono="<i class='mdi mdi-briefcase-outline'></i>" />

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('servicios.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Volver a la lista
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $servicio->nombre }}</p>
            <p><strong>Descripción:</strong> {{ $servicio->descripcion ?? '-' }}</p>
        </div>
    </div>

</div>
@endsection