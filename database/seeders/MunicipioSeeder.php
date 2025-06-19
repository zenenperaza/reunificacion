<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Municipio;

class MunicipioSeeder extends Seeder
{
    public function run(): void
    {
        $municipios = [
            // Amazonas (estado_id = 1)
            ['nombre' => 'Atabapo', 'estado_id' => 1],
            ['nombre' => 'Atures', 'estado_id' => 1],
            ['nombre' => 'Autana', 'estado_id' => 1],
            ['nombre' => 'Manapiare', 'estado_id' => 1],
            ['nombre' => 'Maroa', 'estado_id' => 1],
            ['nombre' => 'Río Negro', 'estado_id' => 1],

            // Anzoátegui (estado_id = 2)
            ['nombre' => 'Anaco', 'estado_id' => 2],
            ['nombre' => 'Aragua', 'estado_id' => 2],
            ['nombre' => 'Fernando de Peñalver', 'estado_id' => 2],
            ['nombre' => 'Francisco de Miranda', 'estado_id' => 2],
            ['nombre' => 'Francisco del Carmen Carvajal', 'estado_id' => 2],
            ['nombre' => 'Guanta', 'estado_id' => 2],
            ['nombre' => 'Independencia', 'estado_id' => 2],
            ['nombre' => 'José Gregorio Monagas', 'estado_id' => 2],
            ['nombre' => 'Juan Antonio Sotillo', 'estado_id' => 2],
            ['nombre' => 'Juan Manuel Cajigal', 'estado_id' => 2],
            ['nombre' => 'Libertad', 'estado_id' => 2],
            ['nombre' => 'Manuel Ezequiel Bruzual', 'estado_id' => 2],
            ['nombre' => 'Pedro María Freites', 'estado_id' => 2],
            ['nombre' => 'Píritu', 'estado_id' => 2],
            ['nombre' => 'San José de Guanipa', 'estado_id' => 2],
            ['nombre' => 'San Juan de Capistrano', 'estado_id' => 2],
            ['nombre' => 'Santa Ana', 'estado_id' => 2],
            ['nombre' => 'Simón Bolívar', 'estado_id' => 2],
            ['nombre' => 'Simón Rodríguez', 'estado_id' => 2],

            // Apure (estado_id = 3)
            ['nombre' => 'Achaguas', 'estado_id' => 3],
            ['nombre' => 'Biruaca', 'estado_id' => 3],
            ['nombre' => 'Muñoz', 'estado_id' => 3],
            ['nombre' => 'Páez', 'estado_id' => 3],
            ['nombre' => 'Pedro Camejo', 'estado_id' => 3],
            ['nombre' => 'Rómulo Gallegos', 'estado_id' => 3],
            ['nombre' => 'San Fernando', 'estado_id' => 3],

            // Aragua (estado_id = 4)
            ['nombre' => 'Bolívar', 'estado_id' => 4],
            ['nombre' => 'Camatagua', 'estado_id' => 4],
            ['nombre' => 'Francisco Linares Alcántara', 'estado_id' => 4],
            ['nombre' => 'Girardot', 'estado_id' => 4],
            ['nombre' => 'José Ángel Lamas', 'estado_id' => 4],
            ['nombre' => 'José Félix Ribas', 'estado_id' => 4],
            ['nombre' => 'José Rafael Revenga', 'estado_id' => 4],
            ['nombre' => 'Libertador', 'estado_id' => 4],
            ['nombre' => 'Mario Briceño Iragorry', 'estado_id' => 4],
            ['nombre' => 'Ocumare de la Costa de Oro', 'estado_id' => 4],
            ['nombre' => 'San Casimiro', 'estado_id' => 4],
            ['nombre' => 'San Sebastián', 'estado_id' => 4],
            ['nombre' => 'Santiago Mariño', 'estado_id' => 4],
            ['nombre' => 'Santos Michelena', 'estado_id' => 4],
            ['nombre' => 'Sucre', 'estado_id' => 4],
            ['nombre' => 'Tovar', 'estado_id' => 4],
            ['nombre' => 'Urdaneta', 'estado_id' => 4],
            ['nombre' => 'Zamora', 'estado_id' => 4],

            // Barinas (estado_id = 5)
            ['nombre' => 'Alberto Arvelo Torrealba', 'estado_id' => 5],
            ['nombre' => 'Andrés Eloy Blanco', 'estado_id' => 5],
            ['nombre' => 'Antonio José de Sucre', 'estado_id' => 5],
            ['nombre' => 'Arismendi', 'estado_id' => 5],
            ['nombre' => 'Barinas', 'estado_id' => 5],
            ['nombre' => 'Bolívar', 'estado_id' => 5],
            ['nombre' => 'Cruz Paredes', 'estado_id' => 5],
            ['nombre' => 'Ezequiel Zamora', 'estado_id' => 5],
            ['nombre' => 'Obispos', 'estado_id' => 5],
            ['nombre' => 'Pedraza', 'estado_id' => 5],
            ['nombre' => 'Rojas', 'estado_id' => 5],
            ['nombre' => 'Sosa', 'estado_id' => 5],

            // Táchira (estado_id = 20)
            ['nombre' => 'Andrés Bello', 'estado_id' => 20],
            ['nombre' => 'Antonio Rómulo Costa', 'estado_id' => 20],
            ['nombre' => 'Ayacucho', 'estado_id' => 20],
            ['nombre' => 'Bolívar', 'estado_id' => 20],
            ['nombre' => 'Cárdenas', 'estado_id' => 20],
            ['nombre' => 'Córdoba', 'estado_id' => 20],
            ['nombre' => 'Fernández Feo', 'estado_id' => 20],
            ['nombre' => 'Francisco de Miranda', 'estado_id' => 20],
            ['nombre' => 'García de Hevia', 'estado_id' => 20],
            ['nombre' => 'Guásimos', 'estado_id' => 20],
            ['nombre' => 'Independencia', 'estado_id' => 20],
            ['nombre' => 'Jáuregui', 'estado_id' => 20],
            ['nombre' => 'José María Vargas', 'estado_id' => 20],
            ['nombre' => 'Junín', 'estado_id' => 20],
            ['nombre' => 'Libertad', 'estado_id' => 20],
            ['nombre' => 'Libertador', 'estado_id' => 20],
            ['nombre' => 'Lobatera', 'estado_id' => 20],
            ['nombre' => 'Michelena', 'estado_id' => 20],
            ['nombre' => 'Panamericano', 'estado_id' => 20],
            ['nombre' => 'Pedro María Ureña', 'estado_id' => 20],
            ['nombre' => 'Rafael Urdaneta', 'estado_id' => 20],
            ['nombre' => 'Samuel Darío Maldonado', 'estado_id' => 20],
            ['nombre' => 'San Cristóbal', 'estado_id' => 20],
            ['nombre' => 'Seboruco', 'estado_id' => 20],
            ['nombre' => 'Simón Rodríguez', 'estado_id' => 20],
            ['nombre' => 'Sucre', 'estado_id' => 20],
            ['nombre' => 'Torbes', 'estado_id' => 20],
            ['nombre' => 'Uribante', 'estado_id' => 20],
            ['nombre' => 'San Judas Tadeo', 'estado_id' => 20],

        ];

        Municipio::insert($municipios);
    }
}
