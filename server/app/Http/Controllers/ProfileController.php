<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Father;
use App\Models\Mother;
use App\Models\Pemetaan;
use App\Models\Prestasi;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 25);
        $users = User::where('role', '!=', 'admin');

        if (request('search')) {
            $users->where('nama_lengkap', 'like', '%' . request('search') . '%');
        }

        return view('profile', [
            "users" => $users->orderBy('is_verif', 'asc')->paginate($perPage),
        ]);
    }

    public function edit(User $user)
    {
        $gol_darah = ["A", "B", "AB", "O",];
        $range = [
            '< 1.000.000',
            '1.000.000 - 2.500.000',
            '2.500.000 - 5.000.000',
            '> 5.000.000'
        ];
        $pekerjaan = [
            "Belum/ Tidak Bekerja",
            "Mengurus Rumah Tangga",
            "Pelajar/ Mahasiswa",
            "Pensiunan",
            "Pegawai Negeri Sipil",
            "Tentara Nasional Indonesia",
            "Kepolisisan RI",
            "Perdagangan",
            "Petani/ Pekebun",
            "Peternak",
            "Nelayan/ Perikanan",
            "Karyawan Swasta",
            "Karyawan BUMN",
            "Karyawan Honorer",
            "Wartawan",
            "Dosen",
            "Guru",
            "Pilot",
            "Pengacara",
            "Notaris",
            "Dokter",
            "Bidan",
            "Perawat",
            "Apoteker",
            "Psikiater/ Psikolog",
            "Perangkat Desa",
            "Wiraswasta",
            "Anggota DPR-RI/DPRD",
        ];

        return view('detail-profile-edit', [
            'user' => $user,
            'father' => $user->father,
            'mother' => $user->mother,
            'gol_darah' => $gol_darah,
            'salary' => $range,
            'job' => $pekerjaan
        ]);
    }

    public function update(User $user, Request $request)
    {
        $validation = $request->validate([
            'nama_lengkap' => 'nullable',
            'jenis_kelamin' => 'nullable',
            'nisn' => 'nullable',
            'nik' => 'nullable',
            'alamat_siswa' => 'nullable',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'gol_darah' => 'nullable',
            'anak_ke' => 'nullable',
        ]);
        $validationAyah = $request->validate([
            'nama_lengkap_ayah' => 'nullable',
            'nik_ayah' => 'nullable|numeric',
            'pekerjaan_ayah' => 'nullable',
            'nama_kantor_ayah' => 'nullable',
            'penghasilan_ayah' => 'nullable',
            'no_telp_ayah' => 'nullable|numeric',
        ]);

        $validationIbu = $request->validate([
            'nama_lengkap_ibu' => 'nullable',
            'nik_ibu' => 'nullable|numeric',
            'pekerjaan_ibu' => 'nullable',
            'nama_kantor_ibu' => 'nullable',
            'penghasilan_ibu' => 'nullable',
            'no_telp_ibu' => 'nullable|numeric',
        ]);

        $validation['nama_lengkap'] = strtoupper($validation['nama_lengkap']);
        $validationAyah['nama_lengkap_ayah'] = ucfirst($validationAyah['nama_lengkap_ayah']);
        $validationIbu['nama_lengkap_ibu'] = ucfirst($validationIbu['nama_lengkap_ibu']);

        User::where('id', $user->id)->update($validation);
        Father::where('user_id', $user->id)->update($validationAyah);
        Mother::where('user_id', $user->id)->update($validationIbu);

        return back()->with('success', "Calon siswa telah diupdate");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $date = ['20/01/2023', '21/01/2023', '22/01/2023', '23/01/2023'];
        $time = ['07.30 - 08.00', '08.00 - 08.30', '09.00 - 09.30', '09.30 - 10.00', '10.30 - 11.00', '11.00 - 11.30'];
        $verifikator = User::where('role', 'admin')->get();

        return view('detail-profile', [
            'user' => $user,
            'date' => $date,
            'time' => $time,
            'verifikator' => $verifikator,
        ]);
    }

    public function indexVerifikasi(Request $request)
    {
        $perPage = $request->input('per_page', 62);

        $userVerifikasi = User::where(function ($query) {
            $query->where('foto_siswa', '!=', null)
                ->orWhere('foto_akte', '!=', null);
        })->where('role', '!=', 'admin');

        if (request('search')) {
            $userVerifikasi->where('nama_lengkap', 'like', '%' . request('search') . '%');
        }

        return view('data-verifikasi', [
            'users' => $userVerifikasi->paginate($perPage)
        ]);
    }

    public function verifSertifikat(Prestasi $prestasi)
    {
        $posisi_prestasi = ['1', '2', '3', 'H1', 'H2', 'H3', 'F'];
        $tingkat = ['kota', 'kabupaten', 'propinsi', 'nasional', 'internasional'];
        $jenis_sertifikat = ['prestasi', 'tahfidz', 'afirmasi'];

        return view('sertifikat-check', [
            'tingkat' => $tingkat,
            'posisi_prestasi' => $posisi_prestasi,
            'prestasi' => $prestasi,
            'jenis_sertifikat' => $jenis_sertifikat
        ]);

        return back()->with('success', "Calon siswa telah diverifikasi");
    }

    public function showVerifikasi(User $user)
    {
        $date = ['20/01/2023', '21/01/2023', '22/01/2023', '23/01/2023'];
        $time = ['07.30 - 08.00', '08.10 - 08.40', '08.50 - 09.20', '09.35 - 10.05', '10.15 - 10.45', '10.55 - 11.25'];

        $tahfidz = Prestasi::where('user_id', $user->id)->where('jenis_sertifikat', 'tahfidz')->first();
        $afirmasi = Prestasi::where('user_id', $user->id)->where('jenis_sertifikat', 'afirmasi')->first();
        $prestasi = Prestasi::where('user_id', $user->id)->where('jenis_sertifikat', 'prestasi')->first();

        $pemetaan = Pemetaan::where('user_id', $user->id)->orderBy('id', 'desc')->first();

        return view('verifikasi', [
            'user' => $user,
            'date' => $date,
            'time' => $time,
            'tahfidz' => $tahfidz,
            'afirmasi' => $afirmasi,
            'prestasi' => $prestasi,
            'pemetaan' => $pemetaan
        ]);
    }

    public function verifikasi(Request $request, User $user)
    {
        $validation = $request->validate([
            "pemetaan_date" => 'nullable',
            'pemetaan_time' => 'nullable',
            'name_validator' => 'nullable',
            'pesan' => 'nullable',
            'lolos' => 'nullable'
        ]);

        $validation['name_validator'] = auth()->user()->nama_lengkap;

        $pemetaan = Pemetaan::where('user_id', $user->id)->first();

        if (empty($pemetaan)) {
            $pemetaan = new Pemetaan();
            $pemetaan->pemetaan_date = $validation['pemetaan_date'];
            $pemetaan->pemetaan_time = $validation['pemetaan_time'];
            $pemetaan->name_validator = $validation['name_validator'];
            $pemetaan->pesan = $validation['pesan'];
            $pemetaan->lolos = $validation['lolos'];
            $pemetaan->user_id = $user->id;
            $pemetaan->save();
        } else {
            $pemetaan->update($validation);
        }

        $user->is_verif = true;
        $user->save();


        return back()->with('success', "Calon siswa telah diverifikasi");
    }

    public function inverifikasi(User $user)
    {
        Pemetaan::where('user_id', $user->id)->delete();

        $user->is_verif = false;
        $user->save();


        return back()->with('error', "Batal verifikasi");
    }

    public function resetPassword(User $user)
    {
        $user->password = bcrypt("12345678");
        $user->save();

        return back()->with('success', "Berhasil melakukan reset password");
    }

    public function indexGuru()
    {
        $user = User::where('role', 'admin')->get();
        return view('profile-guru', [
            'guru' => $user
        ]);
    }

    public function storeGuru(Request $request)
    {
        $validation = $request->validate([
            "nama_lengkap" => 'required',
            "email" => "required|email|unique:users,email",
            "password" => "required|min:5|max:255|confirmed",
        ]);

        $user = new User();
        $user->nama_lengkap = strtoupper($request->nama_lengkap);
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->save();


        return back()->with('success', "Berhasil menambahkan guru");
    }
}
