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

        // Listas de datos
        $beneficiarios = ['Niña adolescente', 'Mujer joven', 'Mujer adulta', 'Niño adolescente', 'Hombre joven', 'Hombre adulto'];
        $acompanantes = ['Padre', 'Madre', 'Representante legal', 'No aplica acompanante'];
        $documentos = ['Certificado de nacimiento', 'Acta de nacimiento (partida de nacimiento)', 'Cédula', 'Pasaporte', 'NO posee documentos'];
        $etnias = ['Akawayo', 'Añu', 'Piaroa', 'Yekuana', 'Otra Etnia'];
        $serviciosCosude = ['Kits de higiene personal', 'Kit de alimentación (cesta de alimentos)', 'Platos servidos', 'Movilizaciones por caso', 'Hospedaje', 'Ningún servicio COSUDE'];
        $serviciosUnicef = ['Kits de higiene (NNA)', 'Viáticos alimentos', 'Traslado (NNA)', 'Traslado seguimiento', 'Traslado consejeros', 'Orientación', 'Ningún servicio UNICEF'];
        $actuaciones = ['Gestoría de casos', 'Derivaciones', 'Asistencia jurídica', 'Orientaciones'];
        $vulnerabilidades = ['NNA separados', 'Violencia familiar', 'Negligencia'];
        $derechos = ['Artículo 26 Derecho a ser criado en una familia', 'Artículo 41 Derecho a la salud y a servicios de salud'];
        $violencias = ['Violencia Psicológica (Conductas amenazantes que no necesariamente implican violencia física ni abuso verbal)'];
        $vicaria = ['Violencia económica (privar de manutención)', 'Negligencia (conductas de descuido a NNA)'];

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
            'numero_caso' => 'ASONACOP-' . strtoupper(Str::random(5)),
            'organizacion_programa' => 'UNICEF',
            'organizacion_solicitante' => 'HIAS',
            'otras_organizaciones' => 'Save the Children',

            'tipo_atencion_programa' => 'REUNIFICACIÓN FAMILIAR',
            'tipo_atencion' => $this->faker->randomElement(['Individual', 'Familiar']),

            'beneficiario' => $this->faker->randomElement($beneficiarios),
            'estado_mujer' => 'No aplica',
            'edad_beneficiario' => $this->faker->numberBetween(1, 17),
            'poblacion_lgbti' => $this->faker->boolean(),
            'acompanante' => $this->faker->randomElement($acompanantes),
            'representante_legal' => $this->faker->randomElement($acompanantes),

            'pais_procedencia' => 'Colombia',
            'otro_pais' => null,
            'nacionalidad_solicitante' => 'Colombiana',
            'pais_nacimiento' => 'Colombia',
            'otro_pais_nacimiento' => null,

            'tipo_documento' => $this->faker->randomElement($documentos),
            'etnia_indigena' => $this->faker->randomElement($etnias),
            'otra_etnia' => null,
            'discapacidad' => 'Ninguna',

            'educacion' => 'Sí',
            'nivel_educativo' => $this->faker->randomElement(['Inicial', 'Primaria', 'Secundaria']),
            'tipo_institucion' => 'Pública',

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

            'remisiones' => json_encode(['Para Defensoría de NNA']),
            'otras_remisiones' => null,

            'fotos' => json_encode(['/uploads/foto1.jpg']),
            'archivos' => json_encode(['/uploads/documento1.pdf']),

            'fecha_actual' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'estatus' => 'Pendiente',
            'indicadores' => 'PSEA.01',
            'observaciones' => 'Caso de prueba generado automáticamente.',
            'verificador' => 1,
            'condicion' => 'Evaluación inicial',
        ];
    }
}
