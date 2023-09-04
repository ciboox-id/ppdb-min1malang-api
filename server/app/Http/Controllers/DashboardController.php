<?php

namespace App\Http\Controllers;

use App\Exports\PemetaanExport;
use App\Exports\UsersExport;
use App\Exports\VerfikasiExport;
use App\Imports\ResultUserImport;
use App\Models\Address;
use App\Models\Father;
use App\Models\Mother;
use App\Models\Pemetaan;
use App\Models\Prestasi;
use App\Models\School;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use \PDF;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 25);

        $userAdmin = User::where('role', 'admin')->get();
        $user = User::where('role', '!=', 'admin')->orderBy('is_verif', 'asc')->orderBy('updated_at', 'desc')->get();
        $loopingUser = User::where('role', '!=', 'admin')->orderBy('is_verif', 'asc')->orderBy('updated_at', 'desc')->paginate($perPage);
        $incomplete = User::whereNull('foto_siswa')->orWhereNull('foto_akte')->orWhereNull('foto_ket_tk')->orWhereNull('foto_kk')->count();
        $complete = User::all()->count() - $incomplete;

        return view('dashboard', [
            'users' => $user,
            'd_users' => $loopingUser,
            'incomplete' => $incomplete - count($userAdmin),
            'complete' => $complete,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student)
    {
        try {
            School::where('user_id', $student->id)->delete();
            Address::where('user_id', $student->id)->delete();
            Father::where('user_id', $student->id)->delete();
            Mother::where('user_id', $student->id)->delete();

            if ($student->foto_akte != null) {
                Storage::delete($student->foto_akte);
            }

            if ($student->foto_siswa != null) {
                Storage::delete($student->foto_siswa);
            }

            $student->delete();

            return back()->with('successDeleteStudent', "Berhasil hapus siswa");
        } catch (Exception $error) {
            return back()->with('errorStudent', "Gagal hapus siswa");
        }
    }

    public function indexSiswa()
    {
        $userAuth = auth()->user();
        $pemetaan = Pemetaan::where('user_id', $userAuth->id)->first();

        $res = User::where('id', $userAuth->id)->get()->toArray();
        $biodata = count(array_keys($res[0], null));

        $resfather = Father::where('user_id', $userAuth->id)->get()->toArray();
        $resmother = Mother::where('user_id', $userAuth->id)->get()->toArray();
        $fat_mot = count(array_keys($resfather[0], null)) + count(array_keys($resmother[0], null));

        $ressch = School::where('user_id', $userAuth->id)->get()->toArray();
        $school = count(array_keys($ressch[0], null));

        $prestasi = Prestasi::where('user_id', $userAuth->id)->get();

        $resad = Address::where('user_id', $userAuth->id)->get()->toArray();
        $address = count(array_keys($resad[0], null));

        return view('dashboard-siswa', [
            'user' => $userAuth,
            'biodata' => $biodata,
            'prestasi' => $prestasi,
            'fatmot' => $fat_mot,
            'school' => $school,
            'address' => $address,
            'pemetaan' => $pemetaan
        ]);
    }

    public function jalurSiswa(Request $request)
    {
        $validation = $request->validate([
            'jalur' => 'required',
        ]);
        $user = User::where('id', auth()->user()->id)->update($validation);
        return back()->with('success', "Anda telah memilih jalur pendaftaran");
    }

    public function downloadKartuPeserta()
    {

        $user = User::find(auth()->user()->id);
        $pemetaan = Pemetaan::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->first();

        $date = "";
        $time = "";

        switch ($pemetaan->id) {
            case $pemetaan->id <= 32:
                $date = "20/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 32 && $pemetaan->id <= 64:
                $date = "20/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 64 && $pemetaan->id <= 96:
                $date = "20/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 96 && $pemetaan->id <= 128:
                $date = "20/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 128 && $pemetaan->id <= 160:
                $date = "20/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 160 && $pemetaan->id <= 192:
                $date = "20/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 192 && $pemetaan->id <= 224:
                $date = "21/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 224 && $pemetaan->id <= 256:
                $date = "21/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 256 && $pemetaan->id <= 288:
                $date = "21/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 288 && $pemetaan->id <= 320:
                $date = "21/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 320 && $pemetaan->id <= 352:
                $date = "21/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 352 && $pemetaan->id <= 384:
                $date = "21/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 384 && $pemetaan->id <= 416:
                $date = "22/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 416 && $pemetaan->id <= 448:
                $date = "22/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 448 && $pemetaan->id <= 480:
                $date = "22/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 480 && $pemetaan->id <= 512:
                $date = "22/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 512 && $pemetaan->id <= 544:
                $date = "22/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 545 && $pemetaan->id <= 576:
                $date = "22/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 576 && $pemetaan->id <= 608:
                $date = "23/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 608 && $pemetaan->id <= 640:
                $date = "23/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 640 && $pemetaan->id <= 672:
                $date = "23/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 672 && $pemetaan->id <= 704:
                $date = "23/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 704 && $pemetaan->id <= 736:
                $date = "23/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 736 && $pemetaan->id <= 768:
                $date = "23/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 768 && $pemetaan->id <= 800:
                $date = "24/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 800 && $pemetaan->id <= 832:
                $date = "24/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 832 && $pemetaan->id <= 864:
                $date = "24/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 864 && $pemetaan->id <= 896:
                $date = "24/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 896 && $pemetaan->id <= 928:
                $date = "24/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 928 && $pemetaan->id <= 960:
                $date = "24/02/2023";
                $time = "10.55-11.25";
                break;
        }

        $pdf =  PDF::loadView('student.kartu-peserta', ['user' => $user, 'pemetaan' => $pemetaan, 'date' => $date, 'time' => $time]);

        return $pdf->download('kartu-peserta.pdf');
    }

    public function downloadSuratResmi()
    {

        $user = User::find(auth()->user()->id);
        $pemetaan = Pemetaan::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->first();

        $date = "";
        $time = "";

        switch ($pemetaan->id) {
            case $pemetaan->id <= 32:
                $date = "20/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 32 && $pemetaan->id <= 64:
                $date = "20/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 64 && $pemetaan->id <= 96:
                $date = "20/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 96 && $pemetaan->id <= 128:
                $date = "20/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 128 && $pemetaan->id <= 160:
                $date = "20/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 160 && $pemetaan->id <= 192:
                $date = "20/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 192 && $pemetaan->id <= 224:
                $date = "21/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 224 && $pemetaan->id <= 256:
                $date = "21/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 256 && $pemetaan->id <= 288:
                $date = "21/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 288 && $pemetaan->id <= 320:
                $date = "21/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 320 && $pemetaan->id <= 352:
                $date = "21/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 352 && $pemetaan->id <= 384:
                $date = "21/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 384 && $pemetaan->id <= 416:
                $date = "22/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 416 && $pemetaan->id <= 448:
                $date = "22/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 448 && $pemetaan->id <= 480:
                $date = "22/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 480 && $pemetaan->id <= 512:
                $date = "22/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 512 && $pemetaan->id <= 544:
                $date = "22/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 545 && $pemetaan->id <= 576:
                $date = "22/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 576 && $pemetaan->id <= 608:
                $date = "23/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 608 && $pemetaan->id <= 640:
                $date = "23/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 640 && $pemetaan->id <= 672:
                $date = "23/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 672 && $pemetaan->id <= 704:
                $date = "23/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 704 && $pemetaan->id <= 736:
                $date = "23/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 736 && $pemetaan->id <= 768:
                $date = "23/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 768 && $pemetaan->id <= 800:
                $date = "24/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 800 && $pemetaan->id <= 832:
                $date = "24/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 832 && $pemetaan->id <= 864:
                $date = "24/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 864 && $pemetaan->id <= 896:
                $date = "24/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 896 && $pemetaan->id <= 928:
                $date = "24/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 928 && $pemetaan->id <= 960:
                $date = "24/02/2023";
                $time = "10.55-11.25";
                break;
        }

        $pdf =  PDF::loadView('student.surat-resmi', ['user' => $user, 'pemetaan' => $pemetaan, 'date' => $date, 'time' => $time]);

        return $pdf->download('surat-hasil-verifikasi.pdf');
    }

    public function downloadKartuPesertaFromAdmin(User $user)
    {

        $user = User::where('id', $user->id)->first();
        $pemetaan = Pemetaan::where('user_id', $user->id)->orderBy('id', 'desc')->first();

        $date = "";
        $time = "";

        switch ($pemetaan->id) {
            case $pemetaan->id <= 32:
                $date = "20/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 32 && $pemetaan->id <= 64:
                $date = "20/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 64 && $pemetaan->id <= 96:
                $date = "20/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 96 && $pemetaan->id <= 128:
                $date = "20/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 128 && $pemetaan->id <= 160:
                $date = "20/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 160 && $pemetaan->id <= 192:
                $date = "20/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 192 && $pemetaan->id <= 224:
                $date = "21/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 224 && $pemetaan->id <= 256:
                $date = "21/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 256 && $pemetaan->id <= 288:
                $date = "21/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 288 && $pemetaan->id <= 320:
                $date = "21/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 320 && $pemetaan->id <= 352:
                $date = "21/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 352 && $pemetaan->id <= 384:
                $date = "21/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 384 && $pemetaan->id <= 416:
                $date = "22/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 416 && $pemetaan->id <= 448:
                $date = "22/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 448 && $pemetaan->id <= 480:
                $date = "22/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 480 && $pemetaan->id <= 512:
                $date = "22/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 512 && $pemetaan->id <= 544:
                $date = "22/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 545 && $pemetaan->id <= 576:
                $date = "22/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 576 && $pemetaan->id <= 608:
                $date = "23/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 608 && $pemetaan->id <= 640:
                $date = "23/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 640 && $pemetaan->id <= 672:
                $date = "23/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 672 && $pemetaan->id <= 704:
                $date = "23/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 704 && $pemetaan->id <= 736:
                $date = "23/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 736 && $pemetaan->id <= 768:
                $date = "23/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 768 && $pemetaan->id <= 800:
                $date = "24/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 800 && $pemetaan->id <= 832:
                $date = "24/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 832 && $pemetaan->id <= 864:
                $date = "24/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 864 && $pemetaan->id <= 896:
                $date = "24/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 896 && $pemetaan->id <= 928:
                $date = "24/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 928 && $pemetaan->id <= 960:
                $date = "24/02/2023";
                $time = "10.55-11.25";
                break;
        }

        $pdf =  PDF::loadView('student.kartu-peserta', ['user' => $user, 'pemetaan' => $pemetaan, 'date' => $date, 'time' => $time]);

        return $pdf->download('kartu-peserta.pdf');
    }

    public function downloadSuratResmiFromAdmin(User $user)
    {

        $user = User::where('id', $user->id)->first();
        $pemetaan = Pemetaan::where('user_id', $user->id)->orderBy('id', 'desc')->first();

        $date = "";
        $time = "";

        switch ($pemetaan->id) {
            case $pemetaan->id <= 32:
                $date = "20/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 32 && $pemetaan->id <= 64:
                $date = "20/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 64 && $pemetaan->id <= 96:
                $date = "20/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 96 && $pemetaan->id <= 128:
                $date = "20/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 128 && $pemetaan->id <= 160:
                $date = "20/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 160 && $pemetaan->id <= 192:
                $date = "20/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 192 && $pemetaan->id <= 224:
                $date = "21/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 224 && $pemetaan->id <= 256:
                $date = "21/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 256 && $pemetaan->id <= 288:
                $date = "21/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 288 && $pemetaan->id <= 320:
                $date = "21/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 320 && $pemetaan->id <= 352:
                $date = "21/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 352 && $pemetaan->id <= 384:
                $date = "21/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 384 && $pemetaan->id <= 416:
                $date = "22/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 416 && $pemetaan->id <= 448:
                $date = "22/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 448 && $pemetaan->id <= 480:
                $date = "22/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 480 && $pemetaan->id <= 512:
                $date = "22/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 512 && $pemetaan->id <= 545:
                $date = "22/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 545 && $pemetaan->id <= 576:
                $date = "22/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 576 && $pemetaan->id <= 608:
                $date = "23/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 608 && $pemetaan->id <= 640:
                $date = "23/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 640 && $pemetaan->id <= 672:
                $date = "23/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 672 && $pemetaan->id <= 704:
                $date = "23/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 704 && $pemetaan->id <= 736:
                $date = "23/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 736 && $pemetaan->id <= 768:
                $date = "23/02/2023";
                $time = "10.55-11.25";
                break;
            case $pemetaan->id > 768 && $pemetaan->id <= 800:
                $date = "24/02/2023";
                $time = "07.30-08.00";
                break;
            case $pemetaan->id > 800 && $pemetaan->id <= 832:
                $date = "24/02/2023";
                $time = "08.10-08.40";
                break;
            case $pemetaan->id > 832 && $pemetaan->id <= 864:
                $date = "24/02/2023";
                $time = "08.50-09.20";
                break;
            case $pemetaan->id > 864 && $pemetaan->id <= 896:
                $date = "24/02/2023";
                $time = "09.35-10.05";
                break;
            case $pemetaan->id > 896 && $pemetaan->id <= 928:
                $date = "24/02/2023";
                $time = "10.15-10.45";
                break;
            case $pemetaan->id > 928 && $pemetaan->id <= 960:
                $date = "24/02/2023";
                $time = "10.55-11.25";
                break;
        }

        $pdf =  PDF::loadView('student.surat-resmi', ['user' => $user, 'pemetaan' => $pemetaan, 'date' => $date, 'time' => $time]);

        return $pdf->download('surat-hasil-verifikasi.pdf');
    }


    public function export()
    {
        return Excel::download(new UsersExport, 'data_siswa.xlsx');
    }

    public function exportDataVerifikasi()
    {
        return Excel::download(new VerfikasiExport, 'data_hasil_verifikasi.xlsx');
    }

    public function exportDataPemetaan()
    {
        return Excel::download(new PemetaanExport, 'data_hasil_pemetaan.xlsx');
    }

    public function importResultUser(Request $request)
    {
        $file = $request->file('excel_file');
        $path = $file->store('temp');

        try {
            Excel::import(new ResultUserImport, $path);
        } catch (\Throwable $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Berhasil update nilai pemetaan siswa');
    }
}
