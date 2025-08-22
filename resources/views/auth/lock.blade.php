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
    <style>
        body {
            background: #f4f4f9;
        }

        .lockscreen-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lockscreen-box {
            display: flex;
            flex-direction: row;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
        }

        .lockscreen-left {
            background: #f0f2f5;
            padding: 40px 30px;
            flex: 1;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .lockscreen-right {
            padding: 40px 30px;
            flex: 1;
        }

        .lockscreen-left img {
            max-height: 350px;
            margin-bottom: 20px;
        }

        .lockscreen-left p {
            font-size: 16px;
            color: #555;
        }

        .form-label {
            font-weight: 600;
        }

        .img-thumbnail {
            border: 3px solid #ccc;
        }

        @media (max-width: 768px) {
            .lockscreen-box {
                flex-direction: column;
            }

            .lockscreen-left, .lockscreen-right {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="lockscreen-container">
        <div class="lockscreen-box">

            <!-- Lado izquierdo -->
            <div class="lockscreen-left">
                <img src="{{ configuracion('imagen_portada') 
            ? Storage::url(configuracion('imagen_portada')) 
            : asset('assets/images/imagen_rlf.png') }}" alt="Logo">
                <p>{{ configuracion('nombre_sistema') ?? 'Caminos seguros' }}</p>
            </div>

            <!-- Lado derecho -->
            <div class="lockscreen-right">
                @php $user = Auth::user(); @endphp

                <div class="text-center mb-4">
                    <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/images/small/default.png') }}"
                        class="rounded-circle img-thumbnail" width="88">
                    <h4 class="mt-3">Hola, {{ $user->name }}</h4>
                    <p class="text-muted">Ingresa tu contraseña para continuar</p>
                </div>

                <form method="POST" action="{{ url('/unlock') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Desbloquear</button>
                </form>

                <div class="mt-4 text-center">
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

    <!-- Scripts -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Forzar recarga si vuelve con el botón atrás
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        });

        // Logout automático después de 3 minutos
        setTimeout(function() {
            document.getElementById('logout-form').submit();
        }, 10 * 60 * 1000);
    </script>
</body>

</html>
