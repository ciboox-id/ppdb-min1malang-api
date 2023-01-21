@extends('layouts.main')

@section('container')
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Card three -->
                    {{-- jumlah pendaftar card --}}
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card register-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ count($users) }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Jumlah Pendaftar</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End jumlah pendaftar Card -->

                    {{-- incomplete card --}}
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card incomplete-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-text-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $incomplete }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Belum Lengkap</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card complete-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title"></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-text-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $complete }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Sudah lengkap</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Customers Card -->

                    {{-- Table siswa --}}
                    <div class="col-12">
                        <div class="card table-student overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title-table">Data Pendaftar</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Status Berkas</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $user->nama_lengkap }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if (is_null($user->foto_akte) && is_null($user->foto_siswa))
                                                    <span class="badge rounded-pill status-danger">Belum Lengkap</span>
                                                @else
                                                    <span class="badge rounded-pill status">Lengkap</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="badge rounded-pill bg-success badge-custom" href="/data-profile/{{ $user->email }}">
                                                    <i class="bi bi-eye-fill"></i>
                                                    Lihat data
                                                </a>
                                                <span class="badge rounded-pill bg-info badge-custom">
                                                    <i class="bi bi-pencil"></i>
                                                    Isi Nilai
                                                </span>
                                                <span class="badge rounded-pill bg-danger badge-custom">
                                                    <i class="bi bi-trash"></i>
                                                    Hapus
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- End Recent Sales -->

                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
@endsection