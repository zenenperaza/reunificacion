@extends('layouts.app')

@section('title', 'Mantenimiento de Casos')

@section('styles')

    <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/daterangepicker/daterangepicker.css') }}" rel="stylesheet">


    <link href="{{ asset('assets/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')



    <div class="container-fluid">
        <x-breadcrumb title="Gestión de Casos" />

        <div class="row mb-3  d-flex my-2 justify-content-between">
            <div class="col-sm-3">
                {{-- <a href="{{ route('casos.create') }}" class="btn btn btn-primary">
                    <i class="mdi mdi-plus"></i> Nuevo Caso
                </a> --}}
                <x-boton.crear ruta="casos.create" permiso="crear casos" texto="Nuevo Caso" />

            </div>
            <div class="col-md-3 ms-auto text-end">
                <div class="dropdown w-100">
                    <button
                        class="btn btn-success dropdown-toggle w-100 d-flex align-items-center justify-content-center gap-2"
                        type="button" id="dropdownImportarExcel" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/excel.jpg') }}" alt="Excel" width="20" height="20">
                        Importar Excel
                    </button>
                    <ul class="dropdown-menu w-100" aria-labelledby="dropdownImportarExcel">
                        <li>
                            <a class="dropdown-item" href="{{ route('casos.importar.vista') }}">
                                <i class="mdi mdi-file-excel"></i> Importar casos (previsualización)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('casos.plantilla') }}">
                                <i class="mdi mdi-download"></i> Descargar excel de ejemplo
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        {{-- Bloque de filtros y exportación --}}
        <div class="row mb-3  d-flex my-2 justify-content-between">
            {{-- Filtros: Fecha y Estatus --}}
            <div class="col-md-9 gap-2">
                <div class="accordion" id="accordionFiltros">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFiltros" style="margin-bottom: 10px;">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFiltros" aria-expanded="false" aria-controls="collapseFiltros"
                                style="padding: 4px 20px; color: red; font-size: medium; padding: 10px 15px;">
                                Filtros
                            </button>
                        </h2>
                        <div id="collapseFiltros" class="accordion-collapse collapse" aria-labelledby="headingFiltros"
                            data-bs-parent="#accordionFiltros">
                            <div class="accordion-body">
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center"
                                        id="daterange-btn">
                                        <i class="far fa-calendar-alt me-1"></i> Buscar por fecha actual
                                        <i class="fas fa-caret-down ms-1"></i>
                                    </button>

                                    <select id="filtro_estatus" class="btn btn-outline-primary">
                                        <option value="">Todos los estatus</option>
                                        <option value="En proceso">En proceso</option>
                                        <option value="En seguimiento">En seguimiento</option>
                                        <option value="Cierre de atención">Cierre de atención</option>
                                    </select>

                                    <button id="clear-daterange" class="btn btn-outline-secondary">
                                        <i class="mdi mdi-filter-remove me-1"></i> Limpiar filtro
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Botón de Exportación --}}
            <div class="col-md-3 text-end">
                <div class="dropdown w-100">
                    <button
                        class="btn btn-success dropdown-toggle w-100 d-flex align-items-center justify-content-center gap-2"
                        type="button" id="dropdownExportExcel" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/excel.jpg') }}" alt="Excel" width="20" height="20">
                        Exportar Excel
                    </button>
                    <ul class="dropdown-menu w-100" aria-labelledby="dropdownExportExcel">
                        <li>
                            <a id="exportExcel" class="dropdown-item" href="#">
                                <i class="mdi mdi-file-excel"></i> Exportar casos
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

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif


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
                            <th>Condicion</th>
                            <th>Estatus</th>
                            <th>Estado</th>
                            <th>Estado</th>
                            <th>Municipio</th>
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

    <script src="{{ asset('assets/libs/mohithg-switchery/switchery.min.js') }}"></script>

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
                    d.estatus = $('#filtro_estatus').val(); // <-- Agregar esta línea
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
                    data: 'condicion',
                    name: 'condicion',
                },
                {
                    data: 'estatus',
                    name: 'estatus'
                },
                 {
                    data: 'estado_completado',
                    name: 'estado_completado',
                    className: 'text-center',
                    orderable: true,
                    searchable: true
                },

                {
                    data: 'estado.nombre',
                    name: 'estado.nombre',
                    className: 'none'
                },
                {
                    data: 'municipio.nombre',
                    name: 'municipio.nombre',
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
                }
            ],
            drawCallback: function() {
                $('.switch-status').each(function() {
                    new Switchery(this, {
                        color: '#039cfd'
                    });
                });
            },
            createdRow: function(row, data, dataIndex) {
                let badgeClass = '';
                switch (data.estatus) {
                    case 'En proceso':
                        badgeClass = 'bg-warning text-dark';
                        break;
                    case 'En seguimiento':
                        badgeClass = 'bg-primary';
                        break;
                    case 'Cierre de atención':
                        badgeClass = 'bg-success';
                        break;
                }

                if (badgeClass !== '') {
                    const badgeHTML = `<span class="badge ${badgeClass}">${data.estatus}</span>`;
                    $('td', row).eq(7).html(badgeHTML); // reemplaza contenido de la celda de estatus
                }
            }



        });

        $('#filtro_estatus').on('change', function() {
            dataTable.ajax.reload();
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

            const dt = $('#casos-table').DataTable();

            // Capturamos el search más reciente usando el input directamente
            const searchInput = $('input[type=search]').val();

            const url = new URL('{{ route('casos.exportarExcel') }}', window.location.origin);

            if (startDate && endDate) {
                url.searchParams.append('start_date', startDate);
                url.searchParams.append('end_date', endDate);
            }

            const estatus = $('#filtro_estatus').val();
            if (estatus) {
                url.searchParams.append('estatus', estatus);
            }

            if (searchInput) {
                url.searchParams.append('search', searchInput);
            }

            window.location.href = url.toString();
        });
    </script>




    <script>
        let tablaCasos = $('#casos-table').DataTable();

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
                            Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                                text: 'El caso ha sido eliminado.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            tablaCasos.ajax.reload(null, false);
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

    <script>
        document.getElementById('importarCasosPorExcel').addEventListener('click', function() {
            document.getElementById('inputArchivoExcel').click();
        });

        document.getElementById('inputArchivoExcel').addEventListener('change', function() {
            document.getElementById('formImportarExcel').submit();
        });

        document.getElementById('descargarExcelEjemplo').addEventListener('click', function() {
            window.location.href = "{{ route('casos.plantilla') }}";
        });
    </script>

    <script>
        $('#clear-daterange').on('click', function() {
            startDate = null;
            endDate = null;
            $('#filtro_estatus').val('');
            $('#daterange-btn span').text('Buscar por fecha actual');
            dataTable.ajax.reload();
        });
    </script>

    <script>
        // Función para bindear el evento correctamente
        function bindSwitchStatusEvent() {
            $('.switch-status').off('change').on('change', function() {
                const id = $(this).data('id');
                const aprobado = $(this).is(':checked') ? 'Aprobado' : 'En espera';

                $.ajax({
                    url: '/casos/' + id + '/aprobar',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        aprobado: aprobado
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            toast: true,
                            position: 'top-center',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'No se pudo cambiar la condición.',
                            toast: true,
                            position: 'top-center',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
                dataTable.ajax.reload();
            });
        }

        // Al cargar el DOM
        $(document).ready(function() {
            // Llamar inmediatamente si ya están cargados los switches
            bindSwitchStatusEvent();

            // Si usas DataTables, vuelve a enlazar después de cada redibujado
            $('#casos-table').on('draw.dt', function() {
                bindSwitchStatusEvent();
            });
        });
    </script>

    <script>
        $(document).ready(function () {
    // Re-inicializar tooltips cada vez que se dibuje la tabla
    $('#casos-table').on('draw.dt', function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
});

    </script>

    @if (session('success'))
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
            <div class="toast align-items-center text-white bg-success border-0 show" role="alert"
                aria-live="assertive" aria-atomic="true">
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
