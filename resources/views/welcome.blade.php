@php
    use App\Models\Configuracion;
    $config = Configuracion::first();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $config->nombre_sistema ?? 'PROGRAMA RLF' }}</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fuente -->
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>

<body class="bg-white text-gray-900 font-sans">

<header class="sticky top-0 z-50 bg-white shadow-sm max-w-6xl mx-auto px-4">
    <div class="max-w-6xl mx-auto px-4 py-3 flex flex-wrap justify-between items-center text-sm">
        <span class="font-bold text-lg text-[#00437c]">
            {{ $config->nombre_sistema ?? 'PROGRAMA RLF' }}
        </span>

        @if (Route::has('login'))
            <nav class="flex gap-2 flex-wrap items-center">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="bg-[#00437c] text-white font-semibold px-5 py-2.5 rounded-md hover:bg-[#00355f] transition">
                        Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-[#00437c] text-white font-semibold px-5 py-2.5 rounded-md hover:bg-[#00355f] transition flex items-center gap-1">
                            <i class="fe-log-out"></i>
                            <span>Cerrar sesión</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-[#00437c] text-white font-semibold px-5 py-2.5 rounded-md hover:bg-[#00355f] transition">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-[#00437c] text-white font-semibold px-5 py-2.5 rounded-md hover:bg-[#00355f] transition">
                        Regístrate
                    </a>
                @endauth
            </nav>
        @endif
    </div>
</header>

<main class="max-w-6xl mx-auto px-4 py-12">
    <!-- Sección hero -->
    <section class="flex flex-col lg:flex-row items-center gap-10">
        <!-- Texto -->
        <div class="lg:w-1/2 text-center lg:text-left space-y-6">
          
            <p class="text-lg text-gray-700">
                {!! nl2br(e($config->texto_portada ?? 'CAMINOS SEGUROS es una plataforma digital integral creada por ASONACOP para el registro, monitoreo y seguimiento especializado de casos de niñas, niños y adolescentes (NNA) en situación de movilidad humana, en riesgo de desprotección o en proceso de reunificación familiar.
.')) !!}
            </p>
            <a href="{{ route('login') }}"
                class="inline-block bg-[#00437c] text-white font-semibold px-6 py-3 rounded-md hover:bg-[#00355f] transition">
                Iniciar Sesión / Registrar caso
            </a>
        </div>

        <!-- Imagen -->
        <div class="lg:w-1/2">
            @if ($config->imagen_portada)
                <img src="{{ Storage::url($config->imagen_portada) }}" alt="Imagen portada"
                    class="w-full max-w-md mx-auto lg:mx-0 rounded-xl shadow-md">
            @else
                <img src="{{ asset('assets/images/rlf-landing-hero.png') }}" alt="Imagen por defecto"
                    class="w-full max-w-md mx-auto lg:mx-0 rounded-xl shadow-md">
            @endif
        </div>
    </section>

    <!-- Testimonios -->
    <section class="mt-20 text-center">
        <h2 class="text-2xl font-semibold mb-8">Historias que inspiran</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <blockquote class="bg-gray-100 rounded-md shadow p-6 text-left">
                <p>"Pensamos que nunca volveríamos a ver a nuestro hijo. Gracias al programa, estamos juntos nuevamente."</p>
                <footer class="mt-2 text-sm text-gray-600">– Familia González</footer>
            </blockquote>
            <blockquote class="bg-gray-100 rounded-md shadow p-6 text-left">
                <p>"Me ayudaron a encontrar a regresar a mi pueblo. Es lo más hermoso que me ha pasado."</p>
                <footer class="mt-2 text-sm text-gray-600">– Camila (14 años)</footer>
            </blockquote>
        </div>
    </section>

    <!-- Aliados -->
    <section class="mt-20 text-center">
        <h2 class="text-2xl font-semibold mb-6">Con el apoyo de:</h2>
        <div class="flex flex-wrap justify-center items-center gap-10">
            <img src="{{ asset('assets/images/logos/asonacop.png') }}" alt="ASONACOP" class="h-14 object-contain">
        </div>
    </section>

    <!-- Contacto -->
    <section class="mt-16 text-center">
        <p class="text-lg">
            ¿Tienes preguntas o necesitas ayuda inmediata? <br>
            <a href="https://wa.me/584125627290" target="_blank" class="text-green-600 font-medium hover:underline">
                Contacta con el Monitor vía WhatsApp
            </a>
        </p>
    </section>
</main>

<footer class="text-center text-sm text-gray-500 py-8">
    © {{ date('Y') }} {{ $config->nombre_sistema ?? 'Programa RLF' }} - ASONACOP
</footer>

</body>
</html>
