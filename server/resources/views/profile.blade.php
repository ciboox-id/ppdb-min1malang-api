@extends('layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Lihat berdasarkan</h1>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="mb-3 col-4">

            <form action="{{ route('dashboard.data-siswa') }}">
                <div class="input-group mb-3">

                    <select class="dropdown btn btn-success" name="jalur">
                        <option value="" disabled selected>Jalur</option>
                        <option class="dropdown-item" value="reguler">Reguler</option>
                        <option class="dropdown-item" value="prestasi">Prestasi</option>
                        <option class="dropdown-item" value="tahfidz">Tahfidz</option>
                        <option class="dropdown-item" value="afirmasi">Afirmasi</option>
                    </select>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search..."
                        value="{{ request('search') }}">
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>

            <a href="{{ route('dashboard.export') }}" class="btn btn-primary">Export to excel</a>
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

                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Jalur</th>
                                        <th scope="col">Status Berkas</th>
                                        <th scope="col">Status verifikasi</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($users) > 0)
                                        @foreach ($users as $user)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $user->nama_lengkap }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td style="text-transform: capitalize">{{ $user->jalur }}</td>
                                                <td>
                                                    @if (is_null($user->foto_akte) && is_null($user->foto_siswa))
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
                                                        <span class="badge rounded-pill status">Sudah terverfikasi</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="badge rounded-pill bg-success badge-custom"
                                                        href="/data-profile/{{ $user->email }}">
                                                        <i class="bi bi-eye-fill"></i>
                                                        Lihat data
                                                    </a>
                                                    {{-- <span class="badge rounded-pill bg-info badge-custom">
                                                        <i class="bi bi-pencil"></i>
                                                        Verifikasi
                                                    </span> --}}
                                                    {{-- <span class="badge rounded-pill bg-danger badge-custom">
                                                        <i class="bi bi-trash"></i>
                                                        Hapus
                                                    </span> --}}
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
                        </div>
                    </div>
                </div><!-- End Recent Sales -->

            </div>
        </div><!-- End Left side columns -->
        </div>
    </section>

@endsection
