@extends('layouts.app')

@section('title', 'Bitácora del Sistema')

@section('styles')
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Bitácora del Sistema</h2>

    <div class="table-responsive">
        <table id="tabla-bitacora" class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Acción</th>
                    <th>Módulo</th>
                    <th>Detalles</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        $(document).ready(function () {
            $('#tabla-bitacora').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('bitacora.data') }}',
                columns: [
                    { data: 'fecha', name: 'created_at' },
                    { data: 'usuario', name: 'causer.name' },
                    { data: 'description', name: 'description' },
                    { data: 'modulo', name: 'log_name' },
                    { data: 'detalles', name: 'properties', orderable: false, searchable: false },
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                }
            });
        });
    </script>
@endsection
