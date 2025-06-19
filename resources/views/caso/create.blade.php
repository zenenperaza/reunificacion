@extends('layouts.app')

@section('title', 'Crear Caso')

@section('styles')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Registro de Caso</h4>
                <form action="{{ route('casos.store') }}" method="POST" enctype="multipart/form-data" id="formCaso">
                    @csrf

                    <div id="progressbarwizard">

                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                            <li class="nav-item">
                                <a href="#tab1" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-account-circle me-1"></i>
                                    <span class="d-none d-sm-inline">Informacion general</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab2" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-face-profile me-1"></i>
                                    <span class="d-none d-sm-inline">Datos del beneficiaria/o</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab3" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                    <span class="d-none d-sm-inline">Adjuntos</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content b-0 mb-0 pt-0">

                            <div id="bar" class="progress mb-3" style="height: 7px;">
                                <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                            </div>

                            <div class="tab-pane" id="tab1">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="periodo" class="form-label mb-2">Periodo</label>
                                                    <input type="text" class="form-control" name="periodo"
                                                        value="{{ date('Y-m') }}" required readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="fecha_atencion" class="form-label mb-2">Fecha de
                                                        Atención</label>
                                                    <input type="date" class="form-control" name="fecha_atencion"
                                                        required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Estado -> Municipio -> Parroquia -->
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label for="estadoSelect" class="form-label mb-2">Estado</label>
                                                <select id="estadoSelect" class="form-select" name="estado_id">
                                                    <option value="">Seleccione</option>
                                                    @foreach ($estados as $estado)
                                                        <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-4">
                                                <label for="municipioSelect" class="form-label mb-2">Municipio</label>
                                                <select id="municipioSelect" class="form-select" name="municipio_id">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-4">
                                                <label for="parroquiaSelect" class="form-label mb-2">Parroquia</label>
                                                <select id="parroquiaSelect" class="form-select" name="parroquia_id">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label for="elaborado_por" class="form-label mb-2">Elaborado por</label>
                                                <input type="text" class="form-control" name="elaborado_por"
                                                    value="{{ auth()->user()->name }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="numero_caso" class="form-label mb-2">Numero de
                                                        caso</label>
                                                    <input type="text" class="form-control" name="numero_caso"
                                                        value="" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label for="" class="form-label mb-2">Organizacion
                                                    programas</label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" value="UNICEF"
                                                        id="unicef" name="organizacion_programas[]" checked>
                                                    <label class="form-check-label" for="unicef">Unicef</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" value="COSUDE"
                                                        id="cosude" name="organizacion_programas[]">
                                                    <label class="form-check-label" for="cosude">COSUDE</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <div class="mt-0">
                                                    <label class="form-label mb-2 ">Organizacion solicitante</label>
                                                    <div class="row">
                                                        @php
                                                            $organizaciones = [
                                                                'Diócesis',
                                                                'UNICEF',
                                                                'World Vision',
                                                                'CORPRODINCO',
                                                                'INTERSOS',
                                                                'UNIANDES',
                                                                'ICBF Colombia',
                                                                'Save the Children',
                                                                'OIM',
                                                                'Aideas Infantiles',
                                                                'Defensoría NNA',
                                                                'CISP',
                                                                'HIAS',
                                                                'IRC',
                                                                'Otras organizaciones',
                                                            ];

                                                        @endphp

                                                        @foreach ($organizaciones as $organizacion)
                                                            <div class="col-md-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="organizacion_solicitante[]"
                                                                        value="{{ $organizacion }}"
                                                                        id="{{ Str::slug($organizacion, '_') }}">
                                                                    <label class="form-check-label"
                                                                        for="{{ Str::slug($organizacion, '_') }}">
                                                                        {{ $organizacion }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" id="otrasOrganizacionesContainer"
                                                style="display: none;">
                                                <div class="mt-3">
                                                    <label for="otras_organizaciones" class="form-label mb-2">Otras
                                                        organizaciones</label>
                                                    <input type="text" class="form-control"
                                                        name="otras_organizaciones" id="otras_organizaciones" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <div class="mt-0">
                                                    <label class="form-label mb-2 ">Tipo de Atención - Programas</label>
                                                    <div class="row">
                                                        @php
                                                            $tipo_atencion_programa = [
                                                                'Reunificación familiar',
                                                                'Localización familiar',
                                                                'Retorno voluntario',
                                                            ];

                                                        @endphp

                                                        @foreach ($tipo_atencion_programa as $tipo_atencion)
                                                            <div class="col-md-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="tipo_atencion_programa[]"
                                                                        value="{{ $tipo_atencion }}"
                                                                        id="{{ Str::slug($tipo_atencion, '_') }}">
                                                                    <label class="form-check-label"
                                                                        for="{{ Str::slug($tipo_atencion, '_') }}">
                                                                        {{ $tipo_atencion }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label for="" class="form-label mb-2">Tipo de atencion</label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tipo_atencion"
                                                        id="individual" value="Individual">
                                                    <label class="form-check-label" for="individual">
                                                        Individual
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tipo_atencion"
                                                        id="grupo_familiar" value="Grupo familiar">
                                                    <label class="form-check-label" for="grupo_familiar">
                                                        Grupo familiar
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab2">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="row bm-3">

                                            <div class="col-md-8">
                                                <div class="mt-0">
                                                    <label class="form-label mb-2 ">Beneficiario</label>
                                                    <div class="row">
                                                        @php
                                                            $beneficiario_programa = [
                                                                'Niña adolescente',
                                                                'Mujer joven',
                                                                'Mujer adulta',
                                                                'Niño adolescente',
                                                                'Hombre joven',
                                                                'Hombre adulto',
                                                            ];

                                                        @endphp

                                                        @foreach ($beneficiario_programa as $beneficiario)
                                                            <div class="col-md-4 mb-1">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="beneficiario[]" value="{{ $beneficiario }}"
                                                                        id="{{ Str::slug($beneficiario, '_') }}">
                                                                    <label class="form-check-label"
                                                                        for="{{ Str::slug($beneficiario, '_') }}">
                                                                        {{ $beneficiario }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-8" id="estado-mujer-block" style="display: none;">
                                                <div class="mt-3">
                                                    <label class="form-label mb-2 ">Estado beneficiario (Si es
                                                        mujer)</label>
                                                    <div class="row">
                                                        @php
                                                            $beneficiario_estado = [
                                                                'Embarazada',
                                                                'Lactante',
                                                                'No aplica',
                                                            ];

                                                        @endphp

                                                        @foreach ($beneficiario_estado as $estado)
                                                            <div class="col-md-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="estado_mujer[]" value="{{ $estado }}"
                                                                        id="{{ Str::slug($estado, '_') }}">
                                                                    <label class="form-check-label"
                                                                        for="{{ Str::slug($estado, '_') }}">
                                                                        {{ $estado }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-4 mt-0">
                                                <label class="form-label mb-2">Edad del beneficiario</label>
                                                <select class="form-select" name="edad_beneficiario"
                                                    id="edad-beneficiario-select">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label for="" class="form-label mb-2">Poblacion LGBTI</label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="poblacion_lgbti"
                                                        id="poblacion_si" value="Si">
                                                    <label class="form-check-label" for="poblacion_si">
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="poblacion_lgbti"
                                                        id="poblacion_no" value="No">
                                                    <label class="form-check-label" for="poblacion_no">
                                                        No
                                                    </label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-3">

                                            <div class="col-md-8">
                                                <div class="mt-0">
                                                    <label class="form-label mb-2 "> Acompanante</label>
                                                    <div class="row">
                                                        @php
                                                            $acompantes = [
                                                                'Padre',
                                                                'Madre',
                                                                'Representante legal',
                                                                'No aplica acompanante',
                                                            ];

                                                        @endphp

                                                        @foreach ($acompantes as $acompanante)
                                                            <div class="col-md-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input acompanante-opcion"
                                                                        type="checkbox" name="acompanante[]"
                                                                        value="{{ $acompanante }}"
                                                                        id="{{ Str::slug($acompanante, '_') }}"
                                                                        data-es-no-aplica="{{ $acompanante === 'No aplica acompanante' ? '1' : '0' }}">

                                                                    <label class="form-check-label"
                                                                        for="{{ Str::slug($acompanante, '_') }}">
                                                                        {{ $acompanante }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row mt-3" id="genero_representante" style="display: none;">
                                            <div class="col-md-6">
                                                <label for="" class="form-label mb-2">Genero - Representante
                                                    legal</label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="representante_legal" id="mujer" value="Mujer">
                                                    <label class="form-check-label" for="mujer">
                                                        Mujer
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="representante_legal" id="hombre" value="Hombre">
                                                    <label class="form-check-label" for="hombre">
                                                        Hombre
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">

                                            <div class="col-md-6">
                                                <div class="mt-0">
                                                    <label class="form-label mb-2">País de procedencia</label>
                                                    <select class="form-select" name="pais_procedencia"
                                                        id="pais_procedencia" required>
                                                        <option value="">Seleccione</option>
                                                        @php
                                                            $paises = [
                                                                'Venezuela',
                                                                'Argentina',
                                                                'Bolivia',
                                                                'Brasil',
                                                                'Chile',
                                                                'Colombia',
                                                                'Costa Rica',
                                                                'Cuba',
                                                                'Ecuador',
                                                                'El Salvador',
                                                                'Guayana Francesa',
                                                                'Granada',
                                                                'Guatemala',
                                                                'Guayana',
                                                                'Haití',
                                                                'Honduras',
                                                                'Jamaica',
                                                                'México',
                                                                'Nicaragua',
                                                                'Paraguay',
                                                                'Panamá',
                                                                'Perú',
                                                                'Puerto Rico',
                                                                'República Dominicana',
                                                                'Surinam',
                                                                'Uruguay',
                                                                'Estados Unidos',
                                                                'Otro País',
                                                            ];
                                                        @endphp

                                                        @foreach ($paises as $pais)
                                                            <option value="{{ $pais }}">{{ $pais }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6" id="otro_pais_container" style="display: none;">
                                                <div class="mt-0">
                                                    <label for="otro_pais" class="form-label mb-2">Indique otro
                                                        pais</label>
                                                    <input type="text" class="form-control" name="otro_pais"
                                                        id="otro_pais">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label for="" class="form-label mb-2"> Nacionalidad del
                                                    solicitante</label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="nacionalidad_solicitante" id="Venezolana"
                                                        value="Venezolana">
                                                    <label class="form-check-label" for="Venezolana">
                                                        Venezolana
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="nacionalidad_solicitante" id="Extranjera"
                                                        value="Extranjera">
                                                    <label class="form-check-label" for="Extranjera">
                                                        Extranjera
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mt-0">
                                                    <label class="form-label mb-2">Tipo de documento</label>
                                                    <select class="form-select" name="tipo_documento" id="tipo_documento"
                                                        required>
                                                        <option value="">Seleccione</option>
                                                        @php
                                                            $tipo_documento = [
                                                                'Certificado de nacimiento',
                                                                'Acta de nacimiento (partida de nacimiento)',
                                                                'Cédula',
                                                                'Pasaporte',
                                                                'NO posee documentos',
                                                            ];
                                                        @endphp

                                                        @foreach ($tipo_documento as $tipo)
                                                            <option value="{{ $tipo }}">{{ $tipo }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mt-3">
                                                    <label class="form-label mb-2">Etnia indígena</label>
                                                    <select class="form-select" name="etnia_indigena"
                                                        id="etnia_indigena">
                                                        <option value="">Seleccione</option>
                                                        @php
                                                            $etnias_indigenas = [
                                                                'Akawayo',
                                                                'Añu',
                                                                'Banova o Kurripako',
                                                                'Barí',
                                                                'Chaima',
                                                                'Cuiva',
                                                                'Gayón',
                                                                'Hoti',
                                                                'Japrería',
                                                                'Jirajara',
                                                                'Jivi',
                                                                'Kariña',
                                                                'Maki',
                                                                'Mapoyo',
                                                                'Panare',
                                                                'Pemón',
                                                                'Piapoko o Wenaiwika',
                                                                'Puinave',
                                                                'Pumé',
                                                                'Sáliba',
                                                                'Sanema',
                                                                'Sapé',
                                                                'Urak',
                                                                'Waike',
                                                                'Waikerí',
                                                                'Wanukia',
                                                                'Waraos',
                                                                'Wayúu',
                                                                'Wottuja-Piaroa',
                                                                'Yabarana',
                                                                'Yanomami',
                                                                'Yekuana',
                                                                'Yukpa',
                                                                'Otra Etnia',
                                                            ];
                                                        @endphp
                                                        @foreach ($etnias_indigenas as $etnia)
                                                            <option value="{{ $etnia }}">{{ $etnia }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6" id="otra_etnia_container" style="display: none;">
                                                <div class="mt-3">
                                                    <label for="otra_etnia" class="form-label mb-2">Indique otra
                                                        etnia</label>
                                                    <input type="text" class="form-control" name="otra_etnia"
                                                        id="otra_etnia" disabled>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mt-3">
                                            <div class="mb-0">
                                                <label class="form-label mb-2">Servicio Brindado COSUDE</label>
                                                <select class="form-control select2" name="servicio_brindado_cosude[]"
                                                    multiple>
                                                    @foreach ($cosude ?? [] as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6cmt-3">
                                            <div class="mb-3">
                                                <label class="form-label mb-2">Servicio Brindado UNICEF</label>
                                                <select class="form-control select2" name="servicio_brindado_unicef[]"
                                                    multiple>
                                                    @foreach ($unicef ?? [] as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label mb-2">Vulnerabilidades</label>
                                                <select class="form-control select2" name="vulnerabilidades[]" multiple>
                                                    @foreach ($vulnerabilidades ?? [] as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label mb-2">Derechos Vulnerados</label>
                                                <select class="form-control select2" name="derechos_vulnerados[]"
                                                    multiple>
                                                    @foreach ($derechos ?? [] as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row mb-3">
                                            <label class="form-label mb-2">Imágenes</label>
                                            <div class="dropzone" id="dropzoneImages"></div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="form-label mb-2">Archivos</label>
                                            <div class="dropzone" id="dropzoneFiles"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="list-inline mt-4 wizard">
                                <li class="previous list-inline-item">
                                    <a href="javascript: void(0);" class="btn btn-secondary">Anterior</a>
                                </li>
                                <li class="next list-inline-item float-end">
                                    <a href="javascript: void(0);" class="btn btn-secondary">Siguiente</a>
                                </li>
                            </ul>

                        </div>
                    </div>



                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>

    <script src="{{ asset('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/mohithg-switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
    <script src="{{ asset('assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>

    <script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-fileuploads.init.js') }}"></script>

    <!-- Init js-->
    {{-- <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script> --}}
    <script>
        $('.select2').select2();

        Dropzone.autoDiscover = false;
        let uploadedImages = [];
        let uploadedFiles = [];

        let dropzoneImages = new Dropzone("#dropzoneImages", {
            url: "{{ route('casos.upload.imagenes') }}",
            paramName: "imagenes[]",
            maxFilesize: 5,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            success: function(file, response) {
                uploadedImages.push(response);
            }
        });

        let dropzoneFiles = new Dropzone("#dropzoneFiles", {
            url: "{{ route('casos.upload.archivos') }}",
            paramName: "archivos[]",
            maxFilesize: 10,
            acceptedFiles: '.pdf,.doc,.docx,.xls,.xlsx,.zip,.rar',
            addRemoveLinks: true,
            success: function(file, response) {
                uploadedFiles.push(response);
            }
        });

        document.getElementById("formCaso").addEventListener("submit", function(e) {
            let form = this;
            let inputImg = document.createElement('input');
            inputImg.type = 'hidden';
            inputImg.name = 'fotos';
            inputImg.value = JSON.stringify(uploadedImages);
            form.appendChild(inputImg);

            let inputFiles = document.createElement('input');
            inputFiles.type = 'hidden';
            inputFiles.name = 'archivos';
            inputFiles.value = JSON.stringify(uploadedFiles);
            form.appendChild(inputFiles);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#estadoSelect').on('change', function() {
                var estadoId = $(this).val();
                $('#municipioSelect').html('<option value="">Cargando...</option>');
                $('#parroquiaSelect').html('<option value="">Seleccione</option>');

                if (estadoId) {
                    $.ajax({
                        url: '{{ url('get-municipios') }}/' + estadoId,

                        type: 'GET',
                        success: function(data) {
                            let options = '<option value="">Seleccione</option>';
                            data.forEach(function(municipio) {
                                options +=
                                    `<option value="${municipio.id}">${municipio.nombre}</option>`;
                            });
                            $('#municipioSelect').html(options);
                        },
                        error: function() {
                            alert('Error al cargar municipios.');
                            $('#municipioSelect').html('<option value="">Seleccione</option>');
                        }
                    });
                } else {
                    $('#municipioSelect').html('<option value="">Seleccione</option>');
                }
            });

            $('#municipioSelect').on('change', function() {
                var municipioId = $(this).val();
                $('#parroquiaSelect').html('<option value="">Cargando...</option>');

                if (municipioId) {
                    $.ajax({
                        url: '{{ url('get-parroquias') }}/' + municipioId,

                        type: 'GET',
                        success: function(data) {
                            let options = '<option value="">Seleccione</option>';
                            data.forEach(function(parroquia) {
                                options +=
                                    `<option value="${parroquia.id}">${parroquia.nombre}</option>`;
                            });
                            $('#parroquiaSelect').html(options);
                        },
                        error: function() {
                            alert('Error al cargar parroquias.');
                            $('#parroquiaSelect').html('<option value="">Seleccione</option>');
                        }
                    });
                } else {
                    $('#parroquiaSelect').html('<option value="">Seleccione</option>');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            const checkboxOtras = $('#otras_organizaciones'); // Este es el checkbox
            const inputContainer = $('#otrasOrganizacionesContainer');
            const inputText = inputContainer.find('input');

            checkboxOtras.on('change', function() {
                if ($(this).is(':checked')) {
                    inputContainer.show();
                    inputText.prop('disabled', false).prop('required', true);
                } else {
                    inputContainer.hide();
                    inputText.prop('disabled', true).prop('required', false).val('');
                }
            });

            // Mostrar el input si estaba seleccionado en reenvío con errores
            if (checkboxOtras.is(':checked')) {
                inputContainer.show();
                inputText.prop('disabled', false).prop('required', true);
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const estadoSelect = document.getElementById('estadoSelect');
            const numeroCasoInput = document.querySelector('input[name="numero_caso"]');

            estadoSelect.addEventListener('change', function() {
                const estadoId = this.value;

                fetch(`/casos/contador-estado/${estadoId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.estado_nombre === 'Táchira') {
                            const nuevoNumero = String(data.conteo + 1).padStart(3, '0');
                            numeroCasoInput.value = `TCT-25-${nuevoNumero}`;
                        } else {
                            numeroCasoInput.value = '';
                        }
                    });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[name="beneficiario[]"]');
            const estadoMujerBlock = document.getElementById('estado-mujer-block');

            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const valor = this.value.toLowerCase();
                    if (valor.includes('mujer') || valor.includes('niña')) {
                        estadoMujerBlock.style.display = 'block';
                    } else {
                        estadoMujerBlock.style.display = 'none';
                        // Limpia los checkboxes marcados si se oculta
                        estadoMujerBlock.querySelectorAll('input[type="checkbox"]').forEach(cb => cb
                            .checked = false);
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const embarazada = document.getElementById('embarazada');
            const lactante = document.getElementById('lactante');
            const noAplica = document.getElementById('no_aplica');

            function actualizarChecks() {
                if (noAplica.checked) {
                    embarazada.checked = false;
                    lactante.checked = false;
                }
            }

            function bloquearNoAplica() {
                if (embarazada.checked || lactante.checked) {
                    noAplica.checked = false;
                }
            }

            embarazada.addEventListener('change', function() {
                bloquearNoAplica();
            });

            lactante.addEventListener('change', function() {
                bloquearNoAplica();
            });

            noAplica.addEventListener('change', function() {
                actualizarChecks();
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reunificacion = document.getElementById('reunificacion_familiar');
            const localizacion = document.getElementById('localizacion_familiar');
            const retorno = document.getElementById('retorno_voluntario');

            function limpiarOtrosSiRetorno() {
                if (retorno.checked) {
                    reunificacion.checked = false;
                    localizacion.checked = false;
                }
            }

            function limpiarRetornoSiOtros() {
                if (reunificacion.checked || localizacion.checked) {
                    retorno.checked = false;
                }
            }

            reunificacion.addEventListener('change', limpiarRetornoSiOtros);
            localizacion.addEventListener('change', limpiarRetornoSiOtros);
            retorno.addEventListener('change', limpiarOtrosSiRetorno);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const edadSelect = document.getElementById('edad-beneficiario-select');
            const radios = document.querySelectorAll('input[name="beneficiario[]"]');

            const rangos = {
                'niña_adolescente': [0, 17],
                'mujer_joven': [18, 21],
                'mujer_adulta': [22, 100],
                'niño_adolescente': [0, 17],
                'hombre_joven': [18, 21],
                'hombre_adulto': [22, 100]
            };

            function llenarRango(edadMin, edadMax) {
                edadSelect.innerHTML = '<option value="">Seleccione</option>';
                for (let i = edadMin; i <= edadMax; i++) {
                    edadSelect.innerHTML += `<option value="${i}">${i}</option>`;
                }
            }

            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const key = this.id; // usa el ID generado por Str::slug
                    if (rangos[key]) {
                        const [min, max] = rangos[key];
                        llenarRango(min, max);
                    } else {
                        edadSelect.innerHTML = '<option value="">Seleccione</option>';
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.acompanante-opcion');

            checkboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    const esNoAplica = this.dataset.esNoAplica === '1';

                    if (esNoAplica && this.checked) {
                        // Desmarcar todos los demás si se marcó "No aplica"
                        checkboxes.forEach(other => {
                            if (other !== this) other.checked = false;
                        });
                    } else if (!esNoAplica && this.checked) {
                        // Desmarcar "No aplica" si se marcó cualquier otro
                        checkboxes.forEach(other => {
                            if (other.dataset.esNoAplica === '1') {
                                other.checked = false;
                            }
                        });
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('representante_legal');
            const generoDiv = document.getElementById('genero_representante');

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    generoDiv.style.display = 'flex'; // o 'block' si prefieres
                } else {
                    generoDiv.style.display = 'none';
                    generoDiv.querySelectorAll('input[type="radio"]').forEach(r => r.checked = false);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('no_aplica_acompanante');
            const generoDiv = document.getElementById('genero_representante');

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    generoDiv.style.display = 'none'; // o 'block' si prefieres
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectPais = document.getElementById('pais_procedencia');
            const otroPaisContainer = document.getElementById('otro_pais_container');
            const otroPaisInput = document.getElementById('otro_pais');

            selectPais.addEventListener('change', function() {
                if (this.value === 'Otro País') {
                    otroPaisContainer.style.display = 'block';
                    otroPaisInput.disabled = false;
                    otroPaisInput.required = true;
                } else {
                    otroPaisContainer.style.display = 'none';
                    otroPaisInput.disabled = true;
                    otroPaisInput.required = false;
                    otroPaisInput.value = '';
                }
            });

            // Ejecutar al cargar por si viene con datos preseleccionados
            if (selectPais.value === 'Otro País') {
                otroPaisContainer.style.display = 'block';
                otroPaisInput.disabled = false;
                otroPaisInput.required = true;
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectNacimiento = document.getElementById('pais_nacimiento');
            const otroNacimientoContainer = document.getElementById('otro_pais_nacimiento_container');
            const otroNacimientoInput = document.getElementById('otro_pais_nacimiento');

            selectNacimiento.addEventListener('change', function() {
                if (this.value === 'Otro país nac') {
                    otroNacimientoContainer.style.display = 'block';
                    otroNacimientoInput.disabled = false;
                    otroNacimientoInput.required = true;
                } else {
                    otroNacimientoContainer.style.display = 'none';
                    otroNacimientoInput.disabled = true;
                    otroNacimientoInput.required = false;
                    otroNacimientoInput.value = '';
                }
            });

            // Ejecutar al cargar por si ya está seleccionado
            if (selectNacimiento.value === 'Otro país nac') {
                otroNacimientoContainer.style.display = 'block';
                otroNacimientoInput.disabled = false;
                otroNacimientoInput.required = true;
            }
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectEtnia = document.getElementById('etnia_indigena');
        const otraEtniaContainer = document.getElementById('otra_etnia_container');
        const otraEtniaInput = document.getElementById('otra_etnia');

        selectEtnia.addEventListener('change', function () {
            if (this.value === 'Otra Etnia') {
                otraEtniaContainer.style.display = 'block';
                otraEtniaInput.disabled = false;
                otraEtniaInput.required = true;
            } else {
                otraEtniaContainer.style.display = 'none';
                otraEtniaInput.disabled = true;
                otraEtniaInput.required = false;
                otraEtniaInput.value = '';
            }
        });

        // Ejecutar al cargar por si ya está seleccionado
        if (selectEtnia.value === 'Otra Etnia') {
            otraEtniaContainer.style.display = 'block';
            otraEtniaInput.disabled = false;
            otraEtniaInput.required = true;
        }
    });
</script>




@endsection
