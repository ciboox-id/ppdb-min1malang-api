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
                <h5 class="card-title">Data Berkas</h5>
                <form class="row g-3" action="{{ route('dashboard.data-berkas.update') }}" method="post"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="col-6">
                        <label for="foto_siswa" class="form-label">Foto Siswa</label>
                        <input class="form-control" type="file" id="foto_siswa" onchange="previewImageSiswa()"
                            accept="image/*" name="foto_siswa">
                        @if ($berkas->foto_siswa)
                            <img src="{{ asset($berkas->foto_siswa) }}" alt="" class="img-fluid col-sm-6 mt-4">
                        @else
                            <img class="img-preview-akte img-fluid mb-3 col-sm-6 mt-4">
                        @endif
                    </div>
                    <div class="col-6">
                        <label for="formFile" class="form-label">Foto Kartu Keluarga</label>
                        <input class="form-control" type="file" id="foto_akte" onchange="previewImageAkte()"
                            accept="image/*" name="foto_akte">
                        @if ($berkas->foto_akte)
                            <img src="{{ asset($berkas->foto_akte) }}" alt="" class="img-fluid col-sm-6 mt-4">
                        @else
                            <img class="img-preview-akte img-fluid mb-3 col-sm-6 mt-4">
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2">
                        Simpan Perubahan
                    </button>
                </form>
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
    </script>
@endsection
