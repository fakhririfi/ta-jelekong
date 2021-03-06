<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">

    @stack('css')
</head>

<body id="page-top">


    </style>


    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class=""></i>
                </div>
                <div class="sidebar-brand-text mx-3">Jelekong</div>


            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Profile -->
            @if (Auth::check())
                <div class="ad" justify-content-center>ADMIN</div>
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item {{ Nav::isRoute('events.*') }}">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-fw fa-list"></i>
                            <span>Events</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="{{ route('events.dashboard') }}">Dashboard Event</a>
                                <a class="collapse-item" href="{{ route('events.create') }}">Buat Event</a>
                                <a class="collapse-item" href="{{ route('events.index') }}">List Event</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item {{ Nav::isRoute('transactions.*') }}">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ticketingCollapse"
                            aria-expanded="true" aria-controls="ticketingCollapse">
                            <i class="fas fa-fw fa-search"></i>
                            <span>Ticketing</span>
                        </a>
                        <div id="ticketingCollapse" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="{{ route('transactions.dashboard') }}">Dashboard
                                    Ticket</a>
                                <a class="collapse-item" href="{{ route('customer.transactions.ticketing') }}">Cari
                                    Ticket</a>
                                <a class="collapse-item" href="{{ route('transactions.index') }}">List Ticket</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item {{ request()->routeIs('schedule.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('schedule.index') }}">
                            <i class="fas fa-fw fa-calendar"></i>
                            <span>{{ __('Calendar') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Nav::isRoute('articles.*') }}">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArticle"
                            aria-expanded="true" aria-controls="collapseArticle">
                            <i class="fas fa-fw fa-book"></i>
                            <span>Articles</span>
                        </a>
                        <div id="collapseArticle" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="{{ route('articles.create') }}">Buat Article</a>
                                <a class="collapse-item" href="{{ route('articles.index') }}">List Article</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item {{ request()->routeIs('usermanagement.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('roles.index') }}">
                            <i class="fas fa-fw fa-calendar"></i>
                            <span>{{ __('User Management') }}</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item {{ request()->routeIs('manageevent.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('manageevent.index') }}">
                        <i class="fas fa-fw fa-calendar"></i>
                        <span>{{ __('Manage Event') }}</span>
                    </a>
                </li>
            @else
                <li class="nav-item {{ Nav::isRoute('events.*') }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-list"></i>
                        <span>Events</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('customer.events.index') }}">List Event</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item {{ Nav::isRoute('transactions.*') }}">
                    <a class="nav-link" href="{{ route('customer.transactions.ticketing') }}">
                        <i class="fas fa-fw fa-search"></i>
                        <span>Ticketing</span>
                    </a>
                </li>

                </li>
                <li class="nav-item {{ Nav::isRoute('articles.*') }}">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseArticle"
                        aria-expanded="true" aria-controls="collapseArticle">
                        <i class="fas fa-fw fa-book"></i>
                        <span>Articles</span>
                    </a>
                    <div id="collapseArticle" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('customer.articles.index') }}">List Article</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item {{ Nav::isRoute('about') }}">
                    <a class="nav-link" href="{{ route('about') }}">
                        <i class="fas fa-fw fa-hands-helping"></i>
                        <span>About Us</span>
                    </a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    @if (Auth::check())
                        <ul class="navbar-nav ml-auto">

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                    <figure class="img-profile rounded-circle avatar font-weight-bold"
                                        data-initial="{{ Auth::user()->name[0] }}"></figure>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('Profile') }}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </li>

                        </ul>
                    @endif
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @stack('notif')
                    @yield('main-content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Jelekong {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @if (Auth::check())
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Apakah anda yakin?') }}</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">??</span>
                        </button>
                    </div>
                    <div class="modal-body">Klik tombol logout untuk keluar.</div>
                    <div class="modal-footer">
                        <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <a class="btn btn-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    @stack('js')
</body>

</html>
