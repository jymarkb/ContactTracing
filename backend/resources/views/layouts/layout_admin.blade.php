<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>Libmanan Contact Tracing - @yield('title')</title>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/html2canvas.js') }}"></script>
    <script src="{{ asset('js/FileSaver.js') }}"></script>
    <script src="{{ asset('js/espromise/es6-promise.auto.js') }}"></script>
    <script src="{{ asset('js/espromise/es6-promise.js') }}"></script>
    <script src="{{ asset('js/dom-to-image.js') }}"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> -->
    <link href="{{ asset('css/AdminCSS/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel = "icon" href = "{{URL::asset('images/system/logo.png')}}" type = "image/x-icon">
    @yield('css-import')

    @yield('js-import')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                @if(Auth::user()->types_id == 3)
                <div class="sidebar-brand-text mx-3">Tracer</div>
                @else
                <div class="sidebar-brand-text mx-3">{{ Auth::user()->type->types_description }}</div>
                @endif
                
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            @if(Auth::user()->types_id == 1)
            <!-- Heading -->
            <div class="sidebar-heading">
                Admin Control
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ Request::is('citizen/*') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('citizen/*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse"
                    data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users fa-cog"></i>
                    <span>Citizen</span>
                </a>
                <div id="collapseTwo" class="collapse {{ Request::is('citizen/*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('citizen/add-new') ? 'active' : '' }}" href="/citizen/add-new">Add New</a>
                        <a class="collapse-item {{ Request::is('citizen/id-card') ? 'active' : '' }}" href="/citizen/id-card">Identification Card</a>
                        <a class="collapse-item {{ Request::is('citizen/records') ? 'active' : '' }}" href="/citizen/records">Records</a>
                    </div>
                </div>
            </li>


            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item {{ Request::is('establishment/*') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('establishment/*') ? 'active' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#establishmentControl"
                    aria-expanded="true" aria-controls="establishmentControl">
                    <i class="fas fa-fw fa-store"></i>
                    <span>Establishment</span>
                </a>
                <div id="establishmentControl" class="collapse {{ Request::is('establishment/*') ? 'show' : '' }}" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('establishment/add-new') ? 'active' : '' }}" href="/establishment/add-new">Add New</a>
                        <a class="collapse-item {{ Request::is('establishment/records') ? 'active' : '' }}" href="/establishment/records">Records</a>
                        <a class="collapse-item {{ Request::is('establishment/scanner') ? 'active' : '' }}" href="/establishment/scanner">Scanner</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item {{ Request::is('admin/*') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('admin/*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#adminControl"
                    aria-expanded="true" aria-controls="adminControl">
                    <i class="fas fa-fw fa-user-shield"></i>
                    <span>Admin</span>
                </a>
                <div id="adminControl" class="collapse {{ Request::is('admin/*') ? 'show' : '' }}" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('admin/add-new') ? 'active' : '' }}" href="/admin/add-new">Add New</a>
                        <a class="collapse-item {{ Request::is('admin/records') ? 'active' : '' }}" href="/admin/records">Records</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MISU CONTROL
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ Request::is('misu/*') ? 'active' : '' }}">
                <a class="nav-link" href="/misu/tracing">
                    <i class="fas fa-fw fa-list-ol"></i>
                    <span>Tracing</span></a>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                CONTACT TRACER CONTROL
            </div>

            <!-- Nav Item - Pages Collapse Menu -->

            <li class="nav-item {{ Request::is('ctc/tagging') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('ctc/tagging') ? '' : 'collapsed' }}" href="/ctc/tagging">
                    <i class="fas fa-fw fa-user-tag"></i>
                    <span>Tagging</span></a>
            </li>

            <li class="nav-item {{ Request::is('ctc/monitor') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('ctc/monitor') ? '' : 'collapsed' }}" href="/ctc/monitor">
                    <i class="fas fa-fw fa-notes-medical"></i>
                    <span>Monitor</span></a>
            </li>

            <li class="nav-item {{ Request::is('ctc/others/*') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('ctc/others/*') ? 'active' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#otherControls" aria-expanded="true" aria-controls="otherControls">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Others</span>
                </a>
                <div id="otherControls" class="collapse {{ Request::is('ctc/others/*') ? 'show' : '' }}" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('ctc/others/symptoms') ? 'active' : '' }}" href="/ctc/others/symptoms">Symptoms</a>
                        <a class="collapse-item {{ Request::is('ctc/others/facility') ? 'active' : '' }}" href="/ctc/others/facility">Facility</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            

            @elseif(Auth::user()->types_id == 2)
            <!-- Heading -->
            <div class="sidebar-heading">
                MISU CONTROL
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="/misu/tracing">
                    <i class="fas fa-fw fa-list-ol"></i>
                    <span>Tracing</span></a>
            </li>

            

            @elseif(Auth::user()->types_id == 3)
                <!-- Heading -->
            <div class="sidebar-heading">
                CONTACT TRACER CONTROL
            </div>

            <!-- Nav Item - Pages Collapse Menu -->

            <li class="nav-item {{ Request::is('ctc/tagging') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('ctc/tagging') ? '' : 'collapsed' }}" href="/ctc/tagging">
                    <i class="fas fa-fw fa-user-tag"></i>
                    <span>Tagging</span></a>
            </li>

            <li class="nav-item {{ Request::is('ctc/monitor') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('ctc/monitor') ? '' : 'collapsed' }}" href="/ctc/monitor">
                    <i class="fas fa-fw fa-notes-medical"></i>
                    <span>Monitor</span></a>
            </li>

            <li class="nav-item {{ Request::is('ctc/others/*') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('ctc/others/*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#otherControls" aria-expanded="true" aria-controls="otherControls">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Others</span>
                </a>
                <div id="otherControls" class="collapse {{ Request::is('ctc/others/*') ? 'show' : '' }}" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::is('ctc/others/symptoms') ? 'active' : '' }}" href="/ctc/others/symptoms">Symptoms</a>
                        <a class="collapse-item {{ Request::is('ctc/others/facility') ? 'active' : '' }}" href="/ctc/others/facility">Facility</a>
                    </div>
                </div>
            </li>

            @endif

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
                    <ul class="navbar-nav ml-auto">



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    @if(Auth::check())
                                        {{ ucwords(strtolower(Auth::user()->users_fname)) .' '. ucwords(substr(Auth::user()->users_mname, 0, 1) ).'. ' . ucwords(strtolower(Auth::user()->users_lname))}}
                                    @endif
                                </span>

                                @if(Auth::user()->users_profile != null)
                                    <img class="img-profile rounded-circle" src="{{ asset('/storage/profiles/'.Auth::user()->users_profile) }}">
                                @else
                                    <div class="img-profile rounded-circle" style="background-color:#343a40;">
                                        <p class="text-white  text-center" style="margin-top:4px;margin-bottom:0px;">{{ ucwords(substr(Auth::user()->users_fname, 0,1)) }}</p>
                                    </div>
                                @endif

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <main class="py-4">
                        @yield('content')
                    </main>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Libmanan Contact Tracing - 2020 . Template Made by : <a href="https://web.facebook.com/mackyhoho"> Jay Mark A. Borja</a></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top" id="scroll-up">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('js/Admin/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/Admin/sb-admin-2.min.js') }}"></script>

    @yield('js-import-add')
    

</body>

</html>