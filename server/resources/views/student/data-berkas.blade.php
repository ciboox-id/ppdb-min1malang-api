@extends('layouts.main')

@section('container')
    <h5 class="card-title">Data Berkas</h5>
    <div class="d-flex">
        <div class="col-6">
            <p>Foto Siswa</p>
            @if (!empty($user->foto_siswa))
                <a href="{{ asset($user->foto_siswa) }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset($user->foto_siswa) }}" alt="foto_siswa">
                </a>
            @else
                <div class="no-image">
                    <p>Belum upload foto diri</p>
                </div>
            @endif
        </div>
        <div class="col-6">
            <p>Foto Kartu Keluarga</p>
            @if (!empty($user->foto_akte))
                <a href="{{ asset($user->foto_akte) }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset($user->foto_akte) }}" alt="foto_siswa">
                </a>
            @else
                <div class="no-image">
                    <p>Belum upload foto Kartu Keluarga</p>
                </div>
            @endif
        </div>
    </div>
@endsection
