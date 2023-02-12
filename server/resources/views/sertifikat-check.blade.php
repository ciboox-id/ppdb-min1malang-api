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

        <div class="card col-6">
            <div class="card-body">
                <p class="card-title">Sertifikat</p>
                <form class="row g-3" action="{{ route('dashboard.data-prestasi.update', ['prestasi' => $prestasi->id]) }}"
                    method="post">
                    @csrf
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Prestasi</label>
                        <input type="text" class="form-control" name="prestasi"
                            placeholder="e.g. Juara 1 lomba olimpiade matematika" value="{{ $prestasi->prestasi }}" disabled>
                    </div>

                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Juara</label>
                        <select class="form-select" name="posisi_prestasi" style="text-transform: capitalize">
                            @foreach ($posisi_prestasi as $posisi)
                                <option value="{{ $posisi }}"
                                    {{ $prestasi->posisi_prestasi == $posisi ? 'selected' : '' }}> {{ $posisi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Tingkat</label>
                        <select class="form-select" name="tingkat">
                            @foreach ($tingkat as $tgkt)
                                <option value="{{ $tgkt }}" {{ $prestasi->tingkat == $tgkt ? 'selected' : '' }}>
                                    {{ $tgkt }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Jenis Sertifikat</label>
                        <select class="form-select" name="jenis_sertifikat">
                            @foreach ($jenis_sertifikat as $js)
                                <option value="{{ $js }}"
                                    {{ $prestasi->jenis_sertifikat == $js ? 'selected' : '' }}>
                                    {{ $js }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 ">
                        <label for="foto_siswa" class="form-label d-block">Sertifikat</label>
                        <a href="{{ asset($prestasi->sertifikat) }}" target="_blank" rel="noopener noreferrer">Foto
                            sertifikat</a>
                    </div>
                    <div class="col-12 d-flex gap-1">
                        <button type="button" class="btn btn-danger mt-4 py-2 rounded-2 col-6"  onclick="closeBtnClicked()">
                            Tutup
                        </button>
                        <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2 col-6">
                            Verifikasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function closeBtnClicked(){
    window.close();
}
    </script>
@endsection
