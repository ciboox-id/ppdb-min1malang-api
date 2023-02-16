<?php

namespace App\Http\Controllers;

use App\Models\Father;
use App\Models\Mother;
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
