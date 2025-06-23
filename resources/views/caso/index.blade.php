@extends('layouts.app')

@section('title', 'Mantenimiento de Casos')

@section('styles')

    <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet">


    <link href="{{ asset('assets/libs/daterangepicker/daterangepicker.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{ route('casos.create') }}" class="btn btn-success">
                    <i class="mdi mdi-plus"></i> Nuevo Caso
                </a>
            </div>
        </div>
        <div class="form-group d-flex m-2">
            <div class="input-group  d-flex justify-content-start">
                <button type="button" class="btn btn-default " id="daterange-btn">
                    <i class="far fa-calendar-alt"></i> Buscar por fecha actual
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>
            <div class="col-md-3 d-flex align-items-end justify-content-end">
                <a id="exportExcel" href="#"
                    class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center gap-2">
                    <img src="{{ asset('assets/images/excel.jpg') }}" alt="Excel" width="20" height="20">
                    Exportar a Excel
                </a>
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
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Responsive -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>

    <!-- Botones -->
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>

    <!-- PDF y Excel -->
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>

    <script src="assets/libs/moment/moment.js"></script>

    <script src="assets/libs/daterangepicker/daterangepicker.js"></script>

    <script>
        let startDate = '';
        let endDate = '';

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
                    d.start_date = startDate;
                    d.end_date = endDate;
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

        // Inicializar el DateRangePicker
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
                    'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
                    'Este mes': [moment().startOf('month'), moment().endOf('month')],
                    'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                        'month')]
                },
                locale: {
                    format: 'YYYY-MM-DD',
                    applyLabel: 'Aplicar',
                    cancelLabel: 'Cancelar',
                    customRangeLabel: 'Rango personalizado'
                },
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month')
            },
            function(start, end) {
                startDate = start.format('YYYY-MM-DD');
                endDate = end.format('YYYY-MM-DD');
                dataTable.ajax.reload(); // Recarga la tabla con los filtros
            }
        );

        // Exportar a Excel con filtros activos
        document.getElementById('exportExcel').addEventListener('click', function(e) {
            e.preventDefault();

            const url = new URL('{{ route('casos.exportarExcel') }}', window.location.origin);
            url.searchParams.append('start_date', startDate || '');
            url.searchParams.append('end_date', endDate || '');

            window.location.href = url.toString();
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

            // Construye la URL con los filtros aplicados
            let url = '{{ route('casos.exportarExcel') }}?start_date=' + startDate + '&end_date=' + endDate;

            window.location.href = url;
        });



        // //Date range as a button
        // $('#daterange-btn').daterangepicker({
        //         ranges: {
        //             'Today': [moment(), moment()],
        //             'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        //             'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        //             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        //             'This Month': [moment().startOf('month'), moment().endOf('month')],
        //             'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
        //                 'month')]
        //         },
        //         startDate: moment().subtract(29, 'days'),
        //         endDate: moment()
        //     },
        //     function(start, end) {
        //         $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        //     }
        // )
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
