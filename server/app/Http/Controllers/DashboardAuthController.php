<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Father;
use App\Models\Mother;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->role === "admin") {
                return redirect()->route('dashboard.admin');
            }

            return redirect()->route('dashboard.siswa');
        }

        return back()->with("loginError", "Login Failed");
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            "nama_lengkap" => 'required',
            "email" => "required|email|unique:users,email",
            "password" => "required|min:5|max:255|confirmed",
        ]);

        $user = new User();
        $user->nama_lengkap = strtoupper($request->nama_lengkap);
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $school = new School();
        $school->user_id = $user->id;
        $school->save();

        $father = new Father();
        $father->user_id = $user->id;
        $father->save();

        $mother = new Mother();
        $mother->user_id = $user->id;
        $mother->save();
        $address = new Address();
        $address->user_id = $user->id;
        $address->save();

        return redirect()->route('login')->with('success', "Berhasil daftar, Silahkan login");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
