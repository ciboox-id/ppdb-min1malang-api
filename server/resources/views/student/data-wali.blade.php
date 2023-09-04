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
                    <h5 class="card-title mt-3 mb-0">Data Wali</h5>
                    <p className="text-gray-500 font-medium">
                        Lengkapi data di bawah, Jika terdapat (<span class="mandatory">*</span>) maka wajib diisi
                    </p>
                    <form class="row g-3" action="{{ route('dashboard.data-wali.update') }}" method="POST"
                        id="data-wali-form">
                        @method('PUT')
                        @csrf
                        <div class="col-sm-12 col-md-6">
                            <label for="hub_wali_siswa" class="form-label">Hubungan wali dengan siswa <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="hub_wali_siswa"
                                value="{{ $wali->hub_wali_siswa ?? '' }}" placeholder="e.g. Paman siswa" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali <span
                                    class="mandatory">*</span></label>
                            <select class="form-select" name="pekerjaan_wali" required>
                                @if (!empty($wali->pekerjaan_wali))
                                    @foreach ($job as $item)
                                        <option value="{{ $item }}"
                                            {{ $item === $wali->pekerjaan_wali ? 'selected' : '' }}> {{ $item }}
                                        </option>
                                    @endforeach
                                @else
                                    @foreach ($job as $item)
                                        <option value="{{ $item }}"> {{ $item }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="pend_terakhir_wali" class="form-label">Pendidikan terakhir <span
                                    class="mandatory">*</span></label>
                            <select class="form-select" name="pend_terakhir_wali">
                                @if (!empty($wali->pend_terakhir_wali))
                                    @foreach ($pendidikan as $item)
                                        <option value="{{ $item }}"
                                            {{ $item === $wali->pend_terakhir_wali ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                @else
                                    @foreach ($pendidikan as $item)
                                        <option value="{{ $item }}">
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nama_kantor_wali" class="form-label">Nama Kantor Wali <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $wali->nama_kantor_wali ?? '' }}"
                                name="nama_kantor_wali" placeholder="e.g. Apple" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="nik_wali"class="form-label">NIK</label>
                            <input type="text" class="form-control" id="inputAddress" value="{{ $wali->nik_wali ?? '' }}"
                                name="nik_wali" placeholder="e.g. 2163688232" maxlength="16">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="alamat_wali" class="form-label">Alamat Wali <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" id="alamat_siswa"
                                value="{{ $wali->alamat_wali ?? '' }}" name="alamat_wali"
                                placeholder="e.g. Jln Danau Ranau" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="kelurahan" class="form-label">Kelurahan <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="kelurahan"
                                value="{{ $wali->kelurahan ?? '' }}" placeholder="e.g. Sawojajar" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="kecamatan" class="form-label">Kecamatan <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $wali->kecamatan ?? '' }}"
                                name="kecamatan" placeholder="e.g. Pagak" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="provinsi" class="form-label">Provinsi <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $wali->provinsi ?? '' }}"
                                name="provinsi" placeholder="e.g. Jawa Timur" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="kota_kab" class="form-label">Kota / Kabupaten <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="kota_kab"
                                value="{{ $wali->kota_kab ?? '' }}" placeholder="e.g. Malang" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="rt" class="form-label">RT <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $wali->rt ?? '' }}" name="rt"
                                placeholder="e.g. 09" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="rw" class="form-label">RW <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $wali->rw ?? '' }}" name="rw"
                                placeholder="e.g. 01" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="kode_pos" class="form-label">Kode Pos <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $wali->kode_pos ?? '' }}"
                                name="kode_pos" placeholder="e.g. 65139" required>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="no_telp" class="form-label">No. Telp Ibu <span
                                    class="mandatory">*</span></label>
                            <input type="text" class="form-control" value="{{ $wali->no_telp ?? '' }}"
                                name="no_telp" placeholder="e.g. 08213526135" required>
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

        document.getElementById("data-wali-form").addEventListener("submit", function() {
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
