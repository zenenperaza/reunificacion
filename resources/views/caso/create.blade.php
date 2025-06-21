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
                                    <span class="d-none d-sm-inline">Descripcion del proceso</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab4" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-flag-checkered me-1"></i>
                                    <span class="d-none d-sm-inline">Vulnerabilidades</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab5" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-flag-checkered me-1"></i>
                                    <span class="d-none d-sm-inline">Derechos vulnerados</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab6" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-file-image-outline me-1"></i>
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
                                                    <input type="text" class="form-control" name="periodo" id="periodo"
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
                                                        id="unicef" name="organizacion_programas[]">
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

                                        {{-- Beneficiario --}}
                                        <div class="row mt-3">
                                            <div class="col-md-8">
                                                <label class="form-label mb-2">Beneficiaria/o del programa</label>
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
                                                                    name="beneficiario" value="{{ $beneficiario }}"
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

                                        {{-- Educación --}}
                                        <div class="row mt-3" id="bloque_educacion" style="display: none;">
                                            <div class="col-md-12">
                                                <label class="form-label fw-bold">* Educación</label>
                                                <small class="d-block text-muted mb-2">Elegir si estudia NNA</small>
                                                <div class="row">
                                                    @php
                                                        $opciones_educacion = ['Si estudia', 'No estudia', 'No Aplica'];
                                                    @endphp

                                                    @foreach ($opciones_educacion as $opcion)
                                                        <div class="col-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="educacion" value="{{ $opcion }}"
                                                                    id="{{ Str::slug($opcion, '_') }}">
                                                                <label class="form-check-label"
                                                                    for="{{ Str::slug($opcion, '_') }}">
                                                                    {{ $opcion }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Nivel educativo y tipo institución --}}
                                        <div class="row mt-3" id="bloque_nivel_educativo_tipo_isntitucion"
                                            style="display: none;">
                                            <div class="col-md-6">
                                                <label for="nivel_educativo_cursado" class="form-label fw-bold">* Nivel
                                                    educativo cursado</label>
                                                <small class="d-block text-muted mb-2">Elegir nivel educativo NNA</small>
                                                <select class="form-select" name="nivel_educativo"
                                                    id="nivel_educativo_cursado">
                                                    <option value="">Seleccione</option>
                                                    @foreach (['Inicial', 'Primaria', 'Media', 'Técnica', 'Universitaria', 'Misiones', 'Especial', 'Ninguna'] as $nivel)
                                                        <option value="{{ $nivel }}">{{ $nivel }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="tipo_institucion" class="form-label fw-bold">Tipo
                                                    institución</label>
                                                <small class="d-block text-muted mb-2">Elegir institución</small>
                                                <select class="form-select" name="tipo_institucion"
                                                    id="tipo_institucion">
                                                    <option value="">Seleccione</option>
                                                    @foreach (['Pública', 'Privada', 'Privada subsidiada', 'Ninguna institución'] as $tipo)
                                                        <option value="{{ $tipo }}">{{ $tipo }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-8" id="estado-mujer-block" style="display: none;">
                                                <div class="mt-3">
                                                    <label class="form-label mb-2 ">Estado beneficiario (Si es
                                                        mujer)</label>
                                                    <div class="row">
                                                        @php
                                                            $beneficiario_estado = [
                                                                'Embarazada',
                                                                'Lactante',
                                                                'No aplica estado',
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

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <div class="mt-0">
                                                    <label class="form-label mb-2">País de nacimiento</label>
                                                    <select class="form-select" name="pais_nacimiento"
                                                        id="pais_nacimiento" required>
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

                                            <div class="col-md-6" id="otro_pais_nacimiento_container"
                                                style="display: none;">
                                                <div class="mt-0">
                                                    <label for="otro_pais" class="form-label mb-2">Indique otro
                                                        país de nacimiento</label>
                                                    <input type="text" class="form-control"
                                                        name="otro_pais_nacimientos" id="otro_pais_nacimientos">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
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



                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab3">

                                <div class="row mt-3" id="servicios_brindados_cosude_container" style="display: none;">
                                    <div class="col-md-12">
                                        <div class="mt-0">
                                            <label class="form-label mb-1 fw-bold">Servicios brindados
                                                COSUDE</label>
                                            <div class="row">
                                                @php
                                                    $servicios_cosude = [
                                                        'Kits de higiene personal',
                                                        'Kit de alimentación (cesta de alimentos)',
                                                        'Platos servidos',
                                                        'Movilizaciones por caso',
                                                        'Hospedaje',
                                                        'Ningún servicio COSUDE',
                                                    ];

                                                @endphp

                                                @foreach ($servicios_cosude as $servicio)
                                                    <div class="col-md-4 mt-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="servicio_brindado_cosude[]"
                                                                value="{{ $servicio }}"
                                                                id="{{ Str::slug($servicio, '_') }}">
                                                            <label class="form-check-label"
                                                                for="{{ Str::slug($servicio, '_') }}">
                                                                {{ $servicio }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3" id="servicios_brindados_unicef_block" style="display: none;">
                                    <div class="mt-0 col-md-12">
                                        <label class="form-label mb-1 fw-bold">Servicos brindados
                                            UNICEF</label>
                                        <div class="row">
                                            @php
                                                $servicios_unicef = [
                                                    'Kits de higiene (NNA)',
                                                    'Viáticos alimentos',
                                                    'Traslado (NNA)',
                                                    'Traslado seguimiento',
                                                    'Traslado consejeros',
                                                    'Traslado personal ASONACOP',
                                                    'Orientación',
                                                    'Orientación legal',
                                                    'Kits de alimentación (ASONACOP)',
                                                    'Kits de higiene (ASONACOP)',
                                                    'Ningún servicio UNICEF',
                                                ];

                                            @endphp

                                            @foreach ($servicios_unicef as $servicio)
                                                <div class="col-md-4 mt-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="servicio_brindado_unicef[]" value="{{ $servicio }}"
                                                            id="{{ Str::slug($servicio, '_') }}">
                                                        <label class="form-check-label"
                                                            for="{{ Str::slug($servicio, '_') }}">
                                                            {{ $servicio }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Estado destino -> Municipio destino -> Parroquia destino -->
                                <div class="row mt-3">
                                    <div class="col-lg-4">
                                        <label for="estadoDestinoSelect" class="form-label mb-2">Estado destino</label>
                                        <select id="estadoDestinoSelect" class="form-select" name="estado_destino_id">
                                            <option value="">Seleccione</option>
                                            @foreach ($estados as $estado)
                                                <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="municipioDestinoSelect" class="form-label mb-2">Municipio
                                            destino</label>
                                        <select id="municipioDestinoSelect" class="form-select"
                                            name="municipio_destino_id">
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="parroquiaDestinoSelect" class="form-label mb-2">Parroquia
                                            destino</label>
                                        <select id="parroquiaDestinoSelect" class="form-select"
                                            name="parroquia_destino_id">
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="direccion_domicilio" class="form-label mb-2">Direccion de
                                                domicilio </label>
                                            <input type="text" class="form-control" name="direccion_domicilio"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="numero_contacto" class="form-label mb-2">Numero de
                                                contacto</label>
                                            <input type="text" class="form-control" name="numero_contacto"
                                                value="">
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">* Tipo de actuación</label>
                                        <small class="d-block text-muted mb-2">Seleccionar si aplica</small>
                                        <div class="row">
                                            @php
                                                $tipos_actuacion = [
                                                    'Gestoría de casos',
                                                    'Derivaciones',
                                                    'Asistencia jurídica',
                                                    'Asesorías',
                                                    'Orientaciones',
                                                    'Otros tipos de actuación',
                                                ];
                                            @endphp

                                            @foreach ($tipos_actuacion as $tipo)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="tipo_actuacion[]" value="{{ $tipo }}"
                                                            id="{{ Str::slug($tipo, '_') }}">
                                                        <label class="form-check-label"
                                                            for="{{ Str::slug($tipo, '_') }}">
                                                            {{ $tipo }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- Campo extra visible solo si se marca "Otros tipos de actuación" --}}
                                        <div class="mt-3" id="otros_actuacion_container" style="display: none;">
                                            <label for="otros_actuacion_texto" class="form-label">Describa otro tipo de
                                                actuación</label>
                                            <input type="text" class="form-control" name="otros_actuacion_descripcion"
                                                id="otros_actuacion_texto" placeholder="Especifique...">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane" id="tab4">

                                {{-- VULNERABILIDADES --}}
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Vulnerabilidades</label>
                                        <small class="d-block text-muted mb-2">Elegir varias opciones de ser
                                            necesario</small>
                                        <div class="row">
                                            @php
                                                $vulnerabilidades = [
                                                    'NNA separados',
                                                    'NNA no acompañados',
                                                    'Violencia física / abuso físico / castigo físico',
                                                    'Violencia verbal / violencia emocional o psicológica / abuso emocional',
                                                    'Violencia sexual / abuso sexual / explotación sexual / VBG / VSBG',
                                                    'Negligencia',
                                                    'Violencia familiar',
                                                    'No tiene documentos de identidad o de identificación (EV25, acta de nacimiento u otro documento de identificación)',
                                                    'NNA fuera de la escuela (NFE) / desescolarizados',
                                                    'Acoso escolar',
                                                    'Violencia online (grooming, sextorsión, cyberbullying)',
                                                    'Aflicción emocional / alteraciones emocionales / trastorno psicosocial / problemas de salud mental / angustia / trastorno de estrés postraumático',
                                                    'Matrimonio infantil / uniones tempranas',
                                                    'Embarazo adolescente / niña o adolescente madre o niño o adolescente padre',
                                                    'NNA con discapacidades o enfermedad crónica',
                                                    'NNA privados de cuidados parentales o de sus cuidadores legales o consuetudinarios / NNA que aparentemente no tienen un cuidador principal o circunstancial / orfandad',
                                                    'Uso o abuso de sustancias psicoactivas / consumo de drogas / dependencia de drogas',
                                                    'Discriminación a grupos minoritarios (etnias, LGBTIQ+, VIH, etc)',
                                                    'NNA asociados o involucrados con fuerzas o grupos armados irregulares',
                                                    'Niños en situación de calle / mendicidad',
                                                    'NNA que incurren en hechos punibles (menores de 14 años) / adolescentes en conflicto con la ley penal',
                                                    'Trabajo infantil / explotación laboral',
                                                    'NNA víctimas de trata o tráfico',
                                                    'Dificultad o falta de acceso a servicios básicos',
                                                    'No se identifica vulnerabilidad',
                                                ];
                                            @endphp

                                            @foreach ($vulnerabilidades as $vulnerabilidad)
                                                <div class="col-md-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="vulnerabilidades[]" value="{{ $vulnerabilidad }}"
                                                            id="{{ Str::slug($vulnerabilidad, '_') }}">
                                                        <label class="form-check-label"
                                                            for="{{ Str::slug($vulnerabilidad, '_') }}">
                                                            {{ $vulnerabilidad }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane" id="tab5">
                                {{-- DERECHOS VULNERADOS --}}
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Derechos vulnerados</label>
                                        <small class="d-block text-muted mb-2">Elegir varias opciones de ser
                                            necesario</small>
                                        <div class="row">
                                            @php
                                                $derechos_vulnerados = [
                                                    'Artículo 15 Derecho a la vida',
                                                    'Artículo 16 Derecho a un nombre y a una nacionalidad',
                                                    'Artículo 17 Derecho a la identificación',
                                                    'Artículo 18 Derecho a ser inscrito o inscrita en el registro del estado civil',
                                                    'Artículo 22 Derecho a documentos públicos de identidad',
                                                    'Artículo 23 Dotación de recursos',
                                                    'Artículo 24 Promoción del reconocimiento de hijos e hijas',
                                                    'Artículo 25 Derecho a conocer a su padre y madre y a ser cuidados por ellos',
                                                    'Artículo 26 Derecho a ser criado en una familia',
                                                    'Artículo 27 Derecho a mantener relaciones personales y contacto directo con el padre y la madre',
                                                    'Artículo 28 Derecho al libre desarrollo de la personalidad',
                                                    'Artículo 29 Derechos de los niños, niñas y adolescentes con necesidades especiales',
                                                    'Artículo 30 Derecho a un nivel de vida adecuado',
                                                    'Artículo 32 Derecho a la integridad personal',
                                                    'Artículo 32-A. Derecho al buen trato',
                                                    'Artículo 33 Derecho a ser protegidos y protegidas contra abuso y explotación sexual',
                                                    'Artículo 34 Servicios forenses',
                                                    'Artículo 35 Derecho a la libertad de pensamiento, conciencia y religión',
                                                    'Artículo 36 Derechos culturales de las minorías',
                                                    'Artículo 37 Derecho a la libertad personal',
                                                    'Artículo 38 Prohibición de esclavitud, servidumbre y trabajo forzoso',
                                                    'Artículo 39 Derecho a la libertad de tránsito',
                                                    'Artículo 40 Protección contra el traslado ilícito',
                                                    'Artículo 41 Derecho a la salud y a servicios de salud',
                                                    'Artículo 42 Responsabilidad del padre, la madre, representantes o responsables en materia de salud',
                                                    'Artículo 43 Derecho a información en materia de salud',
                                                    'Artículo 44 Protección de la maternidad',
                                                    'Artículo 45 Protección del vínculo materno-filial',
                                                    'Artículo 46 Lactancia materna',
                                                    'Artículo 47 Derecho a ser vacunado o vacunada',
                                                    'Artículo 48 Derecho a atención médica de emergencia',
                                                    'Artículo 49 Permanencia del niño, niña o adolescente junto a su padre, madre, representante o responsable',
                                                    'Artículo 50 Salud sexual y reproductiva',
                                                    'Artículo 51 Protección contra sustancias alcohólicas, estupefacientes y psicotrópicas',
                                                    'Artículo 52 Derecho a la seguridad social',
                                                    'Artículo 53 Derecho a la educación',
                                                    'Artículo 54 Obligación del padre, de la madre, representantes o responsables en materia de educación',
                                                    'Artículo 55 Derecho a participar en el proceso de educación',
                                                    'Artículo 56 Derecho a ser respetados y respetadas por los educadores y educadoras',
                                                    'Artículo 57 Disciplina escolar acorde con los derechos y garantías de los niños, niñas y adolescentes',
                                                    'Artículo 58 Vínculo entre la educación y el trabajo',
                                                    'Artículo 59 Educación para niños, niñas y adolescentes trabajadores y trabajadoras',
                                                    'Artículo 60 Educación de niños, niñas y adolescentes indígenas',
                                                    'Artículo 61 Educación de niños, niñas y adolescentes con necesidades especiales',
                                                    'Artículo 62 Difusión de los derechos y garantías de los niños, niñas y adolescentes',
                                                    'Artículo 63 Derecho al descanso, recreación, esparcimiento, deporte y juego',
                                                    'Artículo 64 Espacios e instalaciones para el descanso, recreación, esparcimiento, deporte y juego',
                                                    'Artículo 65 Derecho al honor, reputación, propia imagen, vida privada e intimidad familiar',
                                                    'Artículo 66 Derecho a la inviolabilidad del hogar y de la correspondencia',
                                                    'Artículo 67 Derecho a la libertad de expresión',
                                                    'Artículo 68 Derecho a la información',
                                                    'Artículo 69 Educación crítica para medios de comunicación',
                                                    'Artículo 70 Mensajes de los medios de comunicación acordes con necesidades de los niños, niñas y adolescentes',
                                                    'Artículo 71 Garantía de mensajes e informaciones adecuadas',
                                                    'Artículo 72 Programaciones dirigidas a niños, niñas y adolescentes',
                                                    'Artículo 73 Del fomento a la creación, producción y difusión de información dirigida a niños, niñas y adolescentes',
                                                    'Artículo 74 Envoltura para los medios que contengan informaciones e imágenes inadecuadas para niños, niñas y adolescentes',
                                                    'Artículo 75 Informaciones e imágenes prohibidas en medios dirigidos a niños, niñas y adolescentes',
                                                    'Artículo 76 Acceso a espectáculos públicos, salas y lugares de exhibición',
                                                    'Artículo 77 Información sobre espectáculos públicos, exhibiciones y programas',
                                                    'Artículo 78 Prevención contra juegos computarizados y electrónicos nocivos',
                                                    'Artículo 79 Prohibiciones para la protección de los derechos de información y a un entorno sano',
                                                    'Artículo 80 Derecho a opinar y a ser oído y oída',
                                                    'Artículo 81 Derecho a participar',
                                                    'Artículo 82 Derecho de reunión',
                                                    'Artículo 83 Derecho de manifestar',
                                                    'Artículo 84 Derecho de libre asociación',
                                                    'Artículo 85 Derecho de petición',
                                                    'Artículo 86 Derecho a defender sus derechos',
                                                    'Artículo 87 Derecho a la justicia',
                                                    'Artículo 88 Derecho a la defensa y al debido proceso',
                                                    'Artículo 89 Derecho a un trato humanitario y digno',
                                                    'Artículo 90 Garantías del o de la adolescente sometido al sistema penal de responsabilidad de adolescentes',
                                                    'Artículo 91 Deber y derecho de denunciar amenazas y violaciones de los derechos y garantías de los niños, niñas y adolescentes',
                                                    'Artículo 92 Prevención',
                                                    'Artículo 93 Deberes NNA',
                                                    'Artículo 96 Edad mínima. Parágrafo Tercero',
                                                    'Artículo 96 Edad mínima. Parágrafo Quinto',
                                                    'Artículo 98 Registro adolescente trabajador',
                                                    'Artículo 99 Credencial de trabajador',
                                                    'NO Aplica Derechos Vulnerados',
                                                ];
                                            @endphp

                                            @foreach ($derechos_vulnerados as $derecho)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="derechos_vulnerados[]" value="{{ $derecho }}"
                                                            id="{{ Str::slug($derecho, '_') }}">
                                                        <label class="form-check-label"
                                                            for="{{ Str::slug($derecho, '_') }}">
                                                            {{ $derecho }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="tab-pane" id="tab6">

                                {{-- IDENTIFICACIÓN DE VIOLENCIA BASADA EN GÉNERO --}}
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Identificación de violencia basada en género
                                            VBG</label>
                                        <small class="d-block text-muted mb-2">Elegir varias opciones de ser
                                            necesario</small>
                                        <div class="row">
                                            @php
                                                $tipos_violencia = [
                                                    'Violencia Psicológica (Conductas amenazantes que no necesariamente implican violencia física ni abuso verbal)',
                                                    'Violencia Física (Todo aquel acto que intenta provocar o provoca dolor o daño físico a la víctima que a través de la agresión)',
                                                    'Prácticas tradicionales nocivas (Prácticas discriminatorias que las comunidades y las sociedades realizan de manera regular)',
                                                    'Violencia Sexual (Todo acto sexual realizado contra la voluntad de otra persona)',
                                                    'Violencia Vicaría',
                                                    'Violencia Económica (Reducción y privación de recursos económicos)',
                                                    'No se identifica VBG',
                                                ];
                                            @endphp

                                            @foreach ($tipos_violencia as $violencia)
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="identificacion_violencia[]" value="{{ $violencia }}"
                                                            id="{{ Str::slug($violencia, '_') }}">
                                                        <label class="form-check-label"
                                                            for="{{ Str::slug($violencia, '_') }}">
                                                            {{ $violencia }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- TIPOS DE VIOLENCIA VICARIA --}}
                                    <div class="row mt-3" id="bloque_tipos_vicaria" style="display: none;">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Tipos de violencia vicaria</label>
                                            <small class="d-block text-muted mb-2">Elegir varias opciones de ser
                                                necesario</small>
                                            <div class="row">
                                                @php
                                                    $tipos_vicaria = [
                                                        'Violencia vincular (destruir el vínculo hijo/madre)',
                                                        'Violencia económica (privar de manutención)',
                                                        'Violencia psicológica y física (agresión directa a NNA, exposición a insultos de desvalorización madre)',
                                                        'Violencia judicial/administrativa (instrumentalización de entes abruman con demandas)',
                                                        'Negligencia (conductas de descuido a NNA)',
                                                        'Abuso sexual (asociados a VBG)',
                                                        'Muerte (a NNA vinculadas a la VBG padres/parejas)',
                                                        'Institucional (por no manejo de perspectiva de género por sesgo androadultocéntrico)',
                                                    ];
                                                @endphp

                                                @foreach ($tipos_vicaria as $vicaria)
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="tipos_violencia_vicaria[]"
                                                                value="{{ $vicaria }}"
                                                                id="{{ Str::slug($vicaria, '_') }}">
                                                            <label class="form-check-label"
                                                                for="{{ Str::slug($vicaria, '_') }}">
                                                                {{ $vicaria }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    {{-- REMISIONES --}}
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Remisiones</label>
                                            <div class="row">
                                                @php
                                                    $remisiones = [
                                                        'Para EMD ASONACOP',
                                                        'Para Consejo de Proteccion NNA',
                                                        'Para Defensoría de NNA',
                                                        'A programas sociales del estado',
                                                        'Cita para seguimiento',
                                                        'Derivar a psiquiatría',
                                                        'Derivar a Servicios de atención en salud provenciado por otras organizaciones',
                                                        'Derivar a Servicios de atención Psicosocial',
                                                        'Para Ministerio Público /Fiscalía especializada',
                                                        'Para Registro civil',
                                                        'Para servicios de salud',
                                                        'Remitir con Informe diagnostico al Consejo de Proteccion NNA',
                                                        'Para SAIME',
                                                        'Otras Remisiones',
                                                        'Sin Remisión',
                                                    ];
                                                @endphp

                                                @foreach ($remisiones as $remision)
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="remisiones[]" value="{{ $remision }}"
                                                                id="{{ Str::slug($remision, '_') }}">
                                                            <label class="form-check-label"
                                                                for="{{ Str::slug($remision, '_') }}">
                                                                {{ $remision }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3" id="bloque_otras_remisiones" style="display: none;">
                                        <div class="col-md-6">
                                            <label for="detalle_otras_remisiones" class="form-label">Especifique otras
                                                remisiones</label>
                                            <input type="text" name="otras_remisiones" id="detalle_otras_remisiones"
                                                class="form-control">
                                        </div>
                                    </div>





                                    <div class="row mt-3">
                                             <div class="row">
                                                        <div class="col-12">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="header-title">Dropzone File Upload</h4>
                                                                    <p class="sub-header">
                                                                        DropzoneJS is an open source library that provides
                                                                        drag’n’drop file uploads with
                                                                        image previews.
                                                                    </p>

                                                                    <div class="dropzone" id="myAwesomeDropzone"
                                                                        data-plugin="dropzone"
                                                                        data-previews-container="#file-previews"
                                                                        data-upload-preview-template="#uploadPreviewTemplate">
                                                                        <div class="fallback">
                                                                            <input name="file" type="file"
                                                                                multiple />
                                                                        </div>

                                                                        <div class="dz-message needsclick">
                                                                            <i
                                                                                class="h1 text-muted dripicons-cloud-upload"></i>
                                                                            <h3>Drop files here or click to upload.</h3>
                                                                            <span class="text-muted font-13">(This is just
                                                                                a demo dropzone. Selected files
                                                                                are
                                                                                <strong>not</strong> actually
                                                                                uploaded.)</span>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Preview -->
                                                                    <div class="dropzone-previews mt-3"
                                                                        id="file-previews"></div>

                                                                </div> <!-- end card-body-->
                                                            </div> <!-- end card-->
                                                        </div><!-- end col -->
                                                    </div>
                                                    <!-- end row -->

                                                    <!-- file preview template -->
                                                    <div class="d-none" id="uploadPreviewTemplate">
                                                        <div class="card mt-1 mb-0 shadow-none border">
                                                            <div class="p-2">
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <img data-dz-thumbnail src="#"
                                                                            class="avatar-sm rounded bg-light"
                                                                            alt="">
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <a href="javascript:void(0);"
                                                                            class="text-muted fw-bold" data-dz-name></a>
                                                                        <p class="mb-0" data-dz-size></p>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <!-- Button -->
                                                                        <a href=""
                                                                            class="btn btn-link btn-lg text-muted"
                                                                            data-dz-remove>
                                                                            <i class="dripicons-cross"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
  

                                    </div>
                                </div>
                            </div>

                            <ul class="list-inline mt-4 wizard">
                                <li class="previous list-inline-item">
                                    <a href="javascript: void(0);" class="btn btn-secondary">Anterior</a>
                                </li>
                                
                                <li class="next list-inline-item float-center center">
                                   <button type="submit" class="btn btn-primary">Guardar y continuar</button>
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

    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

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


    <!-- Plugins js -->
    <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/casos.js') }}"></script>

    <script>
Dropzone.autoDiscover = false;
let uploadedFiles = [];

const myDropzone = new Dropzone("#myAwesomeDropzone", {
    url: "{{ route('casos.upload.temp') }}",
    paramName: "file",
    maxFilesize: 5, // MB
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },

    success: function (file, response) {
        uploadedFiles.push(response.filename);
        $('<input>').attr({
            type: 'hidden',
            name: 'imagenes_temp[]',
            value: response.filename
        }).appendTo('form'); // agrega input oculto con el nombre del archivo
    },

    removedfile: function(file) {
        let name = file.upload.filename;

        // Elimina del array
        uploadedFiles = uploadedFiles.filter(f => f !== name);

        // Elimina input oculto
        $('input[value="' + name + '"]').remove();

        file.previewElement.remove();
    }
});

    </script>


@endsection
