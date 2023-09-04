<?php

namespace App\Http\Controllers;

use App\Models\Pemetaan;
use App\Models\Prestasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PemetaanController extends Controller
{
    public function index(Request $request)
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

    public function show(User $user)
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

    public function result()
    {
        $users = User::where('role', '!=', 'admin')->where('is_verif', true)->with(['latestPemetaan', 'score'])->get();

        return view('pemetaan.result', [
            'users' => $users->sortBy(function ($user) {
                return $user->latestPemetaan->id ?? null;
            })
        ]);
    }
}
