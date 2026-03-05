@extends('layouts.app')

@section('styles')
    <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

     <link href="{{ asset('assets/css/actividades.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

    <x-breadcrumb title="Gestión de Actividades" icono="<i class='mdi mdi-format-list-checks'></i>" />

    <div class="row mb-3">
        <div class="col-sm-3">
            <x-boton.crear ruta="actividades.create" permiso="crear actividades" texto="Nueva Actividad" />
        </div>
    </div>

    <table id="actividades-table" class="table table-bordered w-100">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Descripción</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
    </table>

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
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>

    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        let actividadesTable;

        function initActividadesTable() {

            if (actividadesTable) {
                actividadesTable.destroy();
                $('#actividades-table').find('tbody').empty();
            }

            actividadesTable = $('#actividades-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: { details: { type: 'inline', target: 'tr' } },
                ajax: { url: '{{ route('actividades.data') }}' },
                order: [[0, 'desc']],
                lengthMenu: [[10, 25, 50, 100, -1],[10, 25, 50, 100, "Todos"]],
                columns: [
                    { data: 'id', name: 'id', className: 'all' },
                    { data: 'codigo', name: 'codigo', className: 'all' },
                    { data: 'descripcion', name: 'descripcion', className: 'all' },
                    { data: 'acciones', name: 'acciones', className: 'all text-center', orderable:false, searchable:false },
                ],
                language: { url: "{{ asset('assets/lang/datatables/es-ES.json') }}" },
                dom: 'lBfrtip',
                buttons: [
                    { extend:'copy',  text:'<i class="mdi mdi-content-copy"></i> Copiar', className:'btn btn-sm btn-outline-secondary' },
                    { extend:'excel', text:'<i class="mdi mdi-file-excel"></i> Excel', className:'btn btn-sm btn-outline-success' },
                    { extend:'pdf',   text:'<i class="mdi mdi-file-pdf"></i> PDF', className:'btn btn-sm btn-outline-danger' },
                    { extend:'print', text:'<i class="mdi mdi-printer"></i> Imprimir', className:'btn btn-sm btn-outline-dark' },
                ],
            });
        }

        // Eliminar con SweetAlert
        $(document).on('click', '.btn-delete', function() {
            const url = $(this).data('url');
            const nombre = $(this).data('nombre');

            Swal.fire({
                title: '¿Eliminar actividad?',
                text: `Se eliminará: ${nombre}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $('<form>', { method: 'POST', action: url });
                    form.append($('<input>', { type:'hidden', name:'_token', value:$('meta[name="csrf-token"]').attr('content') }));
                    form.append($('<input>', { type:'hidden', name:'_method', value:'DELETE' }));
                    $('body').append(form);
                    form.submit();
                }
            });
        });

        $(function() {
            initActividadesTable();
        });
    </script>

    {{-- SweetAlerts de sesión (solo una vez, sin redundancia) --}}
    @if (session('success'))
        <script>
            Swal.fire({ icon:'success', title:'Listo', text:@json(session('success')), timer:1600, showConfirmButton:false });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({ icon:'warning', title:'Atención', text:@json(session('error')) });
        </script>
    @endif
@endsection