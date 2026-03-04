@extends('layouts.app')

@section('styles')
    <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    
    <link href="{{ asset('assets/css/indicadores.css') }}" rel="stylesheet">

@endsection


@section('content')
<div class="container-fluid">

    <x-breadcrumb title="Gestión de Indicadores" icono="<i class='mdi mdi-chart-line'></i>" />

    <div class="row mb-3">
        <div class="col-sm-3">
            <x-boton.crear ruta="indicadores.create" permiso="crear indicadores" texto="Nuevo Indicador" />
        </div>

    </div>

    <table id="indicadores-table" class="table table-bordered w-100">
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
    <script src="{{ asset('assets/libs/mohithg-switchery/switchery.min.js') }}"></script>

    <script>
        let indicadoresTable;

        function initIndicadoresTable() {

            if (indicadoresTable) {
                indicadoresTable.destroy();
                $('#indicadores-table').find('tbody').empty();
            }

            indicadoresTable = $('#indicadores-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: { details: { type: 'inline', target: 'tr' } },
                ajax: {
                    url: '{{ route('indicadores.data') }}',
                    data: function(d) {
                        d.estatus = $('#filtro_estatus').val();
                    }
                },
                order: [[0,'desc']],
                columns: [
                    { data:'id', name:'id', className:'all' },
                    { data:'codigo', name:'codigo', className:'all' },
                    { data:'descripcion', name:'descripcion', className:'all' },
                    { data:'acciones', name:'acciones', className:'all text-center', orderable:false, searchable:false },
                ],
                language: { url: "{{ asset('assets/lang/datatables/es-ES.json') }}" },
                dom: 'lBfrtip',
                buttons: [
                    { extend:'copy',  text:'<i class="mdi mdi-content-copy"></i> Copiar', className:'btn btn-sm btn-outline-secondary' },
                    { extend:'excel', text:'<i class="mdi mdi-file-excel"></i> Excel', className:'btn btn-sm btn-outline-success' },
                    { extend:'pdf',   text:'<i class="mdi mdi-file-pdf"></i> PDF', className:'btn btn-sm btn-outline-danger' },
                    { extend:'print', text:'<i class="mdi mdi-printer"></i> Imprimir', className:'btn btn-sm btn-outline-dark' },
                ],
                drawCallback: function() {
                    document.querySelectorAll('.switch-indicador').forEach(function(el) {
                        if (!el.dataset.switchery) {
                            new Switchery(el, { color: '#039cfd', size: 'small' });
                        }
                    });
                }
            });
        }

        $(document).on('change', '#filtro_estatus', function(){
            if (indicadoresTable) indicadoresTable.ajax.reload();
        });

      

        // Delete SweetAlert
        $(document).on('click', '.btn-delete', function() {

            const url = $(this).data('url');
            const nombre = $(this).data('nombre');

            Swal.fire({
                title: '¿Eliminar indicador?',
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
            initIndicadoresTable();
        });
    </script>
@endsection