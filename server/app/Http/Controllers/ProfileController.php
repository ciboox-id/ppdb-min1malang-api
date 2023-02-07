<?php

namespace App\Http\Controllers;

use App\Models\Pemetaan;
use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin');

        if (request('search')) {
            $users->where('nama_lengkap', 'like', '%' . request('search') . '%');
        }

        return view('profile', [
            "users" => $users->orderBy('is_verif', 'asc')->paginate(25),
            "active" => "data-profile"
        ]);
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
            'active' => "data-profile",
            'date' => $date,
            'time' => $time,
            'verifikator' => $verifikator
        ]);
    }

    public function indexVerifikasi()
    {
        $date = "2023-02-07";
        $userVerifikasi = User::where('foto_siswa', '!=', null)
            ->where('foto_akte', '!=', null)
            ->where('foto_kk', '!=', null)
            ->where('foto_ket_tk', '!=', null)
            ->where('role', '!=', 'admin')->where('updated_at', '<=', $date)->paginate(62);

        return view('data-verifikasi', [
            'active' => 'verifikasi',
            'users' => $userVerifikasi
        ]);
    }

    public function verifSertifikat(Prestasi $prestasi)
    {
        $posisi_prestasi = ['1', '2', '3', 'H1', 'H2', 'H3', 'F'];
        $tingkat = ['kota', 'kabupaten', 'propinsi', 'nasional', 'internasional'];
        $jenis_sertifikat = ['prestasi', 'tahfidz', 'afirmasi'];

        return view('sertifikat-check', [
            'active' => 'sertifikat',
            'tingkat' => $tingkat,
            'posisi_prestasi' => $posisi_prestasi,
            'prestasi' => $prestasi,
            'jenis_sertifikat' => $jenis_sertifikat
        ]);
    }

    public function showVerifikasi(User $user)
    {
        $date = ['20/01/2023', '21/01/2023', '22/01/2023', '23/01/2023'];
        $time = ['07.30 - 08.00', '08.10 - 08.40', '08.50 - 09.20', '09.35 - 10.05', '10.15 - 10.45', '10.55 - 11.25'];

        $tahfidz = Prestasi::where('user_id', $user->id)->where('jenis_sertifikat', 'tahfidz')->first();
        $afirmasi = Prestasi::where('user_id', $user->id)->where('jenis_sertifikat', 'afirmasi')->first();
        $prestasi = Prestasi::where('user_id', $user->id)->where('jenis_sertifikat', 'prestasi')->first();

        return view('verifikasi', [
            'user' => $user,
            'active' => "verifikasi",
            'date' => $date,
            'time' => $time,
            'tahfidz' => $tahfidz,
            'afirmasi' => $afirmasi,
            'prestasi' => $prestasi
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

        $pemetaan = new Pemetaan();
        $pemetaan->pemetaan_date = $validation['pemetaan_date'];
        $pemetaan->pemetaan_time = $validation['pemetaan_time'];
        $pemetaan->name_validator = $validation['name_validator'];
        $pemetaan->pesan = $validation['pesan'];
        $pemetaan->lolos = $validation['lolos'];
        $pemetaan->user_id = $user->id;
        $pemetaan->save();

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
            'active' => 'guru',
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
