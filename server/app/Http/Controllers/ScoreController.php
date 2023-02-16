<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Score;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->where('is_verif', true)->with('latestPemetaan');

        if (request('search')) {
            $users->where('nama_lengkap', 'like', '%' . request('search') . '%')->orWhereHas(
                'latestPemetaan',
                function ($query) {
                    $query->where('id', 'like', '%' . request('search') . '%');
                }
            );
        }

        return view('pemetaan.index', [
            'users' => $users->get()->sortBy(function ($user) {
                return $user->latestPemetaan->id ?? null;
            })
        ]);
    }

    public function umum(User $user)
    {
        return view('pemetaan.umum', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postUmum(Request $request, User $user)
    {
        $inputs = ['kognitif', 'numeric', 'verbal', 'aktifitas', 'identitas'];
        $distanceScores = [
            "0 - 500 m" => 100,
            "500 - 1000 m" => 75,
            "1000 - 1500 m" => 50,
            "1500 - 5000 m" => 30,
            "> 5000 m" => 25,
        ];
        $distance = $user->address->jarak_rumah;

        $scoreKemandirian = 0;
        $scoreUmum = 0;
        // scoring for kemandirian
        for ($i = 0; $i <= 15; $i++) {
            foreach ($inputs as $input) {
                $scoreUmum += (int)$request->input($input . $i);
            }
            $scoreKemandirian += (int)$request->input('kemandirian' . $i);
        }

        // scroring for jarak rumah
        $scoreKemandirian += $distanceScores[$distance] ?? 0;

        // scoring for age
        $birthdate = new Carbon($user->tanggal_lahir);
        $now = Carbon::now();
        $days = $birthdate->diffInDays($now);
        $age = $days / 365;
        $resultAge = (int)number_format($age, 2);

        switch ($resultAge) {
            case $resultAge >= 7:
                $scoreKemandirian += 100;
                break;
            case $resultAge >= 6.6 && $resultAge <= 6.11:
                $scoreKemandirian += 75;
                break;
            case $resultAge >= 6 && $resultAge <= 6.5:
                $scoreKemandirian += 50;
                break;
            case $resultAge < 6:
                $scoreKemandirian += 25;
                break;
            default:
                break;
        }

        $score = Score::where('user_id', $user->id)->first();
        $data_score = ["mandiri" => $scoreKemandirian, "umum" => $scoreUmum];

        if (empty($score)) {
            $score = new Score();
            $score->umum = $data_score['umum'];
            $score->mandiri = $data_score['mandiri'];
            $score->user_id = $user->id;
            $score->name_validator_umum = auth()->user()->nama_lengkap;
            $score->save();
        } else {
            $score->update($data_score);
        }

        return back()->with('success', "Berhasil Melakukan pemetaan Wawancara umum dan Kemandirian");
    }

    public function agama(User $user)
    {
        return view('pemetaan.agama', [
            'user' => $user
        ]);
    }

    public function postAgama(Request $request, User $user)
    {
        $inputs = ['doa', 'surat', 'solat', 'mengaji', 'mengaji_lanjut'];
        $scoreAgama = 0;
        $scorePrestasi = 0;

        $score = Score::where('user_id', $user->id)->first();
        $data_score = ["agama" => $scoreAgama, "prestasi" => $scorePrestasi];

        // scoring for agama
        for ($i = 0; $i <= 28; $i++) {
            foreach ($inputs as $input) {
                $scoreAgama += (int)$request->input($input . $i);
            }
        }

        // scoring for prestasi
        $prestasi = Prestasi::where('user_id', $user->id)->where('is_valid', true)->get();
        $internasionalScores = [
            "1" => 100, "2" => 90, "3" => 80, "H1" => 70, "H2" => 60, "H3" => 50, "F" => 30,
        ];
        $nasionalScores = [
            "1" => 30, "2" => 27, "3" => 24, "H1" => 20, "H2" => 17, "H3" => 15, "F" => 10,
        ];
        $provinsiScores = [
            "1" => 15, "2" => 13, "3" => 12, "H1" => 10, "H2" => 8, "H3" => 6
        ];
        $kotaScores = [
            "1" => 10, "2" => 8, "3" => 7, "H1" => 5, "H2" => 3, "H3" => 2
        ];

        foreach ($prestasi as $pres) {
            if ($pres->tingkat === "internasional") {
                $scorePrestasi += $internasionalScores[$pres->posisi_prestasi] ?? 0;
            } else if ($pres->tingkat === "nasional") {
                $scorePrestasi += $nasionalScores[$pres->posisi_prestasi] ?? 0;
            } else if ($pres->tingkat === "provinsi") {
                $scorePrestasi += $provinsiScores[$pres->posisi_prestasi] ?? 0;
            } else if ($pres->tingkat === "kota" || $pres->tingkat === "kab") {
                $scorePrestasi += $kotaScores[$pres->posisi_prestasi] ?? 0;
            }
        }

        $score = Score::where('user_id', $user->id)->first();
        $data_score = ['agama' => $scoreAgama, 'prestasi' => $scorePrestasi];

        if (empty($score)) {
            $score = new Score();
            $score->agama = $data_score['agama'];
            $score->prestasi = $data_score['prestasi'];
            $score->name_validator_agama = auth()->user()->nama_lengkap;
            $score->user_id = $user->id;
            $score->save();
        } else {
            $score->update($data_score);
        }

        return back()->with('success', "Berhasil Melakukan pemetaan Wawancara agama dan Prestasi");
    }

    public function tahfidz(User $user)
    {
        return view('pemetaan.tahfidz', [
            'user' => $user
        ]);
    }

    public function postTahfidz(Request $request, User $user)
    {
        $inputs = ['juz30_', 'juz29_', 'juz28_', 'lembar_'];
        $scoreTahfidz = 0;

        for ($i = 0; $i <= 37; $i++) {
            foreach ($inputs as $input) {
                $inputValue = $request->input($input . $i);
                if ($inputValue !== null) {
                    $scoreTahfidz += (int) $inputValue;
                }
            }
        }


        $score = Score::where('user_id', $user->id)->first();
        $dataTahfidz = ['uji_tahfidz' => $scoreTahfidz, 'name_validator_tahfidz' => auth()->user()->nama_lengkap];

        if (empty($score)) {
            $score = new Score();
            $score->uji_tahfidz = $dataTahfidz['uji_tahfidz'];
            $score->name_validator_tahfidz = auth()->user()->nama_lengkap;
            $score->user_id = $user->id;
            $score->save();
        } else {
            $score->update($dataTahfidz);
        }

        return back()->with('success', "Berhasil Melakukan pemetaan Uji Tahfidz");
    }
}
