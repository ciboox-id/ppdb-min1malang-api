<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Father;
use App\Models\Mother;
use App\Models\School;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function dataUmum()
    {
        $gol_darah = ["A", "B", "AB", "O",];

        $user = auth()->user();

        return view('student.data-umum', [
            'active' => 'data-umum',
            'user' => $user,
            'gol_darah' => $gol_darah
        ]);
    }

    public function updateDataUmum(Request $request, User $user)
    {
        try {
            $validation = $request->validate([
                'nama_lengkap' => 'required',
                'jenis_kelamin' => 'nullable',
                'nisn' => 'nullable',
                'alamat_siswa' => 'nullable',
                'tempat_lahir' => 'nullable',
                'tanggal_lahir' => 'nullable',
                'gol_darah' => 'nullable',
                'anak_ke' => 'nullable',
            ]);

            User::where('id', auth()->user()->id)->update($validation);

            return redirect()->route('dashboard.data-umum')->with('success', "Berhasil menyimpan data umum");
        } catch (Exception $err) {
            return back()->with('error', $err->getMessage());
        }
    }

    public function dataOrtu()
    {
        $user = auth()->user();

        return view('student.data-ortu', [
            'active' => 'data-ortu',
            'father' => $user->father,
            'mother' => $user->mother
        ]);
    }

    public function updateDataOrtu(Request $request)
    {
        try {
            $validationAyah = $request->validate([
                'nama_lengkap_ayah' => 'nullable',
                'nik_ayah' => 'nullable',
                'pekerjaan_ayah' => 'nullable',
                'nama_kantor_ayah' => 'nullable',
                'penghasilan_ayah' => 'nullable',
                'no_telp_ayah' => 'nullable',
            ]);

            $validationIbu = $request->validate([
                'nama_lengkap_ibu' => 'nullable',
                'nik_ibu' => 'nullable',
                'pekerjaan_ibu' => 'nullable',
                'nama_kantor_ibu' => 'nullable',
                'penghasilan_ibu' => 'nullable',
                'no_telp_ibu' => 'nullable',
            ]);

            Father::where('user_id', auth()->user()->id)->update($validationAyah);

            Mother::where('user_id', auth()->user()->id)->update($validationIbu);

            return redirect()->route('dashboard.data-ortu')->with('success', "Berhasil menyimpan data orang tua");
        } catch (Exception $err) {
            return back()->with('error', $err->getMessage());
        }
    }


    public function dataSekolah()
    {
        $school = auth()->user()->school;

        return view('student.data-sekolah', [
            'active' => 'data-sekolah',
            'school' => $school
        ]);
    }

    public function updateDataSekolah(Request $request)
    {
        try {
            $validationsSchool = $request->validate([
                'nama_sekolah' => 'nullable',
                'asal_sekolah' => 'nullable',
                'npsn' => 'nullable'
            ]);

            School::where('user_id', auth()->user()->id)->update($validationsSchool);

            return redirect()->route('dashboard.data-sekolah')->with('success', "Berhasil menyimpan data sekolah asal");
        } catch (Exception $err) {
            return back()->with('error', $err->getMessage());
        }
    }

    public function dataPrestasi()
    {
        return view('student.data-prestasi');
    }

    public function dataBerkas()
    {
        return view('student.data-berkas');
    }

    public function dataAlamat()
    {
        $address = auth()->user()->address;

        return view('student.data-alamat', [
            'active' => 'data-alamat',
            'address' => $address
        ]);
    }

    public function updateDataAlamat(Request $request)
    {
        try {
            $validationAddress = $request->validate([
                'no_kk' => 'nullable',
                'kecamatan' => 'nullable',
                'kelurahan' => 'nullable',
                'kota_kab' => 'nullable',
                'kode_pos' => 'nullable'
            ]);

            Address::where('user_id', auth()->user()->id)->update($validationAddress);

            return redirect()->route('dashboard.data-alamat')->with('success', "Berhasil menyimpan data alamat");
        } catch (Exception $err) {
            return back()->with('error', $err->getMessage());
        }
    }
}
