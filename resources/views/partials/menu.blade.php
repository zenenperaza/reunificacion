<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
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
                                    <li><a href="{{ route('casos.index') }}">Ver</a></li>
                                @endcan

                                <li><a href="{{ route('profile.edit') }}">Informes</a></li>
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('Gestion usuarios')
                    <li class="menu-title mt-2">Usuarios</li>

                    <li>
                        <a href="#usuarios" data-bs-toggle="collapse">
                            <i class="mdi mdi-account-outline"></i>
                            <span> Usuario </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="usuarios">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('users.index') }}">Usuarios</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                @if (auth()->user()->can('Gestion roles') ||
                        auth()->user()->can('Gestion permisos') ||
                        auth()->user()->can('Gestion configuracion'))
                    <li>
                        <a href="#contacts" data-bs-toggle="collapse">
                            <i class="mdi mdi-book-open-page-variant-outline"></i>
                            <span> Configuración </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="contacts">
                            <ul class="nav-second-level">
                                @can('Gestion roles')
                                    <li><a href="{{ route('role.index') }}">Roles</a></li>
                                @endcan

                                @can('Gestion permisos')
                                    <li><a href="{{ route('permission.index') }}">Permisos</a></li>
                                @endcan

                                @can('Gestion configuracion')
                                    <li>
                                        <a href="{{ route('configuracion.index') }}">
                                            <i class="mdi mdi-cog-outline"></i>
                                            <span> Configuración </span>
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
