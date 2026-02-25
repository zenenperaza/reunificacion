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

            // ==============================
            // SERVICIOS REALES (catálogo)
            // ==============================
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
                $servicios[] = Servicio::create([
                    'nombre' => $nombre,
                    'descripcion' => $nombre,
                ]);
            }

            // ==============================
            // DONANTES
            // ==============================
            $donantes = [
                'UNICEF',
                'ODISEF',
                'Save the Children'
            ];

            foreach ($donantes as $nombreDonante) {

                $donante = Donante::create([
                    'nombre' => $nombreDonante,
                    'estatus' => true,
                    'enlaces' => [
                        'nombre_contacto' => 'Contacto ' . $nombreDonante,
                        'telefono' => '0414-0000000'
                    ]
                ]);

                // ==============================
                // PROYECTO
                // ==============================
                $proyecto = Proyecto::create([
                    'donante_id' => $donante->id,
                    'estatus' => true,
                    'codigo' => rand(1000, 9999),
                    'descripcion' => 'Proyecto Protección Integral - ' . $nombreDonante,
                    'inicio' => '2026-01-01',
                    'fin' => '2026-12-31',
                ]);

                // ==============================
                // INDICADORES REALES
                // ==============================
                $indicadoresTexto = [
                    'Número de NNA que acceden al registro civil',
                    'Número de personas capacitadas en protección infantil',
                    'Número de NNA que reciben asistencia legal especializada',
                ];

                foreach ($indicadoresTexto as $index => $textoIndicador) {

                    $indicador = Indicador::create([
                        'codigo' => 'IND-' . ($index + 1),
                        'descripcion' => $textoIndicador,
                    ]);

                    $indicadorProyecto = IndicadorProyecto::create([
                        'proyecto_id' => $proyecto->id,
                        'indicador_id' => $indicador->id,
                        'estatus' => true,
                        'meta_cuantitativa' => rand(50, 200),
                        'meta_cualitativa' => 'Cumplimiento del indicador',
                    ]);

                    // ==============================
                    // ACTIVIDADES REALES
                    // ==============================
                    $actividadesTexto = [
                        'Gestión y acompañamiento especializado',
                        'Sensibilización comunitaria',
                        'Asistencia legal especializada',
                    ];

                    foreach ($actividadesTexto as $pos => $textoActividad) {

                        $actividad = Actividad::create([
                            'codigo' => ($index + 1) . '.' . ($pos + 1),
                            'descripcion' => $textoActividad,
                        ]);

                        $actividadIndicador = ActividadIndicador::create([
                            'indicador_proyecto_id' => $indicadorProyecto->id,
                            'actividad_id' => $actividad->id,
                            'meta' => rand(10, 50),
                            'estatus' => true,
                        ]);

                        // ==============================
                        // SERVICIOS ALEATORIOS POR ACTIVIDAD
                        // ==============================
                        $serviciosAleatorios = collect($servicios)->random(3);

                        foreach ($serviciosAleatorios as $servicio) {
                            ServicioActividad::create([
                                'actividad_indicador_id' => $actividadIndicador->id,
                                'servicio_id' => $servicio->id,
                                'cantidad_disponible' => rand(5, 20),
                                'estatus' => true,
                            ]);
                        }
                    }
                }
            }
        });
    }
}