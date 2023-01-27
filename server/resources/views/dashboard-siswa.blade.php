@extends('layouts.main')

@section('container')
    {{-- Student dashboard --}}
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="card dashboard-card">
                        <div class="pagetitle">
                            <h1>Selamat Datang Kembali,</h1>
                            <span>Pastikan semua form pada menu yang tersedia sudah di isi dengan benar</span>
                        </div>

                        @if ($user->jalur != null)
                            <div class="mt-2">
                                @if ($biodata > 7)
                                    <div class="alert alert-warning" role="alert">
                                        <i class="bi bi-exclamation-circle"></i>
                                        Data Umum - Data berkas yang anda masukkan belum lengkap
                                    </div>
                                @else
                                    <div class="alert alert-success" role="alert">
                                        <i class="bi bi-check-circle"></i>
                                        Data Umum - Sudah lengkap
                                    </div>
                                @endif

                                @if (empty($user->foto_siswa) || empty($user->foto_akte))
                                    <div class="alert alert-warning" role="alert">
                                        <i class="bi bi-exclamation-circle"></i>
                                        Data Berkas - Data berkas yang anda masukkan belum lengkap
                                    </div>
                                @else
                                    <div class="alert alert-success" role="alert">
                                        <i class="bi bi-check-circle"></i>
                                        Data Berkas - Sudah lengkap
                                    </div>
                                @endif

                                @if ($fatmot > 0)
                                    <div class="alert alert-danger" role="alert">
                                        <i class="bi bi-exclamation-circle"></i>
                                        Data Orang Tua - Anda belum melengkapi data orang tua
                                    </div>
                                @else
                                    <div class="alert alert-success" role="alert">
                                        <i class="bi bi-check-circle"></i>
                                        Data Orang Tua - Sudah Lengkap
                                    </div>
                                @endif

                                @if ($school > 0)
                                    <div class="alert alert-danger" role="alert">
                                        <i class="bi bi-exclamation-circle"></i>
                                        Data Sekolah - Anda belum melengkapi data sekolah
                                    </div>
                                @else
                                    <div class="alert alert-success" role="alert">
                                        <i class="bi bi-check-circle"></i>
                                        Data Sekolah - Sudah lengkap
                                    </div>
                                @endif

                                @if ($address > 0)
                                    <div class="alert alert-danger" role="alert">
                                        <i class="bi bi-exclamation-circle"></i>
                                        Data Alamat - Anda belum melengkapi data alamat
                                    </div>
                                @else
                                    <div class="alert alert-success" role="alert">
                                        <i class="bi bi-check-circle"></i>
                                        Data Alamat - Sudah lengkap
                                    </div>
                                @endif

                                @if (count($prestasi) > 0)
                                    <div class="alert alert-success" role="alert">
                                        <i class="bi bi-check-circle"></i>
                                        Data Prestasi - Data prestasi telah dimasukkan, ayo tambah lagi jika mempunyai
                                        prestasi lain
                                    </div>
                                @else
                                    <div class="alert alert-warning" role="alert">
                                        <i class="bi bi-exclamation-circle"></i>
                                        Data Prestasi - Data prestasi boleh di isi jika mempunyai prestasi yang bagus
                                    </div>
                                @endif
                            </div>

                            <div class="pagetitle">
                                <h1>Cetak Kartu peserta dan Verifikasi berkas</h1>
                            </div><!-- End Page Title -->
                            @if ($biodata > 7 || $school > 0 || $address > 0 || $fatmot > 0)
                                <div class="alert alert-danger" role="alert">
                                    <i class="bi bi-exclamation-circle"></i>
                                    Lengkapi data diatas terlebih dahulu sebelum cetak kartu peserta
                                </div>
                            @else
                                @if ($user->is_verif)
                                    <a href="{{ route('download.kartu-peserta') }}" target="_blank"
                                        rel="noopener noreferrer">Download kartu Peserta</a>
                                @else
                                    <div class="alert alert-danger" role="alert">
                                        <i class="bi bi-exclamation-circle"></i>
                                        Tunggu data verifikasi terlebih dahulu
                                    </div>
                                @endif
                            @endif

                            @if (is_null($user->pemetaan_date) || is_null($user->pemetaan_time))
                                <div class="alert alert-danger" role="alert">
                                    <i class="bi bi-exclamation-circle"></i>
                                    Tunggu data verifikasi terlebih dahulu
                                </div>
                            @else
                                <a href="{{ route('download.surat-resmi') }}" target="_blank"
                                    rel="noopener noreferrer">Download surat resmi</a>
                            @endif
                        @else
                            <div class="alert alert-danger" role="alert">
                                <i class="bi bi-exclamation-circle"></i>
                                Anda belum terdaftar di Jalur apapun. Silahkan pilih jalur yang disediakan!
                                <button type="button" class="btn btn-info btn-sm mx-2" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                    Pilih Jalur
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Prestas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('dashboard.jalur.update') }}" method="post">
                        @csrf
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Jalur Pendaftaran</label>
                            <select class="form-select" name="jalur" style="text-transform: capitalize">
                                <option value="reguler">reguler</option>
                                <option value="prestasi">prestasi</option>
                                <option value="tahfidz">tahfidz</option>
                                <option value="afirmasi">afirmasi</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2">
                            Tambah Prestasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
