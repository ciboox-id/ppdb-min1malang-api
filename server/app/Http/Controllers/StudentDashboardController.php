<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Father;
use App\Models\Mother;
use App\Models\Prestasi;
use App\Models\School;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                'nisn' => 'nullable|numeric',
                'nik' => 'nullable|numeric',
                'alamat_siswa' => 'nullable',
                'tempat_lahir' => 'nullable',
                'tanggal_lahir' => 'nullable',
                'gol_darah' => 'nullable',
                'anak_ke' => 'nullable',
            ]);

            $validation['nama_lengkap'] = strtoupper($validation['nama_lengkap']);

            User::where('id', auth()->user()->id)->update($validation);

            return redirect()->route('dashboard.data-umum')->with('success', "Berhasil menyimpan data umum");
        } catch (Exception $err) {
            return back()->with('error', $err->getMessage());
        }
    }

    public function dataOrtu()
    {
        $user = auth()->user();
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

        return view('student.data-ortu', [
            'active' => 'data-ortu',
            'father' => $user->father,
            'mother' => $user->mother,
            'user' => $user,
            'salary' => $range,
            'job' => $pekerjaan
        ]);
    }

    public function updateDataOrtu(Request $request)
    {
        try {
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

            $validationAyah['nama_lengkap_ayah'] = ucfirst($validationAyah['nama_lengkap_ayah']);
            $validationIbu['nama_lengkap_ibu'] = ucfirst($validationIbu['nama_lengkap_ibu']);

            Father::where('user_id', auth()->user()->id)->update($validationAyah);

            Mother::where('user_id', auth()->user()->id)->update($validationIbu);

            return redirect()->route('dashboard.data-ortu')->with('success', "Berhasil menyimpan data orang tua");
        } catch (Exception $err) {
            return back()->with('error', $err->getMessage());
        }
    }


    public function dataSekolah()
    {
        $school = auth()->user();
        $asal = ['TK', 'BA', 'RA', 'TA'];

        return view('student.data-sekolah', [
            'active' => 'data-sekolah',
            'user' => $school,
            'asal' => $asal
        ]);
    }

    public function updateDataSekolah(Request $request)
    {
        try {
            $validationsSchool = $request->validate([
                'nama_sekolah' => 'nullable',
                'asal_sekolah' => 'nullable',
                'npsn' => 'nullable|numeric'
            ]);

            School::where('user_id', auth()->user()->id)->update($validationsSchool);

            return redirect()->route('dashboard.data-sekolah')->with('success', "Berhasil menyimpan data sekolah asal");
        } catch (Exception $err) {
            return back()->with('error', $err->getMessage());
        }
    }

    public function dataPrestasi()
    {
        $prestasi = Prestasi::where('user_id', auth()->user()->id)->get();
        $tingkat = ['kota', 'kabupaten', 'propinsi', 'nasional', 'internasional'];

        return view('student.data-prestasi', [
            'active' => 'data-prestasi',
            'prestasi' => $prestasi,
            'tingkat' => $tingkat
        ]);
    }

    public function storeDataPrestasi(Request $request)
    {
        $validationPrestasi = $request->validate([
            'prestasi' => 'required',
            'tingkat' => 'nullable',
            'sertifikat' => 'file|max:2048|required'
        ]);

        if ($request->file('sertifikat')) {
            $fileName = time() . $request->file('sertifikat')->getClientOriginalName();
            $path = $request->file('sertifikat')->storeAs('uploads/sertifikat', $fileName);
            $validationPrestasi['sertifikat'] = $path;
        }

        $validationPrestasi['user_id'] = auth()->user()->id;

        Prestasi::create($validationPrestasi);
        return redirect()->route('dashboard.data-prestasi')->with('success', "Berhasil menyimpan data prestasi");
    }

    public function deleteDataPrestasi($id)
    {
        $prestasi = Prestasi::where('id', $id)->first();
        if ($prestasi->sertifikat != null) {
            Storage::delete($prestasi->sertifikat);
        }
        $prestasi->delete();

        return redirect()->route('dashboard.data-prestasi')->with('success', "Berhasil menghapus data prestasi");
    }

    public function dataBerkas()
    {
        $berkas = auth()->user();
        return view('student.data-berkas', [
            'active' => 'data-berkas',
            'berkas' => $berkas
        ]);
    }

    public function updateDataBerkas(Request $request)
    {
        $validationBerkas = $request->validate([
            "foto_akte" => "file|max:2048|mimes:pdf",
            "foto_ket_tk" => "file|max:2048|mimes:pdf",
            "foto_siswa" => "image|file|max:2048|mimes:jpg,png.jpeg",
            "foto_kk" => "file|max:2048|mimes:pdf",
            "foto_psikolog" => "file|max:2048|mimes:pdf"
        ]);

        try {
            if ($request->file('foto_akte')) {

                if (auth()->user()->foto_akte != null) {
                    Storage::delete(auth()->user()->foto_akte);
                }

                $fileName = time() . $request->file('foto_akte')->getClientOriginalName();
                $path = $request->file('foto_akte')->storeAs('uploads/akte', $fileName);
                $validationBerkas['foto_akte'] = $path;
            }

            if ($request->file('foto_siswa')) {

                if (auth()->user()->foto_siswa != null) {
                    Storage::delete(auth()->user()->foto_siswa);
                }

                $fileName = time() . $request->file('foto_siswa')->getClientOriginalName();
                $path = $request->file('foto_siswa')->storeAs('uploads/foto_siswa', $fileName);
                $validationBerkas['foto_siswa'] = $path;
            }

            if ($request->file('foto_ket_tk')) {

                if (auth()->user()->foto_ket_tk != null) {
                    Storage::delete(auth()->user()->foto_ket_tk);
                }

                $fileName = time() . $request->file('foto_ket_tk')->getClientOriginalName();
                $path = $request->file('foto_ket_tk')->storeAs('uploads/foto_ket_tk', $fileName);
                $validationBerkas['foto_ket_tk'] = $path;
            }

            User::where('id', auth()->user()->id)->update($validationBerkas);

            return redirect()->route('dashboard.data-berkas')->with('success', "Berhasil menyimpan data berkas");
        } catch (Exception $err) {
            return back()->with('error', $err->getMessage());
        }
    }

    public function dataAlamat()
    {
        $jarak = ["0 - 500 m", "500 - 1000 m", "1000 - 1500 m", "1500 - 5000 m", "> 5000 m"];
        $address = auth()->user();

        return view('student.data-alamat', [
            'active' => 'data-alamat',
            'user' => $address,
            'jarak' => $jarak
        ]);
    }

    public function updateDataAlamat(Request $request)
    {
        try {
            $validationAddress = $request->validate([
                'no_kk' => 'nullable|numeric',
                'kecamatan' => 'nullable',
                'kelurahan' => 'nullable',
                'kota_kab' => 'nullable',
                'kode_pos' => 'nullable|numeric',
                'jarak_rumah' => 'nullable'
            ]);

            Address::where('user_id', auth()->user()->id)->update($validationAddress);

            return redirect()->route('dashboard.data-alamat')->with('success', "Berhasil menyimpan data alamat");
        } catch (Exception $err) {
            return back()->with('error', $err->getMessage());
        }
    }
}
