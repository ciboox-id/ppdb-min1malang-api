@extends('layouts.main')

@section('container')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title-table">Daftar Pemetaan</h5>

                            <form action="{{ route('dashboard.data-siswa') }}" method="get">
                                <div class="form-group col-2 my-2 d-flex align-items-center">
                                    <label for="per_page" class="me-2">Tampilkan</label>
                                    <select class="form-control" name="per_page" id="per_page"
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
                                </div>
                            </form>

                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Jalur</th>
                                        <th scope="col">Status verifikasi</th>
                                        <th scope="col">No. Pemetaan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($pemetaans) > 0)
                                        @foreach ($pemetaans as $key => $pemetaan)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $pemetaan->user->nama_lengkap }}</td>
                                                <td>{{ $pemetaan->user->email }}</td>
                                                <td style="text-transform: capitalize">{{ $pemetaan->user->jalur }}</td>
                                                <td>
                                                    @if (!$pemetaan->user->is_verif)
                                                        <span class="badge rounded-pill status-danger">Belum
                                                            terverfikasi</span>
                                                    @else
                                                        <span class="badge rounded-pill status">Sudah terverfikasi</span>
                                                    @endif
                                                </td>
                                                <td>{{ $pemetaan->id }}</td>
                                                <td>
                                                    <a class="badge rounded-pill bg-success badge-custom btn-aksi"
                                                        href="{{ route('dashboard.data-siswa.detail', ['user' => $pemetaan->user->email]) }}">
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
