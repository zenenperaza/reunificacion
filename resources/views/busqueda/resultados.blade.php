@extends('layouts.app')

@section('styles')
    <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <x-breadcrumb title="Búsquedas" icono="<i class='fas fa-tachometer-alt'></i>" />

    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Resultados para: "<span class="text-primary">{{ $search }}</span>"</h4>

            @if ($resultados->count())
                <table id="tabla-resultados" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Beneficiario</th>
                            <th>Tipo de atención</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resultados as $caso)
                            <tr>
                                <td>{{ $caso->beneficiario }}</td>
                                <td>{{ $caso->tipo_atencion }}</td>
                                <td>{{ \Carbon\Carbon::parse($caso->fecha_atencion)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('casos.show', $caso->id) }}" class="btn btn-info btn-sm">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No se encontraron resultados.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#tabla-resultados').DataTable({
            responsive: true,
            language: {
                url: "{{ asset('assets/lang/datatables/es-ES.json') }}"
            }
        });
    });
</script>
@endsection
