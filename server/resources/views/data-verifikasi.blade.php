@extends('layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Data Calon Siswa untuk Verifikasi</h1>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="mb-2 col-4">
            <form action="{{ route('dashboard.verifikasi') }}">
                <div class="input-group mb-3">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search..."
                        value="{{ request('search') }}">
                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title-table">Data Pendaftar</h5>

                            <form action="{{ route('dashboard.verifikasi') }}" method="get">
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

                            <table class="table table-bordered datatable">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jalur</th>
                                        <th scope="col">Status verifikasi</th>
                                        <th scope="col">Verifikator</th>
                                        <th scope="col">Waktu Verifikasi</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($users) > 0)
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <th scope="row">{{ $users->firstItem() + $key }}</th>
                                                <td>{{ $user->nama_lengkap }}</td>
                                                <td style="text-transform: capitalize">{{ $user->jalur }}</td>
                                                <td>
                                                    @if (!$user->is_verif)
                                                        <span class="badge rounded-pill status-danger">Belum
                                                            terverfikasi</span>
                                                    @else
                                                        <span class="badge rounded-pill status">Sudah terverfikasi</span>
                                                    @endif
                                                </td>
                                                <td>{{ $user->pemetaan->name_validator ?? '' }}</td>
                                                <td>{{ $user->pemetaan->updated_at ?? '' }}</td>
                                                <td>
                                                    <a class="badge rounded-pill bg-success badge-custom btn-aksi"
                                                        href="{{ route('dashboard.verifikasi.detail', ['user' => $user->email]) }}">
                                                        <i class="bi bi-eye-fill"></i>
                                                        Lihat data
                                                    </a>
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
                                {{ $users->appends(['per_page' => request('per_page')])->links() }}
                            </div>
                        </div>
                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </div><!-- End Left side columns -->
    </section>

@endsection
