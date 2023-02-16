@extends('layouts.main')

@section('container')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title-table">Data Hasil Pemetaan</h5>

                            <table class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Jalur</th>
                                        <th scope="col">Kemandirian</th>
                                        <th scope="col">Umum</th>
                                        <th scope="col">Agama</th>
                                        <th scope="col">Uji Tahfidz</th>
                                        <th scope="col">Prestasi</th>
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
                                                    <td>{{ $user->score->mandiri ?? "" }}</td>
                                                    <td>{{ $user->score->umum ?? "" }}</td>
                                                    <td>{{ $user->score->agama ?? "" }}</td>
                                                    <td>{{ $user->score->uji_tahfidz ?? "" }}</td>
                                                    <td>{{ $user->score->prestasi ?? "" }}</td>
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
