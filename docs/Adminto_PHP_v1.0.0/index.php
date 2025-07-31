<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Programa Camino seguro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.png">

    <!-- App css -->

    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<!-- body start -->

<body class="loading" data-layout-color="light" data-layout-mode="default" data-layout-size="fluid" data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='true'>

    <!-- Begin page -->
    <div id="wrapper">


        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-end mb-0">

                <li class="d-none d-lg-block">
                    <form class="app-search">
                        <div class="app-search-box">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search..." id="top-search">
                                <button class="btn input-group-text" type="submit">
                                    <i class="fe-search"></i>
                                </button>
                            </div>
                            <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h5 class="text-overflow mb-2">Found 22 results</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-home me-1"></i>
                                    <span>Analytics Report</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-aperture me-1"></i>
                                    <span>How can I help you?</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings me-1"></i>
                                    <span>User profile settings</span>
                                </a>

                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                                </div>

                                <div class="notification-list">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="d-flex align-items-start">
                                            <img class="d-flex me-2 rounded-circle" src="assets/images/users/user-2.jpg" alt="Generic placeholder image" height="32">
                                            <div class="w-100">
                                                <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                                <span class="font-12 mb-0">UI Designer</span>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="d-flex align-items-start">
                                            <img class="d-flex me-2 rounded-circle" src="assets/images/users/user-5.jpg" alt="Generic placeholder image" height="32">
                                            <div class="w-100">
                                                <h5 class="m-0 font-14">Jacob Deo</h5>
                                                <span class="font-12 mb-0">Developer</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </form>
                </li>

                <li class="dropdown d-inline-block d-lg-none">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-search noti-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                        <form class="p-3">
                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                        </form>
                    </div>
                </li>

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-bell noti-icon"></i>
                        <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class="float-end">
                                    <a href="" class="text-dark">
                                        <small>Clear All</small>
                                    </a>
                                </span>Notification
                            </h5>
                        </div>

                        <div class="noti-scroll" data-simplebar>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                <div class="notify-icon">
                                    <img src="assets/images/users/user-1.jpg" class="img-fluid rounded-circle" alt="" />
                                </div>
                                <p class="notify-details">Cristina Pride</p>
                                <p class="text-muted mb-0 user-msg">
                                    <small>Hi, How are you? What about our next meeting</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-primary">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                                <p class="notify-details">Caleb Flakelar commented on Admin
                                    <small class="text-muted">1 min ago</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon">
                                    <img src="assets/images/users/user-4.jpg" class="img-fluid rounded-circle" alt="" />
                                </div>
                                <p class="notify-details">Karen Robinson</p>
                                <p class="text-muted mb-0 user-msg">
                                    <small>Wow ! this admin looks good and awesome design</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-warning">
                                    <i class="mdi mdi-account-plus"></i>
                                </div>
                                <p class="notify-details">New user registered.
                                    <small class="text-muted">5 hours ago</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-info">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                                <p class="notify-details">Caleb Flakelar commented on Admin
                                    <small class="text-muted">4 days ago</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-secondary">
                                    <i class="mdi mdi-heart"></i>
                                </div>
                                <p class="notify-details">Carlos Crouch liked
                                    <b>Admin</b>
                                    <small class="text-muted">13 days ago</small>
                                </p>
                            </a>
                        </div>

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                            View all
                            <i class="fe-arrow-right"></i>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ms-1">
                            Nowak <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>

                        <!-- item-->
                        <a href="contacts-profile.php" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>My Account</span>
                        </a>

                        <!-- item-->
                        <a href="auth-lock-screen.php" class="dropdown-item notify-item">
                            <i class="fe-lock"></i>
                            <span>Lock Screen</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="auth-logout.php" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                        <i class="fe-settings noti-icon"></i>
                    </a>
                </li>

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="index.php" class="logo logo-light text-center">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="16">
                    </span>
                </a>
                <a href="index.php" class="logo logo-dark text-center">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="auto" width="80px">
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
        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="h-100" data-simplebar>



                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul id="side-menu">

                        <li class="menu-title">Navigation</li>

                        <li>
                            <a href="index.php">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span class="badge bg-success rounded-pill float-end">9+</span>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li class="menu-title mt-2">Apps</li>

                        <li>
                            <a href="apps-calendar.php">
                                <i class="mdi mdi-calendar-blank-outline"></i>
                                <span> Calendar </span>
                            </a>
                        </li>

                        <li>
                            <a href="apps-chat.php">
                                <i class="mdi mdi-forum-outline"></i>
                                <span> Chat </span>
                            </a>
                        </li>

                        <li>
                            <a href="#email" data-bs-toggle="collapse">
                                <i class="mdi mdi-email-outline"></i>
                                <span> Email </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="email">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="email-inbox.php">Inbox</a>
                                    </li>
                                    <li>
                                        <a href="email-templates.php">Email Templates</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarTasks" data-bs-toggle="collapse">
                                <i class="mdi mdi-clipboard-outline"></i>
                                <span> Tasks </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarTasks">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="task-kanban-board.php">Kanban Board</a>
                                    </li>
                                    <li>
                                        <a href="task-details.php">Details</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="apps-projects.php">
                                <i class="mdi mdi-briefcase-variant-outline"></i>
                                <span> Projects </span>
                            </a>
                        </li>

                        <li>
                            <a href="#contacts" data-bs-toggle="collapse">
                                <i class="mdi mdi-book-open-page-variant-outline"></i>
                                <span> Contacts </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="contacts">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="contacts-list.php">Members List</a>
                                    </li>
                                    <li>
                                        <a href="contacts-profile.php">Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="menu-title mt-2">Custom</li>

                        <li>
                            <a href="#sidebarAuth" data-bs-toggle="collapse">
                                <i class="mdi mdi-account-multiple-plus-outline"></i>
                                <span> Auth Pages </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarAuth">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="auth-login.php">Log In</a>
                                    </li>
                                    <li>
                                        <a href="auth-register.php">Register</a>
                                    </li>
                                    <li>
                                        <a href="auth-recoverpw.php">Recover Password</a>
                                    </li>
                                    <li>
                                        <a href="auth-lock-screen.php">Lock Screen</a>
                                    </li>
                                    <li>
                                        <a href="auth-confirm-mail.php">Confirm Mail</a>
                                    </li>
                                    <li>
                                        <a href="auth-logout.php">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarExpages" data-bs-toggle="collapse">
                                <i class="mdi mdi-file-multiple-outline"></i>
                                <span> Extra Pages </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarExpages">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="pages-starter.php">Starter</a>
                                    </li>
                                    <li>
                                        <a href="pages-pricing.php">Pricing</a>
                                    </li>
                                    <li>
                                        <a href="pages-timeline.php">Timeline</a>
                                    </li>
                                    <li>
                                        <a href="pages-invoice.php">Invoice</a>
                                    </li>
                                    <li>
                                        <a href="pages-faqs.php">FAQs</a>
                                    </li>
                                    <li>
                                        <a href="pages-gallery.php">Gallery</a>
                                    </li>
                                    <li>
                                        <a href="pages-404.php">Error 404</a>
                                    </li>
                                    <li>
                                        <a href="pages-500.php">Error 500</a>
                                    </li>
                                    <li>
                                        <a href="pages-maintenance.php">Maintenance</a>
                                    </li>
                                    <li>
                                        <a href="pages-coming-soon.php">Coming Soon</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarLayouts" data-bs-toggle="collapse">
                                <i class="mdi mdi-dock-window"></i>
                                <span> Layouts </span>
                                <span class="menu-arrow"></span>

                            </a>
                            <div class="collapse" id="sidebarLayouts">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="layouts-horizontal.php">Horizontal</a>
                                    </li>
                                    <li>
                                        <a href="layouts-preloader.php">Preloader</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="menu-title mt-2">Components</li>

                        <li>
                            <a href="#sidebarBaseui" data-bs-toggle="collapse">
                                <i class="mdi mdi-briefcase-outline"></i>
                                <span> Base UI </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarBaseui">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="ui-buttons.php">Buttons</a>
                                    </li>
                                    <li>
                                        <a href="ui-cards.php">Cards</a>
                                    </li>
                                    <li>
                                        <a href="ui-avatars.php">Avatars</a>
                                    </li>
                                    <li>
                                        <a href="ui-tabs-accordions.php">Tabs & Accordions</a>
                                    </li>
                                    <li>
                                        <a href="ui-modals.php">Modals</a>
                                    </li>
                                    <li>
                                        <a href="ui-progress.php">Progress</a>
                                    </li>
                                    <li>
                                        <a href="ui-notifications.php">Notifications</a>
                                    </li>
                                    <li>
                                        <a href="ui-offcanvas.php">Offcanvas</a>
                                    </li>
                                    <li>
                                        <a href="ui-placeholders.php">Placeholders</a>
                                    </li>
                                    <li>
                                        <a href="ui-spinners.php">Spinners</a>
                                    </li>
                                    <li>
                                        <a href="ui-images.php">Images</a>
                                    </li>
                                    <li>
                                        <a href="ui-carousel.php">Carousel</a>
                                    </li>
                                    <li>
                                        <a href="ui-video.php">Embed Video</a>
                                    </li>
                                    <li>
                                        <a href="ui-dropdowns.php">Dropdowns</a>
                                    </li>
                                    <li>
                                        <a href="ui-tooltips-popovers.php">Tooltips & Popovers</a>
                                    </li>
                                    <li>
                                        <a href="ui-general.php">General UI</a>
                                    </li>
                                    <li>
                                        <a href="ui-typography.php">Typography</a>
                                    </li>
                                    <li>
                                        <a href="ui-grid.php">Grid</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="widgets.php">
                                <i class="mdi mdi-gift-outline"></i>
                                <span> Widgets </span>
                            </a>
                        </li>

                        <li>
                            <a href="#sidebarExtendedui" data-bs-toggle="collapse">
                                <i class="mdi mdi-layers-outline"></i>
                                <span class="badge bg-info float-end">Hot</span>
                                <span> Extended UI </span>
                            </a>
                            <div class="collapse" id="sidebarExtendedui">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="extended-range-slider.php">Range Slider</a>
                                    </li>
                                    <li>
                                        <a href="extended-sweet-alert.php">Sweet Alert</a>
                                    </li>
                                    <li>
                                        <a href="extended-draggable-cards.php">Draggable Cards</a>
                                    </li>
                                    <li>
                                        <a href="extended-tour.php">Tour Page</a>
                                    </li>
                                    <li>
                                        <a href="extended-notification.php">Notification</a>
                                    </li>
                                    <li>
                                        <a href="extended-treeview.php">Tree View</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarIcons" data-bs-toggle="collapse">
                                <i class="mdi mdi-shield-outline"></i>
                                <span> Icons </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarIcons">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="icons-feather.php">Feather Icons</a>
                                    </li>
                                    <li>
                                        <a href="icons-mdi.php">Material Design Icons</a>
                                    </li>
                                    <li>
                                        <a href="icons-dripicons.php">Dripicons</a>
                                    </li>
                                    <li>
                                        <a href="icons-font-awesome.php">Font Awesome 5</a>
                                    </li>
                                    <li>
                                        <a href="icons-themify.php">Themify</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarForms" data-bs-toggle="collapse">
                                <i class="mdi mdi-texture"></i>
                                <span> Forms </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarForms">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="forms-elements.php">General Elements</a>
                                    </li>
                                    <li>
                                        <a href="forms-advanced.php">Advanced</a>
                                    </li>
                                    <li>
                                        <a href="forms-validation.php">Validation</a>
                                    </li>
                                    <li>
                                        <a href="forms-wizard.php">Wizard</a>
                                    </li>
                                    <li>
                                        <a href="forms-quilljs.php">Quilljs Editor</a>
                                    </li>
                                    <li>
                                        <a href="forms-pickers.php">Picker</a>
                                    </li>
                                    <li>
                                        <a href="forms-file-uploads.php">File Uploads</a>
                                    </li>
                                    <li>
                                        <a href="forms-x-editable.php">X Editable</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarTables" data-bs-toggle="collapse">
                                <i class="mdi mdi-table"></i>
                                <span> Tables </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarTables">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="tables-basic.php">Basic Tables</a>
                                    </li>
                                    <li>
                                        <a href="tables-datatables.php">Data Tables</a>
                                    </li>
                                    <li>
                                        <a href="tables-editable.php">Editable Tables</a>
                                    </li>
                                    <li>
                                        <a href="tables-responsive.php">Responsive Tables</a>
                                    </li>
                                    <li>
                                        <a href="tables-tablesaw.php">Tablesaw Tables</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarCharts" data-bs-toggle="collapse">
                                <i class="mdi mdi-chart-donut-variant"></i>
                                <span> Charts </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarCharts">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="charts-flot.php">Flot Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-morris.php">Morris Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-chartjs.php">Chartjs Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-chartist.php">Chartist Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-sparklines.php">Sparkline Charts</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarMaps" data-bs-toggle="collapse">
                                <i class="mdi mdi-map-outline"></i>
                                <span> Maps </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarMaps">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="maps-google.php">Google Maps</a>
                                    </li>
                                    <li>
                                        <a href="maps-vector.php">Vector Maps</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarMultilevel" data-bs-toggle="collapse">
                                <i class="mdi mdi-share-variant"></i>
                                <span> Multi Level </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarMultilevel">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="#sidebarMultilevel2" data-bs-toggle="collapse">
                                            Second Level <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="sidebarMultilevel2">
                                            <ul class="nav-second-level">
                                                <li>
                                                    <a href="javascript: void(0);">Item 1</a>
                                                </li>
                                                <li>
                                                    <a href="javascript: void(0);">Item 2</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="#sidebarMultilevel3" data-bs-toggle="collapse">
                                            Third Level <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="sidebarMultilevel3">
                                            <ul class="nav-second-level">
                                                <li>
                                                    <a href="javascript: void(0);">Item 1</a>
                                                </li>
                                                <li>
                                                    <a href="#sidebarMultilevel4" data-bs-toggle="collapse">
                                                        Item 2 <span class="menu-arrow"></span>
                                                    </a>
                                                    <div class="collapse" id="sidebarMultilevel4">
                                                        <ul class="nav-second-level">
                                                            <li>
                                                                <a href="javascript: void(0);">Item 1</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript: void(0);">Item 2</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
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


        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                   
                </div> <!-- container-fluid -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; Adminto theme by <a href="">Coderthemes</a>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end footer-links d-none d-sm-block">
                                <a href="javascript:void(0);">About Us</a>
                                <a href="javascript:void(0);">Help</a>
                                <a href="javascript:void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">

        <div data-simplebar class="h-100">

            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-end">
                    <i class="mdi mdi-close"></i>
                </a>
                <h4 class="font-16 m-0 text-white">Theme Customizer</h4>
            </div>

            <!-- Tab panes -->
            <div class="tab-content pt-0">

                <div class="tab-pane active" id="settings-tab" role="tabpanel">

                    <div class="p-3">
                        <div class="alert alert-warning" role="alert">
                            <strong>Customize </strong> the overall color scheme, Layout, etc.
                        </div>

                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-color" value="light"
                                id="light-mode-check" checked />
                            <label class="form-check-label" for="light-mode-check">Light Mode</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-color" value="dark"
                                id="dark-mode-check" />
                            <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                        </div>

                        <!-- Width -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Width</h6>
                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-size" value="fluid" id="fluid" checked />
                            <label class="form-check-label" for="fluid-check">Fluid</label>
                        </div>
                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-size" value="boxed" id="boxed" />
                            <label class="form-check-label" for="boxed-check">Boxed</label>
                        </div>

                        <!-- Menu positions -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Menus (Leftsidebar and Topbar) Positon</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-position" value="fixed" id="fixed-check"
                                checked />
                            <label class="form-check-label" for="fixed-check">Fixed</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-position" value="scrollable"
                                id="scrollable-check" />
                            <label class="form-check-label" for="scrollable-check">Scrollable</label>
                        </div>

                        <!-- Left Sidebar-->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Color</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="light" id="light" />
                            <label class="form-check-label" for="light-check">Light</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="dark" id="dark" checked />
                            <label class="form-check-label" for="dark-check">Dark</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="brand" id="brand" />
                            <label class="form-check-label" for="brand-check">Brand</label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="gradient" id="gradient" />
                            <label class="form-check-label" for="gradient-check">Gradient</label>
                        </div>

                        <!-- size -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Size</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-size" value="default"
                                id="default-size-check" checked />
                            <label class="form-check-label" for="default-size-check">Default</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-size" value="condensed"
                                id="condensed-check" />
                            <label class="form-check-label" for="condensed-check">Condensed <small>(Extra Small size)</small></label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-size" value="compact"
                                id="compact-check" />
                            <label class="form-check-label" for="compact-check">Compact <small>(Small size)</small></label>
                        </div>

                        <!-- User info -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Sidebar User Info</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="sidebar-user" value="true" id="sidebaruser-check" />
                            <label class="form-check-label" for="sidebaruser-check">Enable</label>
                        </div>


                        <!-- Topbar -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Topbar</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="topbar-color" value="dark" id="darktopbar-check"
                                checked />
                            <label class="form-check-label" for="darktopbar-check">Dark</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="topbar-color" value="light" id="lighttopbar-check" />
                            <label class="form-check-label" for="lighttopbar-check">Light</label>
                        </div>

                        <div class="d-grid mt-4">
                            <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
                            <a href="https://1.envato.market/admintoadmin" class="btn btn-danger mt-3" target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase Now</a>
                        </div>

                    </div>

                </div>
            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <!-- Vendor -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>

    <!-- knob plugin -->
    <script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>

    <!--Morris Chart-->
    <script src="assets/libs/morris.js06/morris.min.js"></script>
    <script src="assets/libs/raphael/raphael.min.js"></script>

    <!-- Dashboar init js-->
    <script src="assets/js/pages/dashboard.init.js"></script>

    <!-- App js-->
    <script src="assets/js/app.min.js"></script>

</body>

</html>