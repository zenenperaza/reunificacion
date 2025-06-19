<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Caso;

class CasoSeeder extends Seeder
{
    public function run(): void
    {
        Caso::create([
            'user_id' => 1, // Asegúrate que el usuario con ID 1 existe (admin)
            'periodo' => '2025-06',
            'fecha_atencion' => now(),
            'estado_id' => 1, // Amazonas
            'municipio_id' => 1, // Atabapo
            'parroquia_id' => 1, // San Fernando de Atabapo

            'elaborado_por' => 'Juan Pérez',
            'numero_caso' => 'ASONACOP-001',
            'organizacion_programa' => 'UNICEF',
            'organizacion_solicitante' => 'HIAS',
            'otras_organizaciones' => 'Save the Children',

            'tipo_atencion_programa' => 'REUNIFICACIÓN FAMILIAR',
            'tipo_atencion' => 'Individual',

            'beneficiario' => 'Carlos Martínez',
            'estado_mujer' => 'No aplica',
            'edad_beneficiario' => 12,
            'poblacion_lgbti' => false,
            'acompanante' => 'Madre',
            'representante_legal' => 'MADRE',

            'pais_procedencia' => 'Colombia',
            'otro_pais' => null,
            'nacionalidad_solicitante' => 'Colombiana',
            'pais_nacimiento' => 'Colombia',
            'otro_pais_nacimiento' => null,

            'tipo_documento' => 'Registro Civil',
            'etnia_indigena' => 'Piaroa',
            'otra_etnia' => null,
            'discapacidad' => 'Ninguna',

            'educacion' => 'Sí',
            'nivel_educativo' => 'Primaria',
            'tipo_institucion' => 'Pública',

            'servicio_brindado_cosude' => 'KIT DE HIGIENE PERSONAL',
            'servicio_brindado_unicef' => 'TRASLADO(NNA)',

            'estado_destino_id' => 2, // Anzoátegui
            'municipio_destino_id' => 7, // Aragua
            'parroquia_destino_id' => 14, // Cualquiera válida

            'direccion_domicilio' => 'Calle Ficticia #123',
            'numero_contacto' => '0412-0000000',

            'tipo_actuacion' => 'Gestoría de casos',
            'otro_tipo_actuacion' => null,

            'vulnerabilidades' => json_encode(['NNA No Acompañados', 'Violencia Familiar']),
            'derechos_vulnerados' => json_encode(['Artículo 26 Derecho a ser criado en una familia']),
            'identificacion_violencia' => json_encode(['Violencia Psicológica']),
            'tipos_violencia_vicaria' => json_encode(['Violencia económica']),

            'remisiones' => json_encode(['Para Defensoría de NNA']),
            'otras_remisiones' => null,

            'fotos' => json_encode(['/uploads/foto1.jpg']),
            'archivos' => json_encode(['/uploads/documento1.pdf']),

            'fecha_actual' => now(),
            'estatus' => 'Pendiente',
            'indicadores' => 'PSEA.01',
            'observaciones' => 'Caso de prueba generado automáticamente.',
            'verificador' => 1,
            'condicion' => 'Evaluación inicial',
        ]);
    }
}

