<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />

    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.5/dist/sweetalert2.all.min.js"></script>


    <!-- Template CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet">

    @stack('css')
</head>

<body>
    @include('sweetalert::alert')

    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="#">E-Library</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="#">EL</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"><a class="nav-link" href="{{route('dashboard')}}"><i
                                    class="fas fa-gauge"></i>
                                <span>Dashboard</span></a></li>
                        <li class="menu-header">Pengelolaan</li>
                        <li class="nav-item dropdown {{Route::currentRouteName() == 'siswa.create' || Route::currentRouteName() == 'siswa.index' ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-users"></i> <span>Siswa</span></a>
                            <ul class="dropdown-menu">
                                <li class="{{Route::currentRouteName() == 'siswa.create' ? 'active' : '' }}"><a class="nav-link" href="{{route('siswa.create')}}">Tambah Siswa</a></li>
                                <li class="{{Route::currentRouteName() == 'siswa.index' ? 'active' : '' }}"><a class="nav-link" href="{{route('siswa.index')}}">Data Siswa</a></li>
                            </ul>
                        </li>
                        <li class="{{Route::currentRouteName() == 'buku.index' ? 'active' : '' }}"><a class="nav-link" href="{{route('buku.index')}}"><i class="fas fa-book"></i>
                            <span>Buku</span></a></li>
                        <li class="{{Route::currentRouteName() == 'peminjaman.index' ? 'active' : '' }}"><a class="nav-link" href="{{route('peminjaman.index')}}"><i class="fas fa-file"></i>
                            <span>Peminjaman</span></a></li>
                            <li class="{{Route::currentRouteName() == 'pengembalian.index' ? 'active' : '' }}"><a class="nav-link" href="{{route('pengembalian.index')}}"><i class="fas fa-arrow-rotate-left"></i>
                                <span>Pengembalian</span></a></li>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1><?= $header ?></h1>
                    </div>

                    <div class="section-body">
                        @yield('content')
                    </div>
                </section>
            </div>
        </div>
    </div>


    <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/custom-script.js') }}"></script>

    @stack('js')
</body>

</html>
