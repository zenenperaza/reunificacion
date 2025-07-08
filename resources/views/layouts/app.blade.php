<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', config('app.name', ''))</title>
    <title>{{ configuracion('nombre_sistema') ?? 'Sistema RLF' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Panel administrativo" name="description" />
    <meta content="ASONACOP" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- App CSS -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    @yield('styles')

    @if (session('locked'))
        <script>
            window.location.href = "{{ url('/lock') }}";
        </script>
    @endif
</head>

<body class="loading" data-layout-color="light" data-layout-mode="horizontal" data-layout-size="fluid"
    data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size="default"
    data-sidebar-user="true">

    <!-- Begin page -->
    <div id="wrapper">
        @if (!session('locked'))
            @include('partials.header')
            @include('partials.menu')
        @endif

        <div class="content-page">
            <div class="content">
                @if (auth()->check() && auth()->user()->can('sistema deshabilitado') && configuracion('sistema_deshabilitado') === 'si')
                    <div class="alert alert-warning text-center mb-0 rounded-0" role="alert" style="z-index: 9999;">
                        <strong><i class="mdi mdi-alert-outline"></i> Atención:</strong>
                        El sistema está actualmente <strong>DESHABILITADO</strong>.
                        Solo los usuarios autorizados pueden continuar trabajando.
                    </div>
                @endif

                @yield('content')
            </div>

            @include('partials.footer')
        </div>
    </div>

    @include('partials.rightbar')
    @include('partials.js') <!-- Asegúrate que aquí esté incluido jQuery -->

    @yield('scripts')

    <!-- Sweet Alerts -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

    {{-- ✅ AJAX búsqueda en vivo --}}
    <script>
        $(document).ready(function() {
            $('#top-search').on('keyup', function() {
                let query = $(this).val().trim();

                if (query.length >= 2) {
                    $.ajax({
                        url: "{{ route('busqueda.ajax') }}",
                        data: {
                            term: query
                        },
                        success: function(data) {
                            let dropdown = $('#search-dropdown');
                            let results = $('#search-results');
                            results.empty();

                            if (data.length === 0) {
                                results.append(
                                    '<div class="px-3 py-2 text-muted">Sin resultados</div>'
                                    );
                            } else {
                                data.forEach(function(item) {
                                    results.append(`
    <a href="/casos/${item.id}" class="px-3 py-2 d-block text-dark text-decoration-none border-bottom">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <strong>${item.beneficiario}</strong> - ${item.tipo_atencion}
            </div>
       <small class="text-muted">#${item.numero_caso}</small>

        </div>
    </a>
`);

                                });
                            }

                            dropdown.show();
                        },
                        error: function(xhr) {
                            console.error("Error AJAX:", xhr.responseText);
                        }
                    });
                } else {
                    $('#search-dropdown').hide();
                }
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.app-search-box').length) {
                    $('#search-dropdown').hide();
                }
            });
        });
    </script>

    <script>
        $('#ver-todo-link').on('click', function(e) {
            e.preventDefault();
            $(this).closest('form').submit();
        });
    </script>

    {{-- ✅ Bloqueo por inactividad --}}
    @if (!session('locked') && !request()->is('lock'))
        <script>
            (function() {
                let warningTimer, lockTimer;
                const warningDelay = 4 * 60 * 1000;
                const lockDelay = 5 * 60 * 1000;

                function showWarning() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Inactividad detectada',
                        text: 'Tu sesión se bloqueará en 1 minuto si no realizas ninguna acción.',
                        timer: 59000,
                        showConfirmButton: false,
                    });
                }

                function startTimers() {
                    clearTimeout(warningTimer);
                    clearTimeout(lockTimer);

                    warningTimer = setTimeout(showWarning, warningDelay);
                    lockTimer = setTimeout(() => {
                        window.location.href = "{{ url('/lock') }}";
                    }, lockDelay);
                }

                window.onload = startTimers;
                document.onmousemove = startTimers;
                document.onkeydown = startTimers;
                document.onclick = startTimers;
                document.onscroll = startTimers;
            })();
        </script>
    @endif

</body>

</html>
