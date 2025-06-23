@extends('layouts.app')

@section('title', 'Detalle del Caso')

@section('content')
<div class="container">
    <h2 class="mb-4">Detalle del Caso</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>N° Caso:</strong> {{ $caso->numero_caso }}</p>
            <p><strong>Beneficiario:</strong> {{ $caso->beneficiario }}</p>
            <p><strong>Tipo de atención:</strong> {{ $caso->tipo_atencion }}</p>
            <p><strong>Fecha de atención:</strong> {{ \Carbon\Carbon::parse($caso->fecha_atencion)->format('d/m/Y') }}</p>
            <p><strong>Estado:</strong> {{ $caso->estado->nombre ?? 'N/A' }}</p>
            <p><strong>Municipio:</strong> {{ $caso->municipio->nombre ?? 'N/A' }}</p>
            <p><strong>Parroquia:</strong> {{ $caso->parroquia->nombre ?? 'N/A' }}</p>
            <p><strong>Estatus:</strong> {{ $caso->estatus }}</p>
        </div>
    </div>

    <a href="{{ route('casos.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
