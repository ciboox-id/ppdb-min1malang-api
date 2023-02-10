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

                <h5 class="card-title mt-4">Tambah Guru Verifikasi</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="bi bi-cloud-upload"></i>
                    Tambah Guru
                </button>

                <div class=" overflow-auto">
                    <table class="table table-borderless datatable mt-4">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                {{-- <th scope="col">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guru as $gr)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $gr->nama_lengkap }}</td>
                                    <td>{{ $gr->email }}</td>
                                    <td>
                                        <div>
                                            {{-- <form
                                                action="{{ route('dashboard.data-siswa.delete', ['student' => $gr->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="badge rounded-pill bg-danger">
                                                    <i class="bi bi-trash"></i>
                                                    Hapus
                                                </button>
                                            </form> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal1 -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Prestasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('dashboard.data-guru.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="role" value="admin">
                        <div class="col-12">
                            <label for="email" class="form-label">Nama Lengkap</label>
                            <div class="input-group has-validation">
                                <input type="text" name="nama_lengkap"
                                    class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap"
                                    style="text-transform: uppercase" placeholder="ex: Ciboox" autofocus
                                    value="{{ old('nama_lengkap') }}">
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group has-validation">
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="ex: ciboox.id@gmail.com" autofocus value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password')
                                           is-invalid
                                        @enderror"
                                id="password" placeholder="********">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="password_confirmation" class="form-label">Konfirmasi password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation')
                                           is-invalid
                                        @enderror"
                                id="password_confirmation" placeholder="********">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 mt-3">
                            <button class="btn btn-primary w-100" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
