<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalle del Caso - {{ $caso->numero_caso }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 0 40px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        header img {
            height: 60px;
        }

        h1 {
            font-size: 18px;
            text-align: center;
            margin: 20px 0;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            background-color: #f2f2f2;
            font-weight: bold;
            padding: 5px 10px;
            margin-bottom: 8px;
            border-left: 4px solid #007BFF;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            width: 200px;
        }

        .value {
            display: inline-block;
        }

        .list-item {
            margin-left: 15px;
        }

        img.foto {
            max-width: 120px;
            margin: 5px;
            border: 1px solid #ccc;
        }

        footer {
            position: fixed;
            bottom: -30px;
            left: 0;
            right: 0;
            height: 40px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .page-number:after {
            content: counter(page);
        }

        .fotos-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            page-break-inside: avoid;
            margin: 20px 0;
        }

        img.foto {
            max-width: 200px;
            max-height: 200px;
            object-fit: contain;
            border: 1px solid #ccc;
            padding: 4px;
            margin: 10px;
            page-break-inside: avoid;
        }
    </style>
</head>

<body>

    <header>
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ public_path('images/logo.png') }}" width="120" alt="Logo ASONACOP">
            <h3 style="margin-top: 10px;">{{ configuracion('nombre_sistema') ?? ' Caminos seguros' }} - Detalle del Caso</h3>
        </div>
    </header>

    <h1>Detalle del Caso: {{ $caso->numero_caso }}</h1>

    @php
        function listar($campo)
        {
            if (is_string($campo)) {
                $campo = json_decode($campo, true);
            }
            return is_array($campo) ? implode(', ', $campo) : $campo ?? 'Sin datos';
        }
    @endphp

    {{-- Datos generales --}}
    <div class="section">
        <div class="section-title">Datos Generales</div>
        <p><span class="label">Periodo:</span> <span class="value">{{ $caso->periodo }}</span></p>
        <p><span class="label">Fecha Atención:</span> <span
                class="value">{{ \Carbon\Carbon::parse($caso->fecha_atencion)->format('d/m/Y') }}</span></p>
        <p><span class="label">Fecha Actual:</span> <span
                class="value">{{ \Carbon\Carbon::parse($caso->fecha_actual)->format('d/m/Y') }}</span></p>
        <p><span class="label">Estatus:</span> <span class="value">{{ $caso->estatus }}</span></p>
        <p><span class="label">Descripción:</span> <span class="value">{{ $caso->observaciones }}</span></p>
    </div>

    {{-- Ubicación --}}
    <div class="section">
        <div class="section-title">Ubicación y Contacto</div>
        <p><span class="label">Estado:</span> <span class="value">{{ $caso->estado->nombre ?? '' }}</span></p>
        <p><span class="label">Municipio:</span> <span class="value">{{ $caso->municipio->nombre ?? '' }}</span></p>
        <p><span class="label">Parroquia:</span> <span class="value">{{ $caso->parroquia->nombre ?? '' }}</span></p>
        <p><span class="label">Dirección Domicilio:</span> <span
                class="value">{{ $caso->direccion_domicilio }}</span></p>
        <p><span class="label">Número Contacto:</span> <span class="value">{{ $caso->numero_contacto }}</span></p>
    </div>

    {{-- Persona atendida --}}
    <div class="section">
        <div class="section-title">Información del Beneficiario</div>
        <p><span class="label">Beneficiario:</span> <span class="value">{{ $caso->beneficiario }}</span></p>
        <p><span class="label">Edad:</span> <span class="value">{{ $caso->edad_beneficiario }}</span></p>
        <p><span class="label">Población LGBTI:</span> <span class="value">{{ $caso->poblacion_lgbti }}</span></p>
        <p><span class="label">Representante Legal:</span> <span
                class="value">{{ $caso->representante_legal }}</span></p>
    </div>

    {{-- Nacionalidad y documento --}}
    <div class="section">
        <div class="section-title">Datos de Nacionalidad</div>
        <p><span class="label">País Procedencia:</span> <span class="value">{{ $caso->pais_procedencia }}</span></p>
        <p><span class="label">Otro País:</span> <span class="value">{{ $caso->otro_pais }}</span></p>
        <p><span class="label">Nacionalidad Solicitante:</span> <span
                class="value">{{ $caso->nacionalidad_solicitante }}</span></p>
        <p><span class="label">Tipo Documento:</span> <span class="value">{{ $caso->tipo_documento }}</span></p>
        <p><span class="label">País Nacimiento:</span> <span class="value">{{ $caso->pais_nacimiento }}</span></p>
        <p><span class="label">Otro País Nacimiento:</span> <span
                class="value">{{ $caso->otro_pais_nacimiento }}</span></p>
    </div>

    {{-- Datos étnicos y educativos --}}
    <div class="section">
        <div class="section-title">Datos Culturales y Educativos</div>
        <p><span class="label">Etnia Indígena:</span> <span class="value">{{ $caso->etnia_indigena }}</span></p>
        <p><span class="label">Otra Etnia:</span> <span class="value">{{ $caso->otra_etnia }}</span></p>
        <p><span class="label">Educación:</span> <span class="value">{{ $caso->educacion }}</span></p>
        <p><span class="label">Nivel Educativo:</span> <span class="value">{{ $caso->nivel_educativo }}</span></p>
        <p><span class="label">Tipo Institución:</span> <span class="value">{{ $caso->tipo_institucion }}</span></p>
    </div>

    {{-- Atención y servicios --}}
    <div class="section">
        <div class="section-title">Atención y Servicios Brindados</div>
        <p><span class="label">Tipo Atención:</span> <span class="value">{{ $caso->tipo_atencion }}</span></p>
        <p><span class="label">Tipo Atención Programa:</span> <span
                class="value">{{ $caso->tipo_atencion_programa }}</span></p>
        <p><span class="label">Organización Programa:</span> <span
                class="value">{{ $caso->organizacion_programa }}</span></p>
        <p><span class="label">Organización Solicitante:</span> <span
                class="value">{{ $caso->organizacion_solicitante }}</span></p>
        <p><span class="label">Otras Organizaciones:</span> <span
                class="value">{{ $caso->otras_organizaciones }}</span></p>
        <p><span class="label">Servicio COSUDE:</span> <span
                class="value">{{ $caso->servicio_brindado_cosude }}</span></p>
        <p><span class="label">Servicio UNICEF:</span> <span
                class="value">{{ $caso->servicio_brindado_unicef }}</span></p>
        <p><span class="label">Tipo Actuación:</span> <span class="value">{{ $caso->tipo_actuacion }}</span></p>
        <p><span class="label">Otro Tipo Actuación:</span> <span
                class="value">{{ $caso->otro_tipo_actuacion }}</span></p>
    </div>

    {{-- Derechos y violencia --}}
    <div class="section">
        <div class="section-title">Derechos y Violencia</div>
        <p><span class="label">Vulnerabilidades:</span> <span
                class="value">{{ listar($caso->vulnerabilidades) }}</span></p>
        <p><span class="label">Derechos Vulnerados:</span> <span
                class="value">{{ listar($caso->derechos_vulnerados) }}</span></p>
        <p><span class="label">Identificación Violencia:</span> <span
                class="value">{{ listar($caso->identificacion_violencia) }}</span></p>
        <p><span class="label">Violencia Vicaria:</span> <span
                class="value">{{ listar($caso->tipos_violencia_vicaria) }}</span></p>
    </div>

    {{-- Remisiones e indicadores --}}
    <div class="section">
        <div class="section-title">Remisiones e Indicadores</div>
        <p><span class="label">Remisiones:</span> <span class="value">{{ listar($caso->remisiones) }}</span></p>
        <p><span class="label">Otras Remisiones:</span> <span class="value">{{ $caso->otras_remisiones }}</span>
        </p>
        <p><span class="label">Indicadores:</span> <span class="value">{{ listar($caso->indicadores) }}</span></p>
    </div>

    {{-- Información final --}}
    <div class="section">
        <div class="section-title">Información Final</div>
        <p><span class="label">Elaborado Por:</span> <span class="value">{{ $caso->elaborado_por }}</span></p>
        <p><span class="label">Verificador:</span> <span class="value">{{ $caso->verificador }}</span></p>
        <p><span class="label">Usuario Responsable:</span> <span class="value">{{ $caso->user->name ?? '' }}</span>
        </p>
    </div>

    {{-- Archivos --}}
    @if ($caso->fotos)
        <div class="section">
            <p class="label">Fotos:</p>
            <div class="fotos-container">
                @foreach (json_decode($caso->fotos, true) as $foto)
                    <img src="{{ public_path('storage/' . $foto) }}" alt="foto" class="foto">
                @endforeach
            </div>
        </div>
    @endif



    <footer>
        Página <span class="page-number"></span> | Generado el {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
    </footer>

</body>

</html>
