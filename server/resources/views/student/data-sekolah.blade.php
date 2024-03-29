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
                @if ($user->jalur != null)
                    <h5 class="card-title mt-3">Data Sekolah</h5>
                    <p className="text-gray-500 font-medium">
                        Lengkapi data di bawah, Jika terdapat (<span class="mandatory">*</span>) maka wajib diisi
                    </p>
                    <form class="row g-3" action="{{ route('dashboard.data-sekolah.update') }}" method="POST"
                        id="data-sekolah-form">
                        @method('PUT')
                        @csrf
                        <div class="col-sm-12 col-md-6">
                            <label for="nama_sekolah" class="form-label">Nama Sekolah <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="nama_sekolah"
                                value="{{ $user->school->nama_sekolah }}" placeholder="e.g. Tadika Mesra" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="asal_sekolah" class="form-label">Asal Sekolah <span
                                    class="mandatory">*</span></label>
                            <select class="form-select" name="asal_sekolah">
                                @foreach ($asal as $item)
                                    <option value="{{ $item }}"
                                        {{ $item === $user->school->asal_sekolah ? 'selected' : '' }}> {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="transportasi" class="form-label">Transportasi sekolah <span
                                    class="mandatory">*</span></label>
                            <select class="form-select" name="transportasi">
                                @foreach ($transportasi as $item)
                                    <option value="{{ $item }}"
                                        {{ $item === $user->school->transportasi ? 'selected' : '' }}> {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="waktu_tempuh" class="form-label">Waktu tempuh sekolah (menit) <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="waktu_tempuh"
                                value="{{ $user->school->waktu_tempuh }}" placeholder="e.g. 12" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="npsn" class="form-label">NPSN <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $user->school->npsn }}" name="npsn"
                                placeholder="e.g. 1237823" required>
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
        var formSubmitted = false;

        document.getElementById("data-sekolah-form").addEventListener("submit", function() {
            formSubmitted = true;
        });

        window.addEventListener("beforeunload", function(e) {
            if (!formSubmitted) {
                var confirmationMessage =
                    "Apakah benar ingin meninggalkan halama ini? anda belum menyimpan perubahan";
                e.returnValue = confirmationMessage;
                return confirmationMessage;
            }
        });
    </script>
@endsection
