<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ApiFormatter;
use App\Models\Address;
use App\Models\Father;
use App\Models\Mother;
use App\Models\School;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();

        if ($data) {
            return ApiFormatter::createApi('200', 'Berhasil mengambil data calon siswa', $data);
        }

        return ApiFormatter::createApi('404', 'Gagal mengambil data calon siswa', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return ApiFormatter::createApi('404', 'Siswa tidak ditemukan', null);
        }

        return ApiFormatter::createApi('200', 'Berhasil mengambil data siswa', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $student)
    {
        $validation = $request->validate([
            "nama_lengkap" => 'required',
            'nisn' => 'nullable',
            "jenis_kelamin" => 'nullable',
            "alamat_siswa" => 'nullable',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable',
            "gol_darah" => 'max:25|nullable',
            "foto_akte" => "file|mimes:png,jpg",
            "foto_siswa" => "file|mimes:png,jpg",
        ]);

        try {
            if ($request->file('foto_akte')) {

                if ($student->foto_akte != null) {
                    Storage::delete($student->foto_akte);
                }

                $fileName = time() . $request->file('foto_akte')->getClientOriginalName();
                $path = $request->file('foto_akte')->storeAs('uploads/akte', $fileName);
                $validation['foto_akte'] = $path;
            }

            if ($request->file('foto_siswa')) {

                if ($student->foto_siswa != null) {
                    Storage::delete($student->foto_siswa);
                }

                $fileName = time() . $request->file('foto_siswa')->getClientOriginalName();
                $path = $request->file('foto_siswa')->storeAs('uploads/foto_siswa', $fileName);
                $validation['foto_siswa'] = $path;
            }
            $result = $student->update($validation);

            return ApiFormatter::createApi('200', 'Berhasil menyimpan data siswa', $validation);
        } catch (Exception $error) {
            return ApiFormatter::createApi('400', 'Gagal menyimpan data siswa', null);
        }
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
            School::where('id_user', $student->id)->delete();
            Address::where('id_user', $student->id)->delete();
            Father::where('id_user', $student->id)->delete();
            Mother::where('id_user', $student->id)->delete();

            $result = $student->delete();

            return ApiFormatter::createApi('200', 'Berhasil menghapus siswa', $result);
        } catch (Exception $error) {
            return ApiFormatter::createApi('400', 'Gagal menghapus siswa');
        }
    }
}
