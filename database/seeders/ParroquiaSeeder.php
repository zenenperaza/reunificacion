<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Parroquia;

class ParroquiaSeeder extends Seeder
{
    public function run(): void
    {
        $parroquias = [
            // Parroquias de Amazonas (municipio_id = 1–7)
            ['nombre' => 'Atabapo', 'municipio_id' => 1],
            ['nombre' => 'San Fernando de Atabapo', 'municipio_id' => 1],
            ['nombre' => 'Ucata', 'municipio_id' => 1],
            ['nombre' => 'Yapacana', 'municipio_id' => 1],
            ['nombre' => 'Caname', 'municipio_id' => 1],

            ['nombre' => 'Fernando Girón Tovar', 'municipio_id' => 2],
            ['nombre' => 'Luis Alberto Gómez', 'municipio_id' => 2],
            ['nombre' => 'Parhueña', 'municipio_id' => 2],
            ['nombre' => 'Platanillal', 'municipio_id' => 2],

            ['nombre' => 'La Esmeralda', 'municipio_id' => 3],
            ['nombre' => 'Marawaka', 'municipio_id' => 3],
            ['nombre' => 'Mavaca', 'municipio_id' => 3],
            ['nombre' => 'Sierra Parima', 'municipio_id' => 3],

            ['nombre' => 'Samariapo', 'municipio_id' => 4],
            ['nombre' => 'Sipapo', 'municipio_id' => 4],
            ['nombre' => 'Munduapo', 'municipio_id' => 4],
            ['nombre' => 'Guayapo', 'municipio_id' => 4],
            ['nombre' => 'Isla Ratón', 'municipio_id' => 4],

            ['nombre' => 'Alto Ventuari', 'municipio_id' => 5],
            ['nombre' => 'Medio Ventuari', 'municipio_id' => 5],
            ['nombre' => 'Bajo Ventuari', 'municipio_id' => 5],

            ['nombre' => 'Maroa', 'municipio_id' => 6],
            ['nombre' => 'Victorino', 'municipio_id' => 6],
            ['nombre' => 'La Comunidad', 'municipio_id' => 6],

            ['nombre' => 'Casiquiare', 'municipio_id' => 7],
            ['nombre' => 'Cocuy', 'municipio_id' => 7],
            ['nombre' => 'San Carlos de Río Negro', 'municipio_id' => 7],
            ['nombre' => 'Solano', 'municipio_id' => 7],



            // Parroquias de Anzoátegui (municipio_id 8–28)

            ['nombre' => 'Anaco', 'municipio_id' => 8],            // Capital Anaco:contentReference[oaicite:2]{index=2}
            ['nombre' => 'Buena Vista', 'municipio_id' => 8],      // También parte de Anaco:contentReference[oaicite:3]{index=3}
            ['nombre' => 'San Joaquín', 'municipio_id' => 8],      // Parte de Anaco:contentReference[oaicite:4]{index=4}

            ['nombre' => 'Aragua de Barcelona', 'municipio_id' => 9], // Municipal Aragua:contentReference[oaicite:5]{index=5}
            ['nombre' => 'Cachipo', 'municipio_id' => 9],             // Municipal Aragua:contentReference[oaicite:6]{index=6}

            ['nombre' => 'Lechería', 'municipio_id' => 10],          // Diego Bautista Urbaneja:contentReference[oaicite:7]{index=7}
            ['nombre' => 'El Morro', 'municipio_id' => 10],          // Urbaneja:contentReference[oaicite:8]{index=8}

            ['nombre' => 'Puerto Píritu', 'municipio_id' => 11],     // Fernando de Peñalver:contentReference[oaicite:9]{index=9}
            ['nombre' => 'San Miguel', 'municipio_id' => 11],        // Fernando de Peñalver:contentReference[oaicite:10]{index=10}
            ['nombre' => 'Sucre', 'municipio_id' => 11],             // Fernando de Peñalver:contentReference[oaicite:11]{index=11}

            ['nombre' => 'Cantaura', 'municipio_id' => 12],          // Francisco de Miranda:contentReference[oaicite:12]{index=12}
            ['nombre' => 'Santa Rosa', 'municipio_id' => 12],        // Francisco de Miranda:contentReference[oaicite:13]{index=13}
            ['nombre' => 'Urica', 'municipio_id' => 12],             // Francisco de Miranda:contentReference[oaicite:14]{index=14}
            ['nombre' => 'Libertador', 'municipio_id' => 12],        // Francisco de Miranda:contentReference[oaicite:15]{index=15}

            ['nombre' => 'Valle de Guanape', 'municipio_id' => 13],   // Francisco del Carmen Carvajal:contentReference[oaicite:16]{index=16}
            ['nombre' => 'Santa Bárbara', 'municipio_id' => 13],     // Francisco del Carmen Carvajal:contentReference[oaicite:17]{index=17}

            ['nombre' => 'Guanta', 'municipio_id' => 14],            // Guanta:contentReference[oaicite:18]{index=18}
            ['nombre' => 'Chorrerón', 'municipio_id' => 14],         // Guanta:contentReference[oaicite:19]{index=19}
            ['nombre' => 'Pertigalete', 'municipio_id' => 14],       // Guanta:contentReference[oaicite:20]{index=20}

            ['nombre' => 'Soledad', 'municipio_id' => 15],           // Independencia:contentReference[oaicite:21]{index=21}
            ['nombre' => 'Carapa', 'municipio_id' => 15],            // Independencia:contentReference[oaicite:22]{index=22}
            ['nombre' => 'El Mamo', 'municipio_id' => 15],           // Independencia:contentReference[oaicite:23]{index=23}
            ['nombre' => 'Palital', 'municipio_id' => 15],           // Independencia:contentReference[oaicite:24]{index=24}

            ['nombre' => 'Guanipa', 'municipio_id' => 16],           // José Gregorio Monagas (Guanipa):contentReference[oaicite:25]{index=25}

            ['nombre' => 'Puerto La Cruz', 'municipio_id' => 17],    // Juan Antonio Sotillo:contentReference[oaicite:26]{index=26}
            ['nombre' => 'Pozuelos', 'municipio_id' => 17],         // Sotillo:contentReference[oaicite:27]{index=27}
            ['nombre' => 'La Cruz', 'municipio_id' => 17],          // Sotillo:contentReference[oaicite:28]{index=28}
            ['nombre' => 'Hugo Chávez Frías', 'municipio_id' => 17], // Sotillo:contentReference[oaicite:29]{index=29}

            ['nombre' => 'Onoto', 'municipio_id' => 18],            // Juan Manuel Cajigal:contentReference[oaicite:30]{index=30}
            ['nombre' => 'San Pablo', 'municipio_id' => 18],         // Cajigal:contentReference[oaicite:31]{index=31}
            ['nombre' => 'Guaribe', 'municipio_id' => 18],          // Cajigal:contentReference[oaicite:32]{index=32}

            ['nombre' => 'El Carito', 'municipio_id' => 19],         // Libertad:contentReference[oaicite:33]{index=33}
            ['nombre' => 'San Mateo', 'municipio_id' => 19],         // Libertad:contentReference[oaicite:34]{index=34}
            ['nombre' => 'Santa Inés', 'municipio_id' => 19],       // Libertad:contentReference[oaicite:35]{index=35}

            ['nombre' => 'Clarines', 'municipio_id' => 20],          // Manuel Ezequiel Bruzual:contentReference[oaicite:36]{index=36}
            ['nombre' => 'Guanape', 'municipio_id' => 20],           // Bruzual:contentReference[oaicite:37]{index=37}
            ['nombre' => 'Sabana de Uchire', 'municipio_id' => 20],  // Bruzual:contentReference[oaicite:38]{index=38}

            ['nombre' => 'Cantaura', 'municipio_id' => 21],          // Pedro María Freites:contentReference[oaicite:39]{index=39}
            ['nombre' => 'Santa Rosa', 'municipio_id' => 21],        // Freites:contentReference[oaicite:40]{index=40}
            ['nombre' => 'Urica', 'municipio_id' => 21],             // Freites:contentReference[oaicite:41]{index=41}
            ['nombre' => 'Libertador', 'municipio_id' => 21],        // Freites:contentReference[oaicite:42]{index=42}
            ['nombre' => 'Hugo Chávez Frías', 'municipio_id' => 21], // Freites:contentReference[oaicite:43]{index=43}

            ['nombre' => 'Píritu', 'municipio_id' => 22],            // Píritu:contentReference[oaicite:44]{index=44}
            ['nombre' => 'San Francisco', 'municipio_id' => 22],     // Píritu:contentReference[oaicite:45]{index=45}

            ['nombre' => 'San José de Guanipa', 'municipio_id' => 23], // Guanipa:contentReference[oaicite:46]{index=46}

            ['nombre' => 'Boca de Uchire', 'municipio_id' => 24],     // San Juan de Capistrano:contentReference[oaicite:47]{index=47}
            ['nombre' => 'Boca de Chávez', 'municipio_id' => 24],     // San Juan de Capistrano:contentReference[oaicite:48]{index=48}

            ['nombre' => 'Santa Ana', 'municipio_id' => 25],         // Santa Ana:contentReference[oaicite:49]{index=49}
            ['nombre' => 'Pueblo Nuevo', 'municipio_id' => 25],       // Santa Ana:contentReference[oaicite:50]{index=50}

            ['nombre' => 'Edmundo Barrios', 'municipio_id' => 26],    // Simón Bolívar:contentReference[oaicite:51]{index=51}
            ['nombre' => 'Miguel Otero Silva', 'municipio_id' => 26], // Simón Bolívar:contentReference[oaicite:52]{index=52}

            ['nombre' => 'El Tigre', 'municipio_id' => 27],          // Simón Rodríguez:contentReference[oaicite:53]{index=53}

            ['nombre' => 'La Cruz', 'municipio_id' => 28],            // Sotillo (repetido):contentReference[oaicite:54]{index=54}
            ['nombre' => 'Pozuelos', 'municipio_id' => 28],          // Sotillo:contentReference[oaicite:55]{index=55}
            ['nombre' => 'Hugo Chávez Frías', 'municipio_id' => 28],  // Sotillo:contentReference[oaicite:56]{index=56}


            // Parroquias de Apure (municipio_id 29–35)

            // Municipio Achaguas (29)
            ['nombre' => 'Achaguas',               'municipio_id' => 29],
            ['nombre' => 'Apurito',               'municipio_id' => 29],
            ['nombre' => 'El Yagual',             'municipio_id' => 29],
            ['nombre' => 'Guachara',              'municipio_id' => 29],
            ['nombre' => 'Mucuritas',             'municipio_id' => 29],
            ['nombre' => 'Queseras del Medio',    'municipio_id' => 29],

            // Municipio Biruaca (30)
            ['nombre' => 'Biruaca',               'municipio_id' => 30],

            // Municipio Muñoz (31)
            ['nombre' => 'Bruzal',                'municipio_id' => 31],
            ['nombre' => 'San Juan de Payara',    'municipio_id' => 31],

            // Municipio Páez (32)
            ['nombre' => 'Guasdualito',           'municipio_id' => 32],
            ['nombre' => 'El Amparo',             'municipio_id' => 32],

            // Municipio Pedro Camejo (33)
            ['nombre' => 'Pedro Camejo',          'municipio_id' => 33],

            // Municipio Rómulo Gallegos (34)
            ['nombre' => 'Elorza',                'municipio_id' => 34],
            ['nombre' => 'La Trinidad de Orichuna', 'municipio_id' => 34],

            // Municipio San Fernando (35)
            ['nombre' => 'San Fernando',          'municipio_id' => 35],
            ['nombre' => 'El Recreo',            'municipio_id' => 35],
            ['nombre' => 'Peñalver',             'municipio_id' => 35],
            ['nombre' => 'San Rafael de Atamaica', 'municipio_id' => 35],


            // Parroquias de Aragua (municipio_id 36–53)

            // Municipio Bolívar (36)
            // Nota: Bolívar en Aragua es también conocido como San Mateo.
            // Según Área metropolitana de Maracay :contentReference[oaicite:1]{index=1}:
            ['nombre' => 'San Mateo', 'municipio_id' => 36],

            // Municipio Camatagua (37) :contentReference[oaicite:2]{index=2}:
            ['nombre' => 'Camatagua', 'municipio_id' => 37],
            ['nombre' => 'Ollas de Caramacate', 'municipio_id' => 37],
            ['nombre' => 'Valle Morín', 'municipio_id' => 37],
            ['nombre' => 'Carmen de Cura', 'municipio_id' => 37],

            // Municipio Francisco Linares Alcántara (38) :contentReference[oaicite:3]{index=3}:
            ['nombre' => 'Santa Rita', 'municipio_id' => 38],

            // Municipio Girardot (39) – incluye Maracay :contentReference[oaicite:4]{index=4}:
            ['nombre' => 'Pedro José Ovalles', 'municipio_id' => 39],
            ['nombre' => 'Joaquín Crespo', 'municipio_id' => 39],
            ['nombre' => 'José Casanova Godoy', 'municipio_id' => 39],
            ['nombre' => 'Madre María de San José', 'municipio_id' => 39],
            ['nombre' => 'Andrés Eloy Blanco', 'municipio_id' => 39],
            ['nombre' => 'Los Tacarigua', 'municipio_id' => 39],
            ['nombre' => 'Las Delicias', 'municipio_id' => 39],
            ['nombre' => 'Choroní', 'municipio_id' => 39],

            // Municipio José Ángel Lamas (40) :contentReference[oaicite:5]{index=5}:
            ['nombre' => 'Santa Cruz', 'municipio_id' => 40],
            ['nombre' => 'Tovar', 'municipio_id' => 40],

            // Municipio José Félix Ribas (41) :contentReference[oaicite:6]{index=6}:
            ['nombre' => 'José Félix Ribas', 'municipio_id' => 41],
            ['nombre' => 'La Mora', 'municipio_id' => 41],
            ['nombre' => 'Las Peñitas', 'municipio_id' => 41],
            ['nombre' => 'San Francisco de Asís', 'municipio_id' => 41],
            ['nombre' => 'Taguay', 'municipio_id' => 41],
            ['nombre' => 'Zuata', 'municipio_id' => 41],

            // Municipio José Rafael Revenga (42) :contentReference[oaicite:7]{index=7}:
            ['nombre' => 'Magdaleno', 'municipio_id' => 42],
            ['nombre' => 'José Rafael Revenga', 'municipio_id' => 42],
            ['nombre' => 'San Francisco de Asís', 'municipio_id' => 42],
            ['nombre' => 'Valles de Tucutunemo', 'municipio_id' => 42],

            // Municipio Libertador (43) – Palo Negro :contentReference[oaicite:8]{index=8}:
            ['nombre' => 'Palo Negro', 'municipio_id' => 43],
            ['nombre' => 'San Martín de Porres', 'municipio_id' => 43],

            // Municipio Mario Briceño Iragorry (44) :contentReference[oaicite:9]{index=9}:
            ['nombre' => 'El Limón', 'municipio_id' => 44],
            ['nombre' => 'Caña de Azúcar', 'municipio_id' => 44],

            // Municipio Ocumare de la Costa de Oro (45) :contentReference[oaicite:10]{index=10}:
            ['nombre' => 'Ocumare de la Costa de Oro', 'municipio_id' => 45],

            // Municipio San Casimiro (46) :contentReference[oaicite:11]{index=11}:
            ['nombre' => 'San Casimiro', 'municipio_id' => 46],

            // Municipio San Sebastián (47) :contentReference[oaicite:12]{index=12}:
            ['nombre' => 'San Sebastián', 'municipio_id' => 47],

            // Municipio Santiago Mariño (48) :contentReference[oaicite:13]{index=13}:
            ['nombre' => 'Francisco de Miranda', 'municipio_id' => 48],
            ['nombre' => 'Turmero', 'municipio_id' => 48],
            ['nombre' => 'Monseñor Feliciano González', 'municipio_id' => 48],
            ['nombre' => 'Chuao', 'municipio_id' => 48],
            ['nombre' => 'Samán de Güere', 'municipio_id' => 48],

            // Municipio Santos Michelena (49) :contentReference[oaicite:14]{index=14}:
            ['nombre' => 'José Casanova Godoy', 'municipio_id' => 49],
            ['nombre' => 'Madre María de San José', 'municipio_id' => 49],
            ['nombre' => 'Santos Michelena', 'municipio_id' => 49],

            // Municipio Sucre (50) – Cagua :contentReference[oaicite:15]{index=15}:
            ['nombre' => 'Cagua', 'municipio_id' => 50],
            ['nombre' => 'Las Delicias', 'municipio_id' => 50],

            // Municipio Tovar (51) – Colonia Tovar :contentReference[oaicite:16]{index=16}:
            ['nombre' => 'Tovar', 'municipio_id' => 51],

            // Municipio Urdaneta (52) – Barbacoas :contentReference[oaicite:17]{index=17}:
            ['nombre' => 'Barbacoas', 'municipio_id' => 52],

            // Municipio Zamora (53) – Villa de Cura :contentReference[oaicite:18]{index=18}:
            ['nombre' => 'Zamora', 'municipio_id' => 53],

            ['nombre' => 'Sabaneta', 'municipio_id' => 54],
            ['nombre' => 'Juan Antonio Rodríguez Domínguez', 'municipio_id' => 54],

            ['nombre' => 'El Cantón', 'municipio_id' => 55],
            ['nombre' => 'Santa Cruz de Guacas', 'municipio_id' => 55],
            ['nombre' => 'Puerto Vivas', 'municipio_id' => 55],

            ['nombre' => 'Ticoporo', 'municipio_id' => 56],
            ['nombre' => 'Nicolás Pulido', 'municipio_id' => 56],
            ['nombre' => 'Andrés Bello', 'municipio_id' => 56],

            ['nombre' => 'Arismendi', 'municipio_id' => 57],
            ['nombre' => 'Guadarrama', 'municipio_id' => 57],
            ['nombre' => 'La Unión', 'municipio_id' => 57],
            ['nombre' => 'San Antonio', 'municipio_id' => 57],

            ['nombre' => 'Barinas', 'municipio_id' => 58],
            ['nombre' => 'Alberto Arvelo Larriva', 'municipio_id' => 58],
            ['nombre' => 'San Silvestre', 'municipio_id' => 58],
            ['nombre' => 'Santa Inés', 'municipio_id' => 58],
            ['nombre' => 'Santa Lucía', 'municipio_id' => 58],
            ['nombre' => 'Torunos', 'municipio_id' => 58],
            ['nombre' => 'El Carmen', 'municipio_id' => 58],
            ['nombre' => 'Rómulo Betancourt', 'municipio_id' => 58],
            ['nombre' => 'Corazón de Jesús', 'municipio_id' => 58],
            ['nombre' => 'Ramón Ignacio Méndez', 'municipio_id' => 58],
            ['nombre' => 'Alto Barinas', 'municipio_id' => 58],
            ['nombre' => 'Manuel Palacio Fajardo', 'municipio_id' => 58],

            ['nombre' => 'Barinitas', 'municipio_id' => 59],
            ['nombre' => 'Altamira de Cáceres', 'municipio_id' => 59],
            ['nombre' => 'Calderas', 'municipio_id' => 59],

            ['nombre' => 'Barrancas', 'municipio_id' => 60],
            ['nombre' => 'El Socorro', 'municipio_id' => 60],
            ['nombre' => 'Masparrito', 'municipio_id' => 60],

            ['nombre' => 'Santa Bárbara', 'municipio_id' => 61],
            ['nombre' => 'Pedro Briceño Méndez', 'municipio_id' => 61],
            ['nombre' => 'Ramón Ignacio Méndez', 'municipio_id' => 61],
            ['nombre' => 'José Ignacio del Pumar', 'municipio_id' => 61],

            ['nombre' => 'Obispos', 'municipio_id' => 62],
            ['nombre' => 'Los Guasimitos', 'municipio_id' => 62],
            ['nombre' => 'El Real', 'municipio_id' => 62],
            ['nombre' => 'La Luz', 'municipio_id' => 62],

            ['nombre' => 'Ciudad Bolivia', 'municipio_id' => 63],
            ['nombre' => 'José Ignacio Briceño', 'municipio_id' => 63],
            ['nombre' => 'José Félix Ribas', 'municipio_id' => 63],
            ['nombre' => 'Páez', 'municipio_id' => 63],

            ['nombre' => 'Libertad', 'municipio_id' => 64],
            ['nombre' => 'Dolores', 'municipio_id' => 64],
            ['nombre' => 'Santa Rosa', 'municipio_id' => 64],
            ['nombre' => 'Palacio Fajardo', 'municipio_id' => 64],
            ['nombre' => 'Simón Rodríguez', 'municipio_id' => 64],

            ['nombre' => 'Ciudad de Nutrias', 'municipio_id' => 65],
            ['nombre' => 'El Regalo', 'municipio_id' => 65],
            ['nombre' => 'Puerto Nutrias', 'municipio_id' => 65],
            ['nombre' => 'Santa Catalina', 'municipio_id' => 65],
            ['nombre' => 'Simón Bolívar', 'municipio_id' => 65],

            ['nombre' => 'Ticoporo', 'municipio_id' => 66],

            // Municipio Caroní (67)
            ['nombre' => 'Caroní', 'municipio_id' => 67], // Ciudad Guayana

            // Municipio Cedeño (68)
            ['nombre' => 'Cedeño', 'municipio_id' => 68], // Caicara del Orinoco

            // Municipio El Callao (69)
            ['nombre' => 'El Callao', 'municipio_id' => 69], // El Callao

            // Municipio Gran Sabana (70)
            ['nombre' => 'Gran Sabana', 'municipio_id' => 70], // Santa Elena de Uairén

            // Municipio Heres (71)
            ['nombre' => 'Heres', 'municipio_id' => 71], // Ciudad Bolívar

            // Municipio Piar (72)
            ['nombre' => 'Piar', 'municipio_id' => 72], // Upata

            // Municipio Raúl Leoni (73)
            ['nombre' => 'Raúl Leoni', 'municipio_id' => 73], // Ciudad Piar

            // Municipio Roscio (74)
            ['nombre' => 'Roscio', 'municipio_id' => 74], // Guasipati

            // Municipio Sifontes (75)
            ['nombre' => 'Sifontes', 'municipio_id' => 75], // Tumeremo

            // Municipio Sucre (76)
            ['nombre' => 'Sucre', 'municipio_id' => 76], // Maripa

            // Municipio Padre Pedro Chien (77)
            ['nombre' => 'Padre Pedro Chien', 'municipio_id' => 77], // El Palmar


            // Municipio Bejuma (78)
            ['nombre' => 'Bejuma', 'municipio_id' => 78], // Bejuma

            // Municipio Carlos Arvelo (79)
            ['nombre' => 'Carlos Arvelo', 'municipio_id' => 79], // Güigüe

            // Municipio Diego Ibarra (80)
            ['nombre' => 'Diego Ibarra', 'municipio_id' => 80], // Mariara

            // Municipio Guacara (81)
            ['nombre' => 'Guacara', 'municipio_id' => 81], // Guacara

            // Municipio Juan José Mora (82)
            ['nombre' => 'Juan José Mora', 'municipio_id' => 82], // Morón

            // Municipio Libertador (83)
            ['nombre' => 'Libertador', 'municipio_id' => 83], // Tocuyito

            // Municipio Los Guayos (84)
            ['nombre' => 'Los Guayos', 'municipio_id' => 84], // Los Guayos

            // Municipio Miranda (85)
            ['nombre' => 'Miranda', 'municipio_id' => 85], // Miranda

            // Municipio Montalbán (86)
            ['nombre' => 'Montalbán', 'municipio_id' => 86], // Montalbán

            // Municipio Naguanagua (87)
            ['nombre' => 'Naguanagua', 'municipio_id' => 87], // Naguanagua

            // Municipio Puerto Cabello (88)
            ['nombre' => 'Puerto Cabello', 'municipio_id' => 88], // Puerto Cabello

            // Municipio San Diego (89)
            ['nombre' => 'San Diego', 'municipio_id' => 89], // San Diego

            // Municipio San Joaquín (90)
            ['nombre' => 'San Joaquín', 'municipio_id' => 90], // San Joaquín

            // Municipio Valencia (91)
            ['nombre' => 'Valencia', 'municipio_id' => 91], // Valencia


            // Municipio Anzoátegui (92)
            ['nombre' => 'Cojedes', 'municipio_id' => 92],
            ['nombre' => 'Juan de Mata Suárez', 'municipio_id' => 92],

            // Municipio Girardot (94)
            ['nombre' => 'El Baúl', 'municipio_id' => 94],
            ['nombre' => 'Sucre', 'municipio_id' => 94],

            // Municipio Ricaurte (97)
            ['nombre' => 'El Amparo', 'municipio_id' => 97],
            ['nombre' => 'Libertad de Cojedes', 'municipio_id' => 97],
            ['nombre' => 'Caño Hondo', 'municipio_id' => 97],

            // Municipio San Carlos (99)
            ['nombre' => 'San Carlos de Austria', 'municipio_id' => 99],
            ['nombre' => 'Manuel Manrique', 'municipio_id' => 99],
            ['nombre' => 'Juan Ángel Bravo', 'municipio_id' => 99],
            ['nombre' => 'Camoruco', 'municipio_id' => 99],
            ['nombre' => 'Mapurite', 'municipio_id' => 99],

            // Municipio Pao de San Juan Bautista (96)
            ['nombre' => 'El Pao', 'municipio_id' => 96],

            // Municipio Lima Blanco (95)
            ['nombre' => 'Macapo', 'municipio_id' => 95],
            ['nombre' => 'La Aguadita', 'municipio_id' => 95],

            // Municipio Tinaco (100)
            ['nombre' => 'José Laurencio Silva', 'municipio_id' => 100],

            // Municipio Rómulo Gallegos (98)
            ['nombre' => 'Las Vegas', 'municipio_id' => 98],


            // Municipio Antonio Díaz (101)
            ['nombre' => 'Curiapo', 'municipio_id' => 101],
            ['nombre' => 'Almirante Luis Brión', 'municipio_id' => 101],
            ['nombre' => 'Manuel Renaud', 'municipio_id' => 101],
            ['nombre' => 'Capure', 'municipio_id' => 101],
            ['nombre' => 'Sierra Imataca', 'municipio_id' => 101],

            // Municipio Casacoima (102)
            ['nombre' => 'Casacoima', 'municipio_id' => 102],

            // Municipio Pedernales (103)
            ['nombre' => 'Pedernales', 'municipio_id' => 103],

            // Municipio Tucupita (104)
            ['nombre' => 'Tucupita', 'municipio_id' => 104],


            // Municipio Libertador (105)
            ['nombre' => '23 de Enero', 'municipio_id' => 105],
            ['nombre' => 'Altagracia', 'municipio_id' => 105],
            ['nombre' => 'Antímano', 'municipio_id' => 105],
            ['nombre' => 'Candelaria', 'municipio_id' => 105],
            ['nombre' => 'Caricuao', 'municipio_id' => 105],
            ['nombre' => 'Catedral', 'municipio_id' => 105],
            ['nombre' => 'Coche', 'municipio_id' => 105],
            ['nombre' => 'El Junquito', 'municipio_id' => 105],
            ['nombre' => 'El Paraíso', 'municipio_id' => 105],
            ['nombre' => 'El Recreo', 'municipio_id' => 105],
            ['nombre' => 'El Valle', 'municipio_id' => 105],
            ['nombre' => 'La Pastora', 'municipio_id' => 105],
            ['nombre' => 'La Vega', 'municipio_id' => 105],
            ['nombre' => 'Macarao', 'municipio_id' => 105],
            ['nombre' => 'San Agustín', 'municipio_id' => 105],
            ['nombre' => 'San Bernardino', 'municipio_id' => 105],
            ['nombre' => 'San José', 'municipio_id' => 105],
            ['nombre' => 'San Juan', 'municipio_id' => 105],
            ['nombre' => 'San Pedro', 'municipio_id' => 105],
            ['nombre' => 'Santa Rosalía', 'municipio_id' => 105],
            ['nombre' => 'Santa Teresa', 'municipio_id' => 105],
            ['nombre' => 'Sucre', 'municipio_id' => 105],

            // Municipio Acosta (106)
            ['nombre' => 'San Juan de los Cayos', 'municipio_id' => 106],
            ['nombre' => 'Capadare', 'municipio_id' => 106],
            ['nombre' => 'La Soledad', 'municipio_id' => 106],
            ['nombre' => 'El Charal', 'municipio_id' => 106],
            ['nombre' => 'Santa Ana', 'municipio_id' => 106],

            // Municipio Bolívar (107)
            ['nombre' => 'San Luis', 'municipio_id' => 107],
            ['nombre' => 'Aracua', 'municipio_id' => 107],
            ['nombre' => 'La Peña', 'municipio_id' => 107],
            ['nombre' => 'Santa Cruz de Bucaral', 'municipio_id' => 107],

            // Municipio Buchivacoa (108)
            ['nombre' => 'Capatárida', 'municipio_id' => 108],
            ['nombre' => 'Guajiro', 'municipio_id' => 108],
            ['nombre' => 'Zazárida', 'municipio_id' => 108],
            ['nombre' => 'Puerto Cumarebo', 'municipio_id' => 108],

            // Municipio Cacique Manaure (109)
            ['nombre' => 'Yaracal', 'municipio_id' => 109],

            // Municipio Carirubana (110)
            ['nombre' => 'Punta Cardón', 'municipio_id' => 110],
            ['nombre' => 'Carirubana', 'municipio_id' => 110],
            ['nombre' => 'Judibana', 'municipio_id' => 110],
            ['nombre' => 'Urbana Norte', 'municipio_id' => 110],

            // Municipio Colina (111)
            ['nombre' => 'La Vela de Coro', 'municipio_id' => 111],
            ['nombre' => 'La Vela Sur', 'municipio_id' => 111],

            // Municipio Dabajuro (112)
            ['nombre' => 'Dabajuro', 'municipio_id' => 112],

            // Municipio Democracia (113)
            ['nombre' => 'Pedregal', 'municipio_id' => 113],

            // Municipio Falcón (114)
            ['nombre' => 'Pueblo Nuevo', 'municipio_id' => 114],
            ['nombre' => 'Adícora', 'municipio_id' => 114],

            // Municipio Federación (115)
            ['nombre' => 'Churuguara', 'municipio_id' => 115],

            // Municipio Jacura (116)
            ['nombre' => 'Jacura', 'municipio_id' => 116],

            // Municipio Los Taques (117)
            ['nombre' => 'Los Taques', 'municipio_id' => 117],
            ['nombre' => 'Judibana', 'municipio_id' => 117],

            // Municipio Mauroa (118)
            ['nombre' => 'Mene de Mauroa', 'municipio_id' => 118],
            ['nombre' => 'San Félix', 'municipio_id' => 118],

            // Municipio Miranda (119)
            ['nombre' => 'Coro', 'municipio_id' => 119],
            ['nombre' => 'San Antonio', 'municipio_id' => 119],
            ['nombre' => 'Guzmán Guillermo', 'municipio_id' => 119],
            ['nombre' => 'Mitare', 'municipio_id' => 119],
            ['nombre' => 'Río Seco', 'municipio_id' => 119],
            ['nombre' => 'Curimagua', 'municipio_id' => 119],

            // Municipio Monseñor Iturriza (120)
            ['nombre' => 'Chichiriviche', 'municipio_id' => 120],
            ['nombre' => 'Boca de Tocuyo', 'municipio_id' => 120],

            // Municipio Palmasola (121)
            ['nombre' => 'Palmasola', 'municipio_id' => 121],

            // Municipio Petit (122)
            ['nombre' => 'Cabure', 'municipio_id' => 122],

            // Municipio Píritu (123)
            ['nombre' => 'Píritu', 'municipio_id' => 123],

            // Municipio San Francisco (124)
            ['nombre' => 'Mirimire', 'municipio_id' => 124],

            // Municipio Silva (125)
            ['nombre' => 'Tucacas', 'municipio_id' => 125],
            ['nombre' => 'Boca de Aroa', 'municipio_id' => 125],

            // Municipio Sucre (126)
            ['nombre' => 'La Cruz de Taratara', 'municipio_id' => 126],

            // Municipio Tocópero (127)
            ['nombre' => 'Tocópero', 'municipio_id' => 127],

            // Municipio Unión (128)
            ['nombre' => 'Santa Cruz de Bucaral', 'municipio_id' => 128],

            // Municipio Urumaco (129)
            ['nombre' => 'Urumaco', 'municipio_id' => 129],

            // Municipio Zamora (130)
            ['nombre' => 'Puerto Cumarebo', 'municipio_id' => 130],

            // Municipio Camaguán (131)
            ['nombre' => 'Camaguán', 'municipio_id' => 131],
            ['nombre' => 'Puerto Miranda', 'municipio_id' => 131],
            ['nombre' => 'Uverito', 'municipio_id' => 131],

            // Municipio Chaguaramas (132)
            ['nombre' => 'Chaguaramas', 'municipio_id' => 132],

            // Municipio El Socorro (133)
            ['nombre' => 'El Socorro', 'municipio_id' => 133],

            // Municipio Francisco de Miranda (134)
            ['nombre' => 'Calabozo', 'municipio_id' => 134],
            ['nombre' => 'El Rastro', 'municipio_id' => 134],
            ['nombre' => 'Guardatinajas', 'municipio_id' => 134],
            ['nombre' => 'Uverito', 'municipio_id' => 134],

            // Municipio José Félix Ribas (135)
            ['nombre' => 'Tucupido', 'municipio_id' => 135],

            // Municipio José Tadeo Monagas (136)
            ['nombre' => 'Altagracia de Orituco', 'municipio_id' => 136],

            // Municipio Juan Germán Roscio (137)
            ['nombre' => 'San Juan de los Morros', 'municipio_id' => 137],

            // Municipio Julián Mellado (138)
            ['nombre' => 'El Sombrero', 'municipio_id' => 138],

            // Municipio Las Mercedes (139)
            ['nombre' => 'Las Mercedes', 'municipio_id' => 139],

            // Municipio Leonardo Infante (140)
            ['nombre' => 'Valle de la Pascua', 'municipio_id' => 140],
            ['nombre' => 'Espino', 'municipio_id' => 140],

            // Municipio Pedro Zaraza (141)
            ['nombre' => 'Zaraza', 'municipio_id' => 141],

            // Municipio Ortiz (142)
            ['nombre' => 'Ortíz', 'municipio_id' => 142],

            // Municipio San Gerónimo de Guayabal (143)
            ['nombre' => 'Guayabal', 'municipio_id' => 143],

            // Municipio San José de Guaribe (144)
            ['nombre' => 'San José de Guaribe', 'municipio_id' => 144],

            // Municipio Santa María de Ipire (145)
            ['nombre' => 'Santa María de Ipire', 'municipio_id' => 145],

            // Municipio Sebastián Francisco de Miranda (146)
            ['nombre' => 'Calabozo', 'municipio_id' => 146],

            // Municipio Andrés Eloy Blanco (147)
            ['nombre' => 'Sanare', 'municipio_id' => 147],
            ['nombre' => 'Pueblo Nuevo', 'municipio_id' => 147],
            ['nombre' => 'Quíbor', 'municipio_id' => 147],

            // Municipio Crespo (148)
            ['nombre' => 'Duaca', 'municipio_id' => 148],

            // Municipio Iribarren (149)
            ['nombre' => 'Catedral', 'municipio_id' => 149],
            ['nombre' => 'Concepción', 'municipio_id' => 149],
            ['nombre' => 'El Cují', 'municipio_id' => 149],
            ['nombre' => 'Juárez', 'municipio_id' => 149],
            ['nombre' => 'Santa Rosa', 'municipio_id' => 149],
            ['nombre' => 'Tamaca', 'municipio_id' => 149],
            ['nombre' => 'Unión', 'municipio_id' => 149],

            // Municipio Jiménez (150)
            ['nombre' => 'Quíbor', 'municipio_id' => 150],

            // Municipio Morán (151)
            ['nombre' => 'El Tocuyo', 'municipio_id' => 151],

            // Municipio Palavecino (152)
            ['nombre' => 'Cabudare', 'municipio_id' => 152],

            // Municipio Simón Planas (153)
            ['nombre' => 'Sarare', 'municipio_id' => 153],

            // Municipio Torres (154)
            ['nombre' => 'Carora', 'municipio_id' => 154],

            // Municipio Urdaneta (155)
            ['nombre' => 'Siquisique', 'municipio_id' => 155],

            // Municipio Alberto Adriani (156)
            ['nombre' => 'El Vigía', 'municipio_id' => 156],

            // Municipio Andrés Bello (157)
            ['nombre' => 'La Azulita', 'municipio_id' => 157],

            // Municipio Antonio Pinto Salinas (158)
            ['nombre' => 'Santa Cruz de Mora', 'municipio_id' => 158],

            // Municipio Aricagua (159)
            ['nombre' => 'Aricagua', 'municipio_id' => 159],

            // Municipio Arzobispo Chacón (160)
            ['nombre' => 'Canaguá', 'municipio_id' => 160],

            // Municipio Campo Elías (161)
            ['nombre' => 'Ejido', 'municipio_id' => 161],

            // Municipio Caracciolo Parra Olmedo (162)
            ['nombre' => 'Tucaní', 'municipio_id' => 162],

            // Municipio Cardenal Quintero (163)
            ['nombre' => 'Santo Domingo', 'municipio_id' => 163],

            // Municipio Guaraque (164)
            ['nombre' => 'Guaraque', 'municipio_id' => 164],

            // Municipio Julio César Salas (165)
            ['nombre' => 'Arapuey', 'municipio_id' => 165],

            // Municipio Justo Briceño (166)
            ['nombre' => 'Torondoy', 'municipio_id' => 166],

            // Municipio Libertador (167)
            ['nombre' => 'Mérida', 'municipio_id' => 167],

            // Municipio Miranda (168)
            ['nombre' => 'Timotes', 'municipio_id' => 168],

            // Municipio Obispo Ramos de Lora (169)
            ['nombre' => 'Santa Elena de Arenales', 'municipio_id' => 169],

            // Municipio Padre Noguera (170)
            ['nombre' => 'Santa María de Caparo', 'municipio_id' => 170],

            // Municipio Pueblo Llano (171)
            ['nombre' => 'Pueblo Llano', 'municipio_id' => 171],

            // Municipio Rangel (172)
            ['nombre' => 'Mucuchíes', 'municipio_id' => 172],

            // Municipio Rivas Dávila (173)
            ['nombre' => 'Bailadores', 'municipio_id' => 173],

            // Municipio Santos Marquina (174)
            ['nombre' => 'Tabay', 'municipio_id' => 174],

            // Municipio Sucre (175)
            ['nombre' => 'Lagunillas', 'municipio_id' => 175],

            // Municipio Tovar (176)
            ['nombre' => 'Tovar', 'municipio_id' => 176],

            // Municipio Tulio Febres Cordero (177)
            ['nombre' => 'Nueva Bolivia', 'municipio_id' => 177],

            // Municipio Zea (178)
            ['nombre' => 'Zea', 'municipio_id' => 178],



            // Municipio Acevedo (179)
            ['nombre' => 'Caucagua', 'municipio_id' => 179],

            // Municipio Andrés Bello (180)
            ['nombre' => 'San José de Barlovento', 'municipio_id' => 180],

            // Municipio Baruta (181)
            ['nombre' => 'Baruta', 'municipio_id' => 181],

            // Municipio Brión (182)
            ['nombre' => 'Higuerote', 'municipio_id' => 182],

            // Municipio Buroz (183)
            ['nombre' => 'Mamporal', 'municipio_id' => 183],

            // Municipio Carrizal (184)
            ['nombre' => 'Carrizal', 'municipio_id' => 184],

            // Municipio Chacao (185)
            ['nombre' => 'Chacao', 'municipio_id' => 185],

            // Municipio Cristóbal Rojas (186)
            ['nombre' => 'Charallave', 'municipio_id' => 186],

            // Municipio El Hatillo (187)
            ['nombre' => 'El Hatillo', 'municipio_id' => 187],

            // Municipio Guaicaipuro (188)
            ['nombre' => 'Los Teques', 'municipio_id' => 188],

            // Municipio Independencia (189)
            ['nombre' => 'Santa Teresa del Tuy', 'municipio_id' => 189],

            // Municipio Lander (190)
            ['nombre' => 'Ocumare del Tuy', 'municipio_id' => 190],

            // Municipio Los Salias (191)
            ['nombre' => 'San Antonio de los Altos', 'municipio_id' => 191],

            // Municipio Páez (192)
            ['nombre' => 'Rio Chico', 'municipio_id' => 192],

            // Municipio Paz Castillo (193)
            ['nombre' => 'Santa Lucía', 'municipio_id' => 193],

            // Municipio Pedro Gual (194)
            ['nombre' => 'Cúpira', 'municipio_id' => 194],

            // Municipio Plaza (195)
            ['nombre' => 'Guarenas', 'municipio_id' => 195],

            // Municipio Simón Bolívar (196)
            ['nombre' => 'San Francisco de Yare', 'municipio_id' => 196],

            // Municipio Sucre (197)
            ['nombre' => 'Petare', 'municipio_id' => 197],

            // Municipio Urdaneta (198)
            ['nombre' => 'Cúa', 'municipio_id' => 198],

            // Municipio Zamora (199)
            ['nombre' => 'Guatire', 'municipio_id' => 199],

            // Municipio Acosta (200)
            ['nombre' => 'San Antonio de Capayacuar', 'municipio_id' => 200],
            ['nombre' => 'San Francisco de Guayapero', 'municipio_id' => 200],

            // Municipio Aguasay (201)
            ['nombre' => 'Aguasay', 'municipio_id' => 201],

            // Municipio Bolívar (202)
            ['nombre' => 'Caripito', 'municipio_id' => 202],

            // Municipio Caripe (203)
            ['nombre' => 'Caripe', 'municipio_id' => 203],

            // Municipio Cedeño (204)
            ['nombre' => 'Areo', 'municipio_id' => 204],
            ['nombre' => 'Caicara', 'municipio_id' => 204],

            // Municipio Ezequiel Zamora (205)
            ['nombre' => 'Punta de Mata', 'municipio_id' => 205],
            ['nombre' => 'El Tejero', 'municipio_id' => 205],

            // Municipio Libertador (206)
            ['nombre' => 'Temblador', 'municipio_id' => 206],

            // Municipio Maturín (207)
            ['nombre' => 'San Simón', 'municipio_id' => 207],

            // Municipio Piar (208)
            ['nombre' => 'Aragua de Maturín', 'municipio_id' => 208],

            // Municipio Punceres (209)
            ['nombre' => 'Quiriquire', 'municipio_id' => 209],

            // Municipio Santa Bárbara (210)
            ['nombre' => 'Santa Bárbara', 'municipio_id' => 210],

            // Municipio Sotillo (211)
            ['nombre' => 'Barrancas del Orinoco', 'municipio_id' => 211],

            // Municipio Uracoa (212)
            ['nombre' => 'Uracoa', 'municipio_id' => 212],
            // Municipio Antolín del Campo (213)
            ['nombre' => 'Antolín del Campo', 'municipio_id' => 213],

            // Municipio Arismendi (214)
            ['nombre' => 'Arismendi', 'municipio_id' => 214],

            // Municipio Díaz (215)
            ['nombre' => 'San Juan Bautista', 'municipio_id' => 215],
            ['nombre' => 'Zabala', 'municipio_id' => 215],

            // Municipio García (216)
            ['nombre' => 'García', 'municipio_id' => 216],
            ['nombre' => 'Francisco Fajardo', 'municipio_id' => 216],

            // Municipio Gómez (217)
            ['nombre' => 'Bolívar', 'municipio_id' => 217],
            ['nombre' => 'Guevara', 'municipio_id' => 217],
            ['nombre' => 'Matasiete', 'municipio_id' => 217],
            ['nombre' => 'Santa Ana', 'municipio_id' => 217],
            ['nombre' => 'Sucre', 'municipio_id' => 217],

            // Municipio Maneiro (218)
            ['nombre' => 'Aguirre', 'municipio_id' => 218],
            ['nombre' => 'Maneiro', 'municipio_id' => 218],

            // Municipio Marcano (219)
            ['nombre' => 'Adrián', 'municipio_id' => 219],
            ['nombre' => 'Juan Griego', 'municipio_id' => 219],

            // Municipio Mariño (220)
            ['nombre' => 'Mariño', 'municipio_id' => 220],

            // Municipio Península de Macanao (221)
            ['nombre' => 'San Francisco de Macanao', 'municipio_id' => 221],
            ['nombre' => 'Boca de Río', 'municipio_id' => 221],

            // Municipio Tubores (222)
            ['nombre' => 'Tubores', 'municipio_id' => 222],
            ['nombre' => 'Los Barales', 'municipio_id' => 222],

            // Municipio Villalba (223)
            ['nombre' => 'Vicente Fuentes', 'municipio_id' => 223],
            ['nombre' => 'Villalba', 'municipio_id' => 223],


            // Municipio Agua Blanca (224)
            ['nombre' => 'Agua Blanca', 'municipio_id' => 224],

            // Municipio Araure (225)
            ['nombre' => 'Araure', 'municipio_id' => 225],
            ['nombre' => 'Río Acarigua', 'municipio_id' => 225],

            // Municipio Esteller (226)
            ['nombre' => 'Píritu', 'municipio_id' => 226],
            ['nombre' => 'Uveral', 'municipio_id' => 226],

            // Municipio Guanare (227)
            ['nombre' => 'Cordova', 'municipio_id' => 227],
            ['nombre' => 'Guanare', 'municipio_id' => 227],
            ['nombre' => 'San José de la Montaña', 'municipio_id' => 227],
            ['nombre' => 'San Juan de Guanaguanare', 'municipio_id' => 227],
            ['nombre' => 'Virgen de Coromoto', 'municipio_id' => 227],

            // Municipio Guanarito (228)
            ['nombre' => 'Guanarito', 'municipio_id' => 228],
            ['nombre' => 'Trinidad de la Capilla', 'municipio_id' => 228],
            ['nombre' => 'Divina Pastora', 'municipio_id' => 228],

            // Municipio Monseñor José Vicente de Unda (229)
            ['nombre' => 'Chabasquén', 'municipio_id' => 229],
            ['nombre' => 'Peña Blanca', 'municipio_id' => 229],

            // Municipio Ospino (230)
            ['nombre' => 'Aparición', 'municipio_id' => 230],
            ['nombre' => 'La Estación', 'municipio_id' => 230],
            ['nombre' => 'Ospino', 'municipio_id' => 230],

            // Municipio Páez (231)
            ['nombre' => 'Acarigua', 'municipio_id' => 231],
            ['nombre' => 'Payara', 'municipio_id' => 231],
            ['nombre' => 'Pimpinela', 'municipio_id' => 231],
            ['nombre' => 'Ramón Peraza', 'municipio_id' => 231],

            // Municipio Papelón (232)
            ['nombre' => 'Caño Delgadito', 'municipio_id' => 232],
            ['nombre' => 'Papelón', 'municipio_id' => 232],

            // Municipio San Genaro de Boconoíto (233)
            ['nombre' => 'Antolín Tovar Aquino', 'municipio_id' => 233],
            ['nombre' => 'Boconoíto', 'municipio_id' => 233],

            // Municipio San Rafael de Onoto (234)
            ['nombre' => 'Santa Fé', 'municipio_id' => 234],
            ['nombre' => 'San Rafael de Onoto', 'municipio_id' => 234],
            ['nombre' => 'Thelmo Morles', 'municipio_id' => 234],

            // Municipio Santa Rosalía (235)
            ['nombre' => 'Florida', 'municipio_id' => 235],
            ['nombre' => 'El Playón', 'municipio_id' => 235],

            // Municipio Sucre (236)
            ['nombre' => 'Biscucuy', 'municipio_id' => 236],
            ['nombre' => 'Concepción', 'municipio_id' => 236],
            ['nombre' => 'San Rafael de Palo Alzado', 'municipio_id' => 236],
            ['nombre' => 'San José de Saguaz', 'municipio_id' => 236],
            ['nombre' => 'Uvencio Antonio Velásquez', 'municipio_id' => 236],
            ['nombre' => 'Villa Rosa', 'municipio_id' => 236],

            // Municipio Turén (237)
            ['nombre' => 'Villa Bruzual', 'municipio_id' => 237],
            ['nombre' => 'Canelones', 'municipio_id' => 237],
            ['nombre' => 'Santa Cruz', 'municipio_id' => 237],
            ['nombre' => 'San Isidro Labrador la Colonia', 'municipio_id' => 237],

            // Municipio Andrés Eloy Blanco (238)
            ['nombre' => 'Casanay', 'municipio_id' => 238],

            // Municipio Andrés Mata (239)
            ['nombre' => 'San José de Aerocuar', 'municipio_id' => 239],

            // Municipio Arismendi (240)
            ['nombre' => 'Río Caribe', 'municipio_id' => 240],

            // Municipio Benítez (241)
            ['nombre' => 'El Pilar', 'municipio_id' => 241],

            // Municipio Bermúdez (242)
            ['nombre' => 'Carúpano', 'municipio_id' => 242],

            // Municipio Bolívar (243)
            ['nombre' => 'Marigüitar', 'municipio_id' => 243],

            // Municipio Cajigal (244)
            ['nombre' => 'Yaguaraparo', 'municipio_id' => 244],

            // Municipio Cruz Salmerón Acosta (245)
            ['nombre' => 'Araya', 'municipio_id' => 245],

            // Municipio Libertador (246)
            ['nombre' => 'Tunapuy', 'municipio_id' => 246],

            // Municipio Mariño (247)
            ['nombre' => 'Irapa', 'municipio_id' => 247],

            // Municipio Mejía (248)
            ['nombre' => 'San Antonio del Golfo', 'municipio_id' => 248],

            // Municipio Montes (249)
            ['nombre' => 'Cumanacoa', 'municipio_id' => 249],

            // Municipio Ribero (250)
            ['nombre' => 'Cariaco', 'municipio_id' => 250],

            // Municipio Sucre (251)
            ['nombre' => 'Cumaná', 'municipio_id' => 251],

            // Municipio Valdez (252)
            ['nombre' => 'Güiria', 'municipio_id' => 252],


            // Municipio Andrés Bello (253)
            ['nombre' => 'La Palmita', 'municipio_id' => 253],

            // Municipio Antonio Rómulo Costa (254)
            ['nombre' => 'Las Mesas', 'municipio_id' => 254],

            // Municipio Ayacucho (255)
            ['nombre' => 'Colón', 'municipio_id' => 255],

            // Municipio Bolívar (256)
            ['nombre' => 'San Antonio del Táchira', 'municipio_id' => 256],

            // Municipio Cárdenas (257)
            ['nombre' => 'Táriba', 'municipio_id' => 257],

            // Municipio Córdoba (258)
            ['nombre' => 'Santa Ana del Táchira', 'municipio_id' => 258],

            // Municipio Fernández Feo (259)
            ['nombre' => 'El Piñal', 'municipio_id' => 259],

            // Municipio Francisco de Miranda (260)
            ['nombre' => 'San José de Bolívar', 'municipio_id' => 260],

            // Municipio García de Hevia (261)
            ['nombre' => 'La Fría', 'municipio_id' => 261],

            // Municipio Guásimos (262)
            ['nombre' => 'Palmira', 'municipio_id' => 262],

            // Municipio Independencia (263)
            ['nombre' => 'Capacho Nuevo', 'municipio_id' => 263],

            // Municipio Jáuregui (264)
            ['nombre' => 'La Grita', 'municipio_id' => 264],

            // Municipio José María Vargas (265)
            ['nombre' => 'El Cobre', 'municipio_id' => 265],

            // Municipio Junín (266)
            ['nombre' => 'Rubio', 'municipio_id' => 266],

            // Municipio Libertad (267)
            ['nombre' => 'Capacho Viejo', 'municipio_id' => 267],

            // Municipio Libertador (268)
            ['nombre' => 'Abejales', 'municipio_id' => 268],

            // Municipio Lobatera (269)
            ['nombre' => 'Lobatera', 'municipio_id' => 269],

            // Municipio Michelena (270)
            ['nombre' => 'Michelena', 'municipio_id' => 270],

            // Municipio Panamericano (271)
            ['nombre' => 'Coloncito', 'municipio_id' => 271],

            // Municipio Pedro María Ureña (272)
            ['nombre' => 'Ureña', 'municipio_id' => 272],

            // Municipio Rafael Urdaneta (273)
            ['nombre' => 'Delicias', 'municipio_id' => 273],

            // Municipio Samuel Darío Maldonado (274)
            ['nombre' => 'La Tendida', 'municipio_id' => 274],

            // Municipio San Cristóbal (275)
            ['nombre' => 'San Cristóbal', 'municipio_id' => 275],

            // Municipio Seboruco (276)
            ['nombre' => 'Seboruco', 'municipio_id' => 276],

            // Municipio Simón Rodríguez (277)
            ['nombre' => 'San Simón', 'municipio_id' => 277],

            // Municipio Sucre (278)
            ['nombre' => 'Queniquea', 'municipio_id' => 278],

            // Municipio Torbes (279)
            ['nombre' => 'San Josecito', 'municipio_id' => 279],

            // Municipio Uribante (280)
            ['nombre' => 'Pregonero', 'municipio_id' => 280],

            // Municipio San Judas Tadeo (281)
            ['nombre' => 'Umuquena', 'municipio_id' => 281],


            // Municipio Andrés Bello (282)
            ['nombre' => 'Santa Isabel', 'municipio_id' => 282],

            // Municipio Boconó (283)
            ['nombre' => 'Boconó', 'municipio_id' => 283],

            // Municipio Bolívar (284)
            ['nombre' => 'Sabana Grande', 'municipio_id' => 284],

            // Municipio Candelaria (285)
            ['nombre' => 'Chejendé', 'municipio_id' => 285],

            // Municipio Carache (286)
            ['nombre' => 'Carache', 'municipio_id' => 286],

            // Municipio Escuque (287)
            ['nombre' => 'Escuque', 'municipio_id' => 287],

            // Municipio José Felipe Márquez Cañizales (288)
            ['nombre' => 'El Paradero', 'municipio_id' => 288],

            // Municipio Juan Vicente Campo Elías (289)
            ['nombre' => 'Campo Elías', 'municipio_id' => 289],

            // Municipio La Ceiba (290)
            ['nombre' => 'La Ceiba', 'municipio_id' => 290],

            // Municipio Miranda (291)
            ['nombre' => 'El Dividive', 'municipio_id' => 291],

            // Municipio Monte Carmelo (292)
            ['nombre' => 'Monte Carmelo', 'municipio_id' => 292],

            // Municipio Motatán (293)
            ['nombre' => 'Motatán', 'municipio_id' => 293],

            // Municipio Pampán (294)
            ['nombre' => 'Pampán', 'municipio_id' => 294],

            // Municipio Pampanito (295)
            ['nombre' => 'Pampanito', 'municipio_id' => 295],

            // Municipio Rafael Rangel (296)
            ['nombre' => 'Betijoque', 'municipio_id' => 296],

            // Municipio San Rafael de Carvajal (297)
            ['nombre' => 'Carvajal', 'municipio_id' => 297],

            // Municipio Sucre (298)
            ['nombre' => 'Sabana de Mendoza', 'municipio_id' => 298],

            // Municipio Trujillo (299)
            ['nombre' => 'Trujillo', 'municipio_id' => 299],

            // Municipio Urdaneta (300)
            ['nombre' => 'La Quebrada', 'municipio_id' => 300],

            // Municipio Valera (301)
            ['nombre' => 'Valera', 'municipio_id' => 301],

            // Municipio Vargas (302)
            ['nombre' => 'La Guaira', 'municipio_id' => 302],
            ['nombre' => 'Maiquetía', 'municipio_id' => 302],
            ['nombre' => 'Macuto', 'municipio_id' => 302],
            ['nombre' => 'Naiguatá', 'municipio_id' => 302],
            ['nombre' => 'Caraballeda', 'municipio_id' => 302],
            ['nombre' => 'Carayaca', 'municipio_id' => 302],
            ['nombre' => 'El Junko', 'municipio_id' => 302],
            ['nombre' => 'La Sabana', 'municipio_id' => 302],
            ['nombre' => 'Catia La Mar', 'municipio_id' => 302],
            ['nombre' => 'Caruao', 'municipio_id' => 302],
            ['nombre' => 'Caricuao', 'municipio_id' => 302],


            // Municipio Arístides Bastidas (303)
            ['nombre' => 'San Pablo', 'municipio_id' => 303],

            // Municipio Bolívar (304)
            ['nombre' => 'Aroa', 'municipio_id' => 304],

            // Municipio Bruzual (305)
            ['nombre' => 'Chivacoa', 'municipio_id' => 305],

            // Municipio Cocorote (306)
            ['nombre' => 'Cocorote', 'municipio_id' => 306],

            // Municipio Independencia (307)
            ['nombre' => 'Independencia', 'municipio_id' => 307],

            // Municipio José Antonio Páez (308)
            ['nombre' => 'Sabana de Parra', 'municipio_id' => 308],

            // Municipio La Trinidad (309)
            ['nombre' => 'Boraure', 'municipio_id' => 309],

            // Municipio Manuel Monge (310)
            ['nombre' => 'Yumare', 'municipio_id' => 310],

            // Municipio Nirgua (311)
            ['nombre' => 'Nirgua', 'municipio_id' => 311],

            // Municipio Peña (312)
            ['nombre' => 'Yaritagua', 'municipio_id' => 312],

            // Municipio San Felipe (313)
            ['nombre' => 'San Felipe', 'municipio_id' => 313],

            // Municipio Sucre (314)
            ['nombre' => 'Guama', 'municipio_id' => 314],

            // Municipio Urachiche (315)
            ['nombre' => 'Urachiche', 'municipio_id' => 315],

            // Municipio Veroes (316)
            ['nombre' => 'Farriar', 'municipio_id' => 316],

            // Municipio Almirante Padilla (317)
            ['nombre' => 'Isla de Toas', 'municipio_id' => 317],

            // Municipio Baralt (318)
            ['nombre' => 'San Timoteo', 'municipio_id' => 318],

            // Municipio Cabimas (319)
            ['nombre' => 'Cabimas', 'municipio_id' => 319],

            // Municipio Catatumbo (320)
            ['nombre' => 'Encontrados', 'municipio_id' => 320],

            // Municipio Colón (321)
            ['nombre' => 'San Carlos del Zulia', 'municipio_id' => 321],

            // Municipio Francisco Javier Pulgar (322)
            ['nombre' => 'Pueblo Nuevo El Chivo', 'municipio_id' => 322],

            // Municipio Guajira (323)
            ['nombre' => 'Sinamaica', 'municipio_id' => 323],

            // Municipio Jesús Enrique Lossada (324)
            ['nombre' => 'La Concepción', 'municipio_id' => 324],

            // Municipio Jesús María Semprún (325)
            ['nombre' => 'Casigua El Cubo', 'municipio_id' => 325],

            // Municipio La Cañada de Urdaneta (326)
            ['nombre' => 'Concepción', 'municipio_id' => 326],

            // Municipio Lagunillas (327)
            ['nombre' => 'Ciudad Ojeda', 'municipio_id' => 327],

            // Municipio Machiques de Perijá (328)
            ['nombre' => 'Machiques', 'municipio_id' => 328],

            // Municipio Mara (329)
            ['nombre' => 'San Rafael del Moján', 'municipio_id' => 329],

            // Municipio Maracaibo (330)
            ['nombre' => 'Maracaibo', 'municipio_id' => 330],

            // Municipio Miranda (331)
            ['nombre' => 'Los Puertos de Altagracia', 'municipio_id' => 331],

            // Municipio Rosario de Perijá (332)
            ['nombre' => 'La Villa del Rosario', 'municipio_id' => 332],

            // Municipio San Francisco (333)
            ['nombre' => 'San Francisco', 'municipio_id' => 333],

            // Municipio Santa Rita (334)
            ['nombre' => 'Santa Rita', 'municipio_id' => 334],

            // Municipio Simón Bolívar (335)
            ['nombre' => 'Tía Juana', 'municipio_id' => 335],

            // Municipio Sucre (336)
            ['nombre' => 'Bobures', 'municipio_id' => 336],

            // Municipio Valmore Rodríguez (337)
            ['nombre' => 'Bachaquero', 'municipio_id' => 337]
        ];

        Parroquia::insert($parroquias);
    }
}
