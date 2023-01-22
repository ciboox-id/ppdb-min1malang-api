<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\Address;
use App\Models\Father;
use App\Models\Mother;
use App\Models\School;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $user = User::where('role', '!=', 'admin')->get();
        $incomplete = User::whereNull('foto_siswa')->orWhereNull('foto_akte')->count();
        $complete = User::all()->count() - $incomplete;

        return view('dashboard', [
            'users' => $user,
            'incomplete' => $incomplete - count($userAdmin),
            'complete' => $complete,
            'active' => "dashboard"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

            $student->delete();

            redirect('/dashboard')->with('successDeleteStudent', "Berhasil hapus siswa");
        } catch (Exception $error) {
            redirect('/dashboard')->with('errorStudent', "Gagal hapus siswa");
        }
    }
}
