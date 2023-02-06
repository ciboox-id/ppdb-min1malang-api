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
                                    <img src="/images/logo-icon.png" alt="logo_min_1_malang">
                                    <h5 class="card-title text-center pb-0 fs-4">Masuk PPDB APPS</h5>
                                    <p class="text-center small">Masukkan email dan password anda</p>
                                </div>

                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session()->has('adminError'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('adminError') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session()->has('loginError'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('loginError') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif


                                <div class="alert alert-danger" role="alert">
                                    Pendaftaran Telah di tutup
                                </div>
                                <form class="row g-3" action="{{ route('auth.login') }}" method="post">
                                    @csrf
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

                                    <div class="col-12 mt-3">
                                        <button class="btn btn-primary w-100" type="submit">Masuk</button>
                                    </div>
                                </form>
                                <p class="d-flex justify-content-center mt-3">Belum punya akun? <a
                                        href="{{ route('register') }}">Daftar</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
@endsection
