<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Proyecto;
use App\Models\Estado;
use App\Models\Municipio;

class ProyectoUbicacionSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $proyectos = Proyecto::all();
            $totalEstados = Estado::count();

            if ($proyectos->isEmpty()) {
                $this->command?->warn('No hay proyectos. Ejecuta primero ProyectoDemoSeeder.');
                return;
            }

            if ($totalEstados === 0) {
                throw new \Exception('No hay estados en la base de datos.');
            }

            foreach ($proyectos as $proyecto) {

                // 1) Asignar 1 a 3 estados aleatorios por proyecto
                $numEstados = min(rand(1, 3), $totalEstados);

                $estadosIds = Estado::inRandomOrder()
                    ->limit($numEstados)
                    ->pluck('id')
                    ->toArray();

                // Inserta en pivot (sin duplicar)
                $proyecto->estados()->syncWithoutDetaching($estadosIds);

                // 2) Asignar municipios SOLO de esos estados
                $municipiosQuery = Municipio::whereIn('estado_id', $estadosIds);

                $totalMunicipios = $municipiosQuery->count();

                // Si por alguna razón no hay municipios en esos estados, salta
                if ($totalMunicipios === 0) {
                    $this->command?->warn("Proyecto {$proyecto->id}: estados asignados pero sin municipios disponibles.");
                    continue;
                }

                $numMunicipios = min(rand(2, 6), $totalMunicipios);

                $municipiosIds = $municipiosQuery
                    ->inRandomOrder()
                    ->limit($numMunicipios)
                    ->pluck('id')
                    ->toArray();

                $proyecto->municipios()->syncWithoutDetaching($municipiosIds);
            }
        });
    }
}