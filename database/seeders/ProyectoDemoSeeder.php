<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Donante;
use App\Models\Proyecto;
use App\Models\Indicador;
use App\Models\Actividad;
use App\Models\Servicio;

use App\Models\IndicadorProyecto;
use App\Models\ActividadIndicador;
use App\Models\ServicioActividad;

class ProyectoDemoSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            /*
            |--------------------------------------------------------------------------
            | 1. CATÁLOGO DE SERVICIOS (se crean una sola vez)
            |--------------------------------------------------------------------------
            */
            $serviciosData = [
                'Localización Familiar',
                'Asistencia de Documentación',
                'Evaluación y Reunificación Familiar',
                'Evaluación Psicosocial',
                'Apoyo para Reencuentro Familiar',
                'Asistencia y Seguimiento de la Familia',
                'Traslado humanitario interno',
                'Formación a líderes e Instituciones',
                'KITS DE HIGIENE (NNA)',
                'VIATICOS ALIMENTOS',
                'TRASLADO (NNA)',
                'ORIENTACION',
                'ORIENTACION LEGAL',
                'KITS DE ALIMENTACIÓN (ASONACOP)',
            ];

            $servicios = [];
            foreach ($serviciosData as $nombre) {
                $servicios[] = Servicio::firstOrCreate(
                    ['nombre' => $nombre],
                    ['descripcion' => $nombre]
                );
            }

            /*
            |--------------------------------------------------------------------------
            | 2. CATÁLOGO DE INDICADORES (se crean una sola vez)
            |--------------------------------------------------------------------------
            */
            $indicadoresCatalogo = [
                [
                    'codigo' => 'IND-1',
                    'descripcion' => 'Número de NNA que acceden al registro civil',
                ],
                [
                    'codigo' => 'IND-2',
                    'descripcion' => 'Número de personas capacitadas en protección infantil',
                ],
                [
                    'codigo' => 'IND-3',
                    'descripcion' => 'Número de NNA que reciben asistencia legal especializada',
                ],
            ];

            $indicadores = [];
            foreach ($indicadoresCatalogo as $item) {
                $indicadores[] = Indicador::firstOrCreate(
                    ['codigo' => $item['codigo']],
                    ['descripcion' => $item['descripcion']]
                );
            }

            /*
            |--------------------------------------------------------------------------
            | 3. CATÁLOGO DE ACTIVIDADES (se crean una sola vez)
            |--------------------------------------------------------------------------
            | Como son reusables, les damos códigos únicos de catálogo.
            |--------------------------------------------------------------------------
            */
            $actividadesCatalogo = [
                [
                    'codigo' => 'ACT-1',
                    'descripcion' => 'Gestión y acompañamiento especializado',
                ],
                [
                    'codigo' => 'ACT-2',
                    'descripcion' => 'Sensibilización comunitaria',
                ],
                [
                    'codigo' => 'ACT-3',
                    'descripcion' => 'Asistencia legal especializada',
                ],
            ];

            $actividades = [];
            foreach ($actividadesCatalogo as $item) {
                $actividades[] = Actividad::firstOrCreate(
                    ['codigo' => $item['codigo']],
                    ['descripcion' => $item['descripcion']]
                );
            }

            /*
            |--------------------------------------------------------------------------
            | 4. DONANTES
            |--------------------------------------------------------------------------
            */
            $donantes = [
                'UNICEF',
                'ODISEF',
                'Save the Children',
            ];

            foreach ($donantes as $indexDonante => $nombreDonante) {

                $donante = Donante::firstOrCreate(
                    ['nombre' => $nombreDonante],
                    [
                        'estatus' => true,
                        'enlaces' => [
                            'nombre_contacto' => 'Contacto ' . $nombreDonante,
                            'telefono' => '0414-0000000',
                        ],
                    ]
                );

                /*
                |--------------------------------------------------------------------------
                | 5. PROYECTO POR DONANTE
                |--------------------------------------------------------------------------
                | Evitamos usar rand() para que el seeder sea estable y repetible.
                |--------------------------------------------------------------------------
                */
                $codigoProyecto = 'PROY-' . str_pad((string) ($indexDonante + 1), 3, '0', STR_PAD_LEFT);

                $proyecto = Proyecto::firstOrCreate(
                    ['codigo' => $codigoProyecto],
                    [
                        'donante_id' => $donante->id,
                        'estatus' => true,
                        'descripcion' => 'Proyecto Protección Integral - ' . $nombreDonante,
                        'inicio' => '2026-01-01',
                        'fin' => '2026-12-31',
                    ]
                );

                /*
                |--------------------------------------------------------------------------
                | 6. ASOCIAR INDICADORES AL PROYECTO
                |--------------------------------------------------------------------------
                */
                foreach ($indicadores as $indicador) {

                    $indicadorProyecto = IndicadorProyecto::firstOrCreate(
                        [
                            'proyecto_id' => $proyecto->id,
                            'indicador_id' => $indicador->id,
                        ],
                        [
                            'estatus' => true,
                            'meta_cuantitativa' => rand(50, 200),
                            'meta_cualitativa' => 'Cumplimiento del indicador',
                        ]
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | 7. ASOCIAR ACTIVIDADES AL INDICADOR DEL PROYECTO
                    |--------------------------------------------------------------------------
                    */
                    foreach ($actividades as $actividad) {

                        $actividadIndicador = ActividadIndicador::firstOrCreate(
                            [
                                'indicador_proyecto_id' => $indicadorProyecto->id,
                                'actividad_id' => $actividad->id,
                            ],
                            [
                                'meta' => rand(10, 50),
                                'estatus' => true,
                            ]
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | 8. ASOCIAR 3 SERVICIOS ALEATORIOS POR ACTIVIDAD
                        |--------------------------------------------------------------------------
                        */
                        $serviciosAleatorios = collect($servicios)
                            ->shuffle()
                            ->take(3);

                        foreach ($serviciosAleatorios as $servicio) {
                            ServicioActividad::firstOrCreate(
                                [
                                    'actividad_indicador_id' => $actividadIndicador->id,
                                    'servicio_id' => $servicio->id,
                                ],
                                [
                                    'cantidad_disponible' => rand(5, 20),
                                    'estatus' => true,
                                ]
                            );
                        }
                    }
                }
            }
        });
    }
}