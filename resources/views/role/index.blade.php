@extends('layouts.app')

@section('title', 'role y Permisos')

@section('styles')

    <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet">

    {{-- Núcleo de DataTables + Bootstrap 5 --}}
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <div class="container-fluid">
        <x-breadcrumb title="Roles y Permisos" />
        <div class="row">
            <div class="col-12">
                <a href="{{ route('role.create') }}" class="btn btn-primary mb-3">
                    <i class="mdi mdi-plus"></i> Nuevo Rol
                </a>
                <div class="card">
                    <div class="card-body">
                        <table id="roles-table" class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Rol</th>
                                    <th>Permisos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $rol)
                                    <tr>
                                        <td>{{ ucfirst($rol->name) }}</td>
                                        <td>
                                            @foreach ($rol->permissions as $permiso)
                                                <span class="badge bg-info text-white">{{ $permiso->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('role.edit', $rol) }}"
                                                class="btn btn-sm btn-warning m-1">Editar</a>
                                            <form action="{{ route('role.destroy', $rol) }}" method="POST"
                                                class="form-eliminar d-inline-block m-1">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>    

    <!-- DataTables -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>

    <!-- Inicialización de la tabla -->
    <script>
        $(document).ready(function() {
            $('#roles-table').DataTable({
                language: {
                    url: "{{ asset('assets/lang/datatables/es-ES.json') }}"
                },
                pageLength: 10
            });
        });
    </script>

    <script>
        // Confirmación de eliminación con SweetAlert2
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.form-eliminar').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Esta acción no se puede deshacer',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Notificaciones de éxito/error
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    timer: 2500,
                    showConfirmButton: false
                });
            @endif
        });
    </script>

@endsection
