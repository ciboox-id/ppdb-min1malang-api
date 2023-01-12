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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "nama_lengkap" => 'required',
            "email" => "required|email|unique:users,email",
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

        $token = $user->createToken('ppdbmin1malang')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return ApiFormatter::createApi('201', 'Berhasil daftar', $response);
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|min:5|max:255",
        ]);

        if ($validation->fails()) {
            return ApiFormatter::createApi('401', $validation->errors());
        }

        $user = User::where('email', $request->email)->first();
        dd($user);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return ApiFormatter::createApi('401', "Username dan password salah");
        }

        $token = $user->createToken('ppdbmin1malang')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return ApiFormatter::createApi('201', 'Berhasil daftar', $response);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return ApiFormatter::createApi('200', 'Berhasil logout');
    }
}
