@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- <x-breadcrumb title="Detalle Proyecto" /> --}}
        <x-breadcrumb title="Detalle Donante" icono="<i class='mdi mdi-domain'></i>" activo="Detalle" />

        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Volver a la lista
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p><strong>Donante:</strong> {{ $proyecto->donante->nombre ?? '-' }}</p>
                <p><strong>Código:</strong> {{ $proyecto->codigo ?? '-' }}</p>
                <p><strong>Descripción:</strong> {{ $proyecto->descripcion ?? '-' }}</p>
                <p><strong>Inicio:</strong>
                    {{ $proyecto->inicio ? \Carbon\Carbon::parse($proyecto->inicio)->format('d/m/Y') : '-' }}</p>
                <p><strong>Fin:</strong> {{ $proyecto->fin ? \Carbon\Carbon::parse($proyecto->fin)->format('d/m/Y') : '-' }}
                </p>

                <p><strong>Estatus:</strong>
                    @if ($proyecto->estatus)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-danger">Inactivo</span>
                    @endif
                </p>

                <hr>

                {{-- ESTADOS + MUNICIPIOS --}}
                <p class="mb-2"><strong>Ubicación del proyecto</strong></p>

                @if ($proyecto->estados->isEmpty())
                    <div class="alert alert-warning mb-0">
                        Este proyecto no tiene estados/municipios asociados.
                    </div>
                @else
                    @foreach ($proyecto->estados as $estado)
                        <div class="mb-3">
                            <div class="fw-semibold">
                                <span class="badge bg-secondary me-1">{{ $estado->nombre }}</span>
                            </div>

                            @php
                                $munis = $municipiosPorEstado[$estado->id] ?? collect();
                            @endphp

                            @if ($munis->isEmpty())
                                <div class="text-muted small mt-1">Sin municipios asociados.</div>
                            @else
                                <div class="mt-2 d-flex flex-wrap gap-1">
                                    @foreach ($munis as $m)
                                        <span class="badge bg-info">{{ $m->nombre }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif

            </div>
        </div>

    </div>
@endsection
