@extends('layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Lihat berdasarkan</h1>
    </div><!-- End Page Title -->

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
