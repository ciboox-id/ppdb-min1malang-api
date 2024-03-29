@extends('layouts.main')

@section('container')
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
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
                                @if (session()->has('successDeleteStudent'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('successDeleteStudent') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                @if (session()->has('errorStudent'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('errorStudent') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif


                                <form action="{{ route('dashboard.admin') }}" method="get">
                                    <div class="form-group col-2 my-2 d-flex align-items-center">
                                        <label for="per_page" class="me-1">Tampilkan</label>
                                        <select class="form-select" name="per_page" id="per_page"
                                            onchange="this.form.submit()">
                                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50
                                            </option>
                                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100
                                            </option>
                                            <option value="250" {{ request('per_page') == 250 ? 'selected' : '' }}>250
                                            </option>
                                            <option value="500" {{ request('per_page') == 500 ? 'selected' : '' }}>500
                                            </option>
                                        </select>
                                        <label for="per_page" class="ms-1"> Data</label>
                                    </div>
                                </form>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Jalur</th>
                                            <th scope="col">Status Berkas</th>
                                            <th scope="col">Status Verifikasi</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($d_users) > 0)
                                            @foreach ($d_users as $key => $user)
                                                <tr>
                                                    <th scope="row">{{ $d_users->firstItem() + $key }}</th>
                                                    <td>{{ $user->nama_lengkap }}</td>

                                                    <td>{{ $user->email }}</td>
                                                    <td style="text-transform: capitalize">{{ $user->jalur }}</td>
                                                    <td>
                                                        @if (empty($user->foto_akte) && empty($user->foto_siswa) && empty($user->foto_ket_tk) && empty($user->foto_kk))
                                                            <span class="badge rounded-pill status-danger">Kurang</span>
                                                        @else
                                                            <span class="badge rounded-pill status">Lengkap</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!$user->is_verif)
                                                            <span class="badge rounded-pill status-danger">Belum
                                                                terverfikasi</span>
                                                        @else
                                                            <span class="badge rounded-pill status">Sudah
                                                                terverfikasi</span>
                                                        @endif
                                                    </td>
                                                    <td class="d-flex">
                                                        <div class="me-2">
                                                            <a class="badge rounded-pill bg-success badge-custom btn-aksi"
                                                                href="{{ route('dashboard.data-siswa.detail', ['user' => $user->email]) }}">
                                                                <i class="bi bi-eye-fill"></i>
                                                                Lihat data
                                                            </a>
                                                        </div>
                                                        <div>
                                                            {{-- <form
                                                                action="{{ route('dashboard.data-siswa.delete', ['student' => $user->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    class="badge rounded-pill bg-danger badge-custom btn-aksi"
                                                                    onclick="confirm('Apakah anda ingin menghapus data calon siswa ini?')">
                                                                    <i class="bi bi-trash"></i>
                                                                    Hapus
                                                                </button>
                                                            </form> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>Belum ada data siswa</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    {{ $d_users->appends(['per_page' => request('per_page')])->links() }}
                                </div>
                            </div>
                        </div>
                    </div><!-- End Recent Sales -->
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
@endsection
