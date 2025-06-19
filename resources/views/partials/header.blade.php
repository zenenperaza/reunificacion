@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp
<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-end mb-0">

        <li class="d-none d-lg-block">
            <form class="app-search">
                <div class="app-search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar..." id="top-search">
                        <button class="btn input-group-text" type="submit">
                            <i class="fe-search"></i>
                        </button>
                    </div>
                    <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                        <div class="dropdown-header noti-title">
                            <h5 class="text-overflow mb-2">22 resultados encontrados</h5>
                        </div>

                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-home me-1"></i>
                            <span>Informe Analítico</span>
                        </a>

                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-aperture me-1"></i>
                            <span>¿Cómo puedo ayudarte?</span>
                        </a>

                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings me-1"></i>
                            <span>Configuración del perfil</span>
                        </a>

                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow mb-2 text-uppercase">Usuarios</h6>
                        </div>

                        <div class="notification-list">
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="d-flex align-items-start">
                                    <img class="d-flex me-2 rounded-circle" src="{{ asset('assets/images/users/user-2.jpg') }}" alt="Usuario" height="32">
                                    <div class="w-100">
                                        <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                        <span class="font-12 mb-0">Diseñador UI</span>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="d-flex align-items-start">
                                    <img class="d-flex me-2 rounded-circle" src="{{ asset('assets/images/users/user-5.jpg') }}" alt="Usuario" height="32">
                                    <div class="w-100">
                                        <h5 class="m-0 font-14">Jacob Deo</h5>
                                        <span class="font-12 mb-0">Desarrollador</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </form>
        </li>

        <li class="dropdown d-inline-block d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#">
                <i class="fe-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Buscar..." aria-label="Buscar">
                </form>
            </div>
        </li>

        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#">
                <i class="fe-bell noti-icon"></i>
                <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                <div class="dropdown-item noti-title">
                    <h5 class="m-0">
                        <span class="float-end">
                            <a href="#" class="text-dark">
                                <small>Limpiar Todo</small>
                            </a>
                        </span>Notificaciones
                    </h5>
                </div>

                <div class="noti-scroll" data-simplebar>
                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                        <div class="notify-icon">
                            <img src="{{ asset('assets/images/users/user-1.jpg') }}" class="img-fluid rounded-circle" alt="" />
                        </div>
                        <p class="notify-details">Cristina Pride</p>
                        <p class="text-muted mb-0 user-msg">
                            <small>Hola, ¿cómo estás? ¿Qué tal nuestra próxima reunión?</small>
                        </p>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-primary">
                            <i class="mdi mdi-comment-account-outline"></i>
                        </div>
                        <p class="notify-details">Caleb Flakelar comentó en Admin
                            <small class="text-muted">Hace 1 min</small>
                        </p>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon">
                            <img src="{{ asset('assets/images/users/user-4.jpg') }}" class="img-fluid rounded-circle" alt="" />
                        </div>
                        <p class="notify-details">Karen Robinson</p>
                        <p class="text-muted mb-0 user-msg">
                            <small>¡Wow! Este panel se ve genial y tiene un diseño increíble</small>
                        </p>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-warning">
                            <i class="mdi mdi-account-plus"></i>
                        </div>
                        <p class="notify-details">Nuevo usuario registrado.
                            <small class="text-muted">Hace 5 horas</small>
                        </p>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-info">
                            <i class="mdi mdi-comment-account-outline"></i>
                        </div>
                        <p class="notify-details">Caleb Flakelar comentó en Admin
                            <small class="text-muted">Hace 4 días</small>
                        </p>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-secondary">
                            <i class="mdi mdi-heart"></i>
                        </div>
                        <p class="notify-details">A Carlos Crouch le gustó
                            <b>Admin</b>
                            <small class="text-muted">Hace 13 días</small>
                        </p>
                    </a>
                </div>

                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                    Ver todo
                    <i class="fe-arrow-right"></i>
                </a>

            </div>
        </li>

      <li class="dropdown notification-list topbar-dropdown">
    <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#">
       <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/images/small/default.png') }}" alt="user-image" class="rounded-circle" height="32">

        <span class="pro-user-name ms-1">
            {{ $user->name ?? 'Invitado' }} <i class="mdi mdi-chevron-down"></i>
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-end profile-dropdown">
        <div class="dropdown-header noti-title">
            <h6 class="text-overflow m-0">¡Bienvenido, {{ $user->role->nombre ?? 'Sin rol' }}!</h6>
        </div>

        <a href="{{ route('profile.edit') }}" class="dropdown-item notify-item">
            <i class="fe-user"></i>
            <span>Mi cuenta</span>
        </a>

        <a href="#" class="dropdown-item notify-item">
            <i class="fe-lock"></i>
            <span>Bloquear pantalla</span>
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
        <a href="" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="75">
            </span>
        </a>
        <a href="" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg mt-2">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" width="80">
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
