<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Mother;
use Exception;
use Illuminate\Http\Request;

class MotherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mother = Mother::all();

        if (!$mother) {
            return ApiFormatter::createApi('200', 'Berhasil mengambil data ibu', $mother);
        }

        return ApiFormatter::createApi('404', 'Gagal mengambil data ibu', $mother);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mother $mother)
    {
        $motherData = Mother::find($mother);

        if (!$motherData) {
            return ApiFormatter::createApi('404', 'Data ibu tidak ditemukan', null);
        }

        return ApiFormatter::createApi('200', 'Berhasil mengambil data ibu', $motherData);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mother $mother)
    {
        $validation = $request->validate([
            "nama_lengkap_ibu" => 'nullable',
            'nik_ibu' => 'nullable',
            "pekerjaan_ibu" => 'nullable',
            'nama_kantor_ibu' => 'nullable',
            'penghasilan_ibu' => 'nullable',
            "no_telp" => 'max:25|nullable',
        ]);

        try {
            $mother->update($validation);

            return ApiFormatter::createApi('200', 'Berhasil menyimpan data ibu', $validation);
        } catch (Exception $error) {
            return ApiFormatter::createApi('400', 'Gagal menyimpan data ibu', null);
        }
    }
}
