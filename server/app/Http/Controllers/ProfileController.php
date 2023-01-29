<?php

namespace App\Http\Controllers;

use App\Models\Pemetaan;
use App\Models\User;
use Carbon\Carbon;
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

        return view('profile', [
            "users" => $users->filter(['search', 'jalur'])->orderBy('is_verif', 'asc')->get(),
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

    public function verifikasi(Request $request, User $user)
    {
        $validation = $request->validate([
            "pemetaan_date" => 'required',
            'pemetaan_time' => 'required',
            'name_validator' => 'required',
        ]);

        $pemetaan = new Pemetaan();
        $pemetaan->pemetaan_date = $validation['pemetaan_date'];
        $pemetaan->pemetaan_time = $validation['pemetaan_time'];
        $pemetaan->name_validator = $validation['name_validator'];
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
