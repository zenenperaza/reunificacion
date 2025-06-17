@extends('layouts.app')

@section('title', 'Mantenimiento de Usuarios')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-sm-12">
            <a href="{{ route('users.create') }}" class="btn btn-success">
                <i class="mdi mdi-plus"></i> Nuevo Usuario
            </a>
        </div>
    </div>

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
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- DataTables scripts -->
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

<script>
$('#users-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route("users.data") }}',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'role.name', name: 'role.name' }, // CORREGIDO
        { data: 'estatus', name: 'estatus' },
        { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
    ],
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json'
    }
});

</script>
@endsection
