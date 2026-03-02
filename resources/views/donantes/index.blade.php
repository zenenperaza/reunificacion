@extends('layouts.app')
@section('title', 'Donantes')

@section('styles')
    <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- si quieres tu mismo estilo --}}
    <link href="{{ asset('assets/css/casos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/donantes.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <x-breadcrumb title="Gestión de Donantes" icono="<i class='mdi mdi-hand-holding-usd'></i>" />

            <div class="row mb-3 d-flex my-2 justify-content-between">
                <div class="col-sm-3">

                    <x-boton.crear ruta="donantes.create" permiso="crear donantes" texto="Nuevo Donante" />

                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="donantes-table" class="table table-bordered align-middle table-nowrap mb-0 w-100">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Contacto</th>
                                    <th>Teléfono</th>
                                    <th class="text-center">Estatus</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                        </table>

                    </div>

                    <div class="mt-3">
                        {{ $donantes->links() }}
                    </div>

                </div>
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

    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>

    <script src="{{ asset('assets/libs/mohithg-switchery/switchery.min.js') }}"></script>

    <script>
        let donantesTable;

        function initDonantesTable() {

            if (donantesTable) {
                donantesTable.destroy();
                $('#donantes-table').find('tbody').empty();
            }

            donantesTable = $('#donantes-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: {
                    details: {
                        type: 'inline',
                        target: 'tr'
                    }
                },
                ajax: {
                    url: '{{ route('donantes.data') }}',
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
                        data: 'nombre',
                        name: 'nombre',
                        className: 'all'
                    },
                    {
                        data: 'contacto',
                        name: 'contacto',
                        className: 'all'
                    },
                    {
                        data: 'telefono',
                        name: 'telefono',
                        className: 'all'
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

                // ✅ Importante para Switchery (se vuelve a dibujar por AJAX)
                drawCallback: function() {
                    document.querySelectorAll('.switch-donante').forEach(function(el) {
                        // evita duplicar Switchery
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

        // ✅ filtro estatus
        $(document).on('change', '#filtro_estatus', function() {
            if (donantesTable) donantesTable.ajax.reload();
        });
   
        // ✅ SweetAlert eliminar (versión corregida y limpia)
        $(document).on('click', '.btn-delete', function() {

            const url = $(this).data('url');
            const nombre = $(this).data('nombre');

            Swal.fire({
                title: '¿Eliminar donante?',
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

                    // CSRF
                    form.append($('<input>', {
                        type: 'hidden',
                        name: '_token',
                        value: $('meta[name="csrf-token"]').attr('content')
                    }));

                    // METHOD DELETE
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

        // ✅ Toggle estatus con Switchery (la clase correcta)
        $(document).on('change', '.switch-donante', function() {

            const checkbox = $(this);
            const id = checkbox.data('id');
            const url = "{{ url('donantes') }}/" + id + "/estatus";

            checkbox.prop('disabled', true);

            $.ajax({
                url: url,
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Estatus actualizado',
                        timer: 1200,
                        showConfirmButton: false
                    });

                    // recargar sin resetear paginación
                    donantesTable.ajax.reload(null, false);
                },
                error: function() {
                    // revertir si falla
                    checkbox.prop('checked', !checkbox.prop('checked'));

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo cambiar el estatus'
                    });

                    // si el switch visual se desincroniza, recarga
                    if (donantesTable) donantesTable.ajax.reload(null, false);
                },
                complete: function() {
                    checkbox.prop('disabled', false);
                }
            });
        });

        // ✅ iniciar
        $(function() {
            initDonantesTable();
        });
    </script>

@endsection
