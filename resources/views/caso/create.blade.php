@extends('layouts.app')

@section('title', 'Crear Caso')

@section('styles')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Summernote CSS -->
    <link href="{{ asset('assets/libs/summernote/summernote-lite.min.css') }}" rel="stylesheet">
    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/casos.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="container-fluid">
        <x-breadcrumb title="Crear Caso" />

        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Registro de Caso</h4>
                <div id="progressbarwizard">
                    <form action="{{ route('casos.store') }}" method="POST" enctype="multipart/form-data" id="formCaso">
                        @csrf


                        <input type="hidden" name="caso_id" id="caso_id" value="">
                        <input type="hidden" name="paso_final" id="paso_final" value="0">


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
                                    <span class="d-none d-sm-inline">Identificación de violencia basada en género
                                        VBG</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab7" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-file-image-outline me-1"></i>
                                    <span class="d-none d-sm-inline">Documentos Adjuntos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab8" data-bs-toggle="tab" data-toggle="tab"
                                    class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-check-all me-1"></i>
                                    <span class="d-none d-sm-inline">Observaciones - Finalizar</span>
                                </a>
                        </ul>
                        <div class="tab-content b-0 mb-0 pt-0">


                            <div id="bar" class="progress mb-3" style="height: 7px;">
                                <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                            </div>

                            <div class="tab-pane" id="tab1">

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="periodo" class="form-label mb-2">Periodo</label>
                                            <input type="text" class="form-control" name="periodo" id="periodo"
                                                value="{{ date('Y-m') }}" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="fecha_atencion" class="form-label mb-2">Fecha de
                                                Atención</label>
                                            <input type="date" class="form-control" name="fecha_atencion">
                                        </div>
                                    </div>
                                </div>

                                <!-- Estado -> Municipio -> Parroquia -->
                                <div class="row mt-3">
                                    <div class="col-lg-4">
                                        <label for="estadoSelect" class="form-label mb-2">
                                            Estado <span class="text-danger">*</span>
                                        </label>

                                        <select id="estadoSelect" class="form-select" name="estado_id" required>
                                            <option value="">Seleccione</option>
                                            @foreach ($estados as $estado)
                                                <option value="{{ $estado->id }}">{{ $estado->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('estado_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
                                            value="{{ auth()->user()->name }}" readonly required>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="numero_caso" class="form-label mb-2">Numero de
                                                caso</label>
                                            <input type="text" class="form-control" name="numero_caso"
                                                value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label for="" class="form-label mb-2">Organizacion
                                            programas</label>
                                        <br>
                                        <div class="form-check ">
                                            <input class="form-check-input" type="checkbox" value="UNICEF"
                                                id="unicef" name="organizacion_programas[]" checked>
                                            <label class="form-check-label" for="unicef">Unicef</label>
                                        </div>
                                        <div class="form-check ">
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
                                    <div class="col-md-6" id="otrasOrganizacionesContainer" style="display: none;">
                                        <div class="mt-3">
                                            <label for="otras_organizaciones" class="form-label mb-2">Otras
                                                organizaciones</label>
                                            <input type="text" class="form-control" name="otras_organizaciones"
                                                id="otras_organizaciones" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="mt-0">
                                            <label class="form-label mb-2 ">Tipo de Atención - Programas</label>
                                            <div class="col-md-4">
                                                @php
                                                    $tipo_atencion_programa = [
                                                        'Reunificación familiar',
                                                        'Localización familiar',
                                                        'Retorno voluntario',
                                                    ];

                                                @endphp

                                                @foreach ($tipo_atencion_programa as $tipo_atencion)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="tipo_atencion_programa[]" value="{{ $tipo_atencion }}"
                                                            id="{{ Str::slug($tipo_atencion, '_') }}">
                                                        <label class="form-check-label"
                                                            for="{{ Str::slug($tipo_atencion, '_') }}">
                                                            {{ $tipo_atencion }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label for="" class="form-label mb-2">Tipo de atención</label><br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo_atencion"
                                                id="individual" value="Individual">
                                            <label class="form-check-label" for="individual">Individual</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo_atencion"
                                                id="grupo_familiar" value="Grupo familiar">
                                            <label class="form-check-label" for="grupo_familiar">Grupo familiar</label>
                                        </div>
                                    </div>

                                    @can('clonar casos')
                                        <div class="col-md-4" id="integrantesFields" style="display: none;">
                                            <div class="mb-2">
                                                <label for="numero_integrantes" class="form-label">N° de integrantes</label>
                                                <input type="number" name="numero_integrantes" id="numero_integrantes"
                                                    class="form-control" min="1">
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="clonar_integrantes"
                                                    id="clonar_integrantes" value="1">
                                                <label class="form-check-label" for="clonar_integrantes">
                                                    Clonar este registro para cada integrante
                                                </label>
                                            </div>
                                        </div>
                                    @endcan

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
                                                        $beneficiarios = [
                                                            'Niña adolescente',
                                                            'Mujer joven',
                                                            'Mujer adulta',
                                                            'Niño adolescente',
                                                            'Hombre joven',
                                                            'Hombre adulto',
                                                        ];
                                                    @endphp

                                                    @foreach ($beneficiarios as $beneficiario)
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
                                                        <div class="form-check mb-1">
                                                            <input class="form-check-input" type="radio"
                                                                name="educacion" value="{{ $opcion }}"
                                                                id="{{ Str::slug($opcion, '_') }}">
                                                            <label class="form-check-label"
                                                                for="{{ Str::slug($opcion, '_') }}">
                                                                {{ $opcion }}
                                                            </label>
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
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="estado_mujer[]" value="{{ $estado }}"
                                                                    id="{{ Str::slug($estado, '_') }}">
                                                                <label class="form-check-label"
                                                                    for="{{ Str::slug($estado, '_') }}">
                                                                    {{ $estado }}
                                                                </label>
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
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio" name="poblacion_lgbti"
                                                        id="poblacion_si" value="Si">
                                                    <label class="form-check-label" for="poblacion_si">
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="form-check ">
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
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio"
                                                        name="representante_legal" id="mujer" value="Mujer">
                                                    <label class="form-check-label" for="mujer">
                                                        Mujer
                                                    </label>
                                                </div>
                                                <div class="form-check ">
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
                                                        id="pais_procedencia">
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
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio"
                                                        name="nacionalidad_solicitante" id="Venezolana"
                                                        value="Venezolana">
                                                    <label class="form-check-label" for="Venezolana">
                                                        Venezolana
                                                    </label>
                                                </div>
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio"
                                                        name="nacionalidad_solicitante" id="Extranjera"
                                                        value="Extranjera">
                                                    <label class="form-check-label" for="Extranjera">
                                                        Extranjera
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <label class="form-label mb-2">Tipo de documento</label>
                                                <select class="form-select" name="tipo_documento" id="tipo_documento">
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

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <div class="mt-0">
                                                    <label class="form-label mb-2">País de nacimiento</label>
                                                    <select class="form-select" name="pais_nacimiento"
                                                        id="pais_nacimiento">
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
                                                                'Ninguna',
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
                                            <div class="col-md-6">
                                                <div class="mt-0">
                                                    <label class="form-label mb-2">Discapacidad</label>
                                                    <select class="form-select" name="discapacidad" id="discapacidad">
                                                        <option value="">Seleccione</option>
                                                        @php
                                                            $discapacidades = [
                                                                'Ninguna',
                                                                'Física o Motora',
                                                                'Sensorial (auditiva y visual)',
                                                                'Auditiva',
                                                                'Visual',
                                                                'Intelectual',
                                                                'Psíquica',
                                                            ];
                                                        @endphp

                                                        @foreach ($discapacidades as $discapacidad)
                                                            <option value="{{ $discapacidad }}">
                                                                {{ $discapacidad }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                                            <label class="form-label mb-2 fw-bold">Servicios brindados
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
                                                    <div class="col-md-4">
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
                                        <label class="form-label mb-2 fw-bold">Servicos brindados
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
                                                <div class="col-md-4">
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
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="tipo_actuacion[]" value="{{ $tipo }}"
                                                        id="{{ Str::slug($tipo, '_') }}">
                                                    <label class="form-check-label" for="{{ Str::slug($tipo, '_') }}">
                                                        {{ $tipo }}
                                                    </label>
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
                                                    'Artículo 49 Permanencia del niño, niña o adolescente junto a su padre, madre,
                                        representante o responsable',
                                                    'Artículo 50 Salud sexual y reproductiva',
                                                    'Artículo 51 Protección contra sustancias alcohólicas, estupefacientes y
                                        psicotrópicas',
                                                    'Artículo 52 Derecho a la seguridad social',
                                                    'Artículo 53 Derecho a la educación',
                                                    'Artículo 54 Obligación del padre, de la madre, representantes o responsables en
                                        materia de educación',
                                                    'Artículo 55 Derecho a participar en el proceso de educación',
                                                    'Artículo 56 Derecho a ser respetados y respetadas por los educadores y
                                        educadoras',
                                                    'Artículo 57 Disciplina escolar acorde con los derechos y garantías de los
                                        niños, niñas y adolescentes',
                                                    'Artículo 58 Vínculo entre la educación y el trabajo',
                                                    'Artículo 59 Educación para niños, niñas y adolescentes trabajadores y
                                        trabajadoras',
                                                    'Artículo 60 Educación de niños, niñas y adolescentes indígenas',
                                                    'Artículo 61 Educación de niños, niñas y adolescentes con necesidades
                                        especiales',
                                                    'Artículo 62 Difusión de los derechos y garantías de los niños, niñas y
                                        adolescentes',
                                                    'Artículo 63 Derecho al descanso, recreación, esparcimiento, deporte y juego',
                                                    'Artículo 64 Espacios e instalaciones para el descanso, recreación,
                                        esparcimiento, deporte y juego',
                                                    'Artículo 65 Derecho al honor, reputación, propia imagen, vida privada e
                                        intimidad familiar',
                                                    'Artículo 66 Derecho a la inviolabilidad del hogar y de la correspondencia',
                                                    'Artículo 67 Derecho a la libertad de expresión',
                                                    'Artículo 68 Derecho a la información',
                                                    'Artículo 69 Educación crítica para medios de comunicación',
                                                    'Artículo 70 Mensajes de los medios de comunicación acordes con necesidades de
                                        los niños, niñas y adolescentes',
                                                    'Artículo 71 Garantía de mensajes e informaciones adecuadas',
                                                    'Artículo 72 Programaciones dirigidas a niños, niñas y adolescentes',
                                                    'Artículo 73 Del fomento a la creación, producción y difusión de información
                                        dirigida a niños, niñas y adolescentes',
                                                    'Artículo 74 Envoltura para los medios que contengan informaciones e imágenes
                                        inadecuadas para niños, niñas y adolescentes',
                                                    'Artículo 75 Informaciones e imágenes prohibidas en medios dirigidos a niños,
                                        niñas y adolescentes',
                                                    'Artículo 76 Acceso a espectáculos públicos, salas y lugares de exhibición',
                                                    'Artículo 77 Información sobre espectáculos públicos, exhibiciones y programas',
                                                    'Artículo 78 Prevención contra juegos computarizados y electrónicos nocivos',
                                                    'Artículo 79 Prohibiciones para la protección de los derechos de información y a
                                        un entorno sano',
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
                                                    'Artículo 90 Garantías del o de la adolescente sometido al sistema penal de
                                        responsabilidad de adolescentes',
                                                    'Artículo 91 Deber y derecho de denunciar amenazas y violaciones de los derechos
                                        y garantías de los niños, niñas y adolescentes',
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
                                                    'Violencia Psicológica (Conductas amenazantes que no necesariamente implican
                                        violencia física ni abuso verbal)',
                                                    'Violencia Física (Todo aquel acto que intenta provocar o provoca dolor o daño
                                        físico a la víctima que a través de la agresión)',
                                                    'Prácticas tradicionales nocivas (Prácticas discriminatorias que las comunidades
                                        y las sociedades realizan de manera regular)',
                                                    'Violencia Sexual (Todo acto sexual realizado contra la voluntad de otra
                                        persona)',
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
                                                    'Violencia psicológica y física (agresión directa a NNA, exposición a
                                            insultos de desvalorización madre)',
                                                    'Violencia judicial/administrativa (instrumentalización de entes abruman con
                                            demandas)',
                                                    'Negligencia (conductas de descuido a NNA)',
                                                    'Abuso sexual (asociados a VBG)',
                                                    'Muerte (a NNA vinculadas a la VBG padres/parejas)',
                                                    'Institucional (por no manejo de perspectiva de género por sesgo
                                            androadultocéntrico)',
                                                ];
                                            @endphp

                                            @foreach ($tipos_vicaria as $vicaria)
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="tipos_violencia_vicaria[]" value="{{ $vicaria }}"
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
                                                    'Derivar a Servicios de atención en salud provenciado por otras
                                            organizaciones',
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

                            </div>

                            <div class="tab-pane" id="tab7">

                                {{-- DOCUMENTOS ADJUNTOS --}}

                                <div class="row mt-3">
                                    <div class="card-body">
                                        <h4 class="header-title">Fotos e Imágenes</h4>
                                        <p class="sub-header">
                                            Por favor, sube aquí las fotos o imágenes relacionadas con el caso. Puedes
                                            arrastrarlas al área o hacer clic para seleccionarlas desde tu dispositivo. <br>
                                            <strong>Formatos permitidos: .jpg, .jpeg, .png, .gif</strong>
                                        </p>

                                        <div class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone"
                                            data-previews-container="#file-previews"
                                            data-upload-preview-template="#uploadPreviewTemplate">
                                            <div class="fallback">
                                                <input name="fotos" type="file" multiple
                                                    accept=".jpg,.jpeg,.png,.gif" />
                                            </div>

                                            <div class="dz-message needsclick">
                                                <i class="h1 text-muted dripicons-cloud-upload"></i>
                                                <h3>Arrastra los archivos aquí o haz clic para subirlos.</h3>
                                                <h3>Formatos permitidos: .jpg, .jpeg, .png, .gif</h3>
                                                <span class="text-muted font-13">Puedes subir varias imágenes a la
                                                    vez.</span>
                                            </div>
                                        </div>

                                        <div class="dropzone-previews mt-3" id="file-previews"></div>
                                    </div>

                                    <div class="d-none" id="uploadPreviewTemplate">
                                        <div class="card mt-1 mb-0 shadow-none border">
                                            <div class="p-2">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <img data-dz-thumbnail src="#"
                                                            class="avatar-sm rounded bg-light" alt="">
                                                    </div>
                                                    <div class="col ps-0">
                                                        <a href="javascript:void(0);" class="text-muted fw-bold"
                                                            data-dz-name></a>
                                                        <p class="mb-0" data-dz-size></p>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="" class="btn btn-link btn-lg text-muted"
                                                            data-dz-remove>
                                                            <i class="dripicons-cross"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="card-body">
                                        <h4 class="header-title">Documentos</h4>
                                        <p class="sub-header">
                                            Puedes subir aquí cualquier documento relevante al caso, como informes,
                                            certificados o autorizaciones. Arrastra los archivos o haz clic para cargarlos.
                                            <br>
                                            <strong>Formatos permitidos: .pdf, .doc, .docx</strong>
                                        </p>

                                        <div class="dropzone" id="docuemntosDropzone" data-plugin="dropzone"
                                            data-previews-container="#file-previews2"
                                            data-upload-preview-template="#uploadPreviewTemplate2">
                                            <div class="fallback">
                                                <input name="archivos" type="file" multiple
                                                    accept=".pdf,.doc,.docx" />
                                            </div>

                                            <div class="dz-message needsclick">
                                                <i class="h1 text-muted dripicons-cloud-upload"></i>
                                                <h3>Arrastra los archivos aquí o haz clic para subirlos.</h3>
                                                <h3>Formatos permitidos: .pdf, .doc, .docx</h3>
                                                <span class="text-muted font-13">Puedes subir varios documentos en esta
                                                    sección.</span>
                                            </div>
                                        </div>

                                        <div class="dropzone-previews mt-3" id="file-previews2"></div>
                                    </div>

                                    <div class="d-none" id="uploadPreviewTemplate2">
                                        <div class="card mt-1 mb-0 shadow-none border">
                                            <div class="p-2">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <img data-dz-thumbnail src="#"
                                                            class="avatar-sm rounded bg-light" alt="">
                                                    </div>
                                                    <div class="col ps-0">
                                                        <a href="javascript:void(0);" class="text-muted fw-bold"
                                                            data-dz-name></a>
                                                        <p class="mb-0" data-dz-size></p>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="" class="btn btn-link btn-lg text-muted"
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

                            <div class="tab-pane" id="tab8">

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="fecha_actual" class="form-label mb-2">Fecha actual</label>

                                            @can('cambiar fecha actual')
                                                <input type="date" class="form-control" name="fecha_actual"
                                                    value="{{ date('Y-m-d') }}">
                                            @else
                                                <input type="date" class="form-control" name="fecha_actual"
                                                    value="{{ date('Y-m-d') }}" readonly>
                                            @endcan

                                        </div>
                                    </div>


                                </div>
                                <div class="row mt-3">
                                    <div class="mb-3">
                                        <label class="form-label d-block">Estatus de la atención <span
                                                class="text-danger">*</span></label>
                                        <small class="text-muted d-block mb-2">Elegir estatus del caso/expediente</small>

                                        @foreach (['En proceso', 'En seguimiento', 'Cierre de atención'] as $i => $estatus)
                                            @if ($estatus == 'Cierre de atención' && !auth()->user()->can('cierre atencion'))
                                                @continue
                                            @endif
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="estatus"
                                                    id="estatus{{ $i + 1 }}" value="{{ $estatus }}">
                                                <label class="form-check-label"
                                                    for="estatus{{ $i + 1 }}">{{ $estatus }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                                <div class="row mt-3">
                                    <label class="form-label">Indicadores</label>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="indicadores[]"
                                                id="indicador1" value="PSEA.01">
                                            <label class="form-check-label" for="indicador1">
                                                PSEA.01: Difusión comunitaria de mensajes y sensibilización en materia de
                                                Protección contra la Explotación y el Abuso Sexual
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="indicadores[]"
                                                id="indicador2" value="encuesta_satisfaccion">
                                            <label class="form-check-label" for="indicador2">
                                                Encuesta de satisfacción
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="indicadores[]"
                                                id="indicador3" value="no_aplica">
                                            <label class="form-check-label" for="indicador3">
                                                No aplica Indicadores
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-3">
                                    <label for="observaciones" class="form-label">Observaciones</label>
                                    <textarea name="observaciones" id="summernote" class="form-control"></textarea>
                                </div>


                                {{-- <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="verificador" class="form-label mb-2">Verificador </label>
                                        <input type="number" class="form-control" name="verificador" value="">
                                    </div>
                                </div> --}}

                                @can('aprobar casos')
                                    <div class="row mt-3">
                                        <div class="mb-3">
                                            <label class="form-label d-block">Condición <span
                                                    class="text-danger">*</span></label>
                                            <small class="text-muted d-block mb-2">Seleccione el estado de la condición</small>

                                            @php
                                                $condiciones = ['En espera', 'No aprobado', 'Aprobado'];
                                                $valorActual = old('condicion', 'En espera');
                                            @endphp

                                            @foreach ($condiciones as $i => $condicion)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="condicion"
                                                        id="condicion{{ $i + 1 }}" value="{{ $condicion }}"
                                                        {{ $valorActual == $condicion ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="condicion{{ $i + 1 }}">{{ $condicion }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endcan

                                <!-- Botón para finalizar y redirigir -->
                                {{-- <button type="button" class="btn btn-success btn-guardar" data-final="true">Enviar y
                                        finalizar</button> --}}
                                <div class="row mt-3 finalizar">
                                    <ul class="list-inline mt-4 wizard d-flex justify-content-center">

                                        <li class="previous list-inline-item">

                                            <button type="button"
                                                class="btn btn-success waves-effect waves-light  btn-guardar  float-end"
                                                data-final="true">
                                                <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Guardar y
                                                finalizar
                                            </button>

                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <ul class="list-inline mt-4 wizard">

                                <li class="previous list-inline-item">
                                    <a href="javascript: void(0);" class="btn btn-secondary">Anterior</a>
                                </li>

                                <li class="next list-inline-item float-end">
                                    <a href="javascript: void(0);" class="btn btn-secondary">Siguiente</a>
                                </li>


                                <li class="next list-inline-item float-end">

                                    {{-- <button type="button" id="btn-guardar-y-continuar" class="btn btn-primary">Enviar y
                                        continuar</button> --}}

                                    <!-- Botón para avanzar entre tabs -->
                                    @can('guardar continuar')
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-guardar mx-2"
                                            data-final="false"><i class="mdi mdi-cloud-outline me-1"></i> Guardar y
                                            continuar</button>
                                    @endcan

                                    {{-- <button type="button" class="btn btn-primary btn-guardar" data-final="false">Enviar y continuar</button> --}}

                                </li>


                            </ul>






                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/mohithg-switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
    <script src="{{ asset('assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>

    <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>

    <script src="{{ asset('assets/libs/summernote/summernote-lite.min.js') }}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

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
        Dropzone.autoDiscover = false;

        // Dropzone para imágenes
        const imagenesDropzone = new Dropzone("#myAwesomeDropzone", {
            url: "#",
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 10,
            maxFilesize: 5,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            previewsContainer: "#file-previews",
            previewTemplate: document.querySelector("#uploadPreviewTemplate").innerHTML
        });

        // Dropzone para documentos
        const documentosDropzone = new Dropzone("#docuemntosDropzone", {
            url: "#",
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 10,
            maxFilesize: 10,
            acceptedFiles: '.pdf,.doc,.docx,.xls,.xlsx,.txt',
            addRemoveLinks: true,
            previewsContainer: "#file-previews2",
            previewTemplate: document.querySelector("#uploadPreviewTemplate2").innerHTML,
            init: function() {
                this.on("addedfile", function(file) {
                    const ext = file.name.split('.').pop().toLowerCase();
                    let iconPath = "/assets/icons/file.png";
                    if (['doc', 'docx'].includes(ext)) iconPath = "/assets/icons/word.png";
                    else if (ext === 'pdf') iconPath = "/assets/icons/pdf.png";
                    else if (['xls', 'xlsx'].includes(ext)) iconPath = "/assets/icons/excel.png";

                    const thumbnail = file.previewElement.querySelector("[data-dz-thumbnail]");
                    if (thumbnail) thumbnail.src = iconPath;
                });
            }
        });
    </script>

    <script>
        $('.btn-guardar').on('click', function(e) {
            e.preventDefault();

            const esPasoFinal = $(this).data('final') === true || $(this).data('final') === 'true';
            $('#paso_final').val(esPasoFinal ? '1' : '0');

            const form = $('#formCaso')[0];
            const formData = new FormData(form);

            if (typeof imagenesDropzone !== 'undefined') {
                imagenesDropzone.files.forEach(file => formData.append('fotos[]', file));
            }

            if (typeof documentosDropzone !== 'undefined') {
                documentosDropzone.files.forEach(file => formData.append('archivos[]', file));
            }

            const originalText = $(this).html();
            $(this).prop('disabled', true).text('Guardando...');

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        $('#caso_id').val(data.id);

                        Swal.fire({
                            toast: true,
                            position: 'center',
                            icon: 'success',
                            title: 'Datos guardados correctamente. ',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'swal2-toast-center'
                            }
                        });


                        if (esPasoFinal) {
                            window.location.href = "{{ route('casos.index') }}";
                        } else {
                            const activeTab = $('.nav-tabs .nav-link.active');
                            const nextTab = activeTab.closest('li').next().find('.nav-link');
                            if (nextTab.length) nextTab.tab('show');
                        }
                    } else {
                        throw new Error('Error en la respuesta');
                    }
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al guardar el caso. Recuerda llenar los Campos obligatorios: Estado, Municipio, Parroquia...',
                        footer: '<a href="https://wa.me/584245034999" target="_blank">Contacta con el desarrollador</a>'
                    });
                })
                .finally(() => {
                    $(this).prop('disabled', false).html(originalText);
                });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const noAplica = document.getElementById('indicador3'); // "No aplica Indicadores"
            const checkboxes = document.querySelectorAll('input[name="indicadores[]"]:not(#indicador3)');

            // Al seleccionar "No aplica", desmarcar los demás
            noAplica.addEventListener('change', function() {
                if (this.checked) {
                    checkboxes.forEach(cb => cb.checked = false);
                }
            });

            // Al seleccionar otro, desmarcar "No aplica"
            checkboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    if (this.checked) {
                        noAplica.checked = false;
                    }
                });
            });
        });





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



        document.addEventListener('DOMContentLoaded', function() {
            const estadoSelect = document.getElementById('estadoSelect');
            const numeroCasoInput = document.querySelector('input[name="numero_caso"]');

            estadoSelect.addEventListener('change', function() {
                const estadoId = this.value;

                if (!estadoId) {
                    numeroCasoInput.value = '';
                    return;
                }

                fetch(`/casos/contador-estado/${estadoId}`)
                    .then(response => response.json())
                    .then(data => {
                        let nombre = data.estado_nombre.trim().normalize("NFD").replace(
                            /[\u0300-\u036f]/g, ""); // Quitar acentos
                        let siglas = nombre.substring(0, 3).toUpperCase();

                        const numero = String(data.conteo + 1).padStart(3, '0');
                        numeroCasoInput.value = `RLF-${siglas}-${numero}`;
                    })
                    .catch(err => {
                        console.error('Error al obtener datos del estado:', err);
                        numeroCasoInput.value = '';
                    });
            });
        });





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




        document.addEventListener('DOMContentLoaded', function() {
            const selectEtnia = document.getElementById('etnia_indigena');
            const otraEtniaContainer = document.getElementById('otra_etnia_container');
            const otraEtniaInput = document.getElementById('otra_etnia');

            selectEtnia.addEventListener('change', function() {
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



        document.addEventListener("DOMContentLoaded", function() {
            const ninguno = document.getElementById("ningun_servicio_cosude");
            const checkboxes = document.querySelectorAll(
                'input[name="servicio_cosude[]"]:not(#ningun_servicio_cosude)');

            if (ninguno) {
                ninguno.addEventListener("change", function() {
                    if (this.checked) {
                        checkboxes.forEach(cb => cb.checked = false);
                    }
                });

                checkboxes.forEach(cb => {
                    cb.addEventListener("change", function() {
                        if (this.checked) {
                            ninguno.checked = false;
                        }
                    });
                });
            }
        });




        document.addEventListener("DOMContentLoaded", function() {
            const ningunoUnicef = document.getElementById("ningun_servicio_unicef");
            const otrosUnicef = document.querySelectorAll(
                'input[name="servicio_unicef[]"]:not(#ningun_servicio_unicef)');

            if (ningunoUnicef) {
                ningunoUnicef.addEventListener("change", function() {
                    if (this.checked) {
                        otrosUnicef.forEach(cb => cb.checked = false);
                    }
                });

                otrosUnicef.forEach(cb => {
                    cb.addEventListener("change", function() {
                        if (this.checked) {
                            ningunoUnicef.checked = false;
                        }
                    });
                });
            }
        });



        document.addEventListener("DOMContentLoaded", function() {
            const unicefCheckbox = document.getElementById("unicef");
            const cosudeCheckbox = document.getElementById("cosude");

            const unicefContainer = document.getElementById("servicios_brindados_unicef_block");
            const cosudeContainer = document.getElementById("servicios_brindados_cosude_container");

            function actualizarVisibilidad() {
                // Verificar si están marcados exactamente
                const unicefMarcado = unicefCheckbox.checked;
                const cosudeMarcado = cosudeCheckbox.checked;

                // Mostrar u ocultar contenedores
                unicefContainer.style.display = unicefMarcado ? 'block' : 'none';
                cosudeContainer.style.display = cosudeMarcado ? 'block' : 'none';
            }

            // Ejecutar al cargar
            actualizarVisibilidad();

            // Añadir eventos a ambos checkboxes
            unicefCheckbox.addEventListener("change", actualizarVisibilidad);
            cosudeCheckbox.addEventListener("change", actualizarVisibilidad);
        });




        document.addEventListener("DOMContentLoaded", function() {
            // COSUDE
            const ningunoCosude = document.querySelector(
                'input[name="servicio_brindado_cosude[]"][value="Ningún servicio COSUDE"]');
            const otrosCosude = document.querySelectorAll(
                'input[name="servicio_brindado_cosude[]"]:not([value="Ningún servicio COSUDE"])');

            ningunoCosude.addEventListener('change', function() {
                if (this.checked) {
                    otrosCosude.forEach(cb => cb.checked = false);
                }
            });

            otrosCosude.forEach(cb => {
                cb.addEventListener('change', function() {
                    if (this.checked) {
                        ningunoCosude.checked = false;
                    }
                });
            });

            // UNICEF
            const ningunoUnicef = document.querySelector(
                'input[name="servicio_brindado_unicef[]"][value="Ningún servicio UNICEF"]');
            const otrosUnicef = document.querySelectorAll(
                'input[name="servicio_brindado_unicef[]"]:not([value="Ningún servicio UNICEF"])');

            ningunoUnicef.addEventListener('change', function() {
                if (this.checked) {
                    otrosUnicef.forEach(cb => cb.checked = false);
                }
            });

            otrosUnicef.forEach(cb => {
                cb.addEventListener('change', function() {
                    if (this.checked) {
                        ningunoUnicef.checked = false;
                    }
                });
            });
        });


        document.addEventListener("DOMContentLoaded", function() {
            const radiosBeneficiario = document.querySelectorAll('input[name="beneficiario"]');
            const radiosEducacion = document.querySelectorAll('input[name="educacion"]');

            const bloqueEducacion = document.getElementById("bloque_educacion");
            const bloqueNivelTipo = document.getElementById("bloque_nivel_educativo_tipo_isntitucion");
            const bloqueEstadoMujer = document.getElementById("estado-mujer-block");

            function actualizarBloques() {
                const beneficiario = document.querySelector('input[name="beneficiario"]:checked');
                const educacion = document.querySelector('input[name="educacion"]:checked');
                const valor = beneficiario ? beneficiario.value.trim() : "";

                // Mostrar educación si es NNA
                const esNNA = valor === "Niña adolescente" || valor === "Niño adolescente";
                bloqueEducacion.style.display = esNNA ? "block" : "none";

                // Mostrar nivel educativo + tipo institución si "Si estudia"
                const estudia = educacion && educacion.value === "Si estudia";
                bloqueNivelTipo.style.display = (esNNA && estudia) ? "flex" : "none";

                // Mostrar bloque de estado si es mujer (niña adolescente, mujer joven o mujer adulta)
                const esMujer = valor === "Niña adolescente" || valor === "Mujer joven" || valor === "Mujer adulta";
                bloqueEstadoMujer.style.display = esMujer ? "block" : "none";
            }

            radiosBeneficiario.forEach(rb => rb.addEventListener("change", actualizarBloques));
            radiosEducacion.forEach(rb => rb.addEventListener("change", actualizarBloques));

            // Ejecutar al cargar por si hay datos precargados
            actualizarBloques();
        });



        document.addEventListener("DOMContentLoaded", function() {
            const selectEdad = document.getElementById("edad-beneficiario-select");
            const radiosBeneficiario = document.querySelectorAll('input[name="beneficiario"]');

            const rangos = {
                'nina_adolescente': [0, 17],
                'mujer_joven': [18, 21],
                'mujer_adulta': [22, 100],
                'nino_adolescente': [0, 17],
                'hombre_joven': [18, 21],
                'hombre_adulto': [22, 100]
            };

            function normalizarTexto(texto) {
                return texto
                    .toLowerCase()
                    .normalize("NFD").replace(/[\u0300-\u036f]/g, "") // quita tildes
                    .replace(/\s+/g, '_'); // espacios a guión bajo
            }

            function cargarRangoDeEdad(valorNormalizado) {
                selectEdad.innerHTML = '<option value="">Seleccione</option>';

                if (!(valorNormalizado in rangos)) return;

                const [min, max] = rangos[valorNormalizado];
                for (let i = min; i <= max; i++) {
                    const option = document.createElement("option");
                    option.value = i;
                    option.textContent = `${i} años`;
                    selectEdad.appendChild(option);
                }
            }

            radiosBeneficiario.forEach(radio => {
                radio.addEventListener("change", function() {
                    const slug = normalizarTexto(this.value);
                    cargarRangoDeEdad(slug);
                });
            });

            // Ejecutar al cargar si hay selección previa
            const seleccionado = document.querySelector('input[name="beneficiario"]:checked');
            if (seleccionado) {
                const slug = normalizarTexto(seleccionado.value);
                cargarRangoDeEdad(slug);
            }
        });




        document.addEventListener("DOMContentLoaded", function() {
            const checkNoAplica = document.querySelector('input[name="estado_mujer[]"][value="No aplica estado"]');
            const otrosEstados = document.querySelectorAll(
                'input[name="estado_mujer[]"]:not([value="No aplica estado"])');

            if (checkNoAplica) {
                checkNoAplica.addEventListener("change", function() {
                    if (this.checked) {
                        otrosEstados.forEach(cb => cb.checked = false);
                    }
                });

                otrosEstados.forEach(cb => {
                    cb.addEventListener("change", function() {
                        if (this.checked) {
                            checkNoAplica.checked = false;
                        }
                    });
                });
            }
        });



        $(document).ready(function() {
            // Estado destino → Municipio destino
            $('#estadoDestinoSelect').on('change', function() {
                var estadoId = $(this).val();
                $('#municipioDestinoSelect').html('<option value="">Cargando...</option>');
                $('#parroquiaDestinoSelect').html('<option value="">Seleccione</option>');

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
                            $('#municipioDestinoSelect').html(options);
                        },
                        error: function() {
                            alert('Error al cargar municipios destino.');
                            $('#municipioDestinoSelect').html(
                                '<option value="">Seleccione</option>');
                        }
                    });
                } else {
                    $('#municipioDestinoSelect').html('<option value="">Seleccione</option>');
                }
            });

            // Municipio destino → Parroquia destino
            $('#municipioDestinoSelect').on('change', function() {
                var municipioId = $(this).val();
                $('#parroquiaDestinoSelect').html('<option value="">Cargando...</option>');

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
                            $('#parroquiaDestinoSelect').html(options);
                        },
                        error: function() {
                            alert('Error al cargar parroquias destino.');
                            $('#parroquiaDestinoSelect').html(
                                '<option value="">Seleccione</option>');
                        }
                    });
                } else {
                    $('#parroquiaDestinoSelect').html('<option value="">Seleccione</option>');
                }
            });
        });




        document.addEventListener("DOMContentLoaded", function() {
            const checkboxOtros = document.getElementById("otros_tipos_de_actuacion");
            const containerTexto = document.getElementById("otros_actuacion_container");

            if (checkboxOtros) {
                checkboxOtros.addEventListener("change", function() {
                    containerTexto.style.display = this.checked ? 'block' : 'none';
                });

                // Mostrar si ya estaba seleccionado al recargar
                if (checkboxOtros.checked) {
                    containerTexto.style.display = 'block';
                }
            }
        });



        document.addEventListener("DOMContentLoaded", function() {
            const checkNoIdentifica = document.querySelector(
                'input[name="vulnerabilidades[]"][value="No se identifica vulnerabilidad"]');
            const otrasVulnerabilidades = document.querySelectorAll(
                'input[name="vulnerabilidades[]"]:not([value="No se identifica vulnerabilidad"])');

            if (checkNoIdentifica) {
                checkNoIdentifica.addEventListener("change", function() {
                    if (this.checked) {
                        otrasVulnerabilidades.forEach(cb => cb.checked = false);
                    }
                });

                otrasVulnerabilidades.forEach(cb => {
                    cb.addEventListener("change", function() {
                        if (this.checked) {
                            checkNoIdentifica.checked = false;
                        }
                    });
                });
            }
        });



        document.addEventListener("DOMContentLoaded", function() {
            const checkNoAplica = document.querySelector(
                'input[name="derechos_vulnerados[]"][value="NO Aplica Derechos Vulnerados"]');
            const otrosDerechos = document.querySelectorAll(
                'input[name="derechos_vulnerados[]"]:not([value="NO Aplica Derechos Vulnerados"])');

            if (checkNoAplica) {
                checkNoAplica.addEventListener("change", function() {
                    if (this.checked) {
                        otrosDerechos.forEach(cb => cb.checked = false);
                    }
                });

                otrosDerechos.forEach(cb => {
                    cb.addEventListener("change", function() {
                        if (this.checked) {
                            checkNoAplica.checked = false;
                        }
                    });
                });
            }
        });



        document.addEventListener("DOMContentLoaded", function() {
            const checkNoVBG = document.querySelector(
                'input[name="identificacion_violencia[]"][value="No se identifica VBG"]');
            const otrasViolencias = document.querySelectorAll(
                'input[name="identificacion_violencia[]"]:not([value="No se identifica VBG"])');

            if (checkNoVBG) {
                checkNoVBG.addEventListener("change", function() {
                    if (this.checked) {
                        otrasViolencias.forEach(cb => cb.checked = false);
                    }
                });

                otrasViolencias.forEach(cb => {
                    cb.addEventListener("change", function() {
                        if (this.checked) {
                            checkNoVBG.checked = false;
                        }
                    });
                });
            }
        });



        document.addEventListener("DOMContentLoaded", function() {
            const checkboxesVBG = document.querySelectorAll('input[name="identificacion_violencia[]"]');
            const violenciaVicaria = document.querySelector(
                'input[name="identificacion_violencia[]"][value="Violencia Vicaría"]');
            const noIdentifica = document.querySelector(
                'input[name="identificacion_violencia[]"][value="No se identifica VBG"]');
            const bloqueVicaria = document.getElementById("bloque_tipos_vicaria");

            // Obtener los checkboxes del bloque vicaria
            function getVicariaCheckboxes() {
                return document.querySelectorAll('input[name="tipos_violencia_vicaria[]"]');
            }

            // Al seleccionar "No se identifica VBG"
            noIdentifica?.addEventListener("change", function() {
                if (this.checked) {
                    // Desmarcar todos los demás checkboxes de violencia
                    checkboxesVBG.forEach(cb => {
                        if (cb !== this) cb.checked = false;
                    });

                    // Desmarcar todos los tipos de violencia vicaria
                    getVicariaCheckboxes().forEach(cb => cb.checked = false);

                    // Ocultar bloque de violencia vicaria
                    bloqueVicaria.style.display = "none";
                }
            });

            // Al seleccionar "Violencia Vicaría"
            violenciaVicaria?.addEventListener("change", function() {
                if (this.checked) {
                    // Mostrar bloque de violencia vicaria
                    bloqueVicaria.style.display = "block";

                    // Desmarcar "No se identifica VBG"
                    if (noIdentifica.checked) noIdentifica.checked = false;
                } else {
                    // Si se desmarca violencia vicaria, ocultar bloque y desmarcar opciones internas
                    bloqueVicaria.style.display = "none";
                    getVicariaCheckboxes().forEach(cb => cb.checked = false);
                }
            });

            // Desmarcar "No se identifica VBG" si se marca cualquier otro tipo de violencia
            checkboxesVBG.forEach(cb => {
                if (cb !== noIdentifica && cb !== violenciaVicaria) {
                    cb.addEventListener("change", function() {
                        if (this.checked && noIdentifica.checked) {
                            noIdentifica.checked = false;
                        }
                    });
                }
            });
        });



        $(document).ready(function() {
            $('#sin_remision').on('change', function() {
                if ($(this).is(':checked')) {
                    // Desmarcar todos los demás checkbox excepto "Sin Remisión"
                    $('input[name="remisiones[]"]').not(this).prop('checked', false);
                }
            });

            // Si se marca otro checkbox, desmarcar "Sin Remisión"
            $('input[name="remisiones[]"]').not('#sin_remision').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#sin_remision').prop('checked', false);
                }
            });
        });



        $(document).ready(function() {
            $('#pais_nacimiento').on('change', function() {
                const seleccion = $(this).val();
                const bloque = $('#otro_pais_nacimiento_container');
                const input = $('#otro_pais_nacimientos');

                if (seleccion === 'Otro País') {
                    bloque.slideDown();
                    input.prop('required', true);
                } else {
                    bloque.slideUp();
                    input.val('').prop('required', false);
                }
            });
        });

        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200,
                placeholder: 'Escriba aquí los detalles del caso...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipoAtencionRadios = document.querySelectorAll('input[name="tipo_atencion"]');
            const integrantesFields = document.getElementById('integrantesFields');

            if (!integrantesFields) return; // salir si el bloque no existe

            tipoAtencionRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    integrantesFields.style.display = this.value === 'Grupo familiar' ? 'block' :
                        'none';
                });
            });

            // Mostrar al recargar si está preseleccionado
            const selected = document.querySelector('input[name="tipo_atencion"]:checked');
            if (selected && selected.value === 'Grupo familiar') {
                integrantesFields.style.display = 'block';
            }
        });
    </script>



@endsection
