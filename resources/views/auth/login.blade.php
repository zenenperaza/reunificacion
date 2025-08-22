<x-guest-layout>
    <div class="text-center mb-4">
        <img src="{{ configuracion('logo_sistema')
            ? Storage::url(configuracion('logo_sistema'))
            : asset('assets/images/imagen_rlf.png') }}"
            alt="Logo del sistema" class="mx-auto" style="width: 150px">
    </div>

    @if (session('message'))
        <div class="mb-4 text-sm text-yellow-600 text-center bg-yellow-100 border border-yellow-400 rounded p-2">
            {{ session('message') }}
        </div>
    @endif

    <!-- Estado de la sesión -->
    @if (session('status'))
        <div class="mb-4 text-sm text-green-600 text-center">
            {{ session('status') }}
        </div>
    @endif

    <!-- Errores -->
    @if ($errors->any())
        <div class="mb-4 text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
            <input id="email" name="email" type="email" required autofocus
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                value="{{ old('email') }}">
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input id="password" name="password" type="password" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div class="flex items-center justify-between mb-4 mt-2">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

            <x-primary-button class="ms-3 mx-4">
                {{ __('Iniciar sesión') }}
            </x-primary-button>

        </div>


    </form>


</x-guest-layout>
<script>
    // Previene volver al formulario con botón "Atrás"
    if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
        window.location.href = "{{ route('login') }}";
    }

    // Alternativa más robusta
    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            window.location.href = "{{ route('login') }}";
        }
    });
</script>

