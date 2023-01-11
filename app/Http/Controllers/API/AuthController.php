<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use App\Models\Address;
use App\Models\Father;
use App\Models\Mother;
use App\Models\School;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                "nama_lengkap" => 'required',
                "email" => "required|email",
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
}
