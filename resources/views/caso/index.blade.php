@extends('layouts.app')

@section('title', 'Mantenimiento de Casos')

@section('styles')

    <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet">

    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/daterangepicker/daterangepicker.css') }}" rel="stylesheet">

@endsection

@section('content')



    <div class="container-fluid">
   <x-breadcrumb title="Gestión de Casos" />

        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{ route('casos.create') }}" class="btn btn btn-primary">
                    <i class="mdi mdi-plus"></i> Nuevo Caso
                </a>
            </div>
        </div>
        <div class="form-group d-flex my-2">
            <div class="input-group  d-flex justify-content-start">
                <button type="button" class="btn btn btn-outline-primary" id="daterange-btn">
                    <i class="far fa-calendar-alt"></i> Buscar por fecha actual
                    <i class="fas fa-caret-down"></i>
                </button>
                <button id="clear-daterange" class="btn btn-outline-secondary btn-sm">
                    <i class="mdi mdi-filter-remove"></i> Limpiar filtro
                </button>

            </div>

            <div class="col-md-3 d-flex align-items-end justify-content-end">
                <div class="dropdown w-100">
                    <button
                        class="btn btn-outline-success dropdown-toggle w-100 d-flex align-items-center justify-content-center gap-2"
                        type="button" id="dropdownExportExcel" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/excel.jpg') }}" alt="Excel" width="20" height="20">
                        Exportar Excel
                    </button>
                    <ul class="dropdown-menu w-100" aria-labelledby="dropdownExportExcel">
                        <li>
                            <a id="exportExcel" class="dropdown-item" href="#">
                                <i class="mdi mdi-file-excel"></i> Exportar todos los casos
                            </a>
                        </li>
                        <li>
                            <a id="exportPorEstatus" class="dropdown-item" href="#">
                                <i class="mdi mdi-file-excel"></i> Exportar por Estatus
                            </a>
                        </li>
                        <li>
                            <a id="exportPorEstado" class="dropdown-item"
                                href="{{ route('casos.exportarPorEstado', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}">
                                <i class="mdi mdi-file-excel"></i> Exportar por Estado
                            </a>
                        </li>
                    </ul>
                </div>
            </div>



        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Lista de Casos</h4>
                <table id="casos-table" class="table table-bordered dt-responsive nowrap w-100">

                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>N° Caso</th>
                            <th>Beneficiario</th>
                            <th>Tipo Atención</th>
                            <th>Fecha atencion</th>
                            <th>Fecha actual</th>
                            <th>Estado</th>
                            <th>Municipio</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteCasoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form id="deleteCasoForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCasoModalLabel">¿Eliminar caso?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro que deseas eliminar el caso <strong id="casoIdModal"></strong>?</p>
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

    <!-- DataTables núcleo + Bootstrap 5 -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>

    <!-- Responsive -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <!-- Botones -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <!-- PDF y Excel -->
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>

    <!-- Moment y Rango de Fechas -->
    <script src="{{ asset('assets/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/libs/daterangepicker/daterangepicker.js') }}"></script>

    <script>
        let startDate = null;
        let endDate = null;

        // Inicializar DataTable
        const dataTable = $('#casos-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: {
                details: {
                    type: 'inline',
                    target: 'tr'
                }
            },
            ajax: {
                url: '{{ route('casos.data') }}',
                data: function(d) {
                    d.start_date = startDate ?? '';
                    d.end_date = endDate ?? '';
                }

            },
            order: [
                [0, 'desc']
            ],
            columns: [{
                    data: 'id',
                    name: 'id',
                    className: 'all'
                },
                {
                    data: 'numero_caso',
                    name: 'numero_caso',
                    className: 'all'
                },
                {
                    data: 'beneficiario',
                    name: 'beneficiario'
                },
                {
                    data: 'tipo_atencion',
                    name: 'tipo_atencion'
                },
                {
                    data: 'fecha_atencion',
                    name: 'fecha_atencion'
                },
                {
                    data: 'fecha_actual',
                    name: 'fecha_actual'
                },
                {
                    data: 'estado.nombre',
                    name: 'estado.nombre'
                },
                {
                    data: 'municipio.nombre',
                    name: 'municipio.nombre'
                },
                {
                    data: 'estatus',
                    name: 'estatus',
                    className: 'none'
                },
                {
                    data: 'acciones',
                    name: 'acciones',
                    orderable: false,
                    searchable: false,
                    className: 'all text-center'
                }
            ],
            language: {
                url: "{{ asset('assets/lang/datatables/es-ES.json') }}"
            },
            dom: 'Bfrtip',
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
                }
            ]
        });
    </script>


    <script>
        // Inicializar el DateRangePicker
        $('#daterange-btn').daterangepicker({
            autoUpdateInput: false,
            showCustomRangeLabel: true,
            locale: {
                format: 'YYYY-MM-DD',
                applyLabel: 'Aplicar',
                cancelLabel: 'Cancelar',
                customRangeLabel: 'Rango personalizado'
            },
            ranges: {
                'Hoy': [moment(), moment()],
                'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
                'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
                'Este mes': [moment().startOf('month'), moment().endOf('month')],
                'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                    'month')]
            }
        }, function(start, end, label) {
            // Este callback se llama en cualquier selección válida
            startDate = start.format('YYYY-MM-DD');
            endDate = end.format('YYYY-MM-DD');

            $('#daterange-btn span').text(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
            dataTable.ajax.reload();
        });

        // Forzar que al hacer click sobre “Hoy” (u otra opción) se vuelva a ejecutar el callback
        $(document).on('click', '.ranges li', function() {
            const label = $(this).text().trim();
            const picker = $('#daterange-btn').data('daterangepicker');

            if (picker.ranges[label]) {
                const range = picker.ranges[label];
                picker.setStartDate(range[0]);
                picker.setEndDate(range[1]);
                picker.callback(range[0], range[1], label);
            }
        });

        // Botón de cancelar
        $('#daterange-btn').on('cancel.daterangepicker', function(ev, picker) {
            startDate = null;
            endDate = null;
            $('#daterange-btn span').text('Buscar por fecha actual');
            dataTable.ajax.reload();
        });
    </script>

    <script>
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var casoId = button.data('caso-id');

            var modal = $(this);
            modal.find('#casoIdModal').text(casoId);
            modal.find('#deleteCasoForm').attr('action', '/casos/' + casoId);
        });
    </script>



    <script>
        $('#exportExcel').on('click', function(e) {
            e.preventDefault();

            const url = new URL('{{ route('casos.exportarExcel') }}', window.location.origin);

            if (startDate && endDate) {
                url.searchParams.append('start_date', startDate);
                url.searchParams.append('end_date', endDate);
            }

            window.location.href = url.toString();
        });
    </script>

    <script>
        let tablaCasos = $('#casos-table').DataTable(); // reemplaza #miTabla con el ID real de tu tabla

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let url = $(this).data('url');
            let nombre = $(this).data('nombre');

            Swal.fire({
                title: '¿Está seguro?',
                text: "Se eliminará el caso: " + nombre,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'DELETE'
                        },
                        success: function(respuesta) {
                            Swal.fire(
                                '¡Eliminado!',
                                'El caso ha sido eliminado.',
                                'success'
                            );
                            tablaCasos.ajax.reload(null,
                                false); // recargar sin reiniciar la paginación
                        },
                        error: function() {
                            Swal.fire(
                                'Error',
                                'Ocurrió un error al intentar eliminar.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>

    <script>
        document.getElementById('exportPorEstatus').addEventListener('click', function(e) {
            e.preventDefault();

            const url = new URL('{{ route('casos.exportarPorEstatus') }}', window.location.origin);
            if (startDate && endDate) {
                url.searchParams.append('start_date', startDate);
                url.searchParams.append('end_date', endDate);
            }

            window.location.href = url.toString();
        });
    </script>



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
