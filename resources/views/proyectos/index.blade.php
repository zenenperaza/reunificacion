@extends('layouts.app')
@section('title', 'Proyectos')


@section('styles')
    <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- si quieres tu mismo estilo --}}
    <link href="{{ asset('assets/css/casos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/proyectos.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">

        <x-breadcrumb title="Gestión de Proyectos" icono="<i class='mdi mdi-folder'></i>" />

        <div class="row mb-3">
            <div class="col-sm-3">
                <x-boton.crear ruta="proyectos.create" permiso="crear proyectos" texto="Nuevo Proyecto" />
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-circle-outline me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-alert-circle-outline me-1"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table id="proyectos-table" class="table table-bordered w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Donante</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Estados</th>
                    <th>Municipios</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody></tbody>
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

    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>

    <script src="{{ asset('assets/libs/mohithg-switchery/switchery.min.js') }}"></script>

    <script>
        let proyectosTable;

        function initProyectosTable() {

            if (proyectosTable) {
                proyectosTable.destroy();
                $('#proyectos-table').find('tbody').empty();
            }

            proyectosTable = $('#proyectos-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: {
                    details: {
                        type: 'inline',
                        target: 'tr'
                    }
                },
                ajax: {
                    url: '{{ route('proyectos.data') }}',
                    data: function(d) {
                        d.estatus = $('#filtro_estatus').val();
                    }
                },
                order: [
                    [0, 'desc']
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Todos"]
                ],
                columns: [{
                        data: 'id',
                        name: 'id',
                        className: 'all'
                    },
                    {
                        data: 'donante_nombre',
                        name: 'donante.nombre',
                        className: 'all'
                    },
                    {
                        data: 'codigo',
                        name: 'codigo',
                        className: 'all'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion',
                        className: 'all'
                    },
                    {
                        data: 'inicio_fmt',
                        name: 'inicio',
                        className: 'all'
                    },
                    {
                        data: 'fin_fmt',
                        name: 'fin',
                        className: 'all'
                    },
                    {
                        data: 'estados_info',
                        name: 'estados_info',
                        className: 'all text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'municipios_info',
                        name: 'municipios_info',
                        className: 'all text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'estatus_html',
                        name: 'estatus',
                        className: 'all text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'acciones',
                        name: 'acciones',
                        className: 'all text-center',
                        orderable: false,
                        searchable: false
                    },
                ],
                language: {
                    url: "{{ asset('assets/lang/datatables/es-ES.json') }}"
                },
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'copy',
                        text: '<i class="mdi mdi-content-copy"></i> Copiar',
                        className: 'btn btn-sm btn-outline-secondary'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="mdi mdi-file-excel"></i> Excel',
                        className: 'btn btn-sm btn-outline-success'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="mdi mdi-file-pdf"></i> PDF',
                        className: 'btn btn-sm btn-outline-danger'
                    },
                    {
                        extend: 'print',
                        text: '<i class="mdi mdi-printer"></i> Imprimir',
                        className: 'btn btn-sm btn-outline-dark'
                    },
                ],
                drawCallback: function() {
                    document.querySelectorAll('.switch-proyecto').forEach(function(el) {
                        if (!el.dataset.switchery) {
                            new Switchery(el, {
                                color: '#039cfd',
                                size: 'small'
                            });
                        }
                    });
                }
            });
        }

        // filtro estatus
        $(document).on('change', '#filtro_estatus', function() {
            if (proyectosTable) proyectosTable.ajax.reload();
        });

        // toggle estatus (sin reload total; actualiza label)
        $(document).on('change', '.switch-proyecto', function() {

            const checkbox = $(this);
            const id = checkbox.data('id');
            const url = "{{ url('proyectos') }}/" + id + "/estatus";
            const label = checkbox.closest('td').find('.switch-label');

            checkbox.prop('disabled', true);

            $.ajax({
                url: url,
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    if (checkbox.is(':checked')) {
                        label.text('Activo').removeClass('text-danger').addClass('text-success');
                    } else {
                        label.text('Inactivo').removeClass('text-success').addClass('text-danger');
                    }
                },
                error: function() {
                    checkbox.prop('checked', !checkbox.prop('checked'));
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo cambiar el estatus'
                    });
                    if (proyectosTable) proyectosTable.ajax.reload(null, false);
                },
                complete: function() {
                    checkbox.prop('disabled', false);
                }
            });
        });

        // delete SweetAlert
        $(document).on('click', '.btn-delete', function() {

            const url = $(this).data('url');
            const nombre = $(this).data('nombre');

            Swal.fire({
                title: '¿Eliminar proyecto?',
                text: `Se eliminará: ${nombre}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $('<form>', {
                        method: 'POST',
                        action: url
                    });
                    form.append($('<input>', {
                        type: 'hidden',
                        name: '_token',
                        value: $('meta[name="csrf-token"]').attr('content')
                    }));
                    form.append($('<input>', {
                        type: 'hidden',
                        name: '_method',
                        value: 'DELETE'
                    }));
                    $('body').append(form);
                    form.submit();
                }
            });
        });

        $(function() {
            initProyectosTable();
        });
    </script>


@endsection
