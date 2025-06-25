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
                        <input type="text" class="form-control" name="search" placeholder="Buscar..." id="top-search">
                        <button class="btn input-group-text" type="submit">
                            <i class="fe-search"></i>
                        </button>
                    </div>
                    <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                        <div class="dropdown-header noti-title">
                            <h5 class="text-overflow mb-2">22 resultados encontrados</h5>
                        </div>

                        

                    </div>
                </div>
            </form>
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
                    

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-primary">
                            <i class="mdi mdi-comment-account-outline"></i>
                        </div>
                        <p class="notify-details">Nuevos casos por aprobar
                            <small class="text-muted">Hace 1 min</small>
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
