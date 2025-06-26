@extends('layouts.app')

@section('title', 'Detalle del Caso')

@section('content')

    <div class="container-fluid">
        {{-- <x-breadcrumb title="Mostrar Caso" /> --}}
        <div class="row page-title align-items-center my-2">
            <div class="col-sm-6 col-xl-6">
                <h4 class="mb-1 mt-0">Gestión de Casos</h4>
            </div>
            <div class="col-sm-6 col-xl-6">
                <ol class="breadcrumb float-end">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('casos.index') }}">Casos</a></li>
                    <li class="breadcrumb-item active">Mostrar Caso</li>
                </ol>
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

        <div class="tab-content p-3 border border-top-0" id="casoTabsContent">
            <!-- DATOS GENERALES -->
            <div class="tab-pane fade show active" id="datos" role="tabpanel">
                <x-readonly-input label="Periodo" value="{{ $caso->periodo }}" />
                <x-readonly-input label="Fecha de Atención"
                    value="{{ \Carbon\Carbon::parse($caso->fecha_atencion)->format('d/m/Y') }}" />
                <x-readonly-input label="Tipo de Atención" value="{{ $caso->tipo_atencion }}" />
                <x-readonly-input label="Beneficiario" value="{{ $caso->beneficiario }}" />
                <x-readonly-input label="Edad del Beneficiario" value="{{ $caso->edad_beneficiario }}" />
                <x-readonly-input label="Población LGBTI" value="{{ $caso->poblacion_lgbti }}" />
                <x-readonly-input label="Estatus" value="{{ $caso->estatus }}" />
                <x-readonly-input label="Obsrvaciones" value="{{ $caso->observaciones }}" />
                <x-readonly-input label="Verificador" value="{{ $caso->verificador }}" />
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

        <div class="mt-4 d-flex justify-content-center gap-3">
            {{-- Botón para descargar PDF --}}
            <a href="{{ route('casos.pdf', $caso->id) }}" class="btn btn-outline-danger" target="_blank">
                <i class="mdi mdi-file-pdf"></i> Descargar PDF
            </a>

            {{-- Botón para imprimir --}}
            <button onclick="window.print();" class="btn btn-outline-dark">
                <i class="mdi mdi-printer"></i> Imprimir
            </button>

            {{-- Botón para clonar --}}
            <a href="#" class="btn btn-outline-success" target="_blank">
                <i class="mdi mdi-clone"></i> Clona caso actual
            </a>
        </div>


        <div class="mt-4">
            <a href="{{ route('casos.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
@endsection
