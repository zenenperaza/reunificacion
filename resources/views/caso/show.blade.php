@extends('layouts.app')

@section('title', 'Detalle del Caso')

@section('style')
    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />


@endsection
@section('content')

    <div class="container-fluid">

        {{-- <x-breadcrumb title="Mostrar Caso" /> --}}
        <x-breadcrumb title="Ver Caso " />

        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('casos.index') }}" class="btn btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Volver a la lista
                </a>
            </div>
        </div>

        <h4 class="mb-4">Detalle del Caso: {{ $caso->numero_caso }}</h4>

        <ul class="nav nav-tabs" id="casoTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="datos-tab" data-bs-toggle="tab" data-bs-target="#datos" type="button"
                    role="tab">Datos Generales</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ubicacion-tab" data-bs-toggle="tab" data-bs-target="#ubicacion" type="button"
                    role="tab">Ubicación</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="servicios-tab" data-bs-toggle="tab" data-bs-target="#servicios" type="button"
                    role="tab">Servicios</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="archivos-tab" data-bs-toggle="tab" data-bs-target="#archivos" type="button"
                    role="tab">Archivos</button>
            </li>
        </ul>
        <div id="caso-completo">
            <div class="tab-content p-3 border border-top-0" id="casoTabsContent">

                <!-- DATOS GENERALES -->
                <div class="tab-pane fade show active" id="datos" role="tabpanel">
                    <x-readonly-input label="Periodo" value="{{ $caso->periodo }}" />
                    <x-readonly-input label="Fecha de Atención"
                        value="{{ \Carbon\Carbon::parse($caso->fecha_atencion)->format('d/m/Y') }}" />
                    <x-readonly-input label="Tipo de Atención" value="{{ $caso->tipo_atencion }}" />
                    <x-readonly-input label="Fecha nacimiento"
                        value="{{ $caso->fecha_nacimiento ? \Carbon\Carbon::parse($caso->fecha_nacimiento)->format('d/m/Y') : '' }}" />

                    <x-readonly-input label="Beneficiario" value="{{ $caso->beneficiario }}" />
                    <x-readonly-input label="Edad del Beneficiario" value="{{ $caso->edad_beneficiario }}" />
                    <x-readonly-input label="Población LGBTI" value="{{ $caso->poblacion_lgbti }}" />
                    <x-readonly-input label="Estatus" value="{{ $caso->estatus }}" />
                    <x-readonly-input label="Observaciones" value="{{ $caso->observaciones }}" />
                    {{-- <x-readonly-input label="Verificador" value="{{ $caso->verificador }}" /> --}}

                    <x-readonly-input label="Condicion" value="{{ $caso->condicion }}" />
                </div>

                <!-- UBICACIÓN -->
                <div class="tab-pane fade" id="ubicacion" role="tabpanel">
                    <x-readonly-input label="Estado" value="{{ $caso->estado->nombre ?? '' }}" />
                    <x-readonly-input label="Municipio" value="{{ $caso->municipio->nombre ?? '' }}" />
                    <x-readonly-input label="Parroquia" value="{{ $caso->parroquia->nombre ?? '' }}" />
                    <x-readonly-input label="Dirección Domicilio" value="{{ $caso->direccion_domicilio }}" />
                    <x-readonly-input label="Número de Contacto" value="{{ $caso->numero_contacto }}" />
                </div>

                <!-- SERVICIOS -->
                <div class="tab-pane fade" id="servicios" role="tabpanel">
                    <x-readonly-input label="Organización Solicitante" value="{{ $caso->organizacion_solicitante }}" />
                    <x-readonly-input label="Organización Programa" value="{{ $caso->organizacion_programa }}" />
                    <x-readonly-input label="Tipo Atención Programa" value="{{ $caso->tipo_atencion_programa }}" />
                    <x-readonly-input label="Servicios COSUDE" value="{{ $caso->servicio_brindado_cosude }}" />
                    <x-readonly-input label="Servicios UNICEF" value="{{ $caso->servicio_brindado_unicef }}" />
                    <x-readonly-input label="Tipo Actuación" value="{{ $caso->tipo_actuacion }}" />
                    <x-readonly-input label="Otras Organizaciones" value="{{ $caso->otras_organizaciones }}" />
                    <x-readonly-list label="Vulnerabilidades" :items="json_decode($caso->vulnerabilidades, true)" />
                    <x-readonly-list label="Derechos Vulnerados" :items="json_decode($caso->derechos_vulnerados, true)" />
                    <x-readonly-list label="Identificación de Violencia" :items="json_decode($caso->identificacion_violencia, true)" />
                    <x-readonly-list label="Tipos de Violencia Vicaria" :items="json_decode($caso->tipos_violencia_vicaria, true)" />
                    <x-readonly-list label="Remisiones" :items="json_decode($caso->remisiones, true)" />
                    <x-readonly-list label="Indicadores" :items="json_decode($caso->indicadores, true)" />

                </div>

                <!-- ARCHIVOS -->
                <div class="tab-pane fade" id="archivos" role="tabpanel">
                    <x-readonly-files label="Fotos Adjuntas" :files="json_decode($caso->fotos, true)" type="image" />

                    <x-readonly-files label="Archivos Adjuntos" :files="json_decode($caso->archivos, true)" type="file" />
                </div>


            </div>
        </div>

        <div class="mt-4 d-flex flex-wrap justify-content-center gap-2">
            @if (!$caso->trashed())
                @can('aprobar casos')
                    <a href="#" class="btn btn-success btn-aprobar-caso" data-id="{{ $caso->id }}">
                        <i class="fas fa-hand-holding-heart"></i> Aprobar caso
                    </a>
                @endcan

                <a href="{{ route('casos.pdf', $caso->id) }}" class="btn btn-danger">
                    <i class="mdi mdi-file-pdf"></i> Descargar PDF
                </a>

                <button onclick="printCasoCompleto()" class="btn btn-dark">
                    <i class="mdi mdi-printer"></i> Imprimir
                </button>

                {{-- @can('clonar casos')
                    <a href="#" class="btn btn-success">
                        <i class="mdi mdi-clone"></i> Clonar caso actual
                    </a>
                @endcan --}}


                <a href="{{ route('casos.descargarArchivos', $caso->id) }}" class="btn btn-primary">
                    <i class="mdi mdi-folder-download"></i> Descargar Fotos y Archivos
                </a>

                @can('cierre atencion')
                    <a href="#" class="btn btn-warning btn-cerrar-atencion" data-id="{{ $caso->id }}">
                        <i class="fas fa-door-closed"></i> Cerrar atención
                    </a>
                @endcan
            @else
                @can('restaurar casos eliminados')
                    <button class="btn btn-success btn-restore" data-id="{{ $caso->id }}">
                        <i class="fas fa-trash-restore"></i> Restaurar
                    </button>
                @endcan
            @endif
        </div>




        <div class="mt-4">
            <a href="{{ route('casos.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Volver
            </a>
        </div>


    </div>
@endsection

@section('scripts')
    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>



    <script>
        function printCasoCompleto() {
            const contenido = document.getElementById('caso-completo').innerHTML;
            const ventana = window.open('', '', 'height=800,width=1000');
            ventana.document.write('<html><head><title>Detalle del Caso</title>');
            ventana.document.write('</head><body >');
            ventana.document.write(contenido);
            ventana.document.write('</body></html>');
            ventana.document.close();
            ventana.print();
        }
    </script>

    <script>
        $(document).on('click', '.btn-cerrar-atencion', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let url = '{{ url('/casos') }}/' + id + '/cerrar';
            let token = '{{ csrf_token() }}';

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Se cerrará la atención del caso.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, cerrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: token
                        },
                        success: function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Caso cerrado',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'No se pudo cerrar el caso.', 'error');
                        }
                    });
                }
            });
        });
    </script>


    <script>
        $(document).on('click', '.btn-restore', function() {
            let id = $(this).data('id');
            $.ajax({
                url: '/casos/' + id + '/restaurar',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Caso restaurado correctamente',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function() {
                    Swal.fire('Error', 'No se pudo restaurar el caso.', 'error');
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).on('click', '.btn-aprobar-caso', function(e) {
                e.preventDefault();
                const id = $(this).data('id');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas aprobar este caso?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, aprobar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/casos/' + id + '/aprobar',
                            method: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                aprobado: 'Aprobado'
                            },
                            success: function(response) {
                                Swal.fire('¡Aprobado!', response.message, 'success')
                                    .then(() => {
                                        location
                                    .reload(); // Recargar para reflejar cambios
                                    });
                            },
                            error: function() {
                                Swal.fire('Error', 'No se pudo aprobar el caso.',
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    </script>


@endsection
