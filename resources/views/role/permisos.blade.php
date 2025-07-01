@extends('layouts.app')

@section('title', 'Gestión de Permisos')

@section('styles')
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />

@endsection

@section('content')
    <div class="container-fluid">
        <x-breadcrumb title="Gestión de Permisos" />

        <div class="row">
            <div class="col-lg-6">
                <form action="{{ route('permission.store') }}" method="POST" class="card card-body">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nuevo Permiso</label>
                        <input type="text" name="name" class="form-control" placeholder="Ej: ver dashboard" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Permiso</button>
                </form>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Permisos Registrados</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permiso)
                                    <tr>
                                        <td>
                                            <form action="{{ route('permission.update', $permiso) }}" method="POST"
                                                class="d-flex">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="name" value="{{ $permiso->name }}"
                                                    class="form-control form-control-sm me-2" required>
                                                <button class="btn btn-sm btn-success">Guardar</button>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('permission.destroy', $permiso) }}" method="POST"
                                                class="form-eliminar d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                                @if ($permissions->isEmpty())
                                    <tr>
                                        <td colspan="2" class="text-center text-muted">No hay permisos registrados.</td>
                                    </tr>
                                @endif
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

    <script>
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
    </script>

    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        // Confirmación SweetAlert al eliminar
        document.querySelectorAll('.form-eliminar').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede deshacer",
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
    </script>
@endsection
