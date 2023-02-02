@extends('layouts.main')

@section('container')
    <div class="col-12">

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                @if ($berkas->jalur != null)
                    <h5 class="card-title mt-3 mb-0">Data Berkas</h5>
                    <p className="text-gray-500 font-medium ">Unggah foto menggunakan seragam asal sekolah,
                        rapi, wajah tampak jelas dan foto akta kelahiran dengan ketentuan : k tulisan tampak jelas
                        dan bisa terbaca dengan baik.<b>Ukuran maksimal file adalah 2 MB</b> </p>
                    <form class="row g-3" action="{{ route('dashboard.data-berkas.update') }}" method="post"
                        enctype="multipart/form-data" id="data-berkas-form">
                        @method('put')
                        @csrf
                        <div class="col-sm-12 col-md-6">
                            <label for="foto_siswa" class="form-label">Foto Siswa (.jpg, .png, .jpeg, .jfif) <span class="mandatory">*</span></label>
                            <input class="form-control" type="file" id="foto_siswa" onchange="previewImageSiswa()"
                                accept="image/*" name="foto_siswa" class="@error('foto_siswa') is-invalid @enderror">
                            @error('foto_siswa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            @if ($berkas->foto_siswa)
                                <img src="{{ asset($berkas->foto_siswa) }}" alt="" class="img-fluid col-sm-6 mt-4">
                            @else
                                <img class="img-preview-siswa img-fluid mb-3 col-sm-6 mt-4">
                            @endif
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="formFile" class="form-label">Foto Akte Kelahiran (.pdf) <span
                                    class="mandatory">*</span></label>
                            <input class="form-control" type="file" id="foto_akte" onchange="previewImageAkte()"
                                accept="application/pdf,application/vnd.ms-excel" name="foto_akte"
                                class="@error('foto_akte') is-invalid @enderror">
                            @error('foto_akte')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            @if ($berkas->foto_akte)
                                <p class="mt-2 ">Berkas sudah terupload</p>
                            @endif
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="formFile" class="form-label">Foto Kartu Keluarga (.pdf) <span
                                    class="mandatory">*</span></label>
                            <input class="form-control" type="file" id="foto_kk"
                                accept="application/pdf,application/vnd.ms-excel" name="foto_kk"
                                class="@error('foto_kk') is-invalid @enderror">
                            @error('foto_kk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            @if ($berkas->foto_kk)
                                <p class="mt-2 ">Berkas Kartu keluraga sudah terupload</p>
                            @endif
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="formFile" class="form-label">Surat Keterangan TK (.pdf) <span
                                    class="mandatory">*</span></label>
                            <input class="form-control" type="file" id="foto_ket_tk"
                                accept="application/pdf,application/vnd.ms-excel" name="foto_ket_tk"
                                class="@error('foto_ket_tk') is-invalid @enderror">
                            @error('foto_ket_tk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            @if ($berkas->foto_ket_tk)
                                <p class="mt-2 ">Berkas Surat keterangan TK Sudah terupload</p>
                            @endif
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="formFile" class="form-label">Surat psikolog bahwa umum < 6 thn (.pdf)</label>
                            <input class="form-control" type="file" id="foto_psikolog"
                                accept="application/pdf,application/vnd.ms-excel" name="foto_psikolog"
                                class="@error('foto_psikolog') is-invalid @enderror">
                            @error('foto_psikolog')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            @if ($berkas->foto_psikolog)
                                <p class="mt-2 ">Berkas Surat psikolog sudah terupload</p>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2">
                            Simpan Perubahan
                        </button>
                    </form>
                @else
                    <div class="alert alert-danger mt-4 mb-0" role="alert">
                        <i class="bi bi-exclamation-circle"></i>
                        Silahkan memilih jalur pendaftaran terlebih dahulu! <a href="{{ route('dashboard.siswa') }}">Klik
                            disini</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function previewImageSiswa() {
            const foto_siswa = document.querySelector("#foto_siswa");
            const imgPreviewSiswa = document.querySelector(".img-preview-siswa");

            imgPreviewSiswa.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(foto_siswa.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreviewSiswa.src = oFREvent.target.result;
            }
        }

        function previewImageAkte() {
            const foto_akte = document.querySelector("#foto_akte");
            const imgPreviewAkte = document.querySelector(".img-preview-akte");

            imgPreviewAkte.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(foto_akte.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreviewAkte.src = oFREvent.target.result;
            }
        }

        var formSubmitted = false;

        document.getElementById("data-berkas-form").addEventListener("submit", function() {
            formSubmitted = true;
        });

        window.addEventListener("beforeunload", function(e) {
            if (!formSubmitted) {
                var confirmationMessage = "Apakah benar ingin meninggalkan halama ini? anda belum menyimpan perubahan";
                e.returnValue = confirmationMessage;
                return confirmationMessage;
            }
        });
    </script>
@endsection
