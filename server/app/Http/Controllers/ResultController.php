<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Father;
use App\Models\Mother;
use App\Models\Pemetaan;
use App\Models\Prestasi;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use \PDF;

class ResultController extends Controller
{
    public function index()
    {
        return view('result.index');
    }

    public function pengumuman()
    {
        $userAuth = auth()->user();
        $pemetaan = Pemetaan::where('user_id', $userAuth->id)->first();

        $res = User::where('id', $userAuth->id)->get()->toArray();
        $biodata = count(array_keys($res[0], null));

        $resfather = Father::where('user_id', $userAuth->id)->get()->toArray();
        $resmother = Mother::where('user_id', $userAuth->id)->get()->toArray();
        $fat_mot = count(array_keys($resfather[0], null)) + count(array_keys($resmother[0], null));

        $ressch = School::where('user_id', $userAuth->id)->get()->toArray();
        $school = count(array_keys($ressch[0], null));

        $prestasi = Prestasi::where('user_id', $userAuth->id)->get();

        $resad = Address::where('user_id', $userAuth->id)->get()->toArray();
        $address = count(array_keys($resad[0], null));

        return view('student.pengumuman', [
            'user' => $userAuth,
            'biodata' => $biodata,
            'prestasi' => $prestasi,
            'fatmot' => $fat_mot,
            'school' => $school,
            'address' => $address,
            'pemetaan' => $pemetaan
        ]);
    }

    public function downloadHasilPemetaan()
    {
        $pdf =  PDF::loadView('result.index', ['user' => auth()->user()]);

        return $pdf->download('hasil-pemetaan.pdf');
    }
}
