<?php

namespace Database\Factories;

use App\Models\Caso;
use App\Models\User;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Parroquia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CasoFactory extends Factory
{
    protected $model = Caso::class;

    public function definition(): array
    {
        // Selecciona un estado que tenga municipios y parroquias relacionados
        $estado = Estado::has('municipios.parroquias')->inRandomOrder()->first();

        if (!$estado) {
            throw new \Exception('No hay estados con municipios y parroquias disponibles');
        }

        $municipio = $estado->municipios()->has('parroquias')->inRandomOrder()->first();
        $parroquia = $municipio->parroquias()->inRandomOrder()->first();

        // Estado destino diferente
        $estadoDestino = Estado::has('municipios.parroquias')->inRandomOrder()->first();
        $municipioDestino = $estadoDestino->municipios()->has('parroquias')->inRandomOrder()->first();
        $parroquiaDestino = $municipioDestino->parroquias()->inRandomOrder()->first();
        $estados = [
            'AMA',
            'ANZ',
            'APU',
            'ARA',
            'BAR',
            'BOL',
            'CAR',
            'COJ',
            'DEL',
            'DIS',
            'FAL',
            'GUA',
            'LAR',
            'MER',
            'MIR',
            'MON',
            'NUE',
            'POR',
            'SUC',
            'TAC',
            'TRU',
            'LAG',
            'YAR',
            'ZUL'
        ];
        $codigoEstado = $this->faker->randomElement($estados);
        $numero = str_pad($this->faker->numberBetween(1, 999), 3, '0', STR_PAD_LEFT);


        // Listas de datos
        $beneficiarios = ['Niña adolescente', 'Mujer joven', 'Mujer adulta', 'Niño adolescente', 'Hombre joven', 'Hombre adulto'];
        $acompanantes = ['Padre', 'Madre', 'Representante legal', 'No aplica acompanante'];
        $serviciosCosude = ['Kits de higiene personal', 'Kit de alimentación (cesta de alimentos)', 'Platos servidos', 'Movilizaciones por caso', 'Hospedaje', 'Ningún servicio COSUDE'];
        $serviciosUnicef = ['Kits de higiene (NNA)', 'Viáticos alimentos', 'Traslado (NNA)', 'Traslado seguimiento', 'Traslado consejeros', 'Orientación', 'Ningún servicio UNICEF'];
        $actuaciones = ['Gestoría de casos', 'Derivaciones', 'Asistencia jurídica', 'Orientaciones'];
        $vulnerabilidades = ['NNA separados', 'Violencia familiar', 'Negligencia'];
        $derechos = ['Artículo 26 Derecho a ser criado en una familia', 'Artículo 41 Derecho a la salud y a servicios de salud'];
        $violencias = ['Violencia Psicológica (Conductas amenazantes que no necesariamente implican violencia física ni abuso verbal)'];
        $vicaria = ['Violencia económica (privar de manutención)', 'Negligencia (conductas de descuido a NNA)'];
        $tipos = [
            'Reunificación familiar',
            'Localización familiar',
            'Retorno voluntario',
        ];
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

        $tipo_documento = [
            'Certificado de nacimiento',
            'Acta de nacimiento (partida de nacimiento)',
            'Cédula',
            'Pasaporte',
            'NO posee documentos',
        ];
        $discapacidades = [
            'Física o Motora',
            'Sensorial (auditiva y visual)',
            'Auditiva',
            'Visual',
            'Intelectual',
            'Psíquica',
            'Ninguna',
        ];

        return [
            'user_id' => User::inRandomOrder()->value('id') ?? 1,
            'periodo' => now()->format('Y-m'),
            'fecha_atencion' => $this->faker->dateTimeBetween('-6 months', 'now'),

            'estado_id' => $estado->id,
            'municipio_id' => $municipio->id,
            'parroquia_id' => $parroquia->id,

            'estado_destino_id' => $estadoDestino->id,
            'municipio_destino_id' => $municipioDestino->id,
            'parroquia_destino_id' => $parroquiaDestino->id,

            'elaborado_por' => $this->faker->name,
            'numero_caso' => 'RLF-' . $codigoEstado . '-' . $numero,
            'organizacion_programa' => implode(', ', $this->faker->randomElements(['UNICEF', 'COSUDE'], rand(1, 2))),
            'organizacion_solicitante' => implode(', ', $this->faker->randomElements($organizaciones, rand(1, 3))),
            'otras_organizaciones' => 'Save the Children',

            'tipo_atencion_programa' => $this->faker->randomElement($tipos),

            'tipo_atencion' => $this->faker->randomElement(['Individual', 'Grupo familiar']),

            'beneficiario' => $this->faker->randomElement($beneficiarios),
            'estado_mujer' => 'No aplica',
            'edad_beneficiario' => $this->faker->numberBetween(1, 17),
            'poblacion_lgbti' => $this->faker->boolean() ? 'Sí' : 'No',
            'acompanante' => $this->faker->randomElement($acompanantes),
            'representante_legal' => $this->faker->randomElement($acompanantes),

            'pais_nacimiento' => $this->faker->randomElement($paises),
            'etnia_indigena' => $this->faker->randomElement($etnias_indigenas),
            'tipo_documento' => $this->faker->randomElement($tipo_documento),


            'pais_procedencia' => $this->faker->randomElement($paises),
            'otro_pais' => null,
            'nacionalidad_solicitante' => $this->faker->randomElement(['Venezolana', 'Extranjera']),
            'otro_pais_nacimiento' => null,

            'otra_etnia' => null,
            'tipo_documento' => $this->faker->randomElement($discapacidades),

            'educacion' => 'Sí',
            'nivel_educativo' => $this->faker->randomElement(['Inicial', 'Primaria', 'Secundaria']),
            'tipo_institucion' => $this->faker->randomElement([
                'Pública',
                'Privada',
                'Privada subsidiada',
                'Ninguna institución',
            ]),


            'servicio_brindado_cosude' => $this->faker->randomElement($serviciosCosude),
            'servicio_brindado_unicef' => $this->faker->randomElement($serviciosUnicef),

            'direccion_domicilio' => $this->faker->address,
            'numero_contacto' => $this->faker->phoneNumber,

            'tipo_actuacion' => $this->faker->randomElement($actuaciones),
            'otro_tipo_actuacion' => null,

            'vulnerabilidades' => json_encode($this->faker->randomElements($vulnerabilidades, rand(1, 2))),
            'derechos_vulnerados' => json_encode($this->faker->randomElements($derechos, rand(1, 2))),
            'identificacion_violencia' => json_encode($this->faker->randomElements($violencias, 1)),
            'tipos_violencia_vicaria' => json_encode($this->faker->randomElements($vicaria, rand(1, 2))),

            'remisiones' => implode(', ', $this->faker->randomElements([
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
            ], rand(1, 3))),

            'otras_remisiones' => null,

            'fotos' => json_encode(['/casos/imagenes/foto.png']),
            'archivos' => json_encode(['/casos/archivos/documento.pdf']),

            'fecha_actual' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'estatus' => $this->faker->randomElement([
                'En proceso',
                'En seguimiento',
                'Cierre de atención',
            ]),
            'indicadores' => 'PSEA.01',
            'observaciones' => 'Caso de prueba generado automáticamente.',
            'verificador' => 1,
            'condicion' => $this->faker->randomElement(['Aprobado', 'En espera', 'No aprobado']),
        ];
    }
}
