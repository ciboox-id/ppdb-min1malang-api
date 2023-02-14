<?php

namespace App\Http\Controllers;

use App\Models\Pemetaan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PemetaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->where('is_verif', true)->with('latestPemetaan')->get();

        return view('pemetaan.index', [
            'users' => $users->sortBy(function ($user) {
                return $user->latestPemetaan->id ?? null;
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, User $user)
    {
        $inputs = ['kognitif', 'numeric', 'verbal', 'aktifitas', 'kemandirian', 'identitas'];
        $distanceScores = [
            "0 - 500 m" => 100,
            "500 - 1000 m" => 75,
            "1000 - 1500 m" => 50,
            "1500 - 5000 m" => 30,
            "> 5000 m" => 25,
        ];
        $distance = $user->address->jarak_rumah;
        $score = 0;

        // scoring for kemandirian
        for ($i = 1; $i <= 12; $i++) {
            foreach ($inputs as $input) {
                $score += $request->input($input . $i);
            }
        }

        // scroring for jarak rumah
        $score += $distanceScores[$distance] ?? 0;

        // scoring for age
        $birthdate = new Carbon($user->tanggal_lahir);
        $now = Carbon::now();
        $days = $birthdate->diffInDays($now);
        $age = $days / 365;
        $resultAge = (int)number_format($age, 2);

        switch($resultAge) {
            case $resultAge >= 7:
                $score += 100;
                break;
            case $resultAge >= 6.6 && $resultAge <= 6.11:
                $score += 75;
                break;
            case $resultAge >= 6 && $resultAge <= 6.5:
                $score += 50;
                break;
            case $resultAge < 6:
                $score += 25;
                break;
        }

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
    public function show(User $user)
    {
        return view('pemetaan.pemetaan', [
            'user' => $user
        ]);
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
    public function destroy($id)
    {
        //
    }
}
