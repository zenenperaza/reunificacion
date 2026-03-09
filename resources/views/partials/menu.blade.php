<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu" style="z-index: 10">
    <div class="h-100" data-simplebar>
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title"> </li>
                @role('Administrador')
                    @can('Dashboard')
                        <li>
                            <a href="{{ route('dashboard') }}">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                    @endcan
                @endrole

                @role('Usuario')
                    @can('dashboard-user')
                        <li>
                            <a href="{{ route('dashboard.user') }}">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span> Dashboard</span>
                            </a>
                        </li>
                    @endcan
                @endrole


                <li class="menu-title mt-2">Gestiones</li>

                @can('Gestion casos')
                    <li>
                        <a href="#casos" data-bs-toggle="collapse">
                            <i class="mdi mdi-file-multiple-outline"></i>
                            <span> Casos </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="casos">
                            <ul class="nav-second-level">
                                @can('ver casos')
                                    <li><a href="{{ route('casos.index') }}">
                                            <i class="fas fa-tachometer-alt"></i>
                                            <span>Gestionar Casos</span></a></li>
                                @endcan
                                @can('ver casos eliminados')
                                    <li>
                                        <a href="{{ route('casos.eliminados') }}">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                            <span>Casos Eliminados</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('ver informes')
                                    <li>
                                        <a href="{{ route('casos.informes') }}">
                                            <i class="mdi mdi-clipboard-text-outline me-1"></i> Informes
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('Gestion usuarios')
                    <li class="menu-title mt-2">Usuarios</li>

                    <li>
                        <a href="#usuarios" data-bs-toggle="collapse">
                            <i class="mdi mdi-account-outline"></i>
                            <span> Usuarios </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="usuarios">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('users.index') }}">
                                        <i class="fas fa-user-shield"></i>
                                        <span> Usuarios </span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

           @if (
    auth()->user()->can('Gestion roles') ||
    auth()->user()->can('Gestion permisos') ||
    auth()->user()->can('Gestion configuracion')
)
<li>
    <a href="#configuracion" data-bs-toggle="collapse">
        <i class="mdi mdi-book-open-page-variant-outline"></i>
        <span> Configuración </span>
        <span class="menu-arrow"></span>
    </a>

    <div class="collapse" id="configuracion">
        <ul class="nav-second-level">

            {{-- ✅ NIVEL 2: PROYECTOS (PADRE) --}}
            @can('Gestion proyectos')
                <li>
                    <a href="#menu-proyectos" data-bs-toggle="collapse" class="d-flex justify-content-between align-items-center">
                        <span>
                            <i class="mdi mdi-folder-multiple-outline"></i>
                            Proyectos
                        </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <div class="collapse" id="menu-proyectos">
                        <ul class="nav-third-level">

                            {{-- Listado de Proyectos --}}
                            <li>
                                <a href="{{ route('proyectos.index') }}">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                    <span> Gestión de Proyectos </span>
                                </a>
                            </li>

                            {{-- ✅ MAESTROS (nivel 3, opcional) --}}
                            @can('Gestion indicadores')
                                <li>
                                    <a href="{{ route('indicadores.index') }}">
                                        <i class="fas fa-chart-line"></i>
                                        <span> Indicadores </span>
                                    </a>
                                </li>
                            @endcan

                            @can('Gestion actividades')
                                <li>
                                    <a href="{{ route('actividades.index') }}">
                                        <i class="mdi mdi-format-list-checks"></i>
                                        <span> Actividades </span>
                                    </a>
                                </li>
                            @endcan

                            @can('Gestion servicios')
                                <li>
                                    <a href="{{ route('servicios.index') }}">
                                        <i class="fas fa-concierge-bell"></i>
                                        <span> Servicios </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan

            {{-- ✅ NIVEL 2: DONANTES (si quieres que sea independiente de Proyectos, déjalo aquí) --}}
            @can('Gestion donantes')
                <li>
                    <a href="{{ route('donantes.index') }}">
                        <i class="fas fa-hands-helping"></i>
                        <span> Donantes </span>
                    </a>
                </li>
            @endcan

            {{-- ✅ NIVEL 2: SEGURIDAD --}}
            @if(auth()->user()->can('Gestion permisos') || auth()->user()->can('Gestion roles'))
                <li>
                    <a href="#menu-seguridad" data-bs-toggle="collapse">
                        <i class="mdi mdi-shield-account-outline"></i>
                        <span> Seguridad </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <div class="collapse" id="menu-seguridad">
                        <ul class="nav-third-level">
                            @can('Gestion permisos')
                                <li>
                                    <a href="{{ route('permission.index') }}">
                                        <i class="fas fa-list-ul"></i>
                                        <span> Permisos </span>
                                    </a>
                                </li>
                            @endcan

                            @can('Gestion roles')
                                <li>
                                    <a href="{{ route('role.index') }}">
                                        <i class="mdi mdi-account-key-outline"></i>
                                        <span> Roles </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif

            {{-- ✅ Otros --}}
            @can('ver coordinaciones')
                <li>
                    <a href="{{ route('familias.index') }}">
                        <i class="mdi mdi-account-group-outline"></i>
                        <span> Coordinaciones </span>
                    </a>
                </li>
            @endcan

            @can('configuracion')
                <li>
                    <a href="{{ route('configuraciones.index') }}">
                        <i class="fe-settings noti-icon" style="font-size: medium;"></i>
                        <span> Configuraciones </span>
                    </a>
                </li>
            @endcan

            @can('ver bitacora')
                <li>
                    <a href="{{ route('bitacora.index') }}">
                        <i class="mdi mdi-history"></i>
                        <span> Bitácora </span>
                    </a>
                </li>
            @endcan

        </ul>
    </div>
</li>
@endif

            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->
