@extends('layouts.auth')

@section('container')
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-3 p-4">

                            <div class="card-body">

                                <div class="pt-4 pb-2 logo-images">
                                    <img src="/images/logo-icon.png" alt="">
                                    <h5 class="card-title text-center pb-0 fs-4">Daftar PPDB APPS</h5>
                                    <p class="text-center small">Daftar ke MIN 1 Kota malang</p>
                                </div>

                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <form class="row g-3" action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div class="col-12">
                                        <label for="email" class="form-label">Nama Lengkap</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="nama_lengkap"
                                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                id="nama_lengkap" style="text-transform: uppercase" placeholder="ex: Ciboox"
                                                autofocus value="{{ old('nama_lengkap') }}">
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

                                <p class="d-flex justify-content-center mt-3">Sudah punya akun? <a href="{{ route('login') }}">masuk</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
@endsection
