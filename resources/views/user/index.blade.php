@extends('layouts.app')

@section('title', 'Mantenimiento de Usuarios')

@section('styles')

    <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">


    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid mx-2">
        <x-breadcrumb title="Gestión de usuarios" icono="<i class='mdi mdi-account-outline'></i>" />
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{ route('users.create') }}" class="btn btn-success">
                    <i class="mdi mdi-plus"></i> Nuevo Usuario
                </a>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif


        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Lista de Usuarios</h4>
                <div class="table-responsive">
                    <table id="users-table" class="table table-bordered dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Superior</th> {{-- nueva columna --}}
                                <th>Foto</th>
                                <th>Coordinaciones</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="deleteUserForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteUserModalLabel">¿Eliminar usuario?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro que deseas eliminar al usuario <strong id="userNameModal"></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- DataTables scripts -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/mohithg-switchery/switchery.min.js') }}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        $(function() {
            let tabla = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roles',
                        name: 'roles'
                    },
                    {
                        data: 'superior',
                        name: 'superior'
                    },
                    {
                        data: 'photo',
                        name: 'photo',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'familias',
                        name: 'familias',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'estatus',
                        name: 'estatus'
                    },
                    {
                        data: 'acciones',
                        name: 'acciones',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    url: "{{ asset('assets/lang/datatables/es-ES.json') }}"
                },
                drawCallback: function() {
                    $('.switch-status').each(function() {
                        new Switchery(this, {
                            color: '#039cfd'
                        });
                    });
                }
            });
            

            // Manejo de cambio de estatus
            $(document).on('change', '.switch-status', function() {
                let checkbox = $(this);
                let id = checkbox.data('id');
                let estatus = checkbox.is(':checked') ? 'activo' : 'inactivo';

                $.ajax({
                    url: '/users/' + id + '/estatus',
                    method: 'POST',
                    data: {
                        estatus: estatus,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        let label = checkbox.next('.estatus-label');
                        label.text(estatus.charAt(0).toUpperCase() + estatus.slice(1));

                        Swal.fire({
                            icon: 'success',
                            title: 'Actualizado',
                            text: 'El estatus del usuario ha sido actualizado.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var userId = button.data('user-id');
            var userName = button.data('user-name');

            var modal = $(this);
            modal.find('#userNameModal').text(userName);
            modal.find('#deleteUserForm').attr('action', '/users/' + userId);
        });
    </script>

    <!-- Dropzone JS (ya debe estar incluido con Admininto, si no, inclúyelo aquí) -->
    <script></script>


    @if (session('success'))
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
            <div class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Cerrar"></button>
                </div>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
            <div class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Cerrar"></button>
                </div>
            </div>
        </div>
    @endif

@endsection
