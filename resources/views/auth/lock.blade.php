<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <meta charset="utf-8">
    <title>Pantalla de bloqueo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Estilos -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">
</head>

<body class=" authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="text-center">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" height="95" alt="Logo">
                        <p class="text-muted mt-2 mb-4">Sistema de Reunificación</p>
                    </div>

                    <div class="card">
                        <div class="card-body p-4 text-center">
                            @php $user = Auth::user(); @endphp
                            <h4 class="text-uppercase mb-4">Bienvenido de nuevo</h4>
                            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/images/small/default.png') }}"
                                class="rounded-circle img-thumbnail mb-3" width="88">
                            <p class="text-muted">Hola, {{ $user->name }}<br>Ingresa tu contraseña para continuar</p>

                            <form method="POST" action="{{ url('/unlock') }}">
                                @csrf
                                <div class="mb-3 text-start">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary d-block w-100">Desbloquear</button>
                            </form>

                            <div class="mt-3">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="text-muted">
                                    ¿No eres tú? <strong>Cerrar sesión</strong>
                                </a>
                                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                                    @csrf
                                </form>
                          

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Si el usuario usa el botón atrás, forzamos recarga del servidor
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>
    {{-- Logout automático después de 10 minutos en bloqueo --}}
    <script>
        setTimeout(function() {
            document.getElementById('logout-form').submit();
        }, 3 * 60 * 1000); // 10 minutos en milisegundos
    </script>

</body>

</html>
