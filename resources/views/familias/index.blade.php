@extends('layouts.app')

@section('style')
    
    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container">
    @can('crear coordinaciones')
        <a href="{{ route('familias.create') }}" class="btn btn-primary mb-3">Nueva Coordinacion</a>
    @endcan

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ver entre hermanos</th>
                <th>Usuarios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($familias as $familia)
                <tr>
                    <td>{{ $familia->nombre }}</td>
                    <td>{{ $familia->ver_entre_hermanos ? 'Sí' : 'No' }}</td>
                    <td>{{ $familia->usuarios_count }}</td>
                    <td>
                        @can('editar coordinaciones')
                            <a href="{{ route('familias.edit', $familia) }}" class="btn btn-sm btn-warning">Editar</a>
                        @endcan

                        @can('eliminar coordinaciones')
                            <form action="{{ route('familias.destroy', $familia) }}" method="POST" class="d-inline form-eliminar">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
    {{-- SweetAlert CDN (si no lo tienes ya incluido en tu layout) --}}

    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>    



    <script>
        // Confirmación al eliminar
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.form-eliminar');
            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Esta acción no se puede deshacer.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Mostrar mensaje si existe en la sesión
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>


@endsection
