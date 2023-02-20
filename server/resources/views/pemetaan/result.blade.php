@extends('layouts.main')

@section('container')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title-table">Data Hasil Pemetaan</h5>
                            <a href="{{ route('dashboard.export.excel.pemetaan') }}" class="btn btn-primary mb-3">
                                <i class="bi bi-cloud-download"></i>
                                Export excel
                            </a>

                            <table class="table table-bordered datatable">
                                <thead class="sticky-top table-success">
                                    <tr class="">
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Jalur</th>
                                        <th scope="col">Kemandirian</th>
                                        <th scope="col">Umum</th>
                                        <th scope="col">Validator Umum</th>
                                        <th scope="col">Agama</th>
                                        <th scope="col">Validator Agama</th>
                                        <th scope="col">Uji Tahfidz</th>
                                        <th scope="col">Validator Tahfidz</th>
                                        <th scope="col">Prestasi</th>
                                        <th scope="col">Timestamps</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($users))
                                        @foreach ($users as $key => $user)
                                            @if ($user->latestPemetaan && $user->latestPemetaan->lolos == 'lolos')
                                                <tr>
                                                    <td>{{ str_pad($user->latestPemetaan->id, 3, '0', STR_PAD_LEFT) }}</td>
                                                    <td>{{ $user->nama_lengkap }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td style="text-transform: capitalize">{{ $user->jalur }}</td>
                                                    <td>{{ $user->score->mandiri ?? '' }}</td>
                                                    <td>{{ $user->score->umum ?? '' }}</td>
                                                    <td>{{ $user->score->name_validator_umum ?? '' }}</td>
                                                    <td>{{ $user->score->agama ?? '' }}</td>
                                                    <td>{{ $user->score->name_validator_agama ?? '' }}</td>
                                                    <td>{{ $user->score->uji_tahfidz ?? '' }}</td>
                                                    <td>{{ $user->score->name_validator_tahfidz ?? '' }}</td>
                                                    <td>{{ $user->score->prestasi ?? '' }}</td>
                                                    <td>{{ $user->score->updated_at ?? '' }}</td>
                                                </tr>
                                            @endif
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
