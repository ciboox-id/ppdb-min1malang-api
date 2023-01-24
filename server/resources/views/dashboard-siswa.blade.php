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
                        </div><!-- End Page Title -->

                        @if ($biodata > 5)
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

                        @if (count($prestasi))
                            <div class="alert alert-success" role="alert">
                                <i class="bi bi-check-circle"></i>
                                Data Prestasi - Data prestasi telah dimasukkan, tambaha jika mempunyai prestasi lain
                            </div>
                        @else
                            <div class="alert alert-warning" role="alert">
                                <i class="bi bi-exclamation-circle"></i>
                                Data Prestasi - Data prestasi boleh di isi jika mempunyai prestasi yang bagus
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
