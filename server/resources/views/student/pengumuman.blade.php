@extends('layouts.main')

@section('container')
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title mt-3 mb-0">Pengumuman</h1>
                            <p className="text-gray-500 font-medium ">
                                Seluruh pengumuman PPDB MIN 1 Kota Malang
                            </p>

                            @if ($user->is_verif && $user->score != null)
                                <h6 class="card-subtitle mt-3 mb-2"><mark>Pengumuman Pemetaan</mark></h6>
                                @if (\Carbon\Carbon::now()->gt(\Carbon\Carbon::create(2023, 3, 2, 0, 0, 0)))
                                    @if ($user->lolos)
                                        <a href="{{ asset('/data/B-113 Info Nomor Peserta.pdf') }}" target="_blank"
                                            rel="noopener noreferrer" class="btn btn-sm btn-info">Pemberitahuan Nomor
                                            Peserta</a>
                                        <a href="{{ route('download.export.hasil-pemetaan') }}" target="_blank"
                                            class="btn btn-sm btn-success" rel="noopener noreferrer">Download Hasil
                                            pemetaan</a>
                                        <a href="{{ asset('/data/B-116 Undangan Pertemuan.pdf') }}" target="_blank"
                                            rel="noopener noreferrer" class="btn btn-sm btn-info">Surat undangan</a>

                                <h6 class="card-subtitle mt-3 mb-2"><mark>Cetak form daftar ulang</mark></h6>
                                        @if ($biodata > 5 && $fatmot > 0 && $school > 0 && $address > 0)
                                            <div class="alert alert-info" role="alert">
                                                <i class="bi bi-exclamation-circle"></i>
                                                Lengkapi data terlebih dahulu sebelum mencetak form daftar ulang
                                            </div>
                                        @else
                                            <a href="{{ route('download.export.daftar-ulang') }}" target="_blank"
                                                class="btn btn-sm btn-success" rel="noopener noreferrer">Cetak Daftar Ulang</a>
                                        @endif
                                    @else
                                        <a href="{{ asset('/data/B-113 Info Nomor Peserta.pdf') }}" target="_blank"
                                            rel="noopener noreferrer" class="btn btn-sm btn-info">Pemberitahuan Nomor
                                            Peserta</a>
                                        <a href="{{ route('download.export.hasil-pemetaan') }}" target="_blank"
                                            class="btn btn-sm btn-success" rel="noopener noreferrer">Download Hasil
                                            pemetaan</a>
                                    @endif
                                @else
                                    <div class="alert alert-info" role="alert">
                                        <i class="bi bi-check-circle"></i>
                                        Pengumuman hasil pemetaan tanggal 2 Maret 2023
                                    </div>
                                @endif
                            @endif

                            <h6 class="card-subtitle mt-3 mb-2"><mark>Hasil Verifikasi</mark></h6>
                            @if ($user->is_verif)
                                @if (\Carbon\Carbon::now()->lt(\Carbon\Carbon::create(2023, 2, 11, 0, 0, 0)))
                                    <div class="alert alert-success" role="alert">
                                        <i class="bi bi-check-circle"></i>
                                        Data Telah di verifikasi
                                    </div>
                                @else
                                    @if ($user->pemetaan->lolos == 'lolos')
                                        <div class="d-block">
                                            <a href="{{ route('download.kartu-peserta') }}" target="_blank"
                                                class="btn btn-sm btn-success" rel="noopener noreferrer">Download kartu
                                                Peserta</a>
                                            <a href="{{ route('download.surat-resmi') }}" target="_blank"
                                                class="btn btn-sm btn-success" rel="noopener noreferrer">Download surat
                                                hasil verifikasi</a>
                                        </div>
                                    @else
                                        <div class="alert alert-danger" role="alert">
                                            <i class="bi bi-exclamation-circle"></i>
                                            Anda dinyatakan Tidak Lolos Verifikasi Berkas<br />
                                            Karena : {{ $user->pemetaan->pesan }}
                                        </div>
                                    @endif
                                @endif
                            @else
                                @if ($biodata > 7 || $school > 0 || $address > 0 || $fatmot > 0)
                                    <div class="alert alert-danger" role="alert">
                                        <i class="bi bi-exclamation-circle"></i>
                                        Lengkapi data diatas terlebih dahulu sebelum cetak kartu peserta dan surat hasil
                                        verifikasi
                                    </div>
                                @else
                                    <div class="alert alert-danger" role="alert">
                                        <i class="bi bi-exclamation-circle"></i>
                                        Tunggu data verifikasi terlebih dahulu
                                    </div>
                                @endif
                            @endif
                            {{-- end hasil verifikasi --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
