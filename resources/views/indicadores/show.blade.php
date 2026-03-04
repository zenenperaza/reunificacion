@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <x-breadcrumb title="Detalle Indicador" icono="<i class='mdi mdi-chart-line'></i>" />

    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('indicadores.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Volver a la lista
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p><strong>Código:</strong> {{ $indicador->codigo }}</p>
            <p><strong>Descripción:</strong> {{ $indicador->descripcion }}</p>
         
        </div>
    </div>

</div>
@endsection