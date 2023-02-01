<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Address;
use App\Models\Father;
use App\Models\Mother;
use App\Models\Pemetaan;
use App\Models\Prestasi;
use App\Models\School;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
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
    public function index()
    {
        $userAdmin = User::where('role', 'admin')->get();
        $user = User::where('role', '!=', 'admin')->orderBy('is_verif', 'asc')->orderBy('updated_at', 'desc')->get();
        $loopingUser = User::where('role', '!=', 'admin')->orderBy('is_verif', 'asc')->orderBy('updated_at', 'desc')->paginate(25);
        $incomplete = User::whereNull('foto_siswa')->orWhereNull('foto_akte')->count();
        $complete = User::all()->count() - $incomplete;

        return view('dashboard', [
            'users' => $user,
            'd_users' => $loopingUser,
            'incomplete' => $incomplete - count($userAdmin),
            'complete' => $complete,
            'active' => "dashboard"
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
        $user = auth()->user();
        $pemetaan = Pemetaan::where('user_id', $user->id)->first();

        $res = User::where('id', $user->id)->get()->toArray();
        $biodata = count(array_keys($res[0], null));

        $resfather = Father::where('user_id', $user->id)->get()->toArray();
        $resmother = Mother::where('user_id', $user->id)->get()->toArray();
        $fat_mot = count(array_keys($resfather[0], null)) + count(array_keys($resmother[0], null));

        $ressch = School::where('user_id', $user->id)->get()->toArray();
        $school = count(array_keys($ressch[0], null));

        $prestasi = Prestasi::where('user_id', $user->id)->get();

        $resad = Address::where('user_id', $user->id)->get()->toArray();
        $address = count(array_keys($resad[0], null));

        return view('dashboard-siswa', [
            'active' => 'dashboard',
            'user' => $user,
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
        $pemetaan = Pemetaan::where('user_id', auth()->user()->id)->first();
        $pdf =  PDF::loadView('student.kartu-peserta', ['user' => $user, 'pemetaan' => $pemetaan]);

        return $pdf->download('kartu-peserta.pdf');
    }

    public function downloadSuratResmi()
    {

        $user = User::find(auth()->user()->id);
        $pemetaan = Pemetaan::where('user_id', auth()->user()->id)->first();
        $pdf =  PDF::loadView('student.surat-resmi', ['user' => $user, 'pemetaan' => $pemetaan]);

        return $pdf->download('surat-resmi.pdf');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'data_siswa.xlsx');
    }
}
