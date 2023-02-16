@extends('layouts.pemetaan')

@section('container')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
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

                    <div class="card overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title-table">Identitas diri</h5>

                            <div class="row">
                                <div class="col-2">
                                    <img src="{{ asset($user->foto_siswa) }}" class="img-thumbnail"
                                        alt="{{ $user->nama_lengkap }}">
                                    {{-- <img src="{{ asset('/images/profile-img.jpg') }}" class="img-thumbnail"
                                        alt="{{ $user->nama_lengkap }}"> --}}
                                </div>
                                <div class="col-5">
                                    <ul class="list-group">
                                        <li class="list-group-item">Nama Lengkap : {{ $user->nama_lengkap }}</li>
                                        <li class="list-group-item">Asal Sekolah : {{ $user->school->asal_sekolah }}</li>
                                        <li class="list-group-item">Nama Sekolah : {{ $user->school->nama_sekolah }}</li>
                                        <li class="list-group-item">Tempat Lahir : {{ $user->tempat_lahir }}</li>
                                        <li class="list-group-item">Tanggal Lahir: {{ $user->tanggal_lahir }}</li>
                                        <li class="list-group-item">Nama Ayah : {{ $user->father->nama_lengkap_ayah }}</li>
                                    </ul>
                                </div>
                                <div class="col-5">
                                    <ul class="list-group">
                                        <li class="list-group-item">Nama Ibu : {{ $user->mother->nama_lengkap_ibu }}</li>
                                        <li class="list-group-item">No HP Ayah : {{ $user->father->no_telp_ayah }}</li>
                                        <li class="list-group-item">Alamat Rumah : {{ $user->alamat_siswa }}</li>
                                        <li class="list-group-item">Kelurahan : {{ $user->address->kelurahan }}</li>
                                        <li class="list-group-item">Kecamatan : {{ $user->address->kecamatan }}</li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title-table">Uji Tahfidz</h5>

                            <form action="{{ route('dashboard.pemetaan.tahfidz.post', ['user' => $user->email]) }}"
                                method="post">
                                @csrf

                                <div class="col-8">
                                    <h5 class="card-title-table">Juz 30</h5>
                                    <table class="table table-bordered data-table">
                                        <thead>
                                            <tr>
                                                <th>Surah</th>
                                                <th>Tanpa Bantuan</th>
                                                <th>1 - 2 Bantuan</th>
                                                <th>3 - 4 Bantuan</th>
                                                <th> > 5 Bantuan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $surahs = [
                                                    ['name' => 'An-Nas', 'scores' => [3, 2, 1, 0]],
                                                    ['name' => 'Al-Falaq', 'scores' => [4, 3, 1, 0]],
                                                    ['name' => 'Al-Ikhlas', 'scores' => [2, 1, 0, 0]],
                                                    ['name' => 'Al-Lahab', 'scores' => [3, 2, 1, 0]],
                                                    ['name' => 'An-Nashr', 'scores' => [3, 2, 1, 0]],
                                                    ['name' => 'Al-Kafirun', 'scores' => [4, 3, 1, 0]],
                                                    ['name' => 'Al-Kautsar', 'scores' => [1, 0, 0, 0]],
                                                    ['name' => 'Al-Ma\'un', 'scores' => [4, 3, 1, 0]],
                                                    ['name' => 'Quroisy', 'scores' => [3, 2, 1, 0]],
                                                    ['name' => 'Al-Fil', 'scores' => [3, 2, 1, 0]],
                                                    ['name' => 'Al-Humazah', 'scores' => [4, 3, 1, 0]],
                                                    ['name' => 'Al-\'Ashr', 'scores' => [3, 2, 1, 0]],
                                                    ['name' => 'At-Takatsur', 'scores' => [4, 3, 1, 0]],
                                                    ['name' => 'Al-Qori\'ah', 'scores' => [5, 3, 1, 0]],
                                                    ['name' => 'Al-\'Adiyat', 'scores' => [6, 4, 2, 0]],
                                                    ['name' => 'Az-Zalzalah', 'scores' => [6, 4, 2, 0]],
                                                    ['name' => 'Al-Bayyinah', 'scores' => [8, 5, 3, 0]],
                                                    ['name' => 'Al-Qadr', 'scores' => [4, 3, 1, 0]],
                                                    ['name' => 'Al-\'Alaq', 'scores' => [8, 5, 3, 0]],
                                                    ['name' => 'At-Tin', 'scores' => [4, 3, 1, 0]],
                                                    ['name' => 'Al-Insyiroh', 'scores' => [3, 2, 1, 0]],
                                                    ['name' => 'Ad-Dhuha', 'scores' => [6, 4, 2, 0]],
                                                    ['name' => 'Al-Lail', 'scores' => [10, 7, 3, 0]],
                                                    ['name' => 'Ash-Shams', 'scores' => [9, 6, 3, 0]],
                                                    ['name' => 'AL-BALAD', 'scores' => [9, 6, 3, 0]],
                                                    ['name' => 'AL-FAJR', 'scores' => [15, 10, 5, 0]],
                                                    ['name' => 'AL-GHOSYIYAH', 'scores' => [15, 10, 5, 0]],
                                                    ['name' => 'AL-A\'LA', 'scores' => [10, 7, 3, 0]],
                                                    ['name' => 'ATH-THORIQ', 'scores' => [10, 7, 3, 0]],
                                                    ['name' => 'AL-BURUJ', 'scores' => [15, 10, 5, 0]],
                                                    ['name' => 'AL-INSYIQOQ', 'scores' => [15, 10, 5, 0]],
                                                    ['name' => 'AL-MUTHOFFIFIN', 'scores' => [18, 12, 6, 0]],
                                                    ['name' => 'AL-INFITHOR', 'scores' => [12, 8, 4, 0]],
                                                    ['name' => 'AT-TAKWIR', 'scores' => [17, 11, 6, 0]],
                                                    ['name' => 'ABASA', 'scores' => [18, 12, 6, 0]],
                                                    ['name' => 'AN-NAZI\'AT', 'scores' => [18, 12, 6, 0]],
                                                    ['name' => 'AN-NABA\'', 'scores' => [18, 12, 6, 0]],
                                                ];
                                            @endphp

                                            @foreach ($surahs as $index => $surah)
                                                <tr>
                                                    <td>{{ $surah['name'] }}</td>
                                                    @foreach ($surah['scores'] as $score)
                                                        <td>
                                                            <input type="radio" name="juz30_{{ $index }}"
                                                                value="{{ $score }}">
                                                            {{ $score }}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


                                    <h5 class="card-title-table">Juz 29</h5>
                                    <table class="table table-bordered data-table">
                                        <thead>
                                            <tr>
                                                <th>Surah</th>
                                                <th>Tanpa Bantuan</th>
                                                <th>1 - 2 Bantuan</th>
                                                <th>3 - 4 Bantuan</th>
                                                <th> > 5 Bantuan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $surahs29 = [['name' => 'Al-Mursalat', 'scores' => [9, 6, 3, 0]], ['name' => 'Al-Insan', 'scores' => [9, 6, 3, 0]], ['name' => 'Al-Qiyamah', 'scores' => [9, 6, 3, 0]], ['name' => 'Al-Muddaththir', 'scores' => [9, 6, 3, 0]], ['name' => 'Al-Muzzammil', 'scores' => [8, 5, 3, 0]], ['name' => 'Al-Jinn', 'scores' => [9, 6, 3, 0]], ['name' => 'Nuh', 'scores' => [8, 5, 3, 0]], ['name' => 'Al-Ma`arij', 'scores' => [9, 6, 3, 0]], ['name' => 'Al-Haaqqah', 'scores' => [9, 6, 3, 0]], ['name' => 'Al-Qalam', 'scores' => [9, 6, 3, 0]], ['name' => 'Al-Mulk', 'scores' => [12, 8, 4, 0]]];
                                            @endphp

                                            @foreach ($surahs29 as $index => $surah)
                                                <tr>
                                                    <td>{{ $surah['name'] }}</td>
                                                    @foreach ($surah['scores'] as $score)
                                                        <td>
                                                            <input type="radio" name="juz29_{{ $index }}"
                                                                value="{{ $score }}">
                                                            {{ $score }}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <h5 class="card-title-table">Juz 28</h5>
                                    <table class="table data-table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Surah</th>
                                                <th>Tanpa Bantuan</th>
                                                <th>1 - 2 Bantuan</th>
                                                <th>3 - 4 Bantuan</th>
                                                <th> > 5 Bantuan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $surahs28 = [['name' => 'AT-TAHRIM', 'scores' => [10, 7, 3, 0]], ['name' => 'ATH-THOLAQ', 'scores' => [10, 7, 3, 0]], ['name' => 'AT-TAQGHOBUN', 'scores' => [10, 7, 3, 0]], ['name' => 'AL-MUNAFIQUN', 'scores' => [8, 5, 3, 0]], ['name' => 'AL-JUMU\'AH', 'scores' => [8, 5, 3, 0]], ['name' => 'ASH-SHOF', 'scores' => [8, 5, 3, 0]], ['name' => 'AL-MUMTAHANAH', 'scores' => [12, 8, 4, 0]], ['name' => 'AL-HASYR', 'scores' => [17, 11, 6, 0]], ['name' => 'AL-MUJADILAH', 'scores' => [17, 11, 6, 0]]];

                                            @endphp

                                            @foreach ($surahs28 as $index => $surah)
                                                <tr>
                                                    <td>{{ $surah['name'] }}</td>
                                                    @foreach ($surah['scores'] as $score)
                                                        <td>
                                                            <input type="radio" name="juz28_{{ $index }}"
                                                                value="{{ $score }}">
                                                            {{ $score }}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <h5 class="card-title-table">Juz 1</h5>
                                    <table class="table table-bordered data-table">
                                        <thead>
                                            <tr>
                                                <th>Lebar</th>
                                                <th>Tanpa Bantuan</th>
                                                <th>1 - 2 Bantuan</th>
                                                <th>3 - 4 Bantuan</th>
                                                <th> > 5 Bantuan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $pages = [['name' => 'LEMBAR 1', 'scores' => [10, 7, 3, 0]], ['name' => 'LEMBAR 2', 'scores' => [10, 7, 3, 0]], ['name' => 'LEMBAR 3', 'scores' => [10, 7, 3, 0]], ['name' => 'LEMBAR 4', 'scores' => [10, 7, 3, 0]], ['name' => 'LEMBAR 5', 'scores' => [10, 7, 3, 0]], ['name' => 'LEMBAR 6', 'scores' => [10, 7, 3, 0]], ['name' => 'LEMBAR 7', 'scores' => [10, 7, 3, 0]], ['name' => 'LEMBAR 8', 'scores' => [10, 7, 3, 0]], ['name' => 'LEMBAR 9', 'scores' => [10, 7, 3, 0]], ['name' => 'LEMBAR 10', 'scores' => [10, 7, 3, 0]]];
                                            @endphp
                                            @foreach ($pages as $key => $page)
                                                <tr>
                                                    <td>{{ $page['name'] }}</td>
                                                    @foreach ($page['scores'] as $score)
                                                        <td>
                                                            <label>
                                                                <input type="radio" name="lembar_{{ $key + 1 }}"
                                                                    value="{{ $score }}">
                                                                {{ $score }}
                                                            </label>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                                <button type="submit" class="btn btn-primary mt-3">Nilai</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
