<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PPDB APPS</title>
    <meta content="PPDB APPS" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/images/logo-icon.png" rel="icon">
    <link href="/images/logo-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between ">
            <a href="index.html" class="logo d-flex align-items-center header-logo">
                <img src="/images/logo-icon.png" alt="">
                <span class="d-none d-lg-block"> PPDB APPS</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <span class="d-md-block dropdown-toggle ps-2">{{ auth()->user()->nama_lengkap }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ auth()->user()->nama_lengkap }}</h6>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form action="/logout", method="post">
                                @csrf
                                <button class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Logout</span>
                                </button>

                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            @canany(['admin', 'superadmin'])
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/*') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.admin') }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @can('superadmin')
                    <li class="nav-heading">Admin</li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('data-siswa/*', 'data-siswa') ? '' : 'collapsed' }}"
                            href="{{ route('dashboard.data-siswa') }}">
                            <i class="bi bi-people"></i>
                            <span>Data Pendaftar</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('data-guru/*', 'data-guru') ? '' : 'collapsed' }}"
                            href="{{ route('dashboard.data-guru') }}">
                            <i class="bi bi-diagram-3"></i>
                            <span>Data Panitia</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('hasil-pemetaan') ? '' : 'collapsed' }}"
                            href="{{ route('dashboard.hasil-pemetaan') }}">
                            <i class="bi bi-clipboard-data"></i>
                            <span>Hasil Pemetaan</span>
                        </a>
                    </li>
                @endcan

                @canany(['verifikator', 'superadmin'])
                    <li class="nav-heading">Verifikasi</li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('data-verifikasi/*', 'data-verifikasi') ? '' : 'collapsed' }}"
                            href="{{ route('dashboard.verifikasi') }}">
                            <i class="bi bi-check-circle"></i>
                            <span>Verifikasi</span>
                        </a>
                    </li>
                @endcanany

                @canany(['superadmin', 'umum', 'agama', 'tahfidz'])
                    <li class="nav-heading">Pemetaan</li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('data-pemetaan/*', 'data-pemetaan') ? '' : 'collapsed' }}"
                            href="{{ route('dashboard.pemetaan') }}">
                            <i class="bi bi-bar-chart"></i>
                            <span>Pemetaan</span>
                        </a>
                    </li>
                @endcanany
            @endcanany

            @can('siswa')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/student') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.siswa') }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/data-umum') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.data-umum') }}">
                        <i class="bi bi-person"></i>
                        <span>Data Umum</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/data-berkas') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.data-berkas') }}">
                        <i class="bi bi-file-earmark-break"></i>
                        <span>Data Berkas</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/data-ortu') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.data-ortu') }}">
                        <i class="bi bi-people"></i>
                        <span>Data Orang Tua</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/data-sekolah') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.data-sekolah') }}">
                        <i class="bi bi-mortarboard"></i>
                        <span>Data Sekolah</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/data-alamat') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.data-alamat') }}">
                        <i class="bi bi-house"></i>
                        <span>Data Alamat</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/data-prestasi') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.data-prestasi') }}">
                        <i class="bi bi-123"></i>
                        <span>Upload Sertifikat</span>
                    </a>
                </li>
            @endcan

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        @yield('container')
    </main><!-- End #main -->


    <!-- Main js  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
