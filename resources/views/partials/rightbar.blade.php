<!-- Barra lateral derecha -->
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title">
            <a href="javascript:void(0);" class="right-bar-toggle float-end">
                <i class="mdi mdi-close"></i>
            </a>
            <h4 class="font-16 m-0 text-white">Personalización de Tema</h4>
        </div>

        <!-- Contenido de pestañas -->
        <div class="tab-content pt-0">
            <div class="tab-pane active" id="settings-tab" role="tabpanel">
                <div class="p-3">

<div class="alert alert-secondary" role="alert">
                       <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Cerrar sesión</span>
                </button>
            </form>
        </div>

                    <div class="alert alert-warning" role="alert">
                        <strong>Personaliza</strong> el esquema de colores, diseño, etc.
                    </div>

                    <!-- Esquema de Color -->
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Esquema de Color</h6>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="layout-color" value="light"
                            id="light-mode-check" checked />
                        <label class="form-check-label" for="light-mode-check">Modo Claro</label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="layout-color" value="dark"
                            id="dark-mode-check" />
                        <label class="form-check-label" for="dark-mode-check">Modo Oscuro</label>
                    </div>

                    <!-- Ancho -->
                    {{-- <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Ancho</h6>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="layout-size" value="fluid" id="fluid" checked />
                        <label class="form-check-label" for="fluid-check">Fluido</label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="layout-size" value="boxed" id="boxed" />
                        <label class="form-check-label" for="boxed-check">En Caja</label>
                    </div> --}}

                    <!-- Posición de Menús -->
                    {{-- <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Posición de Menús (Barra Izquierda y Superior)</h6>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="leftbar-position" value="fixed" id="fixed-check" checked />
                        <label class="form-check-label" for="fixed-check">Fijo</label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="leftbar-position" value="scrollable"
                            id="scrollable-check" />
                        <label class="form-check-label" for="scrollable-check">Desplazable</label>
                    </div> --}}

                    {{-- <!-- Color de Barra Izquierda -->
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Color de la Barra Izquierda</h6>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="leftbar-color" value="light" id="light" />
                        <label class="form-check-label" for="light-check">Claro</label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="leftbar-color" value="dark" id="dark" checked />
                        <label class="form-check-label" for="dark-check">Oscuro</label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="leftbar-color" value="brand" id="brand" />
                        <label class="form-check-label" for="brand-check">Marca</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input type="radio" class="form-check-input" name="leftbar-color" value="gradient" id="gradient" />
                        <label class="form-check-label" for="gradient-check">Degradado</label>
                    </div> --}}

                    <!-- Tamaño de la Barra Izquierda -->
                    <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Tamaño de la Barra Izquierda</h6>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="leftbar-size" value="default"
                            id="default-size-check" checked />
                        <label class="form-check-label" for="default-size-check">Por Defecto</label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="leftbar-size" value="compact"
                            id="compact-check" />
                        <label class="form-check-label" for="compact-check">Compacto <small>(Tamaño Pequeño)</small></label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="leftbar-size" value="condensed"
                            id="condensed-check" />
                        <label class="form-check-label" for="condensed-check">Reducido <small>(Tamaño Extra Pequeño)</small></label>
                    </div>

                    <!-- Información de Usuario -->
                    {{-- <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Info del Usuario en Barra Lateral</h6>
                    <div class="form-check form-switch mb-1">
                        <input type="checkbox" class="form-check-input" name="sidebar-user" value="true" id="sidebaruser-check" />
                        <label class="form-check-label" for="sidebaruser-check">Activar</label>
                    </div> --}}

                    <!-- Barra Superior -->
                    {{-- <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Barra Superior</h6>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="topbar-color" value="dark" id="darktopbar-check" checked />
                        <label class="form-check-label" for="darktopbar-check">Oscura</label>
                    </div>
                    <div class="form-check form-switch mb-1">
                        <input type="radio" class="form-check-input" name="topbar-color" value="light" id="lighttopbar-check" />
                        <label class="form-check-label" for="lighttopbar-check">Clara</label>
                    </div> --}}

                    <div class="d-grid mt-4">
                        <button class="btn btn-primary" id="resetBtn">Restablecer a valores por defecto</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Superposición de barra derecha -->
<div class="rightbar-overlay"></div>
