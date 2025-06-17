        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="h-100" data-simplebar>



                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul id="side-menu">

                        <li class="menu-title"> </li>

                        <li>
                            <a href="{{ route('dashboard') }}">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li class="menu-title mt-2">Apps</li>

                         <li>
                            <a href="#casos" data-bs-toggle="collapse">
                                <i class="mdi mdi-file-multiple-outline"></i>
                                <span> Casos </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="casos">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('profile.edit') }}">Ver </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile.edit') }}">Informes</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

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
                                        <a href="{{ route('users.index') }}">Usuarios </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('users.index') }}">Roles</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                

                  

                        <li>
                            <a href="#contacts" data-bs-toggle="collapse">
                                <i class="mdi mdi-book-open-page-variant-outline"></i>
                                <span> Configuracion </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="contacts">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('profile.edit') }}">Estados</a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li>

                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->