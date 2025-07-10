@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp
<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-end mb-0">

        <li class="d-none d-lg-block position-relative" style="z-index: 1050;">
            <form class="app-search" action="{{ route('busqueda.resultados') }}" method="GET" autocomplete="off">
                <div class="app-search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Buscar..."
                            id="top-search" autocomplete="off">
                        <button class="btn input-group-text" type="submit">
                            <i class="fe-search"></i>
                        </button>
                    </div>

                    <!-- Dropdown AJAX personalizado -->
                    <div id="search-dropdown" class="dropdown-busqueda"
                        style="display: none; position: absolute; top: 100%; left: 0; right: 0; max-height: 300px; overflow-y: auto; width: 400px;">
                        <div class="dropdown-header px-3 py-2 fw-bold">Resultados encontrados</div>
                        <div id="search-results"></div>
                        <div class="dropdown-footer px-3 py-2 text-center">
                            <a href="#" class="ver-todo-link">Ver todos los resultados</a>
                        </div>
                    </div>

                </div>
            </form>
        </li>






        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#">
                <i class="fe-bell noti-icon"></i>
                @if ($cantidadNotificaciones > 0)
                    <span class="badge bg-danger rounded-circle noti-icon-badge">{{ $cantidadNotificaciones }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                <div class="dropdown-item noti-title">
                    <h5 class="m-0">
                        <span class="float-end"><a href="#" class="text-dark"><small>Limpiar
                                    Todo</small></a></span>
                        Notificaciones
                    </h5>
                </div>

                <div class="noti-scroll" data-simplebar style="max-height: 230px">
                    @forelse ($notificaciones as $caso)
                        <a href="{{ route('casos.show', $caso->id) }}" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning">
                                <i class="mdi mdi-clock-alert-outline"></i>
                            </div>
                            <p class="notify-details">
                                Caso #{{ $caso->numero_caso ?? $caso->id }} en espera
                                <small class="text-muted">{{ $caso->created_at->diffForHumans() }}</small>
                            </p>
                        </a>
                    @empty
                        <div class="dropdown-item text-muted text-center">No hay casos en espera</div>
                    @endforelse
                </div>

                <a href="{{ route('casos.index', ['condicion' => 'En espera']) }}"
                    class="dropdown-item text-center text-primary notify-item notify-all">
                    Ver todos los casos en espera <i class="fe-arrow-right"></i>
                </a>
            </div>
        </li>


        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                href="#">
                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/images/small/default.png') }}"
                    alt="user-image" class="rounded-circle" height="32">

                <span class="pro-user-name ms-1">
                    {{ $user->name ?? 'Invitado' }} <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">
                        ¡Bienvenido, {{ ucfirst($user->getRoleNames()->first() ?? 'Sin rol') }}!
                    </h6>
                </div>


                <a href="{{ route('profile.edit') }}" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>Mi cuenta</span>
                </a>

                <a href="{{ url('/lock') }}" class="dropdown-item notify-item" title="Bloquear pantalla">
                    <i class="mdi mdi-lock-outline"></i> Bloquear
                </a>


                <div class="dropdown-divider"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </li>
        <li class="dropdown notification-list">
            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                <i class="fe-settings noti-icon"></i>
            </a>
        </li>

    </ul>

    <div class="logo-box">
        <a href="{{ url('/dashboard') }}" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{ configuracion('logo_sistema')
                    ? Storage::url(configuracion('logo_sistema'))
                    : asset('assets/images/logo-sm.png') }}"
                    alt="Logo" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{ configuracion('logo_sistema')
                    ? Storage::url(configuracion('logo_sistema'))
                    : asset('assets/images/logo-light.png') }}"
                    alt="Logo" height="75">
            </span>
        </a>

        <a href="{{ url('/dashboard') }}" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="{{ configuracion('logo_sistema')
                    ? Storage::url(configuracion('logo_sistema'))
                    : asset('assets/images/logo-sm.png') }}"
                    alt="Logo" height="22">
            </span>
            <span class="logo-lg mt-2">
                <img src="{{ configuracion('logo_sistema')
                    ? Storage::url(configuracion('logo_sistema'))
                    : asset('assets/images/logo-dark.png') }}"
                    alt="Logo" width="80">
            </span>
        </a>
    </div>


    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>
        <li>
            <h4 class="page-title-main"></h4>
        </li>
    </ul>

    <div class="clearfix"></div>
</div>
<!-- end Topbar -->
