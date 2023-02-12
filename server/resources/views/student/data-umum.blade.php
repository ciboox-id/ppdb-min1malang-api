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
                    <h5 class="card-title mt-3 mb-0">Identitas diri</h5>
                    <p className="text-gray-500 font-medium">
                        Lengkapi data di bawah, Jika terdapat (<span class="mandatory">*</span>) maka wajib diisi
                    </p>
                    <form class="row g-3" action="{{ route('dashboard.data-umum.update') }}" method="POST"
                        id="data-umum-form">
                        @method('PUT')
                        @csrf
                        <div class="col-sm-12 col-md-6">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{ $user->nama_lengkap }}"
                                placeholder="e.g. ciboox.id" style="text-transform: uppercase" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="anak_ke" class="form-label">Anak ke <span class="mandatory">*</span></label>
                            <input type="number" class="form-control" value="{{ $user->anak_ke }}" name="anak_ke"
                                placeholder="e.g. 1" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="category" class="form-label">Jenis Kelamin <span class="mandatory">*</span></label>
                            <select class="form-select" name="jenis_kelamin" required>
                                <option value="Laki-laki" @if ($user->jenis_kelamin == 'Laki-laki') selected @endif>Laki-laki
                                </option>
                                <option value="Perempuan" @if ($user->jenis_kelamin == 'Perempuan') selected @endif>Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" class="form-control" id="inputAddress" value="{{ $user->nisn }}"
                                name="nisn" placeholder="e.g. 2163688232">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nik"class="form-label">NIK</label>
                            <input type="text" class="form-control" id="inputAddress" value="{{ $user->nik }}"
                                name="nik" placeholder="e.g. 2163688232" maxlength="16">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="alamat_siswa" class="form-label">Alamat Siswa <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" id="alamat_siswa" value="{{ $user->alamat_siswa }}"
                                name="alamat_siswa" placeholder="e.g. Jln Danau Ranau" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="gol_darah" class="form-label">Golongan Darah <span
                                    class="mandatory">*</span></label>
                            <select class="form-select" name="gol_darah" required>
                                @foreach ($gol_darah as $gol)
                                    @if ($gol === $user->gol_darah)
                                        <option value="{{ $gol }}" selected> {{ $gol }}</option>
                                    @else
                                        <option value="{{ $gol }}"> {{ $gol }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" id="tempat_lahir" value="{{ $user->tempat_lahir }}"
                                name="tempat_lahir" placeholder="e.g. Malang" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                    class="mandatory">*</span></label>
                            <input type="date" class="form-control" id="tanggal_lahir"
                                value="{{ $user->tanggal_lahir }}" name="tanggal_lahir" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 py-2 rounded-2" id="submitBtn">
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

        document.getElementById("data-umum-form").addEventListener("submit", function() {
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
