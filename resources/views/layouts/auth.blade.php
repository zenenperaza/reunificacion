<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Bloqueo de sesión')</title>
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" />
</head>
<body class="loading authentication-bg authentication-bg-pattern">

    @yield('content')

    <script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Autenticación')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Estilos base de Admininto -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="authentication-bg authentication-bg-pattern">

    @yield('content')

    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>
</html>
