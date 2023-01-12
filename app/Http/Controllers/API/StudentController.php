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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                "nama_lengkap" => 'required',
                "email" => "required|email|unique",
                "password" => "required|min:5|max:255",
                "confirm_password" => "required|min:5|max:255|same:password"
            ]);

            if ($validation->fails()) {
                return ApiFormatter::createApi('401', $validation->errors());
            }

            $user = new User();
            $user->nama_lengkap = $request->nama_lengkap;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            $school = new School();
            $school->id_user = $user->id;
            $school->save();

            $father = new Father();
            $father->id_user = $user->id;
            $father->save();

            $mother = new Mother();
            $mother->id_user = $user->id;
            $mother->save();

            $address = new Address();
            $address->id_user = $user->id;
            $address->save();

            return ApiFormatter::createApi('200', 'Berhasil daftar', $user);
        } catch (Exception $error) {
            return ApiFormatter::createApi('400', 'Gagal mendaftar', null);
        }
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
            "foto_akte" => "file|mimes:png,jpg"
        ]);

        try {
            if ($request->file('foto_akte')) {
                Storage::delete($student->foto_akte);
                $fileName = time() . $request->file('foto_akte')->getClientOriginalName();
                $path = $request->file('foto_akte')->storeAs('uploads/students', $fileName);
                $validation['foto_akte'] = $path;
            }

            $result = $student->update($validation);

            return ApiFormatter::createApi('200', 'Berhasil menyimpan data siswa', $request);
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
