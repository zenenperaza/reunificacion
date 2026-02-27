@extends('layouts.app')

@section('content')

<div class="page-content">
  <div class="container-fluid">
            <x-breadcrumb title="Detalle Donante" icono="<i class='mdi mdi-domain'></i>" activo="Detalle" />

        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('donantes.index') }}" class="btn btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Volver a la lista
                </a>
            </div>
        </div>

    <div class="card">
        <div class="card-body">

            <h4 class="mb-3">
                <i class="mdi mdi-domain"></i> {{ $donante->nombre }}
            </h4>

            <div class="mb-4">
                <strong>Contacto:</strong> {{ $donante->nombre_contacto ?? '-' }} <br>
                <strong>Teléfono:</strong> {{ $donante->telefono_contacto ?? '-' }} <br>
                <strong>Estatus:</strong>
                @if($donante->estatus)
                    <span class="badge bg-success">Activo</span>
                @else
                    <span class="badge bg-danger">Inactivo</span>
                @endif
            </div>

            <hr>

            <h5 class="mb-3">
                <i class="mdi mdi-folder-multiple-outline"></i> Proyectos
            </h5>

            @forelse($donante->proyectos as $proyecto)

                <div class="card mb-3 border">
                    <div class="card-body">

                        <h6 class="fw-bold">
                            {{ $proyecto->codigo }} - {{ $proyecto->descripcion }}
                        </h6>

                        <small>
                            <strong>Inicio:</strong> {{ optional($proyecto->inicio)->format('d/m/Y') }} |
                            <strong>Fin:</strong> {{ optional($proyecto->fin)->format('d/m/Y') }}
                        </small>

                        <div class="mt-3">

                            @foreach($proyecto->indicadorProyecto as $ip)

                                <div class="mb-2 p-2 bg-light rounded">

                                    <strong>
                                        <i class="mdi mdi-chart-line"></i>
                                        {{ $ip->indicador->codigo }}
                                    </strong>

                                    <div class="ms-3 mt-2">

                                        @foreach($ip->actividadIndicador as $ai)

                                            <div class="mb-2">

                                                <i class="mdi mdi-clipboard-text-outline"></i>
                                                {{ $ai->actividad->descripcion }}

                                                <ul class="mt-1">
                                                    @foreach($ai->servicios as $servicio)
                                                        <li>
                                                            <i class="mdi mdi-wrench-outline"></i>
                                                            {{ $servicio->nombre }}
                                                            ({{ $servicio->pivot->cantidad_disponible }})
                                                        </li>
                                                    @endforeach
                                                </ul>

                                            </div>

                                        @endforeach

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>
                </div>

            @empty
                <div class="alert alert-info">
                    Este donante no tiene proyectos asociados.
                </div>
            @endforelse

        </div>
    </div>

</div>
</div>

@endsection